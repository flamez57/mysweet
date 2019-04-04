<?php

namespace hl\library\Tools\Files;

/**
** @ClassName: HLFile
** @Description: 文件操作
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月2日 晚上22:49
** @version V1.0
*/
class HLFile
{
    /*
    ** 当前时间
    */
    private $nowTime;

    public function __construct()
    {
        $this->nowTime = time();
    }

    /**
    ** 创建多级目录
    ** @param $dir string 文件
    ** @param $mode int 权限
    ** @return bool
    */
    public function createDir($dir, $mode = 0777)
    {
        return is_dir($dir) || ($this->createDir(dirname($dir)) && mkdir($dir, $mode));
    }

    /**
    ** 创建指定路径下的指定文件
    ** @param $path string (需要包含文件名和后缀)
    ** @param $overWrite bool 是否覆盖文件
    ** @param $utime int 设置修改时间。默认是当前系统时间 时间戳
    ** @param $atime int 设置访问时间。默认是当前系统时间 时间戳
    ** @return bool
    */
    public function createFile($path, $overWrite = false, $utime = 0, $atime = 0)
    {
        $path = $this->dirReplace($path);
        $utime = empty($utime) ? $this->nowTime : $utime;
        $atime = empty($atime) ? $this->nowTime : $atime;
        if (file_exists($path) && $overWrite) {
            $this->unlinkFile($path);
        }
        $aimDir = dirname($path);
        $this->createDir($aimDir);
        return touch($path, $utime, $atime);
    }

    /**
    ** 关闭文件操作
    ** @param $path string
    ** @return bool
    */
    public function close($path)
    {
        return fclose($path);
    }

    /**
    ** 读取文件操作
    ** @param $file string 文件
    ** @return string
    */
    public function readFile($file)
    {
        return @file_get_contents($file);
    }

    /**
    ** 确定服务器的最大上传限制（字节数）
    ** @return string 服务器允许的最大上传字节数
    */
    public function allowUploadSize()
    {
        return trim(ini_get('upload_max_filesize'));
    }

    /**
    ** 字节格式化 把字节数格式为 B K M G T P E Z Y 描述的大小
    ** @param $size int 字节数
    ** @param $precision int 保留小数位数
    ** @return string
    */
    public function byteFormat($size, $precision = 2)
    {
        $units = ["B", "KB", "MB", "GB", "TB", "PB","EB","ZB","YB"];
        $pos = 0;
        while ($size >= 1024) {
             $size /= 1024;
             $pos++;
        }
        return round($size, $precision) . " " . $units[$pos];
    }

    /**
    ** 删除非空目录 (有权限就可以删除)
    ** @param $dirPath string 目录路径
    ** @return bool
    */
    public function removeDir($dirPath)
    {
        $dirName = $this->dirReplace($dirPath);
        $handle = @opendir($dirName);
        while (($file = @readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $dir = $dirName . '/' . $file;
                is_dir($dir) ? $this->removeDir($dir) : $this->unlinkFile($dir);
            }
        }
        closedir($handle);
        return @rmdir($dirName);
    }

    /**
    ** 获取完整文件名
    ** @param $filePath string 文件路径
    ** @return string
    */
    public function getBasename($filePath)
    {
        $filePath = $this->dirReplace($filePath);
        return basename($filePath);
    }

    /**
    ** 获取文件后缀名
    ** @param $filePath string 文件路径
    ** @return string
    */
    public function getExt($filePath)
    {
        $filePath = $this->dirReplace($filePath);
        return pathinfo($filePath, PATHINFO_EXTENSION);
    }

    /**
    ** 取得指定目录名称
    ** @param $filePath string 文件路径
    ** @param $num int 需要返回以上级目录的数
    ** @return string
    */
    public function fatherDir($filePath, $num = 1)
    {
        $filePath = $this->dirReplace($filePath);
        $arr = explode('/', $filePath);
        if ($num == 0) {
            return pathinfo($filePath, PATHINFO_BASENAME);
        } elseif (count($arr) < $num) {
            return '';
        }
        return $arr[(count($arr) - (1 + $num))];
    }

    /**
    ** 删除文件
    ** @param $filePath string 文件路径
    ** @return bool
    */
    public function unlinkFile($filePath)
    {
        $filePath = $this->dirReplace($filePath);
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
    }

