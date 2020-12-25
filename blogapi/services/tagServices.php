<?php
namespace blogapi\services;
/**
** @ClassName: tagServices
** @Description: 标签业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\memberModels;
use blogapi\models\tagsModels;
use hl\HLServices;

class tagServices extends HLServices
{
    /*
    ** front标签列表
    ** @param $code 博主账号
    */
    public function getFrontTagList($code)
    {
        $memberId = memberModels::getInstance()->getMemberIdByCode($code);
        $where = ['a.member_id' => $memberId, 'a.status' => 1, 'a.deleted_at' => 0, 't.status' => 1];
        $list = tagsModels::getInstance()->tagList($where, 'DISTINCT t.id,t.name', 't.sort asc');
        return ['list' => $list];
    }
}
