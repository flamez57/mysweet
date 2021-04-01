<?php
/**
 * Created by PhpStorm.
 * User: flamez57
 * Date: 2021/1/18
 * Time: 13:48
 */

namespace hl\library\Session;

class HLSessionImpRedis implements HLSessionApi
{
    private $config = [
        'tokenExpire' => 1440, //服务端过期时间
        'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
        'tokenCookieName' => 'zko_ss', //保存token的cookie key，不使用也需配置
        'tokenCookieExpire' => 0, //0 浏览器退出则失效
        'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
        'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
     ];
    private $redisPrefix = RedisCode::SESSION_PREFIX;

    private static $setData = [];

    private $token;

    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * 获取存于redis的真实key
     * @param $token
     * @return string
     */
    private function getRedisKey($token = null)
    {
        $token === null && $token = $this->token;
        return $this->redisPrefix . $this->config['tokenCookieName'] . '_' . $token;
    }

    /**
     * 初始化
     * @param $token
     * @return static
     */
    public function init($token = null)
    {
        $cookieKey = $this->config['tokenCookieName'];
        if (isset(static::$setData[$cookieKey])) {
            //已经初始化过了
            return $this;
        }

        if (empty($token) && $this->config['tokenSaveInCookie'] == 1) {
            $token = isset($_COOKIE[$cookieKey]) ? $_COOKIE[$cookieKey] : '';
        }

        if (empty($token)) {
            $token = md5($_SERVER['REQUEST_TIME_FLOAT'] . uniqid() . mt_rand(0, 1000));
            static::$setData[$cookieKey] = [];
        } else {
            $value = RedisDb::getInstance()->get($this->getRedisKey($token));
            static::$setData[$cookieKey] = empty($value) ? [] : json_decode($value, true);
        }

        $this->token = $token;

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
        //保存
        $expire = $this->config['tokenExpire'];
        $saveResult = RedisDb::getInstance()->set(
            $this->getRedisKey(),
            $value,
            $expire
        );
        if ($saveResult !== true) {
            return false;
        }

        if ($this->config['tokenSaveInCookie'] == 1) {
            if (empty(static::$setData[$cookieKey])) {
                return $this->destroy();
            } else {
                //把token存于Cookie
                $clientExpire = $this->config['tokenCookieExpire'];
                $clientExpire = $clientExpire == 0 ? null : TIMESTAMP + $clientExpire;
                setcookie(
                    $cookieKey,
                    $this->token,
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
        RedisDb::getInstance()->delete($this->getRedisKey());

        if ($this->config['tokenSaveInCookie'] == 1) {
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
        }

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
