<?php
/**
 * Created by PhpStorm.
 * User: flamez57
 * Date: 2019/4/4
 * Time: 16:51
 */

namespace hl\library\Tools\Files;


class HLUploadFile
{
    private $path = "./uploads";          //上传文件保存的路径
    private $allowtype = array('jpg', 'gif', 'png'); //设置限制上传文件的类型
    private $maxsize = 1000000;           //限制文件上传大小（字节）
    private $israndname = true;           //设置是否随机重命名文件， false不随机

    private $originName;              //源文件名
    private $tmpFileName;              //临时文件名
    private $fileType = "jpg";               //文件类型(文件后缀)
    private $fileSize;               //文件大小
    private $newFileName;              //新文件名
    private $errorNum = 0;             //错误号
    private $errorMess = "";             //错误报告消息

    /**
     * 用于设置成员属性（$path, $allowtype,$maxsize, $israndname）
     * 可以通过连贯操作一次设置多个属性值
     * @param  string $key 成员属性名(不区分大小写)
     * @param  mixed  $val 为成员属性设置的值
     * @return  object     返回自己对象$this，可以用于连贯操作
     */
    function set($key, $val)
    {
        $key = strtolower($key);
        if (array_key_exists($key, get_class_vars(get_class($this)))) {
            $this->setOption($key, $val);
        }
        return $this;
    }

    /**
     * 调用该方法上传文件
     * @param  string $fileFile 上传文件的表单名称
     * @return bool        如果上传成功返回数true
     */

    function upload($fileField)
    {
        $return = true;
        /* 检查文件路径是滞合法 */
        if (!$this->checkFilePath()) {
            $this->errorMess = $this->getError();
            return false;
        }
        /* 将文件上传的信息取出赋给变量 */
        $name =$fileField['file']['name'];
        $tmp_name = $fileField['file']['tmp_name'];
        $size = $fileField['file']['size'];
        $error = $fileField['file']['error'];
        /* 如果是多个文件上传则$file["name"]会是一个数组 */
        if (is_Array($name)) {
            $errors = array();
            /*多个文件上传则循环处理 ， 这个循环只有检查上传文件的作用，并没有真正上传 */
            for ($i = 0; $i < count($name); $i++) {
                /*设置文件信息 */
                if ($this->setFiles($name[$i], $tmp_name[$i], $size[$i], $error[$i])) {
                    if (!$this->checkFileSize() || !$this->checkFileType()) {
                        $errors[] = $this->getError();
                        $return = false;
                    }
                } else {
                    $errors[] = $this->getError();
                    $return = false;
                }
                /* 如果有问题，则重新初使化属性 */
                if (!$return)
                    $this->setFiles();
            }

            if ($return) {
                /* 存放所有上传后文件名的变量数组 */
                $fileNames = array();
                /* 如果上传的多个文件都是合法的，则通过销魂循环向服务器上传文件 */
                for ($i = 0; $i < count($name); $i++) {
                    if ($this->setFiles($name[$i], $tmp_name[$i], $size[$i], $error[$i])) {
                        $this->setNewFileName();
                        if (!$this->copyFile()) {
                            $errors[] = $this->getError();
                            $return = false;
                        }
                        $fileNames[] = $this->newFileName;
                    }
                }
                $this->newFileName = $fileNames;
            }
            $this->errorMess = $errors;
            return $return;
            /*上传单个文件处理方法*/
        } else {
            /* 设置文件信息 */
            if ($this->setFiles($name, $tmp_name, $size, $error)) {
                /* 上传之前先检查一下大小和类型 */
                if ($this->checkFileSize() && $this->checkFileType()) {
                    /* 为上传文件设置新文件名 */
                    $this->setNewFileName();
                    /* 上传文件  返回0为成功， 小于0都为错误 */
                    if ($this->copyFile()) {
                        return true;
                    } else {
                        $return = false;
                    }
                } else {
                    $return = false;
                }
            } else {
                $return = false;
            }
            //如果$return为false, 则出错，将错误信息保存在属性errorMess中
            if (!$return)
                $this->errorMess = $this->getError();

            return $return;
        }
    }

