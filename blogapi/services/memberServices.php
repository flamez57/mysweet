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
        $memberId = memberModels::getInstance()->getMemberIdByCode($code);
        $memberInfo = memberModels::getInstance()->getByWhere(
            ['id' => $memberId],
            'code,nickname,avatar,motto,home_page,github,qq,email,content'
        );
        return ['member_info' => $memberInfo];
    }
}
