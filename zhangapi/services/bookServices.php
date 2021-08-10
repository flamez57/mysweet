<?php
namespace zhangapi\services;

/**
** @ClassName: bookServices
** @Description: 账本业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
use blogapi\models\cateModels;
use blogapi\models\commentModels;
use blogapi\models\memberModels;
use blogapi\models\articleModels;
use blogapi\models\tagsRelevanceModels;
use blogapi\models\tagsModels;
use hl\HLServices;
use zhangapi\models\accountBookLogModels;
use zhangapi\models\accountBookMemberModels;
use zhangapi\models\accountBookMsgModels;

class bookServices extends HLServices
{
    //今日账单
    public function getTodayList($bookId)
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $list = accountBookLogModels::getInstance()->getByWhere(
            ['account_book_id' => $bookId, 'year' => $year, 'month' => $month, 'day' => $day],
            'id,sex,title,status,type,obj,money,content,created_at',
            '',
            '',
            100
        );
        //        女条         女钱         男条        男钱         总条        总钱
        $data = ['w_c' => 0, 'w_m' => 0, 'm_c' => 0, 'm_m' => 0, 't_c' => 0, 't_m' => 0];
        if (!empty($list)) {
            foreach ($list as &$_list) {
                $_list['created_at'] = date('H:i:s', $_list['created_at']);
                switch ($_list['sex']) {
                    case '0':
                        $data['w_c'] ++;
                        if ($_list['status'] == 0) { //支出
                            $data['w_m'] -= $_list['money'];
                        } elseif ($_list['status'] == 1) { //收入
                            $data['w_m'] += $_list['money'];
                        }
                        break;
                    case '1':
                        $data['m_c'] ++;
                        if ($_list['status'] == 0) { //支出
                            $data['m_m'] -= $_list['money'];
                        } elseif ($_list['status'] == 1) { //收入
                            $data['m_m'] += $_list['money'];
                        }
                        break;
                }
                $data['t_c'] ++;
                if ($_list['status'] == 0) { //支出
                    $data['t_m'] -= $_list['money'];
                } elseif ($_list['status'] == 1) { //收入
                    $data['t_m'] += $_list['money'];
                }
            }
        } else {
            $list = [];
        }
        $data['list'] = $list;
        return $data;
    }


    /*
    ** 记录详情
    */
    public function getDetail($id, $memberId = 0)
    {
        $where = ['id' => $id];
        $fields = 'title,status,type,obj,money,content,member_id';
        $detail = accountBookLogModels::getInstance($where, $fields);
        if ($detail) {
            $detail['allow_edit'] = 0;
            if ($detail['member_id'] == $memberId) {
                $detail['allow_edit'] = 1;
            }
        }
        return ['detail' => $detail];
    }

    //保存记录
    public function save($param, $id)
    {
        if ($id == 0) {
            $id = accountBookLogModels::getInstance()->insert($param);
        } else {
            $fields = 'title,status,type,obj,money,content,log';
            $detail = accountBookLogModels::getInstance(['id' => $id], $fields);
            $log = $detail['log'];
            unset($detail['log']);
            if (empty($log)) {
                $log = json_encode($detail, true);
            } else {
                $log = json_decode($log, true);
                array_push($log, $detail);
                $log = json_encode($log, true);
            }
            $param['log'] = $log;
            accountBookLogModels::getInstance()->updateById($id, $param);
        }
        return ['id' => $id];
    }

    //汇总
    public function getAllList($bookId, $year, $month)
    {
        $list = accountBookLogModels::getInstance()->getByWhere(
            ['account_book_id' => $bookId, 'year' => $year, 'month' => $month],
            'id,day,sex,title,status,type,obj,money,content,created_at',
            '',
            '',
            100
        );
        $data = ['t_c' => 0, 't_m' => 0, 'type_list' => [], 'type_lists' => [], 'obj_list' => [], 'obj_lists' => []];
        if (!empty($list)) {
            foreach ($list as &$_list) {
                $_list['created_at'] = date('H:i:s', $_list['created_at']);
                $data['t_c'] ++;
                if ($_list['status'] == 0) { //支出
                    $data['t_m'] -= $_list['money'];
                } elseif ($_list['status'] == 1) { //收入
                    $data['t_m'] += $_list['money'];
                }
                if (isset($data['type_list'][$_list['type']])) {
                    if ($_list['status'] == 0) { //支出
                        $data['type_list'][$_list['type']] -= $_list['money'];
                    } elseif ($_list['status'] == 1) { //收入
                        $data['type_list'][$_list['type']] += $_list['money'];
                    }
                } else {
                    $data['type_list'][$_list['type']] = 0;
                    if ($_list['status'] == 0) { //支出
                        $data['type_list'][$_list['type']] -= $_list['money'];
                    } elseif ($_list['status'] == 1) { //收入
                        $data['type_list'][$_list['type']] += $_list['money'];
                    }
                }
                if (isset($data['obj_list'][$_list['obj']])) {
                    if ($_list['status'] == 0) { //支出
                        $data['obj_list'][$_list['obj']] -= $_list['money'];
                    } elseif ($_list['status'] == 1) { //收入
                        $data['obj_list'][$_list['obj']] += $_list['money'];
                    }
                } else {
                    $data['obj_list'][$_list['obj']] = 0;
                    if ($_list['status'] == 0) { //支出
                        $data['obj_list'][$_list['obj']] -= $_list['money'];
                    } elseif ($_list['status'] == 1) { //收入
                        $data['obj_list'][$_list['obj']] += $_list['money'];
                    }
                }
            }
            if (!empty($data['type_list'])) {
                foreach ($data['type_list'] as $_k => $_v) {
                    $data['type_lists'][] = [
                        'name' => accountBookLogModels::TYPE_MAP[$_k],
                        'money' => $_v,
                        'rate' => round($_v * 100 /$data['t_m'])
                    ];
                }
            }
            if (!empty($data['obj_list'])) {
                foreach ($data['obj_list'] as $_k => $_v) {
                    $data['obj_lists'][] = [
                        'name' => accountBookLogModels::OBJ_MAP[$_k],
                        'money' => $_v,
                        'rate' => round($_v * 100 /$data['t_m'])
                    ];
                }
            }
        } else {
            $list = [];
        }
        $data['list'] = $list;
        return $data;
    }

    //类型列表
    public function typeList()
    {
        $map = accountBookLogModels::TYPE_MAP;
        foreach ($map as $_k => $_map) {
            $maps[] = ['id' => $_k, 'name' => $_map];
        }
        return ['list' => $maps];
    }

    //对象列表
    public function objList()
    {
        $obj = accountBookLogModels::OBJ_MAP;
        foreach ($obj as $_k => $_obj) {
            $objs[] = ['id' => $_k, 'name' => $_obj];
        }
        return ['list' => $objs];
    }

    //年月选项
    public function yearMonth()
    {
        $nowYear = date('Y');
        for ($i = 2021; $i <= $nowYear; $i++) {
            $years[] = ['id' => $i, 'name' => $i.'年'];
        }
        $months = [
            ['id' => '01', 'name' => '一月'],
            ['id' => '02', 'name' => '二月'],
            ['id' => '03', 'name' => '三月'],
            ['id' => '04', 'name' => '四月'],
            ['id' => '05', 'name' => '五月'],
            ['id' => '06', 'name' => '六月'],
            ['id' => '07', 'name' => '七月'],
            ['id' => '08', 'name' => '八月'],
            ['id' => '09', 'name' => '九月'],
            ['id' => '10', 'name' => '十月'],
            ['id' => '11', 'name' => '冬月'],
            ['id' => '12', 'name' => '腊月'],
        ];
        return ['years' => $years, 'month' => $months];
    }

    //消息列表
    public function messageList($memberId)
    {
        $member = accountBookMemberModels::getInstance()->getByWhere(['id' => $memberId], 'mobile');
        $list1 = accountBookMsgModels::getInstance()->getByWhere(
            ['accept_member_id' => $memberId],
            'id,type,created_at',
            '',
            '',
            100
        );
        $list2 = accountBookMsgModels::getInstance()->getByWhere(
            ['accept_mobile' => $member['mobile']],
            'id,type,created_at',
            '',
            '',
            100
        );
        $list = [];
        $ids = [];
        if (!empty($list1)) {
            foreach ($list1 as $_v) {
                $_v['type_desc'] = accountBookMsgModels::TYPE_MAP[$_v['type']];
                $list[] = $_v;
                $ids[] = $_v['id'];
            }
        }
        if (!empty($list2)) {
            foreach ($list2 as $__v) {
                if (!in_array($__v['id'], $ids)) {
                    $__v['type_desc'] = accountBookMsgModels::TYPE_MAP[$__v['type']];
                    $list[] = $__v;
                    $ids[] = $__v['id'];
                }
            }
        }
        return ['list' => $list, 'mobile' => $member['mobile']];
    }
}
