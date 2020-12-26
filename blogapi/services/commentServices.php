<?php
namespace blogapi\services;

/**
** @ClassName: commentServices
** @Description: 评论业务
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
use hl\library\Functions\Helper;

class commentServices extends HLServices
{
    /*
    ** 评论
    */
    public function addComment($articleId, $content, $nickname)
    {
        $id = commentModels::getInstance()->insert(
            [
                'article_id' => $articleId,
                'content' => $content,
                'created_at' => TIMESTAMP,
                'nickname' => $nickname,
                'ip' => Helper::getClientIP(),
            ]
        );
        return ['id' => $id];
    }

    /*
    ** 回复
    */
    public function reply($id, $content, $memberId = 0)
    {
        $comment = commentServices::getInstance()->getByWhere(['id' => $id], 'article_id,reply_at');
        $article = articleModels::getInstance()->getByWhere(['id' => $comment['article_id']], 'member_id');
        if ($comment['reply_at'] == 0 && $article['member_id'] == $memberId && !empty($content)) {
            commentModels::getInstance()->updateById($id, ['reply_content' => $content, 'reply_at' => TIMESTAMP]);
        }
        return ['id' => $id];
    }
}
