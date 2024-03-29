<!DOCTYPE html>
<html lang="zh-Hans">
	<head>
	    <meta name="renderer" content="webkit|ie-comp|ie-stand">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta charset="utf-8">
	    <title>我的店铺管理</title>
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
		<?=\hl\HLView::css('base1.css');?>
	    <?=\hl\HLView::css('common.css');?>
	</head>
	<body>
		<div class="warp clearfloat">
			<!--p-center star-->
			<div id="main" class="clearfloat">
				<div class="p-top dinpu-top clearfloat">
					<a href="personal.html">
						<div class="tu">
							<?=\hl\HLView::img('uploads/10.jpg');?>
						</div>
						<p class="name">Guoguo</p>
					</a>
				</div>
				<div class="dinpu clearfix">
					<ul>
						<a href="#">
							<li class="box-s">
								<span class="fl tit">店铺名称：美妆商城</span>
								<span class="fr icon46"></span>
							</li>
						</a>
						<a href="#">
							<li class="box-s">
								<span class="fl tit">绑定手机：17730261159</span>
								<span class="fr icon46"></span>
							</li>
						</a>
						<a href="#">
							<li class="box-s">
								<span class="fl tit">商品管理</span>
								<span class="fr icon47">编辑</span>
							</li>
						</a>
					</ul>
					<div class="wechat clearfix">
						<p class="ewm">
							<?=\hl\HLView::img('uploads/12.jpg');?>
						</p>
						<p class="jinru t_c"><a href="p-index.html">进入店铺</a></p>
					</div>
				</div>
			</div>
			<!--p-center end-->
		</div>
	</body>
</html>
