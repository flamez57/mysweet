<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 20:12
 * Author: Flamez57 <1050355217@qq.com>
 */
class ArticleController extends Controller
{
    /*
    文章列表
     * /index.php?m=web&c=article&a=articleList
     * 
     * 
     *      */
    public function articleList()
    {
        $page = $this->get('page','1');
        $pageSize = $this->get('pageSize','10');
        $category = $this->get('category');
        $tag = $this->get('tag');
        $keyword = $this->get('keyword');
        
        $where = '1=1';
        
        if ($category) {
            $where = " AND ha.category_id={$category}";
        } elseif ($tag) {
            $where = " AND ht.id = {$tag}";
        } elseif ($keyword) {
            $where = " AND ha.digest LIKE '%{$keyword}%'";
        }
        
        $articles = new ArticleModel;
        $data =$articles->getArticleList($page, $pageSize, $where);

        echo Response::getInstance()->json(ErrorCode::SUCCESS, '', $data);
    }

    /*
    文章详情
     * /index.php?m=web&c=article&a=articledetail&id=29
     * 
     * 
     *      */     
    public function articleDetail()
    {
        $articleId = $this->get('id','1');
        
        $articles = new ArticleModel;
        $data =$articles->getArticle($articleId);

        echo Response::getInstance()->json(ErrorCode::SUCCESS, '', $data);
    }
}
