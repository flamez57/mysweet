<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>登录</title>
    <?=\hl\HLView::css('loaders.min.css');?>
    <?=\hl\HLView::css('loading.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('style.css');?>
    <?=\hl\HLView::js('jquery.min.js');?>
    <script type="text/javascript">
    	$(window).load(function(){
    		$(".loading").addClass("loader-chanage")
    		$(".loading").fadeOut(300)
    	})
    </script>
</head>
<!--loading页开始-->
<div class="loading">
	<div class="loader">
        <div class="loader-inner pacman">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
	</div>
</div>
<!--loading页结束-->
<body>
	<header class="top-header">
		<a class="text texta" href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'index', 'index')?>">取消</a>
		<h3>登录</h3>
		<a class="text" href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'sign')?>">注册</a>
	</header>
	
	<div class="login">
		<form>
			<ul>
				<li>
					<?=\hl\HLView::img('images/login.png');?>
					<label>账号</label>
					<input type="text" placeholder="请输入账号"/>
				</li>
				<li>
					<?=\hl\HLView::img('images/password.png');?>
					<label>密码</label>
					<input type="password" placeholder="请输入密码"/>
				</li>
			</ul>
			<input type="submit" value="登录"/>
		</form>
	</div>

</body>
</html>