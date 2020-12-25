<?php
namespace blogapi\services;

/**
** @ClassName: articleServices
** @Description: 文章业务
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/
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
        $fields = 'id,title,content,a.pv,created_at';
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
}
