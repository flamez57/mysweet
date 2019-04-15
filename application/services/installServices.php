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
use hl\library\Functions\Helper;

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
        $a = Helper::removeComment($a);
        $a = explode(";", $a);
        foreach ($a as $_ak => $_av) {
            $_av = trim($_av);
            if (!empty($_av)) {
                exampleModels::getInstance()->aa($_av);
            }
        }
    }
}
