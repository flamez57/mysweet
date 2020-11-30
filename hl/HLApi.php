<?php
namespace hl;

use hl\HLSington;
use hl\library\Tools\HLResponse;

/**
** @ClassName: HLApi
** @Description: 接口基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLApi extends HLSington
{
    public $code = 0;
    public $message = '';
    public $data = [];
    
    /*
    ** 指向到最终的方法
    */
    public function __call($method, $avgs)
    {
        $method .= 'Action';
        if ($avgs) {
            return call_user_func_array([$this, $method], $avgs);
        } else {
            return call_user_func_array([$this, $method], []);
        }
    }

    /**
    ** 获取post传值
    ** @param $key string
    ** @param $value string|array
    ** @return string|array
    */
    public function getPost($key = '', $value = '')
    {
        if (empty($key)) {
            return $_POST;
        }
        return $_POST[$key] ?? $value;
    }
}
