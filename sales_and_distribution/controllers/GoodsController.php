<?php
namespace sales_and_distribution\controllers;
/**
** @ClassName: GoodsController
** @Description: 商品控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use sales_and_distribution\services\exampleServices;

class GoodsController extends HLController
{
    /*
    ** 默认首页
    */
    public function listAction()
    {
        $str = exampleServices::getInstance()->todo();
        //传递值到模板
        \hl\HLView::param('out', $str);
//        \hl\library\Functions\Helper::dump('sdf');  
    }

    /*
     * 商品详情
     */
    public function detailAction()
    {
        
    }
}
