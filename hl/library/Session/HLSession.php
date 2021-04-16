<?php
/**
 * Created by PhpStorm.
 * User: flamez57
 * Date: 2021/1/18
 * Time: 13:51
 */

namespace hl\library\Session;

class HLSession implements HLSessionApi
{
    private static $instance = [];
    private $type;
    /**
     * @var \Session\SlSessionApi;
     */
    private $handle;

    /**
     * 获取实例
     * @param array $config
     * [
     *      'type' => Cookie | TODO
     *      'tokenExpire' => 1440, //服务端过期时间
     *      'tokenSaveInCookie' => 1 | 0,  //是否把token存入cookie，不保存则需要客户端保存token
     *      'tokenCookieName' => 'sl_ss', //保存token的cookie key，不使用也需配置
     *      'tokenCookieExpire' => 0,  //0 浏览器退出则失效
     *      'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
     *      'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
     * ]
     * @return static
     */
    public static function getInstance($config = [])
    {
        $type = isset($config['type']) ? $config['type']: 'Cookie';
        unset($config['type']);
        if (!isset(static::$instance[$type])) {
            static::$instance[$type] = new self($type, $config);
        } elseif (!empty($config)) {
            static::$instance[$type]->setConfig($config);
        }
        return static::$instance[$type];
    }

    private function __construct($type, $config)
    {
        $this->type = $type;
        switch ($type) {
            case 'Cookie':
                $this->handle = new HLSessionImpCookie($config);
                break;
            case 'Redis':
                $this->handle = new HLSessionImpRedis($config);
                break;
        }
    }

    /**
     * 初始化
     * @param $token mixed null则从cookie中
     * @return SlSessionApi
     */
    public function init($token = null)
    {
        return $this->handle->init($token);
    }

    /**
     * 修改配置
     * @param $config
     * @return SlSessionApi
     */
    public function setConfig($config)
    {
        return $this->handle->setConfig($config);
    }

    /**
     * 获取session
     * @param $key
     * @return SlSessionApi
     */
    public function get($key)
    {
        return $this->handle->get($key);
    }

    /**
     * 设置session
     * @param $key
     * @param $value
     * @return SlSessionApi
     */
    public function set($key, $value)
    {
        return $this->handle->set($key, $value);
    }

    /**
     * 保存session
     * @return SlSessionApi
     */
    public function save()
    {
        return $this->handle->save();
    }

    /**
     * 删除session
     * @param $key
     * @return SlSessionApi
     */
    public function delete($key)
    {
        return $this->handle->delete($key);
    }

    /**
     * 清除session
     * @return SlSessionApi
     */
    public function destroy()
    {
        return $this->handle->destroy();
    }

    /**
     * 获取Token
     * @return mixed
     */
    public function getToken()
    {
        return $this->handle->getToken();
    }
}
