<?php

/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/7/2 23:15
 * Author: Flamez57 <1050355217@qq.com>
 */
class Response
{
    private static $_instance = NULL;

    /**
     * @return Response
     */
    final public static function getInstance()
    {
        if (!isset(self::$_instance) || !self::$_instance instanceof self) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function json($errorCode, $msg, $data)
    {
        $response['code'] = $errorCode;
        $response['msg'] = $msg;
        $response['data'] = $data;
        echo json_encode($response);
    }
}
