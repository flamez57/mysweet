<!DOCTYPE html>
<html>
<head>
	<title>首页模板</title>
    <link rel="shortcut icon" href="./favicon.png" type="image/png">
    <style type="text/css">
        body{
            display:flex;
        }
        .list1 ul{
            overflow: hidden;
        }
        .list1 li{
            float: left;
            list-style-type: none;
        }
        .list1 a{
            display: block;
            padding: 0 16px;
            text-decoration: none;
            color: #999;
        }
        .list1 li+li a{
            border-left: 1px solid #aaa;
        }
        .list1 a:hover{
            color: #555;
        }

    </style>
</head>
<body>
    <div style="width:auto; display:inline-block !important; margin:300px auto;">
        <div>
            <?=\hl\HLView::img('deer.gif', ['width' => '200px']);?>
            <?=\hl\HLView::img('mysweet.png', ['width' => '200px']);?>
        </div>
        <nav class="list1">
            <ul>
                <li><a href="<?=\hl\HLRoute::makeUrl('application', 'index', 'index')?>">hello world!</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'index')?>">企业站!</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('blog', 'index', 'index')?>">博客</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'index')?>">手机商城</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('pc_shop', 'index', 'index')?>">pc商城</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'index', 'index')?>">分销商城</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('application', 'index', 'install')?>">安装</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('admin', 'index', 'index')?>">管理后台</a></li>
                <li><a href="<?=\hl\HLRoute::makeUrl('application', 'index', 'test')?>">测试用</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
