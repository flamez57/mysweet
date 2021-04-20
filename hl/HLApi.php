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
    private $posts;

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
        if ($this->posts) {
            $values = $this->posts;
        } else {
            if (strpos(file_get_contents("php://input"), '{') === 0) {
                $this->posts = json_decode(file_get_contents("php://input"), true);
                $values = $this->posts;
            } else {
                $this->posts = $_POST;
                $values = $this->posts;
            }
        }
        if ($key != '') {
            return trim(isset($values[$key]) ? $values[$key] : $value);
        } else {
            return $values;
        }
    }

    /**
    ** 获取get传值
    ** @param $key string
    ** @param $value string|array
    ** @return string|array
    */
    public function getQuery($key = '', $value = '')
    {
        if (empty($key)) {
            return $_GET;
        }
        return $_GET[$key] ?? $value;
    }
}
