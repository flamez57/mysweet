<?php
namespace admin\models;
/**
** @ClassName: HLModel
** @Description: 数据模型示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class authRoleModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'default';
    
    /*
    ** 数据表
    */
    public $tableName = 'hl_auth_role';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function todo()
    {
        /*$sql = "select * from {$this->tableName}";
        $a = $this->query($sql);
        echo '<pre>';
        var_dump($a);
        echo '</pre>';
        foreach ($a as $_v) {
            echo $_v['id'].'--'.$_v['aa'].'<hr>';
        }
        for ($i = 0; $i < 100; $i++) {
            $this->db->insert($this->tableName, ['aa' => 'sdfsd'.$i]);
        }*/
        /*
        $c = $this->db->select($this->tableName, '*', ['id' => ['lt', 30]]);
        foreach ($c as $_v) {
            echo $_v['id'].'--'.$_v['aa'].'<hr>';
        }*/
        //$this->db->update($this->tableName, ['aa' => '李白'], ['id' => 3]);
        //$this->db->delete($this->tableName, ['id' => 2]);
        /*
        //实例化类
        $csv = new \hl\library\Tools\Excel\HLPutoutCsv();
        //设置表名
        $csv->setTableName('aa22');
        //设置表头
        $csv->setTableHead(['id', 'aa']);
        //导出数据
        $csv->putout($c);*/
        //$path = '/vagrant/data/eg.csv';
        /* $xlsx = new \hl\library\Tools\Excel\HLXLSXReader($path);
        //获取表名
        $sheetNames = $xlsx->getSheetNames();
        //读取第一个表数据
        $sheet = $xlsx->getSheet($sheetNames[3]);
        //读取数据
        $excels = $sheet->getData();
        //去除第一个行
        array_shift($excels);
        var_dump($excels);*/
        /*
        $reader = new \hl\library\Tools\Excel\HLXlsReader($path);
        //默认读取第一张表
        $excels_tmp = $reader->dump();
        //去除第一个行
        array_shift($excels_tmp);
        foreach ($excels_tmp as $_excel) {
            $excels[] = array_values($_excel);
        }
        var_dump($excels);*/
        /*$csv = new \hl\library\Tools\Excel\HLCsvReader();
        $data = $csv->getData($path);
        var_dump($data);*/

        return "exampleModels run<br>";
    }

    public function aa($sql, $db = '')
    {
        $this->query($sql, $db);
    }
}
