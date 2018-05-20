<?php
namespace sales_and_distribution\controllers;
/**
** @ClassName: IndexController
** @Description: 个人中心控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use sales_and_distribution\services\exampleServices;

class SelfController extends HLController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        $str = exampleServices::getInstance()->todo();
        //传递值到模板
        \hl\HLView::param('out', $str);
//        \hl\library\Functions\Helper::dump('sdf');  
    }
    
    public function fxcenter1Action()
    {
        
    }
    
    /*
    ** 个人信息
    */
    public function datumAction()
    {
        
    }
    
    /*
    ** 修改个人信息
    */
    public function namechangeAction()
    {
        
    }
    
    /*
    ** 我的收藏
    */
    public function mycollectAction()
    {
        
    }
    
    /*
    ** 消费记录
    */
    public function balanceAction()
    {
        
    }
    
    /*
    ** 地址管理
    */
    public function addresAction()
    {
        
    }
    
    /*
    ** 我的分销
    */
    public function gobuyAction()
    {
        
    }
    
    /*
    ** 修改密码
    */
    public function signAction()
    {
        
    }
    
    /*
    ** 登陆
    */
    public function loginAction()
    {
        
    }
}
