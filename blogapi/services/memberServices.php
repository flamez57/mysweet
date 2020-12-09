<?php
namespace blogapi\services;
/**
** @ClassName: memberServices
** @Description: 用户业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\memberModels;
use hl\HLServices;

class memberServices extends HLServices
{
    public function getMemberInfo($code)
    {
        $a = memberModels::getInstance()->getMemberIdByCode($code);
        var_dump($a);
        echo 'ok';
    }
}
