<?php
namespace blog\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use blog\services\exampleServices;

class IndexController extends HLController
{
    public function header()
    {
        \hl\HLView::html('header');
    }
    
    public function footer()
    {
        \hl\HLView::html('footer');
    }
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        $this->header();
        $str = exampleServices::getInstance()->todo();
        //传递值到模板
        \hl\HLView::param('out', $str); 
    }
    
    public function aboutAction()
    {
        $this->header();
    }
    
    public function contactAction()
    {
        $this->header();
    }
    
    public function fullwidthAction()
    {
        $this->header();
    }
    
    public function singleAction()
    {
        $this->header();
    }
    
    public function __destruct()
    {
        parent::__destruct();
        $this->footer();
    }
}
