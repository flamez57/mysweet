<?php
namespace hl\library\Functions;
/**
** @ClassName: Password
** @Description: 密码库
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月18日 晚上22:49
** @version V1.0
*/
class Password
{
    /**
    ** 加密方式
    ** @param string $input 密码
    ** @param string $salt 盐
    ** @return string 加密后的密码
    */
    public static function makePassword($input, $salt)
    {
        $input = "{$input}-{$salt}";
        return sha1($input);
    }

    /**
    ** 生成加密盐
    ** @param $len int 长度
    ** @return string
    */
    public static function makeSalt($len = 8)
    {
        $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randnum = '';
        for ($i = 0; $i < $len; $i++) {
            $start = rand(1, strlen($str) - 1);
            $randnum .= substr($str, $start, 1);
        }
        return $randnum;
    }
}
