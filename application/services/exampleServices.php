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
        //实例化文件对象
        $f = new \hl\library\Tools\Files\HLFile();
        var_dump($f);
        /*
echo '创建文件夹:create_dir()<br>';
//if($file->create_dir($create_path)) echo '创建目录成功'; else '创建目录失败';
echo '<hr>创建文件:create_file()<br>';
//if($file->create_file($create_path.'创建的文件.txt',true,strtotime('1988-05-04'),strtotime('1988-05-04'))) echo '创建文件成功!'; else echo '创建文件失败!';
echo '<hr>删除非空目录:remove_dir()<br>';
//if($file->remove_dir($file_path,true)) echo '删除非空目录成功!'; else echo '删除非空目录失败!';
echo '<hr>取得文件完整名称(带后缀名):get_basename()<br>';
//echo $file->get_basename($files);
echo '<hr>取得文件后缀名:get_ext()<br>';
//echo $file->get_ext($files);
echo '<hr>取得上N级目录:father_dir()<br>';
//echo $file->father_dir($file_path,3);
echo '<hr>删除文件:unlink_file()<br>';
//if($file->unlink_file($file_path.'/index.php')) echo '删除文件成功!'; else '删除文件失败!';
echo '<hr>操作文件:handle_file()<br>';
//if($file->handle_file($file_path.'/index.php',$create_path.'/index.php','copy',true)) echo '复制文件成功!'; else echo '复制文件失败!';
//if($file->handle_file($file_path.'/index.php', $create_path.'/index.php','move',true)) echo '文件移动成功!'; else echo '文件移动失败!';
echo '<hr>操作文件夹:handle_dir()<br>';
//if($file->handle_dir($file_path,$create_path,'copy',true)) echo '复制文件夹成功!'; else echo '复制文件夹失败!';
//if($file->handle_dir($file_path,$create_path,'move',true)) echo '移动文件夹成功!'; else echo '移动文件夹失败!';
echo '<hr>取得文件夹信息:get_dir_info()<br>';
//print_r($file->get_dir_info($create_path));
echo '<hr>替换统一格式路径:dir_replace()<br>';
//echo $file->dir_replace("c:\d/d\e/d\h");
echo '<hr>取得指定模板文件:get_templtes()<br>';
//echo $file->get_templtes($create_path.'/index.php');
echo '<hr>取得指定条件的文件夹中的文件:list_dir_info()<br>';
//print_r($file->list_dir_info($create_path,true));
echo '<hr>取得文件夹信息:dir_info()<br>';
//print_r($file->dir_info($create_path));
echo '<hr>判断文件夹是否为空:is_empty()<br>';
//if($file->is_empty($create_path)) echo '不为空'; else echo'为空';
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
