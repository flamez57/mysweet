<?php
namespace company\controllers;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use company\services\exampleServices;

class IndexController extends HLController
{
    /*
    ** 公共头
    */
    public function header()
    {
        \hl\HLView::html('header');
    }
    
    /*
    ** 公共底部
    */
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
    
    /*
    ** 品牌溯源
    */
    public function pinpaiAction()
    {
        $this->header();
    }
    
    /*
    ** 经典美食
    */
    public function jingdianAction()
    {
        $this->header();
    }
    
    /*
    ** 门店风采
    */
    public function menmiancaifengAction()
    {
        $this->header();
    }
    
    /*
    ** 移动店车
    */
    public function movecheAction()
    {
        $this->header();
    }
    
    /*
    ** 加盟咨询
    */
    public function jiamengAction()
    {
        $this->header();
    }
    
    /*
    ** 服务支持
    */
    public function serviceAction()
    {
        $this->header();
    }
    
    /*
    ** 资讯中心
    */
    public function newAction()
    {
        $this->header();
    }
    
    /*
    ** 资讯详情
    */
    public function newxiangqingAction()
    {
        $this->header();
    }
    
    /*
    ** 联系我们
    */
    public function callmeAction()
    {
        $this->header();
    }
    
    /*
    ** 引入尾部
    */
    public function __destruct()
    {
        parent::__destruct();
        $this->footer();
    }
}
