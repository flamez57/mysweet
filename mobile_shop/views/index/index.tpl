<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>首页</title>
        <?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('index.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<!-----------------------------header------------------------>
		<header class="clearfix">
			<a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'index')?>" class="fl"><i class="iconfont">&#xe62b;</i></a>
			<h1 class="fl"><a href="#"><?=\hl\HLView::img('logo.png', ['alt' => '']);?></a></h1>
			<a href="#" class="fr"><i class="iconfont">&#xe62f;</i></a>
		</header>
		<!-------------------------banner--------------------------->
		<div class="block_home_slider">
			<div id="home_slider" class="flexslider">
				<ul class="slides">
					<li>
						<div class="slide">
                            <?=\hl\HLView::img('banner1.jpg');?>
						</div>
					</li>
					<li>
						<div class="slide">
                            <?=\hl\HLView::img('banner2.jpg');?>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!-------------------------nav--------------------------->
		<nav>
			<ul>
				<li><a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><?=\hl\HLView::img('na1.jpg');?><span>摆件</span></a></li>
				<li><a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><?=\hl\HLView::img('na2.jpg');?><span>软饰</span></a></li>
				<li><a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><?=\hl\HLView::img('na3.jpg');?><span>壁挂</span></a></li>
				<li><a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><?=\hl\HLView::img('na4.jpg');?><span>香薰</span></a></li>
				<li><a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><?=\hl\HLView::img('na5.jpg');?><span>家居</span></a></li>
			</ul>
		</nav>
		<!-------------------------trueL--------------------------->
		<div class="trueL gong">
			<h3><?=\hl\HLView::img('ih1.jpg');?></h3>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'list')?>" class="ad"><?=\hl\HLView::img('nav.jpg');?></a>
			<ul class="clearfix">
				<li><a href="#"><?=\hl\HLView::img('n2.jpg');?><span>¥29.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('n3.jpg');?><span>¥19.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('n4.jpg');?><span>¥29.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('n5.jpg');?><span>¥19.00</span></a></li>
			</ul>
		</div>
		<!-------------------------flower--------------------------->
		<div class="flower gong">
			<h3><?=\hl\HLView::img('ih2.jpg');?></h3>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'list')?>" class="ad"><?=\hl\HLView::img('nav2.jpg');?></a>
			<ul class="clearfix">
				<li><a href="#"><?=\hl\HLView::img('flo1.jpg');?><span>¥59.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('flo2.jpg');?><span>¥79.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('flo3.jpg');?><span>¥59.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('flo4.jpg');?><span>¥44.00</span></a></li>
			</ul>
		</div>
		<!-------------------------bigua--------------------------->
		<div class="bigua gong">
			<h3><?=\hl\HLView::img('ih3.jpg');?></h3>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'list')?>" class="ad"><?=\hl\HLView::img('nav3.jpg');?></a>
			<ul class="clearfix">
				<li><a href="#"><?=\hl\HLView::img('s4.jpg');?><span>¥159.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('s9.jpg');?><span>¥179.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('s6.jpg');?><span>¥159.00</span></a></li>
				<li><a href="#"><?=\hl\HLView::img('s7.jpg');?><span>¥144.00</span></a></li>
			</ul>
		</div>
		
		<p class="xl">下拉继续加载</p>
		
		
		
		
		
		
		
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
    <?=\hl\HLView::js('jquery.flexslider-min.js');?>
	<script type="text/javascript">
        $(function() {
            $('#home_slider').flexslider({
                animation: 'slide',
                controlNav: true,
                directionNav: false,
                animationLoop: true,
                slideshow: true,
                slideshowSpeed:2000,
                useCSS: false
            });
        });
    </script>
</html>
