<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>我的收藏</title>
        <?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('cart.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<!-----------------------------header------------------------>
		<header class="clearfix">
			<h2>我的收藏</h2>
			<p class="fr">
				<a href="#">编辑</a>
				<a href="#"><i class="iconfont">&#xe62b;</i></a>
			</p>
		</header>
		<!---------------------------------plist------------------------>
		<div class="plist collect">
			<div class="bott clearfix">
				<a href="#" class="img fl"><?=\hl\HLView::img('flo3.jpg');?></a>
				<div class="price fl">
					<a href="#" class="word">现代简约工艺花瓶欧洲时尚客厅摆件摆件</a>
					<a href="#" class="word">颜色分类：<span>白色瓷瓶+白色串枚</span></a>
					<p class="clearfix"><a href="#" class="fl">￥20.00</a></p>
				</div>
			</div>
			<div class="bott clearfix">
				<a href="#" class="img fl"><?=\hl\HLView::img('flo3.jpg');?></a>
				<div class="price fl">
					<a href="#" class="word">现代简约工艺花瓶欧洲时尚客厅摆件摆件</a>
					<a href="#" class="word">颜色分类：<span>白色瓷瓶+白色串枚</span></a>
					<p class="clearfix"><a href="#" class="fl">￥20.00</a></p>
				</div>
			</div>
			<div class="bott clearfix">
				<a href="#" class="img fl"><?=\hl\HLView::img('flo3.jpg');?></a>
				<div class="price fl">
					<a href="#" class="word">现代简约工艺花瓶欧洲时尚客厅摆件摆件</a>
					<a href="#" class="word">颜色分类：<span>白色瓷瓶+白色串枚</span></a>
					<p class="clearfix"><a href="#" class="fl">￥20.00</a></p>
				</div>
			</div>
			<div class="bott clearfix">
				<a href="#" class="img fl"><?=\hl\HLView::img('flo3.jpg');?></a>
				<div class="price fl">
					<a href="#" class="word">现代简约工艺花瓶欧洲时尚客厅摆件摆件</a>
					<a href="#" class="word">颜色分类：<span>白色瓷瓶+白色串枚</span></a>
					<p class="clearfix"><a href="#" class="fl">￥20.00</a></p>
				</div>
			</div>
			<div class="qx clearfix">
				<div class="pro clearfix fl">
					<label class="fl">
						<input type="checkbox"/>
						<span></span>
					</label>
					<span>全选</span>
				</div>
				<div class="price fr">
					<span>￥0.00</span>
					<a href="#">结算</a>
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
