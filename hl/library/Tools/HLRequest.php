<?php

namespace hl\library\Tools;

/**
** @ClassName: HLRequest
** @Description: 请求网络数据
** @author flamez57 <flamez57@mysweet95.com>
** @date 2019年4月13日 晚上22:49
** @version V1.0
*/
class HLRequest
{
    /*
    ** cURL会话
    */
    private $curl = null;

    /*
    ** 错误信息
    */
    private $errorMsg = '';

    public function __construct()
    {
        if (is_null($this->curl)) {
            $this->curl = curl_init();
        }
    }
    /*
    ** CURLOPT_SSL_VERIFYHOST的值
    ** 设为0表示不检查证书
    ** 设为1表示检查证书中是否有CN(common name)字段
    ** 设为2表示在1的基础上校验当前的域名是否与CN匹配
    ** 而libcurl早期版本中这个变量是boolean值，为true时作用同目前设置为2，后来出于调试需求，增加了仅校验是否有CN字段的选项，
    ** 因此两个值true/false就不够用了，升级为0/1/2三个值。
    ** 再后来(libcurl_7.28.1之后的版本)，这个调试选项由于经常被开发者用错，被去掉了，因此目前也不支持1了，只有0/2两种取值。
    */

    /**
    ** cUrl HTTPS GET
    ** @param $url string 网络链接地址
    ** @return json
    */
    public function curlGetHttps($url)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
        return curl_exec($this->curl);     //返回api的json对象
    }

    /**
    ** cURL HTTPS POST
    ** @param string
    ** @param $data array
    ** @return json
    */
    public function curlPostHttps($url, $data)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($this->curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($this->curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($this->curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($this->curl); // 执行操作
        if (curl_errno($this->curl)) {
            $this->errorMsg = curl_error($this->curl);//捕抓异常
        }
        return $tmpInfo; // 返回数据，json格式
    }

    /*
    ** 获取错误信息
    */
    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    /*
    ** 关闭cURL会话
    */
    public function __destruct()
    {
        curl_close($this->curl);
    }
}
