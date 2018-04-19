<?php
namespace hl\library\Tools;
/**
** @ClassName: HLResponse
** @Description: 数据响应
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年4月19日 晚上22:49
** @version V1.0
*/
class HLResponse
{
    /*
    ** 默认使用json格式
    */
    const JSON ='json';
    
    /**
    ** 按json方式输出通信数据
    ** @param integer $code  状态码
    ** @param string $message 提示信息
    ** @param array $data 数据
    ** @return string
    */
    public static function json($code, $message="", $data = [])
    {
        if (!is_numeric($code)) {
            return '';
        }
        
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
        
        echo json_encode($result);die;
    }
    
    /**
    ** 按xml方式输出通信数据
    ** @param integer $code  状态码
    ** @param string $message 提示信息
    ** @param array $data 数据
    ** @return string
    */
    public static function xmlRncode($code, $message='', $data = [])
    {
        if (!is_numeric($code)) {
            return '';
        }
        
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
        
        //在页面显示xml格式的数据   不设置就是显示 HTML的
        header("Content-Type:text/xml");    
        $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .="<root>\n";
        $xml .= self::xmlToEncode($result);
        $xml .= "</root>\n"; 

        echo $xml;die;
    }

    /**
    ** 数据拼装bom格式
    ** 由于数字不可以作为节点所以只能由 
    ** item作为节点 属性id为键值
    */
    private static function xmlToEncode($data)
    {
        $xml = "";
        $attr = "";
        foreach ($data as $_key => $_value) {
            //xml 节点不能为数字
            if(is_numeric($_key)){                  
                $attr = "id='{$_key}'";
                $_key = "item";
            }
            $xml .= "<{$_key} {$attr}>";
            $xml .= is_array($_value) ? self::xmlToEncode($_value) : $_value;
            $xml .= "</{$_key}>";
            unset($attr);
        }
        return $xml;
    }
    
    /**
    ** 综合方式输出通信数据
    ** @param integer $code  状态码
    ** @param string $message 提示信息
    ** @param array $data 数据
    ** @param string $type 数据类型
    ** @return string
    */
    public static function show($code, $message = '', $data = [], $type = self::JSON)
    {
        if ($type == 'json') {
            self::json($code,$message,$data);
        } elseif ($type == 'array') {
            echo '<pre>';
            print_r($result);
            echo '</pre>';
        } elseif ($type == 'xml') {
            self::xmlRncode($code, $message, $data);
        } else {
                //any more
        }
        die;
    }
}
