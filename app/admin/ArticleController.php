<?php

/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/7/2 17:05
 * Author: Flamez57 <1050355217@qq.com>
 */
class ArticleController extends Controller
{
    public function articleList()
    {
        $page = empty($_GPT['page'])?intval($_GPT['page']):1;
        $pagesize = empty($_GPT['pagesize'])?intval($_GPT['pagesize']):'20';
        $articles = new ArticleModel;
//        var_dump($articles);
        $a = $articles->fetchAll();
//        echo json_encode($a);
        echo Response::getInstance()->json(ErrorCode::SUCCESS, $a);
    }

    public function articleSave()
    {

    }

    public function articleUpdate()
    {

    }

    public function articleDelete()
    {

    }
}
