<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>订单列表</title>
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
	<header class="top-header fixed-header">
		<a class="icona" href="javascript:history.go(-1)">
			<?=\hl\HLView::img('images/left.png');?>
		</a>
		<h3>全部订单</h3>
			<a class="iconb" href="#">
			</a>
	</header>

	<div class="contaniner fixed-conta">
		<section class="order">
			<dl>
				<dt>
					<time>2015-11-15 22:55:59</time>
					<span>待发货</span>
				</dt>
				<ul>
					<a href="detail.html">
						<figure><?=\hl\HLView::img('images/classify-ph03.png');?></figure>
						<li>
							<p>超级大品牌服装，现在够级大品牌服装，现在够买只要998</p>
							<small>颜色：经典绮丽款</small>
							<span>尺寸：XL</span>
							<b>￥32.00</b>
							<strong>×3</strong>
						</li>
					</a>
				</ul>
				<dd>
					<h3>商品总额</h3>
					<i>￥98.00</i>
				</dd>
				<dd>
					<input type="button" value="确认收货" class="order-que"/>
					<input type="button" value="查看物流" onclick="javascript:location.href='<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'order', 'logistics')?>'" />
					<input type="button" value="取消订单" />
				</dd>
			</dl>

			<dl>
				<dt>
					<time>2015-11-15 22:55:59</time>
					<span>待发货</span>
				</dt>
				<ul>
					<a href="detail.html">
						<figure><?=\hl\HLView::img('images/classify-ph03.png');?></figure>
						<li>
							<p>超级大品牌服装，现在够级大品牌服装，现在够买只要998</p>
							<small>颜色：经典绮丽款</small>
							<span>尺寸：XL</span>
							<b>￥32.00</b>
							<strong>×3</strong>
						</li>
					</a>
				</ul>
				<dd>
					<h3>商品总额</h3>
					<i>￥98.00</i>
				</dd>
				<dd>
					<input type="button" value="确认收货" class="order-que"/>
					<input type="button" value="查看物流" onclick="javascript:location.href='<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'order', 'logistics')?>'" />
					<input type="button" value="取消订单" />


				</dd>
			</dl>
		</section>
	</div>
</body>
</html>
