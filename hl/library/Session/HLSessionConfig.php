<?php
/**
 * Created by PhpStorm.
 * User: flamez57
 * Date: 2021/1/18
 * Time: 13:51
 */

namespace hl\library\Session;

class SlSessionConfig
{
    //==== 平台管理后台
    public static $SL_ADMIN_SESSION_NAME = 'admin_ss';
    public static function getSlAdminSessionConfig()
    {
        return [
            'type' => 'Cookie', //类型更换后，tokenCookieName需要变更，避免旧数据串扰
            'tokenCookieAuthKey' => Registry::get('config')->get('cookie.authkey.admin'), //密钥，type=Cookie方式专用
            'tokenExpire' => 3600, //服务端过期时间，Cookie方式时，此时间不宜设置太长
            'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
            'tokenCookieName' => 'slp_ss', //保存token的cookie key，不使用也需配置
            'tokenCookieExpire' => 86400, //0 浏览器退出则失效
            'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
            'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
        ];
    }
    public static $SL_ADMIN_HASH_TOKEN_EXPIRE = 86400;  //客户端记住登陆状态最长时间

    //==== 商家管理后台
    public static $SL_SELLER_SESSION_NAME = 'seller_ss';
    public static function getSlSellerSessionConfig()
    {
        return [
            'type' => 'Cookie', //类型更换后，tokenCookieName需要变更，避免旧数据串扰
            'tokenCookieAuthKey' => Registry::get('config')->get('cookie.authkey.seller'), //密钥，type=Cookie方式专用
            'tokenExpire' => 1200, //服务端过期时间
            'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
            'tokenCookieName' => 'sls_ss', //保存token的cookie key，不使用也需配置
            'tokenCookieExpire' => 0, //0 浏览器退出则失效
            'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
            'tokenCookieHttpOnly' => true, //false Web JS可以访问Cookie，true JS禁止读取cookie
        ];
    }
    public static $SL_SELLER_HASH_TOKEN_EXPIRE = 86400;  //客户端记住登陆状态最长时间

    //==== 图片验证码
    public static $SL_CODE_SESSION_NAME = 'vcode';
    public static $SL_CODE_SESSION_COUNT = 'vcode_count';
    public static function getSlCodeSessionConfig()
    {
        return [
            'type' => 'Redis', //类型更换后，tokenCookieName需要变更，避免旧数据串扰
            'tokenCookieAuthKey' => Registry::get('config')->get('cookie.authkey.imgcode'), //密钥，type=Cookie方式专用
            'tokenExpire' => 600, //服务端过期时间，Cookie方式时，此时间不宜设置太长
            'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
            'tokenCookieName' => 'slc', //保存token的cookie key，不使用也需配置
            'tokenCookieExpire' => 0, //0 浏览器退出则失效
            'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
            'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
        ];
    }

    //==== 用户端
    public static $SL_MEMBER_SESSION_NAME = 'user_xj';
    public static function getSlMemberSessionConfig($refreshClientType)
    {
        return [
            'type' => 'Cookie', //类型更换后，tokenCookieName需要变更，避免旧数据串扰
            'tokenCookieAuthKey' => Registry::get('config')->get('cookie.authkey.user'), //密钥，type=Cookie方式专用
            'tokenExpire' => 86400 * 90, //服务端过期时间
            'tokenSaveInCookie' => 0, //是否把token存入cookie，不保存则需要客户端保存token
            'tokenCookieName' => 'zko_ss', //保存token的cookie key，不使用也需配置
            'tokenCookieExpire' => 0, //0 浏览器退出则失效
            'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
            'tokenCookieHttpOnly' => true, //false Web JS可以访问Cookie，true JS禁止读取cookie
        ];
    }

    //==== 用户端发现
    public static $SL_BLOG_VIEW_VIDEO_NAME = 'blog_view_video';
    public static function getSlBlogViewVIDEOConfig()
    {
        return [
            'type' => 'Cookie', //类型更换后，tokenCookieName需要变更，避免旧数据串扰
            'tokenCookieAuthKey' => Registry::get('config')->get('cookie.authkey.user'), //密钥，type=Cookie方式专用
            'tokenExpire' => 86400, //服务端过期时间
            'tokenSaveInCookie' => 0, //是否把token存入cookie，不保存则需要客户端保存token
            'tokenCookieName' => 'zko_blog', //保存token的cookie key，不使用也需配置
            'tokenCookieExpire' => 0, //0 浏览器退出则失效
            'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
            'tokenCookieHttpOnly' => true, //false Web JS可以访问Cookie，true JS禁止读取cookie
        ];
    }

    /**
     * 客户端记住登陆状态最长时间
     * @param $refreshClientType
     * @return int
     */
    public static function getSLMemberClientExpire($refreshClientType)
    {
        if ($refreshClientType == MemberRefreshTokenCode::TYPE_ANDROID_AIO) {
            return 86400 * 365;  //客户端记住登陆状态最长时间
        } else {
            return 86400 * 180;  //客户端记住登陆状态最长时间
        }
    }
}
