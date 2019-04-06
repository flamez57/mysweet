<?php

namespace hl\library\Tools\Files;

/**
** @ClassName: HLUploadFile
** @Description: 文件上传类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月4日 晚上22:49
** @version V1.0
*/
class HLUploadFile
{
    /*
    ** 文件操作类
    */
    private $hlFile;

    /*
    ** 文件允许上传类型
    */
    private $allowType = [
        'jpg', 'jpeg', 'gif', 'png', 'pdf', 'tiff','swf', //常见图片格式有
        'txt', 'doc', 'xls', 'ppt', 'docx', 'xlsx', 'pptx', 'csv', //常见文档格式
        'flv', 'rmvb', 'mp4', 'mvb', //常见视频格式
        'wma', 'mp3' //常见声音格式
    ];

    /*
    ** 保存路径
    */
    private $savePath = './upload/';

    /*
    ** 临时文件信息
    */
    private $originName;               //源文件名
    private $tmpFileName;              //临时文件名
    private $fileType;                 //文件类型(文件后缀)
    private $fileSize;                 //文件大小
    private $errorNum = 0;             //错误号

    /*
    ** 服务器允许上传文件大小
    */
    private $allowSize;

    /*
    ** 限制文件上传大小（字节）
    */
    private $maxSize;

    /*
    ** 是否保持原文件名
    */
    private $isOrigin;

    /*
    ** 新文件名
    */
    private $newFileName;

    /*
    ** 错误报告消息
    */
    private $errorMsg = "";

    /*
    ** 新文件信息
    */
    private $newFileInfo = [];

    /**
    ** @param $savePath string 保存路径
    ** @param $allowType array|string 允许类型
    ** @param $maxSize int 允许上传文件大小
    ** @param $isOrigin bool 是否保持文件原名
    */
    public function __construct($savePath = '', $allowType = '', $maxSize = 1000000, $isOrigin = false)
    {
        $this->hlFile = new HLFile(); //文件操作类
        $this->allowSize = $this->hlFile->allowUploadSize();
        if (!empty($savePath)) {
            $this->savePath = $savePath;
        }
        if (!empty($allowType)) {
            $this->allowType = $this->getAllowType($allowType);
        }
        if (empty($maxSize)) {
            $this->maxSize = $this->hlFile->toByte($this->allowSize);
        } else {
            $this->maxSize = $maxSize;
            $this->allowSize = $this->hlFile->byteFormat($maxSize);
        }
        $this->isOrigin = $isOrigin;
    }


