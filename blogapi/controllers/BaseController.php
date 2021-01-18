<?php
namespace blogapi\controllers;

use blogapi\models\memberModels;
use hl\HLApi;
use hl\library\Functions\Jwt;
use hl\library\Session\HLSession;
use hl\library\Tools\HLResponse;

/**
** @ClassName: IndexController
** @Description: 默认首选控制器
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年11月28日 晚上21:49
** @version V1.0
*/

class BaseController extends HLApi
{
    public $memberId = 0;

    public function __construct()
    {
        $this->checkLogin();
    }

    //校验登陆
    public function checkLogin()
    {
        $token = $this->getToken();
        //验证token 这里只对过期时间做基础验证 验证通过返回数组 不通过返回false
        $tokenArr = Jwt::verifyToken($token);
        if ($tokenArr === false) {
            // 未登录状态
            HLResponse::json('-1', '请先登陆', new \stdClass());
            die;
        } else {
            $memberId = HLSession::getInstance()->get($tokenArr['token']);
            if (!empty($memberId)) {
                $this->memberId = $memberId;
            } else {
                $memberId = memberModels::getInstance()->getMemberIdByToken($tokenArr['token']);
                if (empty($memberId)) {
                    HLResponse::json('-1', '登陆信息失效', new \stdClass());
                    die;
                } else {
                    $this->memberId = $memberId;
                    HLSession::getInstance()->set($tokenArr['token'], $this->memberId);
                }
            }
        }
    }

    protected function getToken()
    {
        if (isset($_SERVER['HTTP_TOKEN']) && !empty($_SERVER['HTTP_TOKEN'])) {
            $token = $_SERVER['HTTP_TOKEN'];
        } else {
            $token = !empty($this->getPost('token')) ? $this->getPost('token') :
                $this->getQuery('token');
        }
        return $token;
    }
}
