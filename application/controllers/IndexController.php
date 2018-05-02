<?php
namespace application\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use application\services\exampleServices;

class IndexController extends HLController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        \hl\library\Functions\Helper::dump('sdf');
        exampleServices::getInstance()->todo();
        echo 'hello world!<br>';
        echo \hl\HLRoute::makeUrl('user', 'manger', 'index');
        echo '<br>';
        for($i=0;$i<=25;$i++){
            \hl\HLView::img('640 ('.$i.').webp', ['width' => '200px']);
        }
        for($i=0;$i<=20;$i++){
            \hl\HLView::img('jpg'.DIRECTORY_SEPARATOR.$i.'.jpg', ['width' => '200px']);
        }
    }
}
