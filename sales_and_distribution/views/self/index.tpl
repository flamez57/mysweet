<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>个人中心</title>
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
	<!--<header class="self-header">
		<figure><img src="images/self-tou.png"/></figure>
		<dl>
			<dt>瑾晨</dt>
			<dd>
				<img src="images/self-header.png"/>
				<span>5684</span>
				<span>炒饭大湿</span>
			</dd>
		</dl>
		<button>签到</button>
	</header>-->

	<div class="p-top  clearfloat">
		<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'qrcode')?>">
			<div class="tu">
				<?=\hl\HLView::img('touxiang.png');?>
			</div>
			<p class="name">Guoguo</p>
		</a>
		<div class="p-bottom p-bottom1 clearfloat">
			<ul class="clearfloat">
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'fxcenter1')?>">
					<li class="box-s">
						<span class="opa6"></span>
						<p class="bt">我的佣金</p>
						<p class="price">0.00</p>
					</li>
				</a>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'integral')?>">
					<li class="box-s">
						<span class="opa6"></span>
						<p class="bt">我的积分</p>
						<p class="price">0</p>
					</li>
				</a>
				<a href="#">
					<li class="box-s">
						<span class="opa6"></span>
						<p class="bt">我的足迹</p>
						<p class="price">0</p>
					</li>
				</a>
			</ul>
		</div>
	</div>
	
	<div class="contaniner fixed-contb">
		<section class="self">
			<dl>
				<dt>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'order', 'index')?>">
						<?=\hl\HLView::img('images/self-icon.png');?>
						<b>全部订单</b>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</dt>
				<dd>
						<ul>
							<li>
								<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'order', 'index')?>">
									<?=\hl\HLView::img('images/order-icon01.png');?>
									<p>待发货</p>
								</a>
							</li>
							<li>
								<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'order', 'index')?>">
									<?=\hl\HLView::img('images/order-icon03.png');?>
									<p>待付款</p>
								</a>
							</li>
							<li>
								<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'order', 'index')?>">
									<?=\hl\HLView::img('images/order-icon02.png');?>
									<p>待收货</p>
								</a>
							</li>
							<li>
								<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'assess', 'index')?>">
									<?=\hl\HLView::img('images/order-icon04.png');?>
									<p>待评价</p>
								</a>
							</li>
						</ul>
				</dd>
			</dl>
			
			<ul class="self-icon">
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'datum')?>">
						<?=\hl\HLView::img('images/self-icon01.png');?>
						<p>个人信息</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'mycollect')?>">
						<?=\hl\HLView::img('images/self-icon02.png');?>
						<p>我的收藏</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'balance')?>">
						<?=\hl\HLView::img('images/self-icon012.png');?>
						<p>消费记录</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'addres')?>">
						<?=\hl\HLView::img('images/self-icon04.png');?>
						<p>地址管理</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
			</ul>
			<ul class="self-icon">
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'gobuy')?>">
						<?=\hl\HLView::img('images/self-icon05.png');?>
						<p>我的分销</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'children')?>">
						<?=\hl\HLView::img('images/self-icon05.png');?>
						<p>我的会员</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
				<li>
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'sign')?>">
						<?=\hl\HLView::img('images/self-icon011.png');?>
						<p>修改密码</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
				<li>
					<a href="#">
						<?=\hl\HLView::img('images/self-icon013.png');?>
						<p>账号绑定</p>
						<span><?=\hl\HLView::img('images/right.png');?></span>
					</a>
				</li>
			</ul>
			<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'login')?>"><input type="button" value="退出" /></a>
			
		</section>
		
		
	</div>
	
	<footer class="page-footer fixed-footer">
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
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'index')?>">
                    <?=\hl\HLView::img('images/footer003.png');?>
					<p>购物车</p>
				</a>
			</li>
			<li class="active">
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'index')?>">
                    <?=\hl\HLView::img('images/footer04.png');?>
					<p>个人中心</p>
				</a>
			</li>
		</ul>
	</footer>
	
	
</body>
</html>
