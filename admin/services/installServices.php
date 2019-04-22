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
use application\Models\installModels;
use hl\library\Functions\Helper;

class installServices extends HLServices
{
    /**
    ** 写数据库配置
    ** @param $host string
    ** @param $username string
    ** @param $password string
    ** @param $dbname string
    ** @return bool
    */
    public function wdbConfig($host = 'localhost', $username = 'root', $password = 'root', $dbname = 'mysweet')
    {
        $cfp = ROOT_PATH.'config/db.php';
        $f = new HLFile();
        $f->createFile($cfp, true);
        $txt =<<<EOF
<?php

return [
    'default' => [
        'host' => '{$host}',
        'dbname' => '{$dbname}',
        'username' => '{$username}',
        'password' => '{$password}',
        'charset' => 'utf8',
        'port' => '3306'
    ], 
];

EOF;
        $f->writeFile($cfp, $txt);
    }

    /**
    ** 建表并插入数据
    ** @param $dbname string 数据库名
    ** @param $sqlFile string 数据文件名
    */
    public function createTableAndInsertData($dbname = 'mysweet', $sqlFile = 'default')
    {
        if (!is_string($dbname)) {
            $dbname = 'mysweet';
        }
        //创建数据库
        installModels::getInstance()->execSql("CREATE DATABASE {$dbname}");
        //导入数据文件
        $sqlf = ROOT_PATH.'data/'.$sqlFile.'.sql';
        $f = new HLFile();
        $sqls = $f->readFile($sqlf);
        $sqls = Helper::removeComment($sqls);
        $sqls = explode(";", $sqls);
        foreach ($sqls as $_ak => $_av) {
            $_av = trim($_av);
            if (!empty($_av)) {
                installModels::getInstance()->execSql($_av, $dbname);
            }
        }
    }

    /*
    ** 创建管理员账户
    */
    public function createAdmin($adminName, $adminPwd, $adminPwd2)
    {
        //
    }
}