    /**
     * 获取上传后的文件名称
     * @param  void   没有参数
     * @return string 上传后，新文件的名称， 如果是多文件上传返回数组
     */
    public function getFileName()
    {
        return $this->newFileName;
    }

    /**
     * 上传失败后，调用该方法则返回，上传出错信息
     * @param  void   没有参数
     * @return string  返回上传文件出错的信息报告，如果是多文件上传返回数组
     */
    public function getErrorMsg()
    {
        return $this->errorMess;
    }

    /* 设置上传出错信息 */
    private function getError()
    {
        $str = "上传文件<font color='red'>{$this->originName}</font>时出错 : ";
        switch ($this->errorNum) {
            case 4:
                $str .= "没有文件被上传";
                break;
            case 3:
                $str .= "文件只有部分被上传";
                break;
            case 2:
                $str .= "上传文件的大小超过了HTML表单中MAX_FILE_SIZE选项指定的值";
                break;
            case 1:
                $str .= "上传的文件超过了php.ini中upload_max_filesize选项限制的值";
                break;
            case -1:
                $str .= "未允许类型";
                break;
            case -2:
                $str .= "文件过大,上传的文件不能超过{$this->maxsize}个字节";
                break;
            case -3:
                $str .= "上传失败";
                break;
            case -4:
                $str .= "建立存放上传文件目录失败，请重新指定上传目录";
                break;
            case -5:
                $str .= "必须指定上传文件的路径";
                break;
            default:
                $str .= "未知错误";
        }
        return $str . '<br>';
    }

    /* 设置和$_FILES有关的内容 */
    private function setFiles($name = "", $tmp_name = "", $size = 0, $error = 0)
    {
        $this->setOption('errorNum', $error);
        if ($error)
            return false;
        $this->setOption('originName', $name);
        $this->setOption('tmpFileName', $tmp_name);
        $aryStr = explode(".", $name);
        $this->setOption('fileType', strtolower($aryStr[count($aryStr) - 1]));
        $this->setOption('fileSize', $size);
        return true;
    }

    /* 为单个成员属性设置值 */
    private function setOption($key, $val)
    {
        $this->$key = $val;
    }

    /* 设置上传后的文件名称 */
    private function setNewFileName()
    {
        if ($this->israndname) {
            $this->setOption('newFileName', $this->proRandName());
        } else {
            $this->setOption('newFileName', $this->originName);
        }
    }

    /* 检查上传的文件是否是合法的类型 */
    private function checkFileType()
    {
        if (in_array(strtolower('jpg'), $this->allowtype)) {
            return true;
        } else {
            $this->setOption('errorNum', -1);
            return false;
        }
    }

    /* 检查上传的文件是否是允许的大小 */
    private function checkFileSize()
    {
        if ($this->fileSize > $this->maxsize) {
            $this->setOption('errorNum', -2);
            return false;
        } else {
            return true;
        }
    }

    /* 检查是否有存放上传文件的目录 */
    private function checkFilePath()
    {
        if (empty($this->path)) {
            $this->setOption('errorNum', -5);
            return false;
        }
        if (!file_exists($this->path) || !is_writable($this->path)) {
            if (!@mkdir($this->path, 0755)) {
                $this->setOption('errorNum', -4);
                return false;
            }
        }
        return true;
    }

    /* 设置随机文件名 */
    private function proRandName()
    {
        $fileName = date('YmdHis') . "_" . rand(100, 999);
        return $fileName . '.' . $this->fileType;
    }

    /* 复制上传文件到指定的位置 */
    private function copyFile()
    {
        if (!$this->errorNum) {
            $path = rtrim($this->path, '/') . '/';
            $path .= $this->newFileName;
            if (@move_uploaded_file($this->tmpFileName, $path)) {
                return true;
            } else {
                $this->setOption('errorNum', -3);
                return false;
            }
        } else {
            return false;
        }
    }