    /**
    ** 文件操作(复制/移动)
    ** @param $oldPath string 指定要操作文件路径(需要含有文件名和后缀名)
    ** @param $newPath string 指定新文件路径（需要新的文件名和后缀名）
    ** @param $type string 文件操作类型
    ** @param $overWrite bool 是否覆盖已存在文件
    ** @return bool
    */
    public function handleFile($oldPath, $newPath, $type = 'copy', $overWrite = false)
    {
        $oldPath = $this->dirReplace($oldPath);
        $newPath = $this->dirReplace($newPath);
        if(file_exists($newPath) && $overWrite == false) {
            return false;
        } elseif (file_exists($newPath) && $overWrite == true) {
            $this->unlinkFile($newPath);
        }

        $aimDir = dirname($newPath);
        $this->createDir($aimDir);
        switch ($type) {
            case 'copy':
                return copy($oldPath, $newPath);
                break;
            case 'move':
                return rename($oldPath, $newPath);
                break;
        }
    }

    /**
    ** 文件夹操作(复制/移动)
    ** @param $oldPath string 指定要操作文件夹路径
    ** @param $newPath string 指定新文件夹路径
    ** @param $type string 操作类型
    ** @param $overWrite bool 是否覆盖文件和文件夹
    ** @return bool
    */
    public function handleDir($oldPath, $newPath, $type = 'copy', $overWrite = false)
    {
        $newPath = $this->checkPath($newPath);
        $oldPath = $this->checkPath($oldPath);
        if (!is_dir($oldPath)) {
            return false;
        }
        if (!file_exists($newPath)) {
            $this->createDir($newPath);
        }
        $dirHandle = opendir($oldPath);
        if (!$dirHandle) {
            return false;
        }
        $boolean = true;
        while (false !== ($file = readdir($dirHandle))) {
            if ($file=='.' || $file=='..') {
                continue;
            }
            if (!is_dir($oldPath.$file)) {
                $boolean = $this->handleFile($oldPath.$file, $newPath.$file, $type, $overWrite);
            } else {
                $this->handleDir($oldPath.$file, $newPath.$file, $type, $overWrite);
            }
        }
        switch ($type) {
            case 'copy':
                closedir($dirHandle);
                return $boolean;
                break;
            case 'move':
                closedir($dirHandle);
                return rmdir($oldPath);
                break;
        }
    }

    /**
    ** 替换相应的字符
    ** @param string $path 路径
    ** @return string
    */
    public function dirReplace($path)
    {
        return str_replace('//', '/', str_replace('\\', '/', $path));
    }

    /**
    ** 读取指定路径下模板文件
    ** @param $filePath string 指定路径下的文件
    ** @return string
    */
    public function getTempltes($filePath)
    {
        $filePath = $this->dirReplace($filePath);
        if (file_exists($filePath)) {
            $fp = fopen($filePath, 'r');
            $rstr = @fread($fp, filesize($filePath));
            fclose($fp);
            return $rstr;
        } else {
            return '';
        }
    }

    /**
    ** 文件重命名
    ** @param $oldName string 原名
    ** @param $newName string 新名
    ** @return bool
    */
    public function reName($oldName, $newName)
    {
        $oldName = $this->dirReplace($oldName);
        $newName = $this->dirReplace($newName);
        if (($newName != $oldName) && is_writable($oldName)) {
            return rename($oldName, $newName);
        } else {
            return false;
        }
    }

    /**
    ** 获取指定路径下的信息
    ** @param $dir string 路径
    ** @return array
    */
    public function getDirInfo($dir)
    {
        $handle = @opendir($dir);//打开指定目录
        $totalSize = 0; //大小
        $fileCout = 0; //文件数
        $directoryCount = 0; //目录数
        while (false !== ($filePath = readdir($handle))) {
            if ($filePath != "." && $filePath != "..") {
                $nextPath = $dir.'/'.$filePath;
                if (is_dir($nextPath)) {
                    $directoryCount++;
                    $resultValue = $this->getDirInfo($nextPath);
                    $totalSize += $resultValue['size'];
                    $fileCout += $resultValue['filecount'];
                    $directoryCount += $resultValue['dircount'];
                } elseif (is_file($nextPath)) {
                    $totalSize += filesize($nextPath);
                    $fileCout++;
                }
            }
        }
        closedir($handle);//关闭指定目录
        $resultValue['size'] = $totalSize;
        $resultValue['filecount'] = $fileCout;
        $resultValue['dircount'] = $directoryCount;
        return $resultValue;
    }

