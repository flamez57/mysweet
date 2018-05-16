<!doctype html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>登陆</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('login.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<div class="login">
			<h1><a href="#"><?=\hl\HLView::img('logo.png');?></a></h1>
			<form action="#" method="post" class="clearfix">
				<p><i class="iconfont">&#xe607;</i><input type="text" name="" id="" value="" autocomplete="" placeholder="用户名/邮箱地址/手机号" /></p>
				<p><i class="iconfont">&#xe6b7;</i><input type="text" name="" id="" value="" placeholder="请输入密码" /></p>
				<a href="#" class="fr">忘记密码？</a>
			</form>
			<p><input type="button" name="" id="" value="登录" /></p>
			<p><input type="button" name="" id="" value="注册" /></p>
			<p>—————<span>快捷登陆</span>—————</p>
			<p>
				<a href="#"><i class="iconfont">&#xe63c;</i></a>
				<a href="#"><i class="iconfont">&#xe63c;</i></a>
				<a href="#"><i class="iconfont">&#xe63c;</i></a>
			</p>
			<div class="footer">Copyright&copy;2013-2017 MINGDE</div>
		</div>
        <?=\hl\HLView::js('rem.js');?>
        <?=\hl\HLView::js('public.js');?>
	</body>
</html>