        private $max_size   = '2000000'; //设置上传文件的大小，此为2M
    private $rand_name   = true;   //是否采用随机命名
    private $allow_type  = array();  //允许上传的文件扩展名
    private $error     = 0;     //错误代号
    private $msg      = '';    //信息
    private $new_name   = '';    //上传后的文件名
    private $save_path   = '';    //文件保存路径
    private $uploaded   = '';    //路径.文件名
    private $file     = '';    //等待上传的文件
    private $file_type   = array();  //文件类型
    private $file_ext   = '';    //上传文件的扩展名
    private $file_name   = '';    //文件原名称
    private $file_size   = 0;     //文件大小
    private $file_tmp_name = '';    //文件临时名称

    /**
     * 构造函数，初始化
     * @param string $rand_name 是否随机命名
     * @param string $save_path 文件保存路径
     * @param string $allow_type 允许上传类型
        $allow_type可为数组  array('jpg', 'jpeg', 'png', 'gif');
        $allow_type可为字符串 'jpg|jpeg|png|gif';中间可用' ', ',', ';', '|'分割
     */
    public function __construct($rand_name=true, $save_path='./upload/', $allow_type=''){
      $this->rand_name = $rand_name;
      $this->save_path = $save_path;
      $this->allow_type = $this->get_allow_type($allow_type);
    }

    /**
     * 上传文件
     * 在上传文件前要做的工作
     * (1) 获取文件所有信息
     * (2) 判断上传文件是否合法
     * (3) 设置文件存放路径
     * (4) 是否重命名
     * (5) 上传完成
     * @param array $file 上传文件
     *     $file须包含$file['name'], $file['size'], $file['error'], $file['tmp_name']
     */
    public function upload_file($file){
      //$this->file   = $file;
      $this->file_name   = $file['name'];
      $this->file_size   = $file['size'];
      $this->error     = $file['error'];
      $this->file_tmp_name = $file['tmp_name'];

      $this->ext = $this->get_file_type($this->file_name);

      switch($this->error){
        case 0: $this->msg = ''; break;
        case 1: $this->msg = '超出了php.ini中文件大小'; break;
        case 2: $this->msg = '超出了MAX_FILE_SIZE的文件大小'; break;
        case 3: $this->msg = '文件被部分上传'; break;
        case 4: $this->msg = '没有文件上传'; break;
        case 5: $this->msg = '文件大小为0'; break;
        default: $this->msg = '上传失败'; break;
      }
      if($this->error==0 && is_uploaded_file($this->file_tmp_name)){
        //检测文件类型
        if(in_array($this->ext, $this->allow_type)==false){
          $this->msg = '文件类型不正确';
          return false;
        }
        //检测文件大小
        if($this->file_size > $this->max_size){
          $this->msg = '文件过大';
          return false;
        }
      }
      $this->set_file_name();
      $this->uploaded = $this->save_path.$this->new_name;
      if(move_uploaded_file($this->file_tmp_name, $this->uploaded)){
        $this->msg = '文件上传成功';
        return true;
      }else{
        $this->msg = '文件上传失败';
        return false;
      }
    }

    /**
    * 设置上传后的文件名
    * 当前的毫秒数和原扩展名为新文件名
    */
    public function set_file_name(){
      if($this->rand_name==true){
        $a = explode(' ', microtime());
        $t = $a[1].($a[0]*1000000);
        $this->new_name = $t.'.'.($this->ext);
      }else{
        $this->new_name = $this->file_name;
      }
    }

    /**
    * 获取上传文件类型
    * @param string $filename 目标文件
    * @return string $ext 文件类型
    */
    public function get_file_type($filename){
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      return $ext;
    }

    /**
     * 获取可上传文件的类型
     */
    public function get_allow_type($allow_type){
      $s = array();
      if(is_array($allow_type)){
        foreach($allow_type as $value){
          $s[] = $value;
        }
      }else{
        $s = preg_split("/[\s,|;]+/", $allow_type);
      }
      return $s;
    }

    //获取错误信息
    public function get_msg(){
      return $this->msg;
    }
}
