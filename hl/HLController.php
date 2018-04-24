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
    public function __destruct()
    {
        $class = get_called_class();
        $class = explode(DIRECTORY_SEPARATOR, $class);
        $path = $class[0].DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR. lcfirst(rtrim($class[2], 'Controller')).DIRECTORY_SEPARATOR;
        var_dump($path);
    }
}
