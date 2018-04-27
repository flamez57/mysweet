<?php
namespace hl;

use hl\HLSington;
/**
** @ClassName: HLController
** @Description: 控制器基类
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年3月26日 晚上21:49
** @version V1.0
*/

class HLController extends HLSington
{
    /*
    ** 被调用的方法
    */
    private $callFunction;
    
    /*
    ** 指向到最终的方法
    */
    public function __call($method, $avgs)
    {
        $this->callFunction = $method;
        $method .= 'Action';
        if ($avgs) {
            return call_user_func_array([$this, $method], $avgs);
        } else {
            return call_user_func_array([$this, $method], []);
        }
    }
    
    /*
    ** 结束时引入默认的模板文件
    */
    public function __destruct()
    {
        $class = get_called_class();
        $class = explode(DIRECTORY_SEPARATOR, $class);
        $path = $class[0].DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR. lcfirst(rtrim($class[2], 'Controller')).DIRECTORY_SEPARATOR;
        $path .= $this->callFunction;
        $path .= '.html';
        var_dump($path);
    }
}
