<?php
namespace hl\library\Functions;
/**
** @ClassName: Sha2
** @Description: 加密算法
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年4月23日 晚上22:49
** @version V1.0
*/
class Sha2
{
    /** 
    ** sha256() 
    ** 
    ** @param string $data 要计算散列值的字符串
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */
    public static function sha256($data, $rawOutput = false)
    {
        if(!is_scalar($data)){
            return false;
        }
        $data = (string)$data;
        $rawOutput = !!$rawOutput;
        return hash('sha256', $data, $rawOutput);
    }
    
    /** 
    ** sha256_file()
    ** 
    ** @param string file 要计算散列值的文件名，可以是单独的文件名，也可以包含路径，绝对路径相对路径都可以
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */      
    public static function sha256_file($file, $rawOutput = false)
    {
        if(!is_scalar($file)){
            return false;
        }
        $file = (string)$file;
        if(!is_file($file) || !is_readable($file)){
            return false;
        }
        $rawOutput = !!$rawOutput;
        return hash_file('sha256', $file, $rawOutput);
    }

    /** 
    ** sha512() 
    ** 
    ** @param string $data 要计算散列值的字符串
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */
    public static function sha512($data, $rawOutput = false)
    {
        if(!is_scalar($data)){
            return false;
        }
        $data = (string)$data;
        $rawOutput = !!$rawOutput;
        return hash('sha512', $data, $rawOutput);
    }
    
    /** 
    ** sha512_file()
    ** 
    ** @param string file 要计算散列值的文件名，可以是单独的文件名，也可以包含路径，绝对路径相对路径都可以
    ** @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
    ** @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
    */ 
    public static function sha512_file($file, $rawOutput = false)
    {
        if(!is_scalar($file)){
            return false;
        }
        $file = (string)$file;
        if(!is_file($file) || !is_readable($file)){
            return false;
        }
        $rawOutput = !!$rawOutput;
        return hash_file('sha512', $file, $rawOutput);
    }        
}
