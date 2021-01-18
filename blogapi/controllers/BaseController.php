<?php
namespace blogapi\controllers;

use hl\HLApi;
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
