<?php
namespace hl\library\Functions;
/**
** @ClassName: Jwt
** @Description: token签名验证
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年2月17日 晚上22:49
** @version V1.0
*/
class Jwt
{
    /**
    ** 头部
    ** @var  $header array
    */
    protected static $header = [
        'alg' => 'HS256', //生成signature的算法
        'typ' => 'JWT'  //类型
    ];

    protected static $key;
    protected static $time;

    public function __construct()
    {
        self::$key = 'secret'; //密钥
        self::$time = time();
    }

    /**
    ** 获取jwt token
    ** @param array $payload jwt载荷  格式如下非必须
    ** @return bool|string 返回结果集
    **/
    public static function getToken(array $payload)
    {
        $arr = [
            'iss' => 'mysweet95', //该JWT的签发者
            'iat' => self::$time, //签发时间
            'exp' => self::$time + 15 * 86400, //过期时间
            'nbf' => self::$time, //该时间之前不接收处理该Token
            'sub' => '', //面向的用户
            'jti' => md5(uniqid('JWT') . self::$time) //该Token唯一标识
        ];
        $payload = array_merge($arr, $payload);
        if (is_array($payload)) {
            $base64header = self::base64UrlEncode(json_encode(self::$header, JSON_UNESCAPED_UNICODE));
            $base64payload = self::base64UrlEncode(json_encode($payload, JSON_UNESCAPED_UNICODE));
            $token = $base64header . '.' . $base64payload . '.' .
                self::signature($base64header . '.' . $base64payload, self::$key, self::$header['alg']);
            return $token;
        } else {
            return false;
        }
    }

    /**
    ** 验证token是否有效,默认验证exp,nbf,iat时间
    ** @param string $Token 需要验证的token
    ** @return bool|string 返回结果集
    */
    public static function verifyToken(string $Token)
    {
        $tokens = explode('.', $Token);
        if (count($tokens) != 3) {
            return false;
        }
        list($base64header, $base64payload, $sign) = $tokens;
        //获取jwt算法
        $base64decodeheader = json_decode(self::base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader['alg'])) {
            return false;
        }
        //签名验证
        if (self::signature($base64header . '.' . $base64payload, self::$key, $base64decodeheader['alg']) !== $sign) {
            return false;
        }
        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);
        //签发时间大于当前服务器时间验证失败
        if (isset($payload['iat']) && $payload['iat'] > self::$time) {
            return false;
        }
        //过期时间小宇当前服务器时间验证失败
        if (isset($payload['exp']) && $payload['exp'] < self::$time) {
            return false;
        }
        //该nbf时间之前不接收处理该Token
        if (isset($payload['nbf']) && $payload['nbf'] > self::$time) {
            return false;
        }
        return $payload;
    }

    /**
    ** base64UrlEncode  https://jwt.io/ 中base64UrlEncode编码实现
    ** @param string $input 需要编码的字符串
    ** @return mixed 返回结果集
    */
    private static function base64UrlEncode(string $input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
    **  base64UrlEncode https://jwt.io/ 中base64UrlEncode解码实现
    ** @param string $input 需要解码的字符串
    ** @return false|string 返回结果集
    */
    private static function base64UrlDecode(string $input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
    ** HMACSHA256签名  https://jwt.io/ 中HMACSHA256签名实现
    ** @param string $input 为base64UrlEncode(header).".".base64UrlEncode(payload)
    ** @param string $key
    ** @param string $alg
    ** @return mixed 返回结果集
    */
    private static function signature(string $input, string $key, $alg = "HS256")
    {
        $alg_config = ['HS256' => 'sha256'];
        return self::base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key, true));
    }
}
