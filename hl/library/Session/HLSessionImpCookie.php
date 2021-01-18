<?php
/**
 * Created by PhpStorm.
 * User: flamez57
 * Date: 2021/1/18
 * Time: 13:48
 */

namespace hl\library\Session;

class HLSessionImpCookie implements HLSessionApi
{
    private $config = [
        'tokenExpire' => 1440, //服务端过期时间
        'tokenCookieAuthKey' => 'this is auth key, safe require', //cookie加密密钥
        'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
        'tokenCookieName' => 'sl_ss', //保存token的cookie key，不使用也需配置
        'tokenCookieExpire' => 0, //0 浏览器退出则失效
        'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
        'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
     ];

    private static $setData = [];

    private $token; //Cookie 方式，token就是密文

    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * 初始化
     * @param $token
     * @return static
     */
    public function init($token = null)
    {
        $cookieKey = $this->config['tokenCookieName'];
        if (!isset(static::$setData[$cookieKey])) {
            if (empty($token)) {
                if (isset($_COOKIE[$cookieKey])) {
                    $value = $_COOKIE[$cookieKey];
                    $this->token = $value;
                    $value = $this->authcode($value);
                    static::$setData[$cookieKey] = empty($value) ? [] : json_decode($value, true);
                } else {
                    static::$setData[$cookieKey] = [];
                }
            } else {
                $this->token = $token;
                $value = $this->authcode($token);
                static::$setData[$cookieKey] = empty($value) ? [] : json_decode($value, true);
            }
        }
        return $this;
    }

    /**
     * 修改配置
     * @param $config
     * @return static
     */
    public function setConfig($config)
    {
        if (!empty($config)) {
            $this->config = array_merge($this->config, $config);
        }
        return $this;
    }

    /**
     * 获取session
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $cookieKey = $this->config['tokenCookieName'];
        if (isset(static::$setData[$cookieKey][$key])) {
            return static::$setData[$cookieKey][$key];
        } else {
            return '';
        }
    }

    /**
     * 设置session
     * @param $key
     * @param $value
     * @return static
     */
    public function set($key, $value)
    {
        $cookieKey = $this->config['tokenCookieName'];
        if (!isset(static::$setData[$cookieKey])) {
            return $this;
        }
        static::$setData[$cookieKey][$key] = $value;

        return $this;
    }

    /**
     * 保存session
     * @return mixed
     */
    public function save()
    {
        $cookieKey = $this->config['tokenCookieName'];
        if (!isset(static::$setData[$cookieKey])) {
            return false;
        }

        $value = json_encode(static::$setData[$cookieKey]);
        //加密
        $expire = $this->config['tokenExpire'];
        $value = $this->authcode($value, 'ENCODE', '', $expire);
        $this->token = $value;

        if ($this->config['tokenSaveInCookie'] == 1) {
            if (empty(static::$setData[$cookieKey])) {
                return $this->destroy();
            } else {
                //Cookie方式，加密保存token对应值
                $clientExpire = $this->config['tokenCookieExpire'];
                $clientExpire = $clientExpire == 0 ? null : TIMESTAMP + $clientExpire;
                return setcookie(
                    $cookieKey,
                    $value,
                    $clientExpire,
                    '/',
                    CommonConfig::getCookieDomain(),
                    $this->config['tokenCookieSecure'],
                    $this->config['tokenCookieHttpOnly']
                );
            }
        }

        return true;
    }

    /**
     * 删除session
     * @param $key
     * @return static
     */
    public function delete($key)
    {
        $cookieKey = $this->config['tokenCookieName'];
        unset(static::$setData[$cookieKey][$key]);
        return $this;
    }

    /**
     * 清除session
     * @return mixed
     */
    public function destroy()
    {
        //Cookie方式，加密保存token对应值
        $cookieKey = $this->config['tokenCookieName'];
        setcookie(
            $cookieKey,
            '',
            -1,
            '/',
            CommonConfig::getCookieDomain(),
            $this->config['tokenCookieSecure'],
            $this->config['tokenCookieHttpOnly']
        );
        return true;
    }

    /**
     * 获取Token
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * 加密、解密
     * @param $string
     * @param string $operation
     * @param string $key
     * @param int $expiry
     * @return bool|string
     */
    private function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        $key = md5($key != '' ? $key : $this->config['tokenCookieAuthKey']);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) :
            substr(md5(microtime()), - $ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) :
            sprintf('%010d', $expiry ? $expiry + time() : 0) .
            substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i ++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i ++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i ++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || intval(substr($result, 0, 10)) - time() > 0) &&
                substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)
            ) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }
}
