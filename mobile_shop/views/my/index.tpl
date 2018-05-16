<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>我的</title>
        <?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('kind.css')?>
        <?=\hl\HLView::css('my.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<div class="my">
			<header>
				<a class="fl" href="#"><i class="iconfont">&#xe624;</i></a>
				<h2>我的</h2>
				<a href="#"><i class="iconfont">&#xe62b;</i></a>
			</header>
			<div class="myMsg">
				<div class="pic">
					<p></p>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'login')?>"><?=\hl\HLView::img('temp/pic.jpg');?></a>
					<p></p>
				</div>
				<p class="userName">尤物范儿</p>
			</div>
			<div class="navList">
				<nav>
					<a href="order.html"><i class="iconfont">&#xe606;</i>待付款</a>
					<a href="order.html"><i class="iconfont">&#xe63e;</i>待收货</a>
					<a href="order.html"><i class="iconfont">&#xe627;</i>已完成</a>
				</nav>
				<div class="subNav">
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'order')?>"><i class="iconfont">&#xe603;</i><br/>全部订单</a>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'news')?>"><i class="iconfont">&#xe62b;</i><br/>我的消息</a>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'address', 'index')?>"><i class="iconfont">&#xe614;</i><br/>我的地址</a>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'collec')?>"><i class="iconfont">&#xe689;</i><br/>我的收藏</a>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'eva')?>"><i class="iconfont">&#xe62c;</i><br/>我的评价</a>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'msg')?>"><i class="iconfont">&#xe6aa;</i><br/>资料修改</a>
					<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'collec')?>"><i class="iconfont">&#xe689;</i><br/>我的收藏</a>
					<a href="#"><i class="iconfont">&#xe606;</i><br/>意见反馈</a>
				</div>
			</div>
			
		</div>
		<div style="padding-top: 4rem;"></div>
		<!--------------------------footer----------------------->
		<footer>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'index')?>" class="on"><i class="iconfont">&#xe60d;</i><br /><span>首页</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><i class="iconfont">&#xe6f4;</i><br /><span>分类</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'match', 'index')?>"><i class="iconfont">&#xe601;</i><br /><span>搭配</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'cart', 'index')?>"><i class="iconfont">&#xe6cc;</i><br /><span>购物车</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'index')?>"><i class="iconfont">&#xe607;</i><br /><span>我</span></a>
		</footer>
		
	</body>
    <?=\hl\HLView::js('rem.js');?>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
    <?=\hl\HLView::js('public.js');?>
</html>
