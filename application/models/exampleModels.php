<?php
namespace application\models;
/**
** @ClassName: HLModel
** @Description: 数据模型示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class exampleModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'default';
    
    /*
    ** 数据表
    */
    public $tableName = 'example';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function todo()
    {
        $sql = "select * from {$this->tableName}";
        $a = $this->query($sql);
        echo '<pre>';
        var_dump($a);
        echo '</pre>';
        foreach ($a as $_v) {
            echo $_v['id'].'--'.$_v['aa'].'<hr>';
        }
        return "exampleModels run<br>";
    }
}
