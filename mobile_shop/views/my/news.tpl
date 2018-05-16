<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>订单</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('news.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>	
		
		<header>
			<a class="fl" href="#"><i class="iconfont">&#xe624;</i></a>
			<h2>我的消息</h2>
			<a href="#"><i class="iconfont">&#xe62b;</i></a>
		</header>
		<div class="pa">
			<div class="newList clearfix first">
				<a href="#" class="fl"><?=\hl\HLView::img('news1.jpg');?><span></span></a>
				<div class="fl">
					<div class="clearfix">
						<h3 class="fl">官方消息</h3><span class="fr">10:23</span></div>
					<p class="you">[通知]</p>
				</div>
			</div>
			<div class="newList clearfix first">
				<a href="#" class="fl"><?=\hl\HLView::img('news2.jpg');?></a>
				<div class="fl">
					<div class="clearfix">
						<h3 class="fl">通知</h3><span class="fr">8:40</span></div>
					<p class="you">有新的消息都在这里显示哟~</p>
				</div>
			</div>
			<div class="newList clearfix first">
				<a href="#" class="fl"><?=\hl\HLView::img('news3.jpg');?></a>
				<div class="fl">
					<div class="clearfix">
						<h3 class="fl">shop 41</h3><span class="fr">9:33</span></div>
					<p class="you">欢迎光临本店。</p>
				</div>
			</div>
			<div class="newList clearfix first">
				<a href="#" class="fl"><?=\hl\HLView::img('news1.jpg');?></a>
				<div class="fl">
					<div class="clearfix">
						<h3 class="fl">官方消息</h3><span class="fr">10:23</span></div>
					<p class="you">[通知]</p>
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
        <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
        <?=\hl\HLView::js('rem.js');?>
        <?=\hl\HLView::js('public.js');?>
	</body>
</html>