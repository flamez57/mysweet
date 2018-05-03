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

<h5>配置</h5>

1)common

    'url_mode' => 0, 0非美化url  1美化后url
	'module' => 'application', 默认模块
	'controller' => 'index', 默认控制器
	'action' => 'index' 默认方法

2)db

    'default' => [ 默认连接库
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'port' => '3306'
    ], 

<h5>视图</h5>

1)js文件引入

    \hl\HLView::js($path)

2)css文件引入

    \hl\HLView::css($path)

3)图片引入

    \hl\HLView::img($path, $param)
4)传入模板参数

    \hl\HLView::param($key, $value)

5)引入模板

    \hl\HLView::showTpl($path)
