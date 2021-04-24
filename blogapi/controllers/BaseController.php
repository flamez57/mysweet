<?php
namespace blogapi\controllers;

use blogapi\models\memberModels;
use hl\HLApi;
use hl\library\Functions\Jwt;
use hl\library\Session\HLSession;
use hl\library\Session\HLSessionImpRedis;
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
    public $needLogin = true;

    public function __construct()
    {
        $this->checkLogin();
    }

    //校验登陆
    public function checkLogin()
    {
        $token = $this->getToken();
        if (!empty($token)) {
            $session = HLSession::getInstance(self::$config['token']['blogapi'])->init($token);
        } else {
            $session = HLSession::getInstance(self::$config['token']['blogapi'])->init();
        }
        $memberId = $session->get('member_id');
        $btoken = $session->get('token'); //表里的token
        $token = $session->getToken(); //客户端用
        if (empty($memberId) && $this->needLogin) {
            // 未登录状态
            HLResponse::json('-1', '请先登陆', new \stdClass());
            die;
        } else {
            $this->memberId = $memberId;
        }
    }

    //获取token
    protected function getToken()
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $header = apache_request_headers();
            $_SERVER['HTTP_AUTHORIZATION'] = $header['Authorization'] ?? '';
        }
        if (isset($_SERVER['HTTP_AUTHORIZATION']) && !empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $token = $_SERVER['HTTP_AUTHORIZATION'];
        } else {
            $token = !empty($this->getPost('token')) ? $this->getPost('token') :
                $this->getQuery('token');
        }
        return $token;
    }
}
