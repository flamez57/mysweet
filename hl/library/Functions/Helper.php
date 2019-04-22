<?php
namespace hl\library\Functions;
/**
** @ClassName: Helper
** @Description: 函数库
** @author flamez57 <flamez57@mysweet95.com>
** @date 2018年4月25日 晚上22:49
** @version V1.0
*/
class Helper
{
    /**
    ** 浏览器友好的变量输出
    ** @param mixed $var 变量
    ** @param $echo bool 是否输出 默认为True 如果为false 则返回输出字符串
    ** @param $label string 标签 默认为空
    ** @param $strict bool 是否严谨 默认为true
    ** @return void|string
    */
    static public function dump($var, $echo = true, $label = null, $strict = true)
    {
        $label = ( $label === null ) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();//打开输出缓冲区
            var_dump($var);
            $output = ob_get_clean(); //获取当前缓冲区内容并清除当前的输出缓冲
            //extension_loaded — 检查一个扩展是否已经加载
            if (!extension_loaded('xdebug')) {
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo $output;
            return null;
        } else {
            return $output;
        }
    }

    /**
    ** 去除PHP代码注释
    ** @param $content string 代码内容
    ** @return string 去除注释之后的内容
    */
    static public function removeComment($content)
    {
        return preg_replace(
            ['/\/\*.*?\*\//s', '/#.*?\n/', '/\/\/.*?\n/', '/\-\-.*?\n/'],
            '',
            str_replace(array("\r\n", "\r"), "\n", $content)
        );
    }