    /**
    ** 指定文件编码转换
    ** @param string $filePath 文件路径
    ** @param string $inputCode 原始编码
    ** @param string $outCode 输出编码
    ** @return bool
    */
    public function changeFileCode($filePath, $outCode, $inputCode = '')
    {
        $filePath = $this->dirReplace($filePath);
        //检查文件是否存在,如果存在就执行转码,返回真
        if (is_file($filePath)) {
            $content = file_get_contents($filePath);
            if (empty($inputCode)) {
                //获取当前字符串的编码
                $inputCode = mb_detect_encoding($content, ["ASCII",'UTF-8',"GB2312","GBK",'BIG5']);
            }
            //将字符编码改为utf-8
            $content = mb_convert_encoding($content, $outCode, $inputCode);
            $fp = fopen($filePath, 'w');
            return fputs($fp, $content) ? true : false;
            fclose($fp);
        }
    }

    /**
    ** 指定目录下指定条件文件编码转换
    ** @param $dirname string 目录路径
    ** @param $inputCode string 原始编码
    ** @param $outCode string 输出编码
    ** @param $isAll bool 是否转换所有子目录下文件编码
    ** @param $exts string 文件类型 文件后缀
    ** @return bool
    */
    public function changeDirFilesCode($dirname, $outCode, $inputCode, $isAll = true, $exts = '')
    {
        $dirname = $this->dirReplace($dirname);
        if (is_dir($dirname)) {
            $fh = opendir($dirname);
            while (($file = readdir($fh)) !== false) {
                if (strcmp($file , '.') == 0 || strcmp($file , '..') == 0) {
                    continue;
                }
                $filepath = $dirname.'/'.$file;
                if (is_dir($filepath) && $isAll == true) {
                    $this->changeDirFilesCode($filepath, $inputCode, $outCode, $isAll, $exts);
                } else {
                    if($this->getExt($filepath) == $exts && is_file($filepath)) {
                        $boole = $this->changeFileCode($filepath, $outCode, $inputCode);
                        if(!$boole) continue;
                    }
                }
            }
            closedir($fh);
            return true;
        } else {
            return false;
        }
    }

