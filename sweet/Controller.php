<?php
/**
 * Created by PhpStorm.
 * Computer: Administrator
 * Date: 2017/6/21 22:18
 * Author: Flamez57 <1050355217@qq.com>
 */
class Controller
{
    public function index()
    {
        echo 'ok';
    }
    
    public function get($field, $default='')
    {
        $get = $_GET[$field];
        if ($get) {
            return $get;
        } else {
            return $default;
        }
    }
}
