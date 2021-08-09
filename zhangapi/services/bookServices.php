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

    /*
    ** 文章编辑详情
    */
    public function articleDetail($id, $memberId)
    {
        $article = articleModels::getInstance()->getByWhere(
            ['id' => $id, 'member_id' => $memberId],
            'id,cate_id,title,drafts_content'
        );
        if (empty($article)) {
            $article = ['id' => 0, 'cate_id' => 0, 'title' => '', 'drafts_content' => '', 'tags' => []];
        } else {
            $tr = tagsRelevanceModels::getInstance()->getByWhere(['article_id' => $id], 'tag_id', '', '', 20);
            $tagIds = array_column($tr, 'tag_id');
            if (!empty($tagIds)) {
                $article['tags'] = tagsModels::getInstance()->getByWhere(['id' => ['in', $tagIds]], 'id,name', ' sort ASC ', '', 20);
            } else {
                $article['tags'] = [];
            }
        }
        return $article;
    }

    /*
    ** 文章保存
    */
    public function articleSave($id, $param, $memberId)
    {
        $param['member_id'] = $memberId;
        $param['created_at'] = TIMESTAMP;
        $param['updated_at'] = TIMESTAMP;
        if ($param['status'] == 1) {
            $param['content'] = $param['drafts_content'];
        }
        $tags = $param['tags'];
        unset($param['tags']);
        if ($id == 0) {
            $id = articleModels::getInstance()->insert($param);
        } else {
            articleModels::getInstance()->updateById($id, $param);
        }
        //暂时最多10个标签
        $trs = tagsRelevanceModels::getInstance()->getByWhere(['article_id' => $id], 'id,tag_id', '', '', 10);
        $trs = array_column($trs, 'id', 'tag_id');
        if (!empty($tags)) {
            foreach ($tags as $_tag) {
                if ($_tag['id'] == 0) {
                    $tag = tagsModels::getInstance()->getByWhere(['name' => $_tag['name']], 'id,name');
                    if (empty($tag)) {
                        $_tag['id'] = tagsModels::getInstance()->insert(
                            [
                                'name' => $_tag['name'],
                                'status' => 1
                            ]
                        );
                    } else {
                        $_tag = $tag;
                    }
                }
                if (isset($trs[$_tag['id']])) { //已经有的排除
                    unset($trs[$_tag['id']]);
                } else { //没有的插入
                    tagsRelevanceModels::getInstance()->insert(['article_id' => $id, 'tag_id' => $_tag['id']]);
                }
            }
        }
        if (!empty($trs)) { //多余的删除
            foreach ($trs as $_k => $_v) {
                tagsRelevanceModels::getInstance()->delById($_v);
            }
        }
    }

    /*
    ** 删除文章
    */
    public function delArticle($id, $memberId, &$code, &$message)
    {
        $article = articleModels::getInstance()->getByWhere(['id' => $id], 'member_id');
        if ($memberId != $article['member_id']) {
            $code = -1;
            $message = '只有作者本人可以删除';
        } else {
            articleModels::getInstance()->updateById($id, ['deleted_at' => TIMESTAMP]);
        }
        return new \stdClass();
    }

    /*
    ** 发布于撤回
    */
    public function updateStatus($id, $status, $memberId, &$code, &$message)
    {
        $article = articleModels::getInstance()->getByWhere(['id' => $id], 'member_id,drafts_content');
        if ($memberId != $article['member_id']) {
            $code = -1;
            $message = '只有作者本人可以操作';
        } else {
            if ($status == 1) { //发布
                articleModels::getInstance()->updateById(
                    $id,
                    ['content' => $article['drafts_content'], 'status' => 1, 'updated_at' => TIMESTAMP]
                );
            } else { //撤回
                articleModels::getInstance()->updateById($id, ['status' => 0, 'updated_at' => TIMESTAMP]);
            }
        }
        return new \stdClass();
    }
}
