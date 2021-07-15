<?php
namespace zhangapi\controllers;

use zhangapi\services\memberServices;
use hl\library\Tools\HLResponse;
/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->needLogin = false;
        parent::__construct();
    }

    /*
    ** 注册 http://mysweet.com/index.php?m=zhangapi&c=index&a=register
    */
    public function registerAction()
    {
        $params['mobile'] = $this->getPost('mobile', '');
        $params['pwd'] = $this->getPost('pwd', '');
        $params['sex'] = $this->getPost('sex', 0);
        memberServices::getInstance()->register($params, $this->code, $this->message, $this->data);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 登录 http://mysweet.com/index.php?m=zhangapi&c=index&a=login
    */
    public function loginAction()
    {
        $mobile = $this->getPost('mobile', '');
        $pwd = $this->getPost('pwd', '');
        memberServices::getInstance()->login($mobile, $pwd, $this->code, $this->message, $this->data);
        HLResponse::json($this->code, $this->message, $this->data);
    }

    /*
    ** 忘记密码 http://mysweet.com/index.php?m=zhangapi&c=index&a=forget
    */
    public function forgetAction()
    {
        $mobile = $this->getPost('mobile', '');
        memberServices::getInstance()->forget($mobile, $this->code, $this->message, $this->data);
        HLResponse::json($this->code, $this->message, $this->data);
    }
}
