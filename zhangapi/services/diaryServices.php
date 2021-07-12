<?php
namespace blogapi\services;
/**
** @ClassName: diaryServices
** @Description: 日记业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\memberModels;
use blogapi\models\diaryModels;
use hl\HLServices;

class diaryServices extends HLServices
{
    /*
    ** front日记列表
    ** @param $code 博主账号
    */
    public function getFrontList($code)
    {
        $memberId = memberModels::getInstance()->getMemberIdByCode($code);
        $list = diaryModels::getInstance()->getByWhere(['member_id' => $memberId], 'id,year,content,created_at', 'id desc', '', '200');
        $outList = [];
        if ($list) {
            foreach ($list as $_v) {
                $outList[$_v['year']]['year'] = $_v['year'];
                $_v['created_at'] = date('m-d  H:i ', $_v['created_at']);
                $outList[$_v['year']]['list'][] = $_v;
            }
        }
        return ['list' => array_values($outList)];
    }

    /*
    ** 管理端日记列表
    */
    public function diaryList($page, $pageSize, $param, $memberId)
    {
        $where = ['member_id' => $memberId];
        if (!empty($param['year'])) {
            $where['year'] = $param['year'];
        }
        if (!empty($param['mon'])) {
            $where['mon'] = $param['mon'];
        }
        if (!empty($param['day'])) {
            $where['day'] = $param['day'];
        }
        $start = ($page - 1) * $pageSize;
        $list = array_map(function ($_list) {
            $_list['created_at'] = date('Y-m-d H:i:s', $_list['created_at']);
            return $_list;
        }, diaryModels::getInstance()->getByWhere($where, 'id,content,created_at', 'id desc', '', " {$start},{$pageSize} "));
        $count = diaryModels::getInstance()->getCountByWhere($where);
        return ['list' => $list, 'count' => $count];
    }

    /*
    ** 写日记
    */
    public function addDiary($content, $memberId)
    {
        $data = [
            'member_id' => $memberId,
            'year' => date('Y'),
            'mon' => date('m'),
            'day' => date('d'),
            'content' => $content,
            'created_at' => TIMESTAMP
        ];
        diaryModels::getInstance()->insert($data);
        return new \stdClass();
    }
}
