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
        $memberId = memberModels::getInstance()->getMemberIdByCode($param['code']);
        $where = ['member_id' => $memberId, 'status' => 1, 'deleted_at' => 0];
        $name = '';
        if (!empty($param['cate_id'])) {
            $cate = cateModels::getInstance()->getByWhere(['id' => $param['cate_id']], 'id,name');
            $name = $cate['name'] ?? '';
            $where['cate_id'] = $param['cate_id'];
        }
        if (!empty($param['tag_id'])) {
            $tag = tagsModels::getInstance()->getByWhere(['id' => $param['tag_id']], 'id,name');
            $name = $tag['name'] ?? '';
            $count = tagsRelevanceModels::getInstance()->getCountByWhere(['tag_id' => $param['tag_id']]);
            $articleIds = tagsRelevanceModels::getInstance()->getByWhere(
                ['tag_id' => $param['tag_id']],
                'article_id',
                '',
                '',
                $count
            );
            if ($count == 1) {
                $where['id'] = $articleIds['article_id'];
            } else {
                $articleIds = array_column($articleIds, 'article_id');
                if ($articleIds) {
                    $where['id'] = ['in', $articleIds];
                } else {
                    return ['list' => [], 'count' => 0];
                }
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
                $_list['content'] = \hl\library\Functions\Helper::substrCut($_list['content'], 200);
                return $_list;
            }, $list),
            'count' => $count,
            'name' => $name
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
    ** 文章列表
    */
    public function articleList($page, $pageSize, $keyword, $type, $memberId)
    {
        $where['member_id'] = $memberId;
        switch ($type) {
            case 1:
                $where['deleted_at'] = 0;
                $where['status'] = 0;
                break;
            case 2:
                $where['deleted_at'] = 0;
                $where['status'] = 1;
                break;
            case 3:
                $where['deleted_at'] = ['neq', 0];
                break;
            case 0:
            default:
                $where['deleted_at'] = 0;
        }
        if (!empty($keyword)) {
            $where['title'] = ['like', trim($keyword)];
        }
        $start = ($page - 1) * $pageSize;
        $limit = " {$start},{$pageSize} ";
        $fields = 'id,title,member_id,cate_id,drafts_content,pv,status,created_at,updated_at';
        $list = articleModels::getInstance()->getByWhere($where, $fields, ' updated_at DESC ', '', $limit);
        $count = articleModels::getInstance()->getCountByWhere($where);
        $cateIds = array_column($list, 'cate_id');
        if (!empty($cateIds)) {
            $cates = cateModels::getInstance()->getByWhere(['id' => ['in', $cateIds]], 'id,name', '', '', $pageSize);
            $cates = array_column($cates, 'name', 'id');
        } else {
            $cates = [];
        }
        $memberIds = array_column($list, 'member_id');
        if (!empty($memberIds)) {
            $members = memberModels::getInstance()->getByWhere(
                ['id' => ['in', $memberIds]],
                'id,code,nickname,avatar',
                '',
                '',
                $pageSize
            );
            $members = array_combine(array_column($members, 'id'), $members);
        } else {
            $members = [];
        }
        return [
            'list' => array_map(function ($_list) use ($cates, $members) {
                $_list['cate_name'] = $cates[$_list['cate_id']] ?? '';
                if (isset($members[$_list['member_id']])) {
                    $_list += $members[$_list['member_id']];
                }
                $_list['created_at'] = date("Y-m-d H:i:s", $_list['created_at']);
                $_list['drafts_content'] = \hl\library\Functions\Helper::substrCut($_list['drafts_content'], 20);
                return $_list;
            }, $list),
            'count' => $count
        ];
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
                $article['tags'] = tagsModels::getInstance()->getByWhere(['' => ['in', $tagIds]], 'id,name', ' sort ASC ', '', 20);
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
        if (!empty($tags)) {
            foreach ($tags as $_tag) {
                if ($_tag['id'] == 0) {
                    $tag = tagsModels::getInstance()->getByWhere(['name' => $_tag['name']], 'id,name');
                    if (empty($tag)) {
                        $_tag['id'] = tagsModels::getInstance()->insert(
                            [
                                'name' => $_tag['name'],
                                'status' => 0
                            ]
                        );
                    } else {
                        $_tag = $tag;
                    }
                }
                $tr = tagsRelevanceModels::getInstance()->getByWhere(['article_id' => $id, 'tag_id' => $_tag['id']], 'id');
                if (empty($tr)) {
                    tagsRelevanceModels::getInstance()->insert(['article_id' => $id, 'tag_id' => $_tag['id']]);
                }
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
