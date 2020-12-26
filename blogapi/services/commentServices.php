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
     * 回复
     */
    public function reply($id, $content, $memberId = 0)
    {
        /*CREATE TABLE `yx_article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  article_id
  `reply_content` varchar(255) NOT NULL DEFAULT '' COMMENT '回复内容',
  `reply_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='评论表';*/
    }
}
