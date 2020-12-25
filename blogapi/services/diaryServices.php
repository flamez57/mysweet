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
        $list = diaryModels::getInstance()->getByWhere(['member_id' => $memberId], 'year,content,created_at', 'id desc', '', '200');
        $outList = [];
        if ($list) {
            foreach ($list as $_v) {
                $outList[$_v['year']]['year'] = $_v['year'];
                $_v['created_at'] = date('m-d H:i:s', $_v['created_at']);
                $outList[$_v['year']]['list'][] = $_v;
            }
        }
        return ['list' => array_values($outList)];
    }
}