    /**
    ** 列出指定目录下符合条件的文件和文件夹
    ** @param $dirName string 路径
    ** @param $isAll bool 是否列出子目录中的文件
    ** @param $exts string 需要列出的后缀名文件
    ** @param $sort string 数组排序
    ** @return array
    */
    public function listDirInfo($dirName, $isAll = false, $exts = '', $sort = 'ASC')
    {
        //处理多余的/号
        $new = strrev($dirName);
        if(strpos($new,'/')==0) {
            $new = substr($new,1);
        }
        $dirName = strrev($new);

        //将字符转换成小写
        $sort = strtolower($sort);

        $files = array();

        if (is_dir($dirName)) {
            $fh = opendir($dirName);
            while (($file = readdir($fh)) !== false) {
                if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0) {
                    continue;
                }

                $filepath = $dirName.'/'.$file;

                switch ($exts) {
                    case '*': //全部
                        if (is_dir($filepath) && $isAll == true) {
                            $files = array_merge($files, $this->listDirInfo($filepath, $isAll, $exts, $sort));
                        }
                        array_push($files, $filepath);
                        break;
                    case 'folder': //文件夹
                        if (is_dir($filepath) && $isAll == true) {
                            $files = array_merge($files, $this->listDirInfo($filepath, $isAll, $exts, $sort));
                            array_push($files, $filepath);
                        } elseif (is_dir($filepath)) {
                            array_push($files, $filepath);
                        }
                        break;
                    case 'file': //文件
                        if (is_dir($filepath) && $isAll == true) {
                            $files = array_merge($files, $this->listDirInfo($filepath, $isAll, $exts, $sort));
                        } elseif (is_file($filepath)) {
                            array_push($files, $filepath);
                        }
                        break;
                    default: //指定后缀文件
                        if (is_dir($filepath) && $isAll == true) {
                            $files = array_merge($files, $this->listDirInfo($filepath, $isAll, $exts, $sort));
                        } elseif (preg_match("/\.($exts)/i", $filepath) && is_file($filepath)) {
                            array_push($files, $filepath);
                        }
                        break;
                }

                switch ($sort) {
                    case 'asc':
                        sort($files);
                        break;
                    case 'desc':
                        rsort($files);
                        break;
                    case 'nat':
                        natcasesort($files);
                        break;
                }
            }
            closedir($fh);
        }
        return $files;
    }

    /**
    ** 返回指定路径的文件夹信息，其中包含指定路径中的文件和目录
    ** @param $dir string 路径
    ** @return array
    */
    public function dirInfo($dir)
    {
        $dir = $this->dirReplace($dir);
        return scandir($dir);
    }

    /**
    ** 判断目录是否为空
    ** @param $dir string 路径
    ** @return bool
    */
    public function isEmpty($dir)
    {
        $dir = $this->dirReplace($dir);
        $handle = opendir($dir);
        while (($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                closedir($handle);
                return false;
            }
        }
        closedir($handle);
        return true;
    }

    /**
    ** 返回指定文件和目录的信息
    ** @param $file string
    ** @return ArrayObject
    */
    public function listInfo($file)
    {
        $dir = [];
        $file = $this->dirReplace($file);
        $dir['filename']   = basename($file);//返回路径中的文件名部分。
        $dir['pathname']   = realpath($file);//返回绝对路径名。
        $dir['owner']      = fileowner($file);//文件的 user ID （所有者）。
        $dir['perms']      = fileperms($file);//返回文件的 inode 编号。
        $dir['inode']      = fileinode($file);//返回文件的 inode 编号。
        $dir['group']      = filegroup($file);//返回文件的组 ID。
        $dir['path']       = dirname($file);//返回路径中的目录名称部分。
        $dir['atime']      = fileatime($file);//返回文件的上次访问时间。
        $dir['ctime']      = filectime($file);//返回文件的上次改变时间。
        $dir['perms']      = fileperms($file);//返回文件的权限。
        $dir['size']       = filesize($file);//返回文件大小。
        $dir['type']       = filetype($file);//返回文件类型。
        $dir['ext']        = is_file($file) ? pathinfo($file,PATHINFO_EXTENSION) : '';//返回文件后缀名
        $dir['mtime']      = filemtime($file);//返回文件的上次修改时间。
        $dir['isDir']      = is_dir($file);//判断指定的文件名是否是一个目录。
        $dir['isFile']     = is_file($file);//判断指定文件是否为常规的文件。
        $dir['isLink']     = is_link($file);//判断指定的文件是否是连接。
        $dir['isReadable'] = is_readable($file);//判断文件是否可读。
        $dir['isWritable'] = is_writable($file);//判断文件是否可写。
        $dir['isUpload']   = is_uploaded_file($file);//判断文件是否是通过 HTTP POST 上传的。
        return $dir;
    }

    /**
    ** 返回关于打开文件的信息
    ** @param $file 文件路径
    ** @return array
    ** 数字下标     关联键名（自 PHP 4.0.6）     说明
    ** 0            dev                     设备名
    ** 1            ino                     号码
    ** 2            mode                    inode 保护模式
    ** 3            nlink                   被连接数目
    ** 4            uid                     所有者的用户 id
    ** 5            gid                     所有者的组 id
    ** 6            rdev                    设备类型，如果是 inode 设备的话
    ** 7            size                    文件大小的字节数
    ** 8            atime                   上次访问时间（Unix 时间戳）
    ** 9            mtime                   上次修改时间（Unix 时间戳）
    ** 10           ctime                   上次改变时间（Unix 时间戳）
    ** 11           blksize                 文件系统 IO 的块大小
    ** 12           blocks                  所占据块的数目
    */
    public function openInfo($file)
    {
        $file = $this->dirReplace($file);
        $file = fopen($file, "r");
        $result = fstat($file);
        fclose($file);
        return $result;
    }

    /**
    ** 改变文件和目录的相关属性
    ** @param $file string 文件路径
    ** @param $type string 操作类型
    ** @param $chInfo string 操作信息
    ** @return bool
    */
    public function changeFile($file, $type, $chInfo)
    {
        $file = $this->dirReplace($file);
        switch ($type) {
            case 'group':
                $isOk = chgrp($file, $chInfo);//改变文件组。$chInfo 组名
                break;
            case 'mode':
                /*  改变文件模式。$chInfo的值
                    第一个数字永远是 0
                    第二个数字规定所有者的权限
                    第二个数字规定所有者所属的用户组的权限
                    第四个数字规定其他所有人的权限
                    可能的值（如需设置多个权限，请对下面的数字进行总计）：
                    1 - 执行权限
                    2 - 写权限
                    4 - 读权限
                */
                $isOk = chmod($file, $chInfo);
                break;
            case 'ower':
                $isOk = chown($file, $chInfo);//改变文件所有者。$chInfo 所有者用户名
                break;
        }
        return $isOk;
    }

    /**
    ** 取得文件路径信息
    ** @param $path string 完整路径
    ** @return array
    */
    public function getFileType($path)
    {
        $path = $this->dirReplace($path);
        //-----extension取得文件后缀名【pathinfo($path,PATHINFO_EXTENSION)】
        //-----dirname取得文件路径【pathinfo($path,PATHINFO_DIRNAME)】
        //-----basename取得文件完整文件名【pathinfo($path,PATHINFO_BASENAME)】
        //-----filename取得文件名【pathinfo($path,PATHINFO_FILENAME)】
        return pathinfo($path);
    }

    /**
    ** 取得上传文件信息
    ** @param $file file属性信息
    ** @return array
    */
    public function getUploadFileInfo($file)
    {
        $fileInfo = $_FILES[$file];//取得上传文件基本信息
        $info = array();
        $info['type']  = strtolower(
            trim(
                stripslashes(
                    preg_replace("/^(.+?);.*$/", "\\1", $fileInfo['type'])
                ),
                '"'
            )
        );//取得文件类型
        $info['temp']  = $fileInfo['tmp_name'];//取得上传文件在服务器中临时保存目录
        $info['size']  = $fileInfo['size'];//取得上传文件大小
        $info['error'] = $fileInfo['error'];//取得文件上传错误
        $info['name']  = $fileInfo['name'];//取得上传文件名
        $info['ext']   = $this->getExt($fileInfo['name']);//取得上传文件后缀
        return $info;
    }

    /**
    ** 文件命名
    ** @param $type string 命名规则
    ** @return string
    */
    public function setFileName($type)
    {
        switch ($type) {
            case 'hash':
                $name = md5(uniqid(mt_rand()));//mt_srand()以随机数md5加密来命名
                break;
            case 'time':
                $name = time();
                break;
            default:
                $name = date($type.'YmdHis', time());
                break;
        }
        return $name;
    }

    /**
    ** 文件保存路径处理
    ** @param $path string 文件路径
    ** @return string
    */
    public function checkPath($path)
    {
        //如果不是/结尾就加一个/
        return (preg_match('/\/$/', $path)) ? $path : $path . '/';
    }

    /**
    ** 下载远程文件
    ** @param $url string 远程文件路径
    ** @param $saveDir string 保存文件路径
    ** @param $fileName string 保存成的文件名
    ** @param $type int 获取方式 0 readfile | 1 curl
    ** @return array
    */
    public function downRemoteFile($url, $saveDir='', $fileName='', $type = 0)
    {
        //远程地址为空
        if (trim($url) == '') {
            return ['file_name'=>'', 'save_path'=>'', 'error'=>1, 'msg' => '远程地址为空'];
        }
        //保存路径为空就存在当前文件
        if (trim($saveDir) == '') {
            $saveDir='./';
        }
        $saveDir = $this->dirReplace($saveDir);
        //保存文件名
        if (trim($fileName) == '') {
            $ext = strrchr($url, '.');
            if (!$ext) {
                return ['file_name'=>'', 'save_path'=>'', 'error'=>3, 'msg' => '未知文件类型'];
            }
            $fileName = $this->setFileName('hash') . $ext;
        }
        //如果地址不是/结尾加个/
        if (0 !== strrpos($saveDir, '/')) {
            $saveDir .= '/';
        }
        //创建保存目录
        $this->createDir($saveDir);
        //获取远程文件所采用的方法
        if ($type) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $img = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }

        $fp2 = fopen($saveDir.$fileName, 'a');
        fwrite($fp2, $img);
        fclose($fp2);
        unset($img, $url);
        return ['file_name' => $fileName, 'save_path' => $saveDir.$fileName, 'error' => 0, 'msg' => 'success'];
    }
}
