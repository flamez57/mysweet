<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>商品列表</title>
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
		<h3>商品列表</h3>

			<a class="iconb" href="#">
				<?=\hl\HLView::img('images/shopbar.png');?>
			</a>
	</header>

	<div class="contaniner fixed-conta">
		<section class="list">
			<figure><?=\hl\HLView::img('images/list-ban01.png');?></figure>
			<div class="search">
				<input type="search" placeholder="韩版卫衣" />
				<label><?=\hl\HLView::img('images/list-search.png');?></label>
			</div>
			<nav>
				<ul>
					<li>
						<a href="#">
							<span>全部</span>
						</a>
					</li>
					<li class="list-active">
						<a href="#">
							<span>销量</span>
							<?=\hl\HLView::img('images/up-red.png');?>
						</a>
					</li>
					<li>
						<a href="#">
							<span>价格</span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>评价</span>
						</a>
					</li>
				</ul>
			</nav>
			<ul class="wall">
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph01.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph02.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph01.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph02.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph01.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph02.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph01.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
				<li class="pic">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
						<?=\hl\HLView::img('images/list-ph02.png');?>
						<p>韩版青少年休闲修身长袖紧身衬衫</p>
						<b>￥58</b><del>￥538</del>
					</a>
				</li>
			</ul>
		</section>
	</div>



	<!--<?=\hl\HLView::js('jquery.min.js');?>-->
	<?=\hl\HLView::js('jaliswall.js');?>
	<script type="text/javascript">
	$(window).load(function(){
		$('.wall').jaliswall({ item: '.pic' });
	});
	</script>
</body>
</html>
