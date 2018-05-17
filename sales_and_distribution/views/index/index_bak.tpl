<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>商城</title>
    <?=\hl\HLView::css('loaders.min.css');?>
    <?=\hl\HLView::css('loading.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('style.css');?>
    <?=\hl\HLView::css('swiper.min.css');?>
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
	

	<header class="page-header">
		<h3>商城</h3>
	</header>
	
	<div class="contaniner fixed-contb">
		<figure class="ban swiper-container">
			<ul class="swiper-wrapper">
				<li class="swiper-slide">
					<a href="#">
						<?=\hl\HLView::img('images/index-ban01.png');?>
					</a>
				</li>
				<li class="swiper-slide">
					<a href="#">
						<?=\hl\HLView::img('images/index-ban02.png');?>
					</a>
				</li>
				<li class="swiper-slide">
					<a href="#">
						<?=\hl\HLView::img('images/index-ban03.png');?>
					</a>
				</li>
			</ul>
		</figure>
		
		<section class="shop">
			<h3>
				<a href="#">
					服装
					<span><?=\hl\HLView::img('images/right.png');?></span>
				</a>
			</h3>
			<dl>
				<dd>
					<a href="list.html">
						<?=\hl\HLView::img('images/index-ph01.png');?>
						<b>男装</b>
					</a>
				</dd>
				<dd>
					<a href="list.html">
						<?=\hl\HLView::img('images/index-ph02.png');?>
						<b>女装</b>
					</a>
				</dd>
			</dl>
		</section>
		
		<section class="shop">
			<h3>
				<a href="list.html">
					食品
					<span><?=\hl\HLView::img('images/right.png');?></span>
				</a>
			</h3>
			<dl>
				<dd>
					<a href="list.html">
						<?=\hl\HLView::img('images/index-03.png');?>
						<b>切糕</b>
					</a>
				</dd>
				<dd>
					<a href="list.html">
						<?=\hl\HLView::img('images/index-ph04.png');?>
						<b>酥饼</b>
					</a>
				</dd>
			</dl>
		</section>
	</div>
	
	<footer class="page-footer fixed-footer">
		<ul>
			<li class="active">
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'index', 'index')?>">
                    <?=\hl\HLView::img('images/footer01.png');?>
					<p>首页</p>
				</a>
			</li>
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'assort', 'index')?>">
                    <?=\hl\HLView::img('images/footer002.png');?>
					<p>分类</p>
				</a>
			</li>
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'index')?>">
                    <?=\hl\HLView::img('images/footer003.png');?>
					<p>购物车</p>
				</a>
			</li>
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'index')?>">
                    <?=\hl\HLView::img('images/footer004.png');?>
					<p>个人中心</p>
				</a>
			</li>
		</ul>
	</footer>
	
	
    <?=\hl\HLView::js('swiper.min.js');?>
	<script type="text/javascript">
		$(document).ready(function(){
			var mySwiper = new Swiper('.swiper-container',{
				    loop: true,
				    speed:1000,
					autoplay: 2000
				  });
		})
	</script>
</body>
</html>