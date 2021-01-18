<?php
namespace blogapi\controllers;

use hl\HLApi;
use hl\library\Functions\Jwt;

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
        } else {
            /* 验证成功返回参数
                array (size=7)
                  'iss' => string 'mysweet95' (length=9)  //该JWT的签发者
                  'iat' => int 1582123404   //签发时间
                  'exp' => int 1583419404   //过期时间
                  'nbf' => int 1582123404   //该时间之前不接收处理该Token
                  'sub' => string '' (length=0)  //面向的用户
                  'jti' => string 'c5e8f2e681ab5e8ca5006f06f7fe77a9' (length=32)//该Token唯一标识
                  'token' => string 'sdfs' (length=4)  //后面的都是要携带参数
                */
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
