<?php
namespace admin\services;
/**
** @ClassName: exampleServices
** @Description: 业务层示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLServices;
use admin\models\auth\adminModels;
use admin\models\auth\groupMenuModels;
use admin\models\auth\groupModels;
use admin\models\auth\groupRoleModels;
use admin\models\auth\logModels;
use admin\models\auth\menuModels;
use admin\models\auth\nodeModels;
use admin\models\auth\roleModels;
use admin\models\auth\roleNodeModels;

class authServices extends HLServices
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
        //取得指定条件的文件夹中的文件
        print_r($f->listDirInfo($create_path,true));
        //取得文件夹信息
        print_r($f->dirInfo($create_path));
        //判断文件夹是否为空
        if($f->isEmpty($create_path)) echo '为空'; else echo'不为空';
        //返回指定文件和目录的信息
        print_r($f->listInfo($create_path));
        //返回关于打开文件的信息
        print_r($f->openInfo($create_path.'没事看这里.txt'));
        //取得文件路径信息
        print_r($f->getFileType($create_path));
        //改变文件和目录的相关属性
        $f->changeFile($create_path, 'mode', '0777');
        //取得上传文件信息
        var_dump($f->getUploadFileInfo('name'));
        //文件命名
        echo $f->setFileName('hash');
        //下载远程文件
        var_dump($f->downRemoteFile('https://img01.sldlcdn.com/G0/M02/00/0F/CgIAiFt28-yIKIdWAAAAPDaASdYAAAG0gM22p0AAABU885.jpg', $create_path));
        //指定文件编码
        $f->changeFileCode($create_path.'没事看这里.txt','utf-8');
        //指定文件编码
        $f->changeDirFilesCode($create_path, 'utf-8');

        //@param $savePath string 保存路径
        //@param $allowType array|string 允许类型
        //@param $maxSize int 允许上传文件大小
        //@param $isOrigin bool 是否保持文件原名
        $upload = new \hl\library\Tools\Files\HLUploadFile('','','','');
        if ($upload->upload('')) {
            //上传后的文件信息 name size type
            $upload->getFileInfo();
            //上传后的文件名
            $upload->getFileName();
        } else {
            //失败的错误信息
            $upload->getErrorMsg();
        }*/



        $start_time = microtime(1);
        $py = new \hl\library\Tools\Pinyin\HLPinyin();
        var_dump($py->pinyin('对多音字无能为力'));
        var_dump($py->pinyin('最全的PHP汉字转拼音库，比百度词典还全（dict.baidu.com）'));
        var_dump($py->pinyin('试试：㐀㐁㐄㐅㐆㐌㐖㐜'));
        var_dump($py->pinyin('一起开始数：12345'));
        var_dump($py->pinyin('海南'));
        var_dump($py->pinyin('乌鲁木齐'));
        var_dump($py->pinyin('前总理朱镕基'));

        echo number_format(microtime(1) - $start_time, 6);
echo '<hr>';
        $pym = new \hl\library\Tools\Pinyin\HLPinyinMs();
        var_dump($pym->pinyin('对多音字无能为力'));
        var_dump($pym->pinyin('最全的PHP汉字转拼音库，比百度词典还全（dict.baidu.com）'));
        var_dump($pym->pinyin('试试：㐀㐁㐄㐅㐆㐌㐖㐜'));
        var_dump($pym->pinyin('一起开始数：12345'));
        var_dump($pym->pinyin('海南'));
        var_dump($pym->pinyin('乌鲁木齐'));
        var_dump($pym->pinyin('前总理朱镕基'));
echo '<hr>';
        $pymi = new \hl\library\Tools\Pinyin\HLPinyinMini();
        var_dump($pymi->utf8To('朱镕基'));
        var_dump($pymi->utf8To('我是中国人'));
        var_dump($pymi->utf8To('PHP汉字转拼音类'));
        var_dump($pymi->utf8To('GB2312标准共收录6763个汉字，不在范围内的汉字是无法转换，如：中国前总理朱镕基的“镕”字。'));
        var_dump($pymi->utf8To('`1234567890-=QWERTYUIOP[]ASDFGHJKL;ZXCVBNM,./abcdefghijklmnopqrstuvwxyz'));

        var_dump($pymi->utf8To('朱镕基', 1));
        var_dump($pymi->utf8To('我是中国人', 1));
        var_dump($pymi->utf8To('PHP汉字转拼音类', 1));
        var_dump($pymi->utf8To('GB2312标准共收录6763个汉字，不在范围内的汉字是无法转换，如：中国前总理朱镕基的“镕”字。', 1));
        var_dump($pymi->utf8To('`1234567890-=QWERTYUIOP[]ASDFGHJKL;ZXCVBNM,./abcdefghijklmnopqrstuvwxyz', 1));

        var_dump($pymi->toFirst('朱镕基'));
        var_dump($pymi->toFirst('我是中国人'));
        var_dump($pymi->toFirst('PHP汉字转拼音类'));
        var_dump($pymi->toFirst('GB2312标准共收录6763个汉字，不在范围内的汉字是无法转换，如：中国前总理朱镕基的“镕”字。'));
        var_dump($pymi->toFirst('▂▃▄▅▆▇█▉`1234567890-=QWERTYUIOP[]ASDFGHJKL;ZXCVBNM,./abcdefghijklmnopqrstuvwxyz'));

        $str .= 'exampleServices Run <br>';
        return $str;
    }
}