    /**
    ** 信息弹框
    ** @param $title
    ** @param $content string
    ** @param $url
    ** @return string
    */
    static public function alert($title, $content, $url = '#')
    {
        $top = \hl\HLView::url('top.png');
        $main = \hl\HLView::url('main.jpg');
        $bottom = \hl\HLView::url('bottom.png');
        $html = <<<HTML
<style type="text/css">
    .top{ 
        background-image: url({$top});
        background-repeat: no-repeat;
        list-style-type:none;
        height:40px;
        width:390px;
    }
    .main{ 
        background-image: url({$main}); 
        background-repeat: repeat-y;  
        list-style-type:none;
        width:340px;
        padding:5px 25px;
        max-width:340px;
    }
    .bottom{ 
        background-image: url({$bottom});
        background-repeat: no-repeat;
        list-style-type:none;
        height:20px;
        width:390px;
    }
    #hl_alert{
        width:440px;position:absolute; 
        top: 50px; 
        left: 200px; 
        z-index: 99999;
    }
    .closebutton{
        width:80px;
        height:40px;
        float:right
    }
</style>
<ul id="hl_alert">
    <li class="top">
        <div class="closebutton" onclick="hlHidden()"></div>
    </li>
    <li class="main">
        <h3 style="color:red;margin:0px;padding:0px;">{$title}:</h3>
        <p style="width:320px;pxmargin:0px;padding:0px;">{$content}</p>
    </li>
    <li class="main">
        <button onclick="hlHidden()"><a href="{$url}" style="text-decoration:none; ">确定</a></button>
        <button onclick="hlHidden()"><a href="#" style="text-decoration:none; ">取消</a></button>
    </li>
    <li class="bottom"></li>
</ul>
<script type="text/javascript">
    function hlHidden(){
        var obj = document.getElementById('hl_alert');
        obj.style.display = "none";
    }
</script>
HTML;
        return $html;
    }

    /*
    ** 获取客户端IP地址
    */
    static public function getClientIP()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }
            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $ip = ( false !== ip2long($ip) ) ? $ip : '0.0.0.0';
        return $ip;
    }

    /**
    ** 脚本执行时间
    ** @param $start int|float 开始计时时间
    ** @return void
    */
    static public function execTime($start = REQUEST_TIME_FLOAT)
    {
        echo number_format(microtime(1) - $start, 6).'秒';
    }

    /**
    ** 获得来源类型 post get
    ** @return unknown
    */
    static public function method()
    {
        return strtoupper(isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET');
    }

    /**
    ** 提示信息
    ** @param $action
    ** @param $content
    ** @param $redirect
    ** @param $timeout
    */
    static public function message($action = 'success', $content = '', $redirect = 'javascript:history.back(-1);', $timeout = 4)
    {

        switch ($action) {
            case 'success':
                $titler = '操作完成';
                $class = 'message_success';
                break;
            case 'error':
                $titler = '操作未完成';
                $class = 'message_error';
                break;
            case 'errorBack':
                $titler = '操作未完成';
                $class = 'message_error';
                break;
            case 'redirect':
                header("Location:$redirect");
                break;
            case 'script':
                if (empty($redirect)) {
                    exit('<script language="javascript">alert("' . $content . '");window.history.back(-1)</script>');
                } else {
                    exit('<script language="javascript">alert("' . $content . '");window.location="' . $redirect . '"</script>');
                }
                break;
        }

        $html = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{$titler}</title>
    <style type="text/css">
        body{font:12px/1.7 "\5b8b\4f53",Tahoma;}
        html,body,div,p,a,h3{margin:0;padding:0;}
        .tips_wrap{ background:#F7FBFE;border:1px solid #DEEDF6;width:780px;padding:50px;margin:50px auto 0;}
        .tips_inner{zoom:1;}
        .tips_inner:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
        .tips_inner .tips_img{width:80px;float:left;}
        .tips_info{float:left;line-height:35px;width:650px}
        .tips_info h3{font-weight:bold;color:#1A90C1;font-size:16px;}
        .tips_info p{font-size:14px;color:#999;}
        .tips_info p.message_error{font-weight:bold;color:#F00;font-size:16px; line-height:22px}
        .tips_info p.message_success{font-weight:bold;color:#1a90c1;font-size:16px; line-height:22px}
        .tips_info p.return{font-size:12px}
        .tips_info .time{color:#f00; font-size:14px; font-weight:bold}
        .tips_info p a{color:#1A90C1;text-decoration:none;}
    </style>
</head>
<body>
    <script type="text/javascript">
        function delayURL(url) {
            var delay = document.getElementById("time").innerHTML;
            if (delay > 0) {
                delay--;
                document.getElementById("time").innerHTML = delay;
            } else {
                window.location.href = url;
                return;
            }
            setTimeout("delayURL('" + url + "')", 1000);
        }
    </script>
    <div class="tips_wrap">
        <div class="tips_inner">
            <div class="tips_img"></div>
            <div class="tips_info">
                <p class="{$class}">{$content}</p>
                <p class="return">
                    系统自动跳转在  <span class="time" id="time">{$timeout}</span>  秒后，如果不想等待，
                    <a href="{$redirect}">点击这里跳转</a>
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        delayURL("{$redirect}");
    </script>
</body>
</html>
HTML;
        exit($html);
    }

    /**
     * base64_encode
     */
    static function b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    /**
     * base64_decode
     */
    static function b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    /**
     * 验证邮箱
     */
    public static function email($str) {
        if (empty($str))
            return true;
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if (strpos($str, '@') !== false && strpos($str, '.') !== false) {
            if (preg_match($chars, $str)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
    ** 验证手机号码
    ** @param $str string 手机号
    ** @return bool
    */
    public static function mobile($str)
    {
        if (empty($str)) {
            return false;
        }
        return preg_match('#^1[\d]{10}$#', trim($str)) ? true : false;
    }

    /**
     * 验证固定电话
     */
    public static function tel($str) {
        if (empty($str)) {
            return true;
        }
        return preg_match('/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', trim($str));
    }

    /**
    ** 验证qq号码
    ** @param $str string
    ** @return bool
    */
    public static function qq($str)
    {
        if (empty($str)) {
            return false;
        }
        return preg_match('/^[1-9]\d{4,12}$/', trim($str)) ? true : false;
    }

    /**
    ** 验证邮政编码
    ** @param $str string
    ** @return bool
    */
    public static function zipCode($str)
    {
        if (empty($str)) {
            return false;
        }
        return preg_match('/^[1-9]\d{5}$/', trim($str)) ? true : false;
    }

    /**
    ** 验证ip
    ** @param $str string
    ** @return bool
    */
    public static function ip($str)
    {
        if (empty($str)) {
            return false;
        }
        if (!preg_match('#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$#', $str)) {
            return false;
        }
        $ipArray = explode('.', $str);
        //真实的ip地址每个数字不能大于255（0-255）
        return ($ipArray[0] <= 255 && $ipArray[1] <= 255 && $ipArray[2] <= 255 && $ipArray[3] <= 255) ? true : false;
    }

    /**
     * 验证身份证(中国)
     */
    public static function idCard($str) {
        $str = trim($str);
        if (empty($str))
            return true;

        if (preg_match("/^([0-9]{15}|[0-9]{17}[0-9a-z])$/i", $str))
            return true;
        else
            return false;
    }

    /**
     * 验证网址
     */
    public static function url($str) {
        if (empty($str))
            return true;

        return preg_match('#(http|https|ftp|ftps)://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?#i', $str) ? true : false;
    }



    /**
     * 拆分sql
     *
     * @param $sql
     */
    public static function splitsql($sql) {
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=" . Yii::app()->db->charset, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return ($ret);
    }

    /**
     * 字符截取
     *
     * @param $string
     * @param $length
     * @param $dot
     */
    public static function cutstr($string, $length, $dot = '...', $charset = 'utf-8') {
        if (strlen($string) <= $length)
            return $string;

        $pre = chr(1);
        $end = chr(1);
        $string = str_replace(array('&', '"', '<', '>'), array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), $string);

        $strcut = '';
        if (strtolower($charset) == 'utf-8') {

            $n = $tn = $noc = 0;
            while ($n < strlen($string)) {

                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || ( 32 <= $t && $t <= 126 )) {
                    $tn = 1;
                    $n++;
                    $noc++;
                } elseif (194 <= $t && $t <= 223) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif (224 <= $t && $t <= 239) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }

                if ($noc >= $length) {
                    break;
                }
            }
            if ($noc > $length) {
                $n -= $tn;
            }

            $strcut = substr($string, 0, $n);
        } else {
            for ($i = 0; $i < $length; $i++) {
                $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
            }
        }

        $strcut = str_replace(array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), array('&', '"', '<', '>'), $strcut);

        $pos = strrpos($strcut, chr(1));
        if ($pos !== false) {
            $strcut = substr($strcut, 0, $pos);
        }
        return $strcut . $dot;
    }


    /**
     * 检测是否为英文或英文数字的组合
     *
     * @return unknown
     */
    public static function isEnglist($param) {
        if (!eregi("^[A-Z0-9]{1,26}$", $param)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 将自动判断网址是否加http://
     *
     * @param $http
     * @return  string
     */
    public static function convertHttp($url) {
        if ($url == 'http://' || $url == '')
            return '';

        if (substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://')
            $str = 'http://' . $url;
        else
            $str = $url;
        return $str;
    }

    /*
      标题样式格式化
     */

    public static function titleStyle($style) {
        $text = '';
        if ($style['bold'] == 'Y') {
            $text .='font-weight:bold;';
            $serialize['bold'] = 'Y';
        }

        if ($style['underline'] == 'Y') {
            $text .='text-decoration:underline;';
            $serialize['underline'] = 'Y';
        }

        if (!empty($style['color'])) {
            $text .='color:#' . $style['color'] . ';';
            $serialize['color'] = $style['color'];
        }

        return array('text' => $text, 'serialize' => empty($serialize) ? '' : serialize($serialize));
    }

    // 自动转换字符集 支持数组转换
    static public function autoCharset($string, $from = 'gbk', $to = 'utf-8') {
        $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
        $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
        if (strtoupper($from) === strtoupper($to) || empty($string) || (is_scalar($string) && !is_string($string))) {
            //如果编码相同或者非字符串标量则不转换
            return $string;
        }
        if (is_string($string)) {
            if (function_exists('mb_convert_encoding')) {
                return mb_convert_encoding($string, $to, $from);
            } elseif (function_exists('iconv')) {
                return iconv($from, $to, $string);
            } else {
                return $string;
            }
        } elseif (is_array($string)) {
            foreach ($string as $key => $val) {
                $_key = self::autoCharset($key, $from, $to);
                $string[$_key] = self::autoCharset($val, $from, $to);
                if ($key != $_key)
                    unset($string[$key]);
            }
            return $string;
        } else {
            return $string;
        }
    }

    /*
      标题样式恢复
     */

    public static function titleStyleRestore($serialize, $scope = 'bold') {
        $unserialize = unserialize($serialize);
        if ($unserialize['bold'] == 'Y' && $scope == 'bold')
            return 'Y';
        if ($unserialize['underline'] == 'Y' && $scope == 'underline')
            return 'Y';
        if ($unserialize['color'] && $scope == 'color')
            return $unserialize['color'];
    }

    /**
     * 列出文件夹列表
     *
     * @param $dirname
     * @return unknown
     */
    public static function getDir($dirname) {
        $files = array();
        if (is_dir($dirname)) {
            $fileHander = opendir($dirname);
            while (( $file = readdir($fileHander) ) !== false) {
                $filepath = $dirname . '/' . $file;
                if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0 || is_file($filepath)) {
                    continue;
                }
                $files[] = self::autoCharset($file, 'GBK', 'UTF8');
            }
            closedir($fileHander);
        } else {
            $files = false;
        }
        return $files;
    }

    /**
     * 列出文件列表
     *
     * @param $dirname
     * @return unknown
     */
    public static function getFile($dirname) {
        $files = array();
        if (is_dir($dirname)) {
            $fileHander = opendir($dirname);
            while (( $file = readdir($fileHander) ) !== false) {
                $filepath = $dirname . '/' . $file;

                if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0 || is_dir($filepath)) {
                    continue;
                }
                $files[] = self::autoCharset($file, 'GBK', 'UTF8');
                ;
            }
            closedir($fileHander);
        } else {
            $files = false;
        }
        return $files;
    }

    /**
     * [格式化图片列表数据]
     *
     * @return [type] [description]
     */
    public static function imageListSerialize($data) {

        foreach ((array) $data['file'] as $key => $row) {
            if ($row) {
                $var[$key]['fileId'] = $data['fileId'][$key];
                $var[$key]['file'] = $row;
            }
        }
        return array('data' => $var, 'dataSerialize' => empty($var) ? '' : serialize($var));
    }

    /**
     * 反引用一个引用字符串
     * @param  $string
     * @return string
     */
    static function stripslashes($string) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = self::stripslashes($val);
            }
        } else {
            $string = stripslashes($string);
        }
        return $string;
    }

    /**
     * 引用字符串
     * @param  $string
     * @param  $force
     * @return string
     */
    static function addslashes($string, $force = 1) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = self::addslashes($val, $force);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }

    /**
     * 格式化内容
     */
    static function formatHtml($content, $options = '') {
        $purifier = new CHtmlPurifier();
        if ($options != false)
            $purifier->options = $options;
        return $purifier->purify($content);
    }
    
    /*
    * 生成随机字符串
    * @param int $length 生成随机字符串的长度
    * @param string $char 组成随机字符串的字符串
    * @return string $string 生成的随机字符串
    */
    public static function str_rand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') 
    {
        if(!is_int($length) || $length < 0) {
            return false;
        }

        $string = '';
        for($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }

        return $string;
    }
    /* * *************************
 * 生成随机字符串，可以自己扩展   //若想唯一，只需在开头加上用户id
 * $type可以为：upper(只生成大写字母)，lower(只生成小写字母)，number(只生成数字)
 * $len为长度，定义字符串长度
 * mark 2017/8/15
 * ************************** */

function random($type, $len = 0) {
    $new = '';
    $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';  //数据池
    if ($type == 'upper') {
        for ($i = 0; $i < $len; $i++) {
            $new .= $string[mt_rand(36, 61)];
        }
        return $new;
    }
    if ($type == 'lower') {
        for ($i = 0; $i < $len; $i++) {
            $new .= $string[mt_rand(10, 35)];
        }
        return $new;
    }
    if ($type == 'number') {
        for ($i = 0; $i < $len; $i++) {
            $new .= $string[mt_rand(0, 9)];
        }
        return $new;
    }
}
//计算该月有几天
function getdaysInmonth($month, $year) {
    $days = '';
    if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
        $days = 31;
    else if ($month == 4 || $month == 6 || $month == 9 || $month == 11)
        $days = 30;
    else if ($month == 2) {
        if (isLeapyear($year)) {
            $days = 29;
        } else {
            $days = 28;
        }
    }
    return ($days);
}

//判断是否为润年
function isLeapyear($year) {
    if ((($year % 4) == 0) && (($year % 100) != 0) || (($year % 400) == 0)) {
        return (true);
    } else {
        return (false);
    }
}
//生成订单15位
function auto_order($ord = 0) {
    //自动生成订单号  传入参数为0 或者1   0为本地  1为线上订单
    if ($ord == 0) {
        $str = '00' . time() . rand(1000, 9999); //00 本地订单
    } else {
        $str = '99' . time() . rand(1000, 9999);  //11 线上订单
    }
    return $str;
}

//生成订单15位
function auto_new_order($ord = 0) {
    srand(time());
    //自动生成订单号  传入参数为0 或者1   0为本地  1为线上订单
    if ($ord == 0) {
        $str = '00' . time() . mt_rand(100000,999999); //00 本地订单
    } else {
        $str = '11' . time() . mt_rand(100000,999999);  //11 线上订单
    }
    return $str;
}
/**
 * 检测是否为UTF8编码 
 * @param $string 检测字符串
 * @return bool
 */
function is_utf8($string) {
    return preg_match('%^(?:
          [\x09\x0A\x0D\x20-\x7E]            # ASCII
        | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
        |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
        | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
        |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
        |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
        | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
        |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
    )*$%xs', $string);
}
//处理json字符中的特殊字符
function getJsonToArr($result,$return_array=true)
{
        $tempArr = NULL;
        $result = preg_replace('/([^\\])(":)(\d{9,})(,")/i', '${1}${2}"${3}"${4}', $result); //taobao bug,number >2^32
        $tempArr = json_decode($result, $return_array);
        if ($tempArr == NULL) {
            $patterns = array('/,+\s*\}/', '/,+\s*\]/', '/"\s+|\s+"/', '/\n|\r|\t/','/\\\/','/ss+/');
            $replacements = array('}', ']', '"', ' ','',' ');
            $result = preg_replace($patterns, $replacements, $result);            
            $tempArr = json_decode($result, $return_array);
        }

        return $tempArr;
}


//非法字符过滤函数
function has_unsafeword($str) {
    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\.|\/|\;|\'|\`|\=|\\\|\|/";
    return preg_replace($regex,"",$str);   
}

//去空格，以及字符添加斜杠
function _trim(&$value) {
    Return addslashes(trim($value));
}
/**
 * 将多维数组转为一维数组
 * @param array $arr
 * @return array
 */
function ArrMd2Ud($arr) {
    #将数值第一元素作为容器，作地址赋值。
    $ar_room = &$arr[key($arr)];
    #第一容器不是数组进去转呀
    if (!is_array($ar_room)) {
        #转为成数组
        $ar_room = array($ar_room);
    }
    #指针下移
    next($arr);
    #遍历
    while (list($k, $v) = each($arr)) {
        #是数组就递归深挖，不是就转成数组
        $v = is_array($v) ? call_user_func(__FUNCTION__, $v) : array($v);
        #递归合并
        $ar_room = array_merge_recursive($ar_room, $v);
        #释放当前下标的数组元素
        unset($arr[$k]);
    }
    return $ar_room;
}
    /**
     * 判断是PC端还是wap端访问
     * @return type判断手机移动设备访问
     */
    function isMobile()
    { 
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        } 
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        { 
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        } 
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
                ); 
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            } 
        } 
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        { 
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            } 
        } 
        return false;
    }
    //判断是否为安卓手机
    public function isAndroid()
    {
        if(isset($_SERVER['HTTP_USER_AGENT'])){
            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($agent,'android') !== false)
                return true;
        }
        return false;
    }
    //判断是否为iphone或者ipad
    public function isIos()
    {
        if(isset($_SERVER['HTTP_USER_AGENT'])){
            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($agent, 'iphone')||strpos($agent, 'ipad'))
                return true;
        }
        return false;
    }
    //判断是否为微信内置浏览器打开
    public function isWechet()
    {
        if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            return true;
        }
        return false;
    }
    //整合到一起，判断当前设备，1：安卓；2：IOS；3：微信；0：未知
    public function isDevice()
    {
        if($_SERVER['HTTP_USER_AGENT']){
            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($agent, 'micromessenger') !== false)
                return 3;
            elseif(strpos($agent, 'iphone')||strpos($agent, 'ipad'))
                return 2;
            else
                return 1;
        }
        return 0;
    }
    /**
     * 日期转换成几分钟前
     */
    public function formatTime($date) {
        $timer = strtotime($date);
        $diff = $_SERVER['REQUEST_TIME'] - $timer;
        $day = floor($diff / 86400);
        $free = $diff % 86400;
        if($day > 0) {
            if(15 < $day && $day <30){
                return "半个月前";
            }elseif(30 <= $day && $day <90){
                return "1个月前";
            }elseif(90 <= $day && $day <187){
                return "3个月前";
            }elseif(187 <= $day && $day <365){
                return "半年前";
            }elseif(365 <= $day){
                return "1年前";
            }else{
                return $day."天前";
            }
        }else{
            if($free>0){
                $hour = floor($free / 3600);
                $free = $free % 3600;
                if($hour>0){
                    return $hour."小时前";
                }else{
                    if($free>0){
                        $min = floor($free / 60);
                        $free = $free % 60;
                    if($min>0){
                        return $min."分钟前";
                    }else{
                        if($free>0){
                            return $free."秒前";
                        }else{
                            return '刚刚';
                        }
                    }
                    }else{
                        return '刚刚';
                    }
                }
            }else{
                return '刚刚';
            }
        }
    }
    /**
     * 截取长度
     */
    public function getSubString($rawString,$length='100',$etc = '...',$isStripTag=true){
        $rawString = str_replace('_baidu_page_break_tag_', '', $rawString);
        $result = '';
        if($isStripTag)
            $string = html_entity_decode(trim(strip_tags($rawString)), ENT_QUOTES, 'UTF-8');
        else
            $string = trim($rawString);
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++){
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0){
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }else{
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        if($isStripTag)
            $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');

        if ($i < $strlen){
            $result .= $etc;
        }
        return $result;
    }
    /**
     * utf-8和gb2312自动转化
     * @param unknown $string
     * @param string $outEncoding
     * @return unknown|string
     */
    function safeEncoding($string,$outEncoding = 'UTF-8')
    {
        $encoding = "UTF-8";
        for($i = 0; $i < strlen ( $string ); $i ++) {
            if (ord ( $string {$i} ) < 128)
                continue;

            if ((ord ( $string {$i} ) & 224) == 224) {
                // 第一个字节判断通过
                $char = $string {++ $i};
                if ((ord ( $char ) & 128) == 128) {
                    // 第二个字节判断通过
                    $char = $string {++ $i};
                    if ((ord ( $char ) & 128) == 128) {
                        $encoding = "UTF-8";
                        break;
                    }
                }
            }
            if ((ord ( $string {$i} ) & 192) == 192) {
                // 第一个字节判断通过
                $char = $string {++ $i};
                if ((ord ( $char ) & 128) == 128) {
                    // 第二个字节判断通过
                    $encoding = "GB2312";
                    break;
                }
            }
        }

        if (strtoupper ( $encoding ) == strtoupper ( $outEncoding ))
            return $string;
        else
            return @iconv ( $encoding, $outEncoding, $string );
    }
    /** 
    *对内容中的关键词添加链接 
    *只处理第一次出现的关键词，对已有链接的关键不会再加链接，支持中英文 
    *$content:string 原字符串 
    *$keyword:string  关键词 
    *$link:string,链接 
    */ 
   function yang_keyword_link($content,$keyword,$link){ 
        //排除图片中的关键词 
        $content = preg_replace( '|(<img[^>]*?)('.$keyword.')([^>]*?>)|U', '$1%&&&&&%$3', $content); 
        $regEx = '/(?!((<.*?)|(<a.*?)))('.$keyword.')(?!(([^<>]*?)>)|([^>]*?<\/a>))/si'; 
        $url='<a href="'.$link.'" target="_blank" class="content_guanjianci">'.$keyword.'</a>'; 
        $content = preg_replace($regEx,$url,$content,1); 
        //还原图片中的关键词 
        $content=str_replace('%&&&&&%',$keyword,$content); 
        return $content; 
    }
}
