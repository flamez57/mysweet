<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>订单</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('order.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>	
		
		<header>
			<a class="fl" href="#"><i class="iconfont">&#xe624;</i></a>
			<h2>我的订单</h2>
			<a href="#"><i class="iconfont">&#xe62b;</i></a>
		</header>
		<div class="next">
			<nav>
				<ul>
					<li><a class="on" href="#">全部</a></li>
					<li><a  href="#">待付款</a></li>
					<li><a  href="#">待发货</a></li>
					<li><a  href="#">待收货</a></li>
					<li><a  href="#">待评价</a></li>
				</ul>
			</nav>
		</div>
		<div class="proBox">
			<div class="proList">
				<div class="top">
					<a href="#">交易成功</a>
					<span>待评价</span>
				</div>
				<div class="imgbox">
					<a class="proImg" href="#"><?=\hl\HLView::img('s11.jpg');?></a>
					<div class="infor">
						<p>现代简约时尚欧美客厅摆件</p>
						<p>颜色分类：白色瓷瓶+白色枚束</p>
					</div>
					<div class="price">
						<p>￥58.57</p>
						<p>×1</p>
					</div>
				</div>
				<p class="word">共1件商品 合计：￥58.57（含运费￥0.00）</p>
				<div class="proBtn">
					<a href="#">查看订单</a>
					<a href="#">去评价</a>
				</div>
			</div>
			<div class="proList">
				<div class="top">
					<a href="#">待付款</a>
				</div>
				<div class="imgbox">
					<a class="proImg" href="#"><?=\hl\HLView::img('s11.jpg');?></a>
					<div class="infor">
						<p>现代简约时尚欧美客厅摆件</p>
						<p>颜色分类：白色瓷瓶+白色枚束</p>
					</div>
					<div class="price">
						<p>￥58.57</p>
						<p>×1</p>
					</div>
				</div>
				<p class="word">共1件商品 合计：￥58.57（含运费￥0.00）</p>
				<div class="proBtn">
					<a href="#">取消订单</a>
					<a href="#">立即付款</a>
				</div>
			</div>
			<div class="proList">
				<div class="top">
					<a href="#">待收货</a>
				</div>
				<div class="imgbox">
					<a class="proImg" href="#"><?=\hl\HLView::img('s11.jpg');?></a>
					<div class="infor">
						<p>现代简约时尚欧美客厅摆件</p>
						<p>颜色分类：白色瓷瓶+白色枚束</p>
					</div>
					<div class="price">
						<p>￥58.57</p>
						<p>×1</p>
					</div>
				</div>
				<p class="word">共1件商品 合计：￥58.57（含运费￥0.00）</p>
				<div class="proBtn">
					<a href="#">查看物流</a>
					<a href="#">确认收货</a>
				</div>
			</div>
			<div class="proList">
				<div class="top">
					<a href="#">已收货</a>
					<span>待评价</span>
				</div>
				<div class="imgbox">
					<a class="proImg" href="#"><?=\hl\HLView::img('s11.jpg');?></a>
					<div class="infor">
						<p>现代简约时尚欧美客厅摆件</p>
						<p>颜色分类：白色瓷瓶+白色枚束</p>
					</div>
					<div class="price">
						<p>￥58.57</p>
						<p>×1</p>
					</div>
				</div>
				<p class="word">共1件商品 合计：￥58.57（含运费￥0.00）</p>
				<div class="proBtn">
					<a href="#">查看订单</a>
					<a href="#">去评价</a>
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