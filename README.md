# mysweet
<h5>环境需要</h5>
注意需要支持命名空间

<h6>Apache 配置</h6>

1）首先需要apache开启重定向，修改httpd.conf配置：

    查找：
    Options FollowSymLinks 
    AllowOverride None
    改为： 
    Options FollowSymLinks 
    AllowOverride All

2）去掉下面的注释 

    LoadModule rewrite_module modules/mod_rewrite.so      //去掉行前的#


<h6>Nginx 重定向配置</h6>

    # nginx rewrite  rule 
    rewrite ^(.*)/(.*)_(.*)_(.*).html$ $1/index.php?m=$2&c=$3&a=$4 last;
    # end nginx rewrite rule

<h5>框架结构</h5>

    application 应用示例
    hl 框架核心
    config 框架配置

<h5>路由</h5>

1)生成连接

    \hl\HLRoute::makeUrl($model, $controller, $action);

2)获取参数

    \hl\HLRoute::getParam($key, $value);

<h5>数据响应</h5>
1)json

    \hl\library\Tools\HLResponse::json(200, 'success', $data);

2)xml

    \hl\library\Tools\HLResponse::xmlToEncode(200, 'success', $data);

3)综合

    \hl\library\Tools\HLResponse::show(200, 'success', $data, 'xml');