<?php
namespace application\services;
/**
** @ClassName: exampleServices
** @Description: 业务层示例
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLServices;
use application\models\exampleModels;

class exampleServices extends HLServices
{
    public function todo()
    {
        echo 'exampleServices Run <br>';
        exampleModels::getInstance()->todo();
    }
}
