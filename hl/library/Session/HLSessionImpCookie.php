<?php
/**
 * Created by PhpStorm.
 * User: flamez57
 * Date: 2021/1/18
 * Time: 13:48
 */

namespace hl\library\Session;

use hl\library\Functions\Jwt;

class HLSessionImpCookie implements HLSessionApi
{
    private $config = [
        'cookieDomain' => 'mysweet.com', // cookie存放域名
        'tokenExpire' => 1440, //服务端过期时间
        'tokenCookieAuthKey' => 'this is auth key, safe require', //cookie加密密钥
        'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
        'tokenCookieName' => 'hl_f', //保存token的cookie key，不使用也需配置
        'tokenCookieExpire' => 0, //0 浏览器退出则失效
        'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
        'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
    ];

    private $jwt;

    private static $setData = [];

    private $token; //Cookie 方式，token就是密文

    public function __construct($config)
    {
        $jwt = new Jwt();
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
                    $value = Jwt::verifyToken($value);
                    static::$setData[$cookieKey] = empty($value) ? [] : $value;
                } else {
                    static::$setData[$cookieKey] = [];
                }
            } else {
                $this->token = $token;
                $value = Jwt::verifyToken($token);
                static::$setData[$cookieKey] = empty($value) ? [] : $value;
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
        //生成token存在客户端，每次请求都要携带这个token
        $value = Jwt::getToken(static::$setData[$cookieKey]);//生成256位的字符串
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
                    $this->config['cookieDomain'],
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
            $this->config['cookieDomain'],
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
}
