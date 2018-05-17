<?php
namespace sales_and_distribution\models;
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
    public $tableName = '';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function todo()
    {
        return "exampleModels run<br>";
    }
}