<?php
namespace admin\models\auth;
/**
** @ClassName: HLModel
** @Description: 节点表数据模型示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLModel;

class nodeModels extends HLModel
{
    /*
    ** 选择数据库
    */
    public $_db = 'default';
    
    /*
    ** 数据表
    */
    public $tableName = 'hl_auth_node';
    
    public function __construct()
    {
        parent::__construct();
    }
}
