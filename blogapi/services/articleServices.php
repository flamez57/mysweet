<?php
namespace blogapi\services;

/**
** @ClassName: articleServices
** @Description: 文章业务
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

class articleServices extends HLServices
{
    /*
    ** front文章列表
    ** @param $code 博主账号
    */
    public function getFrontArticleList($param)
    {
        $memberId = memberModels::getInstance()->getMemberIdByCode($param);
        $where = ['member_id' => $memberId, 'status' => 1, 'deleted_at' => 0];
        if (!empty($param['cate_id'])) {
            $where['cate_id'] = $param['cate_id'];
        }
        if (!empty($param['tag_id'])) {
            $count = tagsRelevanceModels::getInstance()->getCountByWhere(['tag_id' => $param['tag_id']]);
            $articleIds = tagsRelevanceModels::getInstance()->getByWhere(
                ['tag_id' => $param['tag_id']],
                'article_id',
                '',
                '',
                $count
            );
            $articleIds = array_column($articleIds, 'article_id');
            if ($articleIds) {
                $where['id'] = ['in', $articleIds];
            } else {
                return ['list' => [], 'count' => 0];
            }
        }
        if (!empty($param['keyword'])) {
            $where['title'] = ['like', trim($param['keyword'])];
        }
        $start = ($param['page'] - 1) * $param['page_size'];
        $limit = " {$start},{$param['page_size']} ";
        $fields = 'id,title,content,pv,created_at';
        $list = articleModels::getInstance()->getByWhere($where, $fields, ' id DESC ', '', $limit);
        $count = articleModels::getInstance()->getCountByWhere($where);
        $articleIds = array_column($list, 'id');
        $tagList = [];
        if ($articleIds) {
            $tagsRel = tagsRelevanceModels::getInstance()->getByWhere(
                ['article_id' => ['in', $articleIds]],
                'article_id,tag_id',
                '',
                '',
                '1000'
            );
            $tagIds = array_column($tagsRel, 'tag_id');
            if ($tagIds) {
                $tags = tagsModels::getInstance()->getByWhere(
                    ['id' => ['in', $tagIds], 'status' => 1],
                    'id,name',
                    '',
                    '',
                    '1000'
                );
                $tags = array_column($tags, 'name', 'id');
            } else {
                $tags = [];
            }
            if ($tagsRel) {
                foreach ($tagsRel as $v) {
                    if (isset($tags[$v['tag_id']])) {
                        $tagList[$v['article_id']][] = ['id' => $v['tag_id'], 'name' => $tags[$v['tag_id']]];
                    }
                }
            }
        }

        return [
            'list' => array_map(function ($_list) use ($tagList) {
                $_list['tags'] = $tagList[$_list['id']] ?? [];
                $_list['created_at'] = date('Y-m-d H:i:s', $_list['created_at']);
                return $_list;
            }, $list),
            'count' => $count
        ];
    }

    /*
    ** 文章详情
    */
    public function getFrontArticleDetail($id, $memberId = 0)
    {
        $where = ['id' => $id];
        articleModels::getInstance()->incr($where, 'pv');
        $where['deleted_at'] = 0;
        $where['status'] = 1;
        $fields = 'id,title,content,pv,created_at,member_id,cate_id';
        $detail = articleModels::getInstance()->getByWhere($where, $fields);
        $reply = false;
        if ($detail) {
            if ($detail['member_id'] == $memberId) {
                $reply = true;
            }
            $tagsRel = tagsRelevanceModels::getInstance()->getByWhere(
                ['article_id' => $id],
                'tag_id',
                '',
                '',
                '1000'
            );
            $tagIds = array_column($tagsRel, 'tag_id');
            if ($tagIds) {
                $tags = tagsModels::getInstance()->getByWhere(
                    ['id' => ['in', $tagIds], 'status' => 1],
                    'id,name',
                    '',
                    '',
                    '1000'
                );
                $tags = array_column($tags, 'name', 'id');
            } else {
                $tags = [];
            }
            if ($tagsRel) {
                foreach ($tagsRel as $v) {
                    if (isset($tags[$v['tag_id']])) {
                        $detail['tags'][] = ['id' => $v['tag_id'], 'name' => $tags[$v['tag_id']]];
                    }
                }
            }
            $detail['created_at'] = date('Y-m-d H:i:s', $detail['created_at']);
            $detail['cate'] = cateModels::getInstance()->getByWhere(['id' => $detail['cate_id']], 'id,name');
            $detail['before'] = articleModels::getInstance()->getByWhere(
                ['id' => ['gt', $id], 'member_id' => $detail['member_id'], 'status' => 1, 'deleted_at' => 0],
                'id,title'
            );
            $detail['next'] = articleModels::getInstance()->getByWhere(
                ['id' => ['lt', $id], 'member_id' => $detail['member_id'], 'status' => 1, 'deleted_at' => 0],
                'id,title'
            );
        }
        $comment = array_map(function ($_list) use ($reply) {
            $_list['created_at'] = date('Y-m-d H:i', $_list['created_at']);
            if ($_list['reply_at'] == 0) {
                $_list['allow_reply'] = $reply ? 1 : 0;
            } else {
                $_list['allow_reply'] = 0;
                $_list['reply_at'] = date('Y-m-d H:i', $_list['reply_at']);
            }
            return $_list;
        }, commentModels::getInstance()->getByWhere(
            ['article_id' => $id],
            'id,content,created_at,nickname,reply_content,reply_at',
            '',
            '',
            '50'
        ));
        return ['detail' => $detail, 'comments' => $comment, 'comment_num' => count($comment)];
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
