<?php
namespace hl;

use hl\HLSington;
use hl\library\Db\HLDBFactory;
/**
** @ClassName: HLModel
** @Description: 数据模型基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLModel extends HLSington
{
    /*
    ** 数据库对象
    */
    public $db;

    public function __construct()
    {
        $this->db = HLDBFactory::factory('Mysqli');
    }
}
