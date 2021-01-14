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

    /*
    ** 分类下拉选项
    */
    public function cateSelect()
    {
        $list = cateModels::getInstance()->getByWhere(['status' => 1], 'id,name', 'sort asc', '', '100');
        return ['list' => $list];
    }

    /*
    ** 管理分类列表
    */
    public function cateList($page, $pageSize, $memberId)
    {
        $start = ($page - 1) * $pageSize;
        $list = cateModels::getInstance()->getByWhere([], 'id,name,sort,status', '', '', " {$start},{$pageSize} ");
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
            }, $list),
            'count' => cateModels::getInstance()->getCountByWhere()
        ];
    }

    /*
    ** 编辑用详情
    */
    public function cateDetail($id)
    {
        return cateModels::getInstance()->getByWhere(['id' => $id], 'id,name,sort,status');
    }

    /*
    ** 分类保存
    */
    public function saveCate($id, $param, &$code, &$message)
    {
        if ($id == 0) {
            cateModels::getInstance()->insert($param);
        } else {
            cateModels::getInstance()->updateById($id, $param);
        }
        return new \stdClass();
    }
}
