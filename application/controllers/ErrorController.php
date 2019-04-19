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

class IndexController extends HLController
{
    /*
    ** 默认首页
    */
    public function indexAction()
    {
        $action = 'success';
        $content = '';
        $redirect = 'javascript:history.back(-1);';
        $timeout = 4;
        switch ($action) {
            case 'success':
                $titler = '操作完成';
                $class = 'message_success';
                $images = 'message_success.png';
                break;
            case 'error':
                $titler = '操作未完成';
                $class = 'message_error';
                $images = 'message_error.png';
                break;
            case 'errorBack':
                $titler = '操作未完成';
                $class = 'message_error';
                $images = 'message_error.png';
                break;
            case 'redirect':
                header("Location:$redirect");
                break;
            case 'script':
                if (empty($redirect)) {
                    exit('<script language="javascript">alert("' . $content . '");window.history.back(-1)</script>');
                } else {
                    exit('<script language="javascript">alert("' . $content . '");window.location=" ' . $redirect . ' "</script>');
                }
                break;
        }

        \hl\HLView::param('title', $titler); //标题
        \hl\HLView::param('class', $class); //文案样式
        \hl\HLView::param('image', $images); //提示图片
        \hl\HLView::param('content', $content); //文案
        \hl\HLView::param('timeout', $timeout); //超时跳转时间
        \hl\HLView::param('redirect', $redirect); //跳转链接
    }
}
