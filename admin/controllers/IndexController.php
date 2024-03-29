<?php
namespace admin\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use application\models\installModels;
use application\services\exampleServices;
use application\services\installServices;
use hl\HLView;

class IndexController extends BaseController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        HLView::param('title', '管理后台首页');
        HLView::param('active', 'index');
        //框架欢迎页
//        for ($i = 100; $i < 251; $i++) {
//            echo <<<HTML
//<li onclick="checkThis('resource/0{$i}.mp4', this)">0{$i}.mp4</li>\n\r
//HTML;
//
//        }

    }

    public function index2Action()
    {
        HLView::param('title', '管理后台首页');
        HLView::param('active', 'index2');
    }
}
