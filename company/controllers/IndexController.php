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
    ** 默认首页
    */
    public function indexAction()
    {
        $str = exampleServices::getInstance()->todo();
        //传递值到模板
        \hl\HLView::param('out', $str); 
    }
    
    /*
    ** 品牌溯源
    */
    public function pinpaiAction()
    {
        
    }
    
    /*
    ** 经典美食
    */
    public function jingdianAction()
    {
        
    }
    
    /*
    ** 门店风采
    */
    public function menmiancaifengAction()
    {
        
    }
    
    /*
    ** 移动店车
    */
    public function movecheAction()
    {
        
    }
    
    /*
    ** 加盟咨询
    */
    public function jiamengAction()
    {
        
    }
    
    /*
    ** 服务支持
    */
    public function serviceAction()
    {
        
    }
    
    /*
    ** 资讯中心
    */
    public function newAction()
    {
        
    }
    
    /*
    ** 资讯详情
    */
    public function newxiangqingAction()
    {
        
    }
    
    /*
    ** 联系我们
    */
    public function callmeAction()
    {
        
    }
}
