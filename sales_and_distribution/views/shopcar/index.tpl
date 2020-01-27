<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>购物车</title>
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
	<header class="page-header">
		<h3>购物车</h3>
	</header>
	
	<div class="contaniner fixed-contb">
		<section class="shopcar">
			<div class="shopcar-checkbox">
				<label for="shopcar" onselectstart="return false"></label>
				<input type="checkbox" id="shopcar"/>
			</div>
			<figure><?=\hl\HLView::img('images/shopcar-ph01.png');?></figure>
			<dl>
				<dt>超级大品牌服装，现在买只要998</dt>
				<dd>颜色：经典绮丽款</dd>
				<dd>尺寸：L</dd>
				<div class="add">
					<span>-</span>
					<input type="text" value="3" />
					<span>+</span>
				</div>
				<h3>￥653.00</h3>
				<small><?=\hl\HLView::img('images/shopcar-icon01.png');?></small>
			</dl>
		</section>
		<!--去结算-->
		<div style="margin-bottom: 16%;"></div>
		
	</div>
	<script type="text/javascript">
		$(".shopcar-checkbox label").on('touchstart',function(){
			if($(this).hasClass('shopcar-checkd')){
				$(".shopcar-checkbox label").removeClass("shopcar-checkd")
			}else{
				$(".shopcar-checkbox label").addClass("shopcar-checkd")
			}
		})
	</script>
	<footer class="page-footer fixed-footer">
		<div class="shop-go">
			<b>合计：￥108.90</b>
			<span><a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'buy')?>">去结算（2）</a></span>
		</div>
		<ul>
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'index', 'index')?>">
                    <?=\hl\HLView::img('images/footer001.png');?>
					<p>首页</p>
				</a>
			</li>
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'assort', 'index')?>">
                    <?=\hl\HLView::img('images/footer002.png');?>
					<p>分类</p>
				</a>
			</li>
			<li class="active">
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'index')?>">
                    <?=\hl\HLView::img('images/footer03.png');?>
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
	
	
</body>
</html>
