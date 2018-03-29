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
    public function __construct()
    {
        parent::__construct();
    }
    
    public function todo()
    {
        echo "exampleModels run<br>";
        echo $this->db->connect('config');
    }
}