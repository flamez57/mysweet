### session使用
```angular2html
//配置信息
$config = [
    'type' => 'Cookie', //类型更换后，tokenCookieName需要变更，避免旧数据串扰  Redis还未调通
    'tokenCookieAuthKey' => 'mysweet95', //密钥，type=Cookie方式专用
    'cookieDomain' => 'mysweet.cc', //token存放域名
    'tokenExpire' => 3600, //服务端过期时间，Cookie方式时，此时间不宜设置太长
    'tokenSaveInCookie' => 1, //是否把token存入cookie，不保存则需要客户端保存token
    'tokenCookieName' => 'hl_f', //保存token的cookie key，不使用也需配置
    'tokenCookieExpire' => 86400, //0 浏览器退出则失效
    'tokenCookieSecure' => false, //false Cookie http明文模式，true https加密模式
    'tokenCookieHttpOnly' => false, //false Web JS可以访问Cookie，true JS禁止读取cookie
];
//初始化
$session = HLSession::getInstance($config)->init();
//添加要保存的值
$session->set('member_id', $member['id']);
$session->set('token', $token);
//保存
$session->save();
//获取生成的token
$session->getToken();

//接受到token初始化
$session = HLSession::getInstance(self::$config['token']['blogapi'])->init($token);
//未接受token初始化
$session = HLSession::getInstance(self::$config['token']['blogapi'])->init();
//获取session里面的值
$memberId = $session->get('member_id');
$token = $session->getToken(); //获取token
```