    /**
    ** 调用该方法上传文件
    ** @param  $fileField string 上传文件的表单名称
    ** @return bool        如果上传成功返回数true
    */
    function upload($fileField)
    {
        $return = true;
        $this->hlFile->createDir($this->savePath);

        // 将文件上传的信息取出赋给变量
        $name = $_FILES[$fileField]['name'];
        $tmp_name = $_FILES[$fileField]['tmp_name'];
        $size = $_FILES[$fileField]['size'];
        $error = $_FILES[$fileField]['error'];

        //如果是多个文件上传则$name会是一个数组
        if (is_array($name)) {
            $errors = [];
            // 多个文件上传则循环检查上传文件
            for ($i = 0; $i < count($name); $i++) {
                //设置文件信息
                if ($this->setFiles($name[$i], $tmp_name[$i], $size[$i], $error[$i])) {
                    if (!$this->checkFileSize() || !$this->checkFileType()) {
                        $errors[] = $this->errorMsg();
                        $return = false;
                    }
                } else {
                    $errors[] = $this->errorMsg();
                    $return = false;
                }
                //重新初使化属性
                $this->setFiles();
            }

            if ($return) {
                //存放所有上传后文件名的变量数组
                $fileNames = [];
                //如果上传的多个文件都是合法的，则通过循环向服务器上传文件
                for ($i = 0; $i < count($name); $i++) {
                    if ($this->setFiles($name[$i], $tmp_name[$i], $size[$i], $error[$i])) {
                        $this->setNewFileName();
                        if (!$this->copyFile()) {
                            $errors[] = $this->errorMsg();
                            $return = false;
                        }
                        $fileNames[] = $this->newFileName;
                        $this->newFileInfo[] = [
                            'name' => $this->newFileName,
                            'type' => $this->fileType,
                            'size' => $this->fileSize,
                        ];
                    }
                }
                $this->newFileName = $fileNames;
            }
            $this->errorMsg = $errors;
            return $return;
        } else { //上传单个文件处理
            //设置文件信息
            if ($this->setFiles($name, $tmp_name, $size, $error)) {
                //上传之前先检查一下大小和类型
                if ($this->checkFileSize() && $this->checkFileType()) {
                    //为上传文件设置新文件名
                    $this->setNewFileName();
                    if ($this->copyFile()) {
                        $this->newFileInfo[] = [
                            'name' => $this->newFileName,
                            'type' => $this->fileType,
                            'size' => $this->fileSize,
                        ];
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
            if (!$return) {
                $this->errorMsg = $this->errorMsg();
            }
            return $return;
        }
    }

    /**
    ** 获取上传后的文件名称
    ** @param  void   没有参数
    ** @return string 上传后，新文件的名称， 如果是多文件上传返回数组
    */
    public function getFileName()
    {
        return $this->newFileName;
    }

    /**
    ** 获取上传后的文件名称
    ** @param  void   没有参数
    ** @return string 上传后，新文件的信息 二维数组 name文件名  type文件类型  size大小
    */
    public function getFileInfo()
    {
        return $this->newFileInfo;
    }

    /*
    ** 设置和$_FILES有关的内容
    */
    private function setFiles($name = "", $tmp_name = "", $size = 0, $error = 0)
    {
        $this->errorNum = $error;
        if ($error) {
            return false;
        }
        $this->originName = $name;
        $this->tmpFileName = $tmp_name;
        $aryStr = explode(".", $name);
        $this->fileType = strtolower($aryStr[count($aryStr) - 1]);
        $this->fileSize = $size;
        return true;
    }

    /*
    ** 设置上传后的文件名称
    */
    private function setNewFileName()
    {
        if ($this->isOrigin) {
            $this->newFileName = $this->originName;
        } else {
            $this->newFileName = $this->hlFile->setFileName('hash').'.'.$this->fileType;
        }
    }

    /*
    ** 检查上传的文件是否是合法的类型
    */
    private function checkFileType()
    {
        if (in_array(strtolower($this->fileType), $this->allowType)) {
            return true;
        } else {
            $this->errorNum = -1;
            return false;
        }
    }

    /*
    ** 检查上传的文件是否是允许的大小
    */
    private function checkFileSize()
    {
        if ($this->fileSize > $this->maxSize) {
            $this->errorNum = -2;
            return false;
        } else {
            return true;
        }
    }

    /*
    ** 复制上传文件到指定的位置
    */
    private function copyFile()
    {
        if (!$this->errorNum) {
            $path = $this->hlFile->checkPath($this->savePath);
            $path .= $this->newFileName;
            if (@move_uploaded_file($this->tmpFileName, $path)) {
                return true;
            } else {
                $this->errorNum = -3;
                return false;
            }
        } else {
            return false;
        }
    }

    /*
    ** 上传失败原因
    */
    public function errorMsg()
    {
        $errorStr = '';
        switch ($this->errorNum) {
            case UPLOAD_ERR_OK:  //0 正常，上传成功
                break;
            case UPLOAD_ERR_INI_SIZE: //1 上传文件大小超过服务器允许上传的最大值，php.ini中设置upload_max_filesize选项限制的值
                $errorStr .= "The file is too large (server).";
                break;
            case UPLOAD_ERR_FORM_SIZE: //2 上传文件大小超过HTML表单中隐藏域MAX_FILE_SIZE选项指定的值
                $errorStr .= "The file is too large (form).";
                break;
            case UPLOAD_ERR_PARTIAL: //3 文件只有部分被上传
                $errorStr .= "The file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE: //4 没有文件被上传
                $errorStr .= "No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR: //6 没有找不到临时文件夹
                $errorStr .= "The servers temporary folder is missing.";
                break;
            case UPLOAD_ERR_CANT_WRITE: //7 文件写入失败
                $errorStr .= "Failed to write to the temporary folder.";
                break;
            case UPLOAD_ERR_EXTENSION: //8 php文件上传扩展没有打开
                $errorStr .= "不支持上传文件";
                break;
            case -1:
                $errorStr .= "未允许类型";
                break;
            case -2:
                $errorStr .= "文件过大,上传的文件不能超过{$this->allowSize}";
                break;
            case -3:
                $errorStr .= "上传失败";
                break;
        }
        return $errorStr;
    }

    /**
    ** 获取可上传文件的类型
    ** @param $allowType array|string
    ** @return array
    */
    public function getAllowType($allowType)
    {
        $return = [];
        if (is_array($allowType)) {
            foreach ($allowType as $_v) {
                $return[] = $_v;
            }
        } else {
            //空格  , |  ; 分割
            $return = preg_split("/[\s,|;]+/", $allowType);
        }
        return $return;
    }

    /**
    ** 上传失败后，调用该方法则返回，上传出错信息
    ** @param  void   没有参数
    ** @return string  返回上传文件出错的信息报告，如果是多文件上传返回数组
    */
    public function getErrorMsg()
    {
        return $this->errorMsg;
    }
}
