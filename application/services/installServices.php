<?php
namespace application\services;
/**
** @ClassName: installServices
** @Description: 业务层示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLServices;
use hl\library\Tools\Files\HLFile;
use application\Models\exampleModels;

class installServices extends HLServices
{
    /**
    ** 写数据库配置
    ** @param $host string
    ** @param $username string
    ** @param $password string
    ** @return bool
    */
    public function wdbConfig($host = 'localhost', $username = 'root', $password = 'root')
    {
        $cfp = ROOT_PATH.'config/db.php';
        $f = new HLFile();
        $f->createFile($cfp, true);
        $txt =<<<EOF
<?php

return [
    'default' => [
        'host' => '{$host}',
        'username' => '{$username}',
        'password' => '{$password}',
        'charset' => 'utf8',
        'port' => '3306'
    ], 
];

EOF;
        $f->writeFile($cfp, $txt);
    }

    /*
    ** 建表并插入数据
    */
    public function createTableAndInsertData()
    {
        $sqlf = ROOT_PATH.'data/default.sql';
        $f = new HLFile();
        $a = $f->readFile($sqlf);
        $a = explode("\n", $a);
        preg_replace('/^\/\**\*\/$/', '', $a);
        $cc = false; //是否开始注释
        $i = 0; //可执行sql计数器
        $bb = ''; //可执行sql集
        foreach ($a as $_k => $_v) {
           // echo '<pre>';
            $_v = trim($_v);
            $c = strpos($_v, '--');
            //echo '</pre>';
            //var_dump($_v, $c);
            if (empty($_v) || $c === 0) {
                unset($a[$_k]);
            }
            if (!empty($_v) && $c !== 0) {
                if ($c) {
                    $bb .= substr($_v, 0, $c);
                }
                echo $_v.'<br>';
            }
        }
        $a = array_values($a);
        foreach ($a as $_a) {
            echo $_a.'<br>';
        }
        //exampleModels::getInstance()->aa($a);
        echo '2';
    }
}
