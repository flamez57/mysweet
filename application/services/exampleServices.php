<?php
namespace application\services;
/**
** @ClassName: exampleServices
** @Description: 业务层示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLServices;
use application\models\exampleModels;

class exampleServices extends HLServices
{
    public function todo()
    {
        $str = exampleModels::getInstance()->todo();
        $create_path = '/vagrant/data/掌声/在/那里';
        //实例化文件对象
        $f = new \hl\library\Tools\Files\HLFile();/*
        //创建文件夹
        if($f->createDir($create_path)) echo '创建目录成功'; else '创建目录失败';
        //创建文件
        if($f->createFile($create_path.'/创建的文件.txt',true)) echo '创建文件成功!'; else echo '创建文件失败!';
        //读取文件
        $a = $f->readFile($create_path.'/创建的文件.txt');
        //服务器允许的最大上传字节
        $b = $f->allowUploadSize();
        //字节格式化
        $c = $f->byteFormat(145236987412563);
        //删除非空目录
        $f->removeDir($create_path, true);
        //获取取得文件完整名称(带后缀名)
        echo $f->getBasename($create_path.'创建的文件.txt');
        //取得文件后缀名
        echo $f->getExt($create_path.'创建的文件.txt');
        //取得上N级目录
        echo $f->fatherDir($create_path.'创建的文件.txt', 0); echo '<br>';
        echo $f->fatherDir($create_path.'创建的文件.txt', 1);echo '<br>';
        echo $f->fatherDir($create_path.'创建的文件.txt', 2);echo '<br>';
        echo $f->fatherDir($create_path.'创建的文件.txt', 3);echo '<br>';
        //删除文件
        if($f->unlinkFile($create_path.'创建的文件.txt')) echo '删除文件成功!'; else '删除文件失败!';
        //操作文件
        if($f->handleFile($create_path.'创建的文件.txt',$create_path.'创建的文件3.txt','copy',true))
            echo '复制文件成功!';
        else
            echo '复制文件失败!';
        if($f->handleFile($create_path.'创建的文件2.txt', $create_path.'创建的文件5.txt','move',true))
            echo '文件移动成功!';
        else
            echo '文件移动失败!';
        //操作文件夹
        if($f->handleDir('/vagrant/data/掌声/在','/vagrant/data/掌声/在这好','copy',true))
            echo '复制文件夹成功!';
        else
            echo '复制文件夹失败!';
        if($f->handleDir('/vagrant/data/掌声/在这','/vagrant/data/掌声/在这是啥','move',true))
            echo '移动文件夹成功!';
        else
            echo '移动文件夹失败!';
        //读取文件内容
        echo $f->getTempltes($create_path.'创建的文件.txt');
        //重命名
        $f->reName($create_path.'创建的文件5.txt', $create_path.'没事看这里.txt');
        //取得文件夹信息
        print_r($f->getDirInfo('/vagrant/data/掌声'));
        //替换统一格式路径
        echo $f->dirReplace("c:\d/d\\e/d\h");
        */


        /*

echo '<hr>取得指定条件的文件夹中的文件:list_dir_info()<br>';
//print_r($file->list_dir_info($create_path,true));
echo '<hr>取得文件夹信息:dir_info()<br>';
//print_r($file->dir_info($create_path));
echo '<hr>判断文件夹是否为空:is_empty()<br>';
//if($file->is_empty($create_path)) echo '为空'; else echo'不为空';
echo '<hr>返回指定文件和目录的信息:list_info()<br>';
//print_r($file->list_info($create_path));
echo '<hr>返回关于打开文件的信息:open_info()<br>';
//print_r($file->open_info($create_path.'/index.php'));
echo '<hr>取得文件路径信息:get_file_type()<br>';
//print_r($file->get_file_type($create_path));
 * */
        $str .= 'exampleServices Run <br>';
        return $str;
    }
}
