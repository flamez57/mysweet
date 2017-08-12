<?php

/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/7/2 20:58
 * Author: Flamez57 <1050355217@qq.com>
 */
class ArticleModel extends Model
{
    public $tablename = 'articles';
    public $pk = 'id';
    
    public function getArticleList($page, $pageSize, $where = '1=1')
    {
        $page = ($page-1)*$pageSize;
        $sql = "/*flamez57*/SELECT ha.id, ha.title, digest, ha.created_at, "
                . "hu.name AS userName, hc.name AS categoryName, ha.category_id,"
                . "ht.id AS tagId, ht.name AS tagName FROM `hl_articles` ha "
                . "LEFT JOIN `hl_users` hu ON hu.id=ha.user_id "
                . "LEFT JOIN `hl_categories` hc ON hc.id=ha.category_id "
                . "LEFT JOIN `hl_article_tag` hat ON hat.article_id=ha.id "
                . "LEFT JOIN `hl_tags` ht ON ht.id=hat.tag_id "
                . "WHERE {$where} LIMIT {$page},{$pageSize}";
        return $this->fetchAll($sql);
    }
    
    public function getArticle($articleId)
    {
        $sql = "/*flamez57*/SELECT ha.id, ha.title, digest, ha.updated_at, ha.content,"
                . "hu.name AS userName, hc.name AS categoryName, ha.category_id,"
                . "ht.id AS tagId, ht.name AS tagName FROM `hl_articles` ha "
                . "LEFT JOIN `hl_users` hu ON hu.id=ha.user_id "
                . "LEFT JOIN `hl_categories` hc ON hc.id=ha.category_id "
                . "LEFT JOIN `hl_article_tag` hat ON hat.article_id=ha.id "
                . "LEFT JOIN `hl_tags` ht ON ht.id=hat.tag_id "
                . "WHERE ha.id = {$articleId}";
        return $this->fetchRow($sql);
    }
}
