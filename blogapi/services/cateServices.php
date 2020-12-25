<?php
namespace blogapi\services;
/**
** @ClassName: cateServices
** @Description: 分类业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\memberModels;
use blogapi\models\cateModels;
use blogapi\models\articleModels;
use hl\HLServices;

class cateServices extends HLServices
{
    /*
    ** front分类列表
    ** @param $code 博主账号
    */
    public function getFrontCateList($code)
    {
        $memberId = memberModels::getInstance()->getMemberIdByCode($code);
        $list = cateModels::getInstance()->getByWhere(['status' => 1], 'id,name', 'sort asc', '', '20');
        $cateIds = array_column($list, 'id');
        if (!empty($cateIds)) {
            $articleCount = articleModels::getInstance()->getByWhere(
                ['member_id' => $memberId, 'cate_id' => ['in', $cateIds], 'status' => 1, 'deleted_at' => 0],
                'cate_id,count(id) AS num',
                '',
                'cate_id',
                '30'
            );
            $articleCount = array_column($articleCount, 'num', 'cate_id');
        } else {
            $articleCount = [];
        }

        return [
            'list' => array_map(function ($_list) use ($articleCount) {
                $_list['num'] = $articleCount[$_list['id']] ?? 0;
                return $_list;
            }, $list)
        ];
    }
}
