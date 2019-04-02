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
//        $sql = "select * from {$this->tableName}";
//        $a = $this->query($sql);
//        echo '<pre>';
//        var_dump($a);
//        echo '</pre>';
//        foreach ($a as $_v) {
//            echo $_v['id'].'--'.$_v['aa'].'<hr>';
//        }
//        for ($i = 0; $i < 100; $i++) {
//            $this->db->insert($this->tableName, ['aa' => 'sdfsd'.$i]);
//        }
        $c = $this->db->select($this->tableName, '*', ['id' => ['lt', 5]]);
//        foreach ($c as $_v) {
//            echo $_v['id'].'--'.$_v['aa'].'<hr>';
//        }
        /*
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('aa22');
        //设置表头
        $csv->setTableHead(['id', 'aa']);
        //导出数据
        $csv->putout($c);*/
        die();
        //$this->db->update($this->tableName, ['aa' => '李白'], ['id' => 3]);
        //$this->db->delete($this->tableName, ['id' => 2]);
        return "exampleModels run<br>";
    }
}
