<!DOCTYPE html>
<html lang="zh-Hans">
	<head>
	    <meta name="renderer" content="webkit|ie-comp|ie-stand">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta charset="utf-8">
	    <title>我的会员</title>
	    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta http-equiv="Cache-Control" content="no-siteapp">
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="mobile-web-app-capable" content="yes">
	    <meta name="format-detection" content="telephone=no">
	    <meta name="keywords" content="">
	    <meta name="description" content="">
	    <?=\hl\HLView::js('jquery-1.8.3.min.js');?>
	    <?=\hl\HLView::js('hmt.js');?>
	    <?=\hl\HLView::js('swipe.js');?>
		<?=\hl\HLView::css('base.css');?>
		<?=\hl\HLView::css('base1.css');?>
	    <?=\hl\HLView::css('common.css');?>
	    <?=\hl\HLView::css('style.css');?>
	</head>
	<body class="fx-center">
		<div class="warp clearfloat">
			<!--header star-->
			<div class="header2 clearfloat box-s" id="header">
				<div class="left1 clearfloat fl">
					<a href="javascript:history.go(-1)" class="back">
						<?=\hl\HLView::img('images/left.png');?>
					</a>
				</div>
				<div class="middle clearfloat fl">
					我的会员
				</div>
				<div class="right1 fr clearfloat">
					<a href="#" class="back"></a>
				</div>
			</div>
			<!--header end-->
			<!--p-center star-->
			<div id="main" class="clearfloat">
				<div class="p-top p-top1 clearfloat">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'qrcode')?>">
						<div class="tu">
							<?=\hl\HLView::img('touxiang.png');?>
						</div>
						<p class="name">Guoguo</p>
					</a>
					<div class="p-bottom clearfloat">
						<ul>
							<a href="#">
								<li class="box-s">
									<span class="opa6"></span>
									<p class="bt">资格</p>
									<p class="price">分销商</p>
								</li>
							</a>
							<a href="#">
								<li class="box-s">
									<span class="opa6"></span>
									<p class="bt">累计销售</p>
									<p class="price">￥138</p>
								</li>
							</a>
							<a href="#">
								<li class="box-s">
									<span class="opa6"></span>
									<p class="bt">累计佣金</p>
									<p class="price">￥2.76</p>
								</li>
							</a>
						</ul>
					</div>
				</div>
				<div class="p-list p-listtwo clearfloat">
					<ul>
						<a href="#">
							<li class="box-s">
								<p class="fl icon222 icon223">我的一级会员</p>
								<p class="list-number fr">2人</p>
							</li>
						</a>
						<a href="#">
							<li class="box-s">
								<p class="fl icon222 icon223">我的二级会员</p>
								<p class="list-number fr">2人</p>
							</li>
						</a>
						<a href="#">
							<li class="box-s">
								<p class="fl icon222 icon223">我的三级会员</p>
								<p class="list-number fr">2人</p>
							</li>
						</a>
					</ul>
				</div>

			</div>

		</div>
		<!--p-center end-->
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
