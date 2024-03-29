<!DOCTYPE html>
<html lang="zh-Hans">
	<head>
	    <meta name="renderer" content="webkit|ie-comp|ie-stand">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta charset="utf-8">
	    <title>分销中心</title>
	    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <meta http-equiv="Cache-Control" content="no-siteapp">
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="mobile-web-app-capable" content="yes">
	    <meta name="format-detection" content="telephone=no">
	    <meta name="keywords" content="">
	    <meta name="description" content="">
	    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
	    <script src="js/hmt.js" type="text/javascript"></script>
	    <script type="text/javascript" src="js/swipe.js"></script>
	    
	    <link rel="stylesheet" type="text/css" href="css/base.css"/>
	    <link rel="stylesheet" type="text/css" href="css/base1.css"/>
	    <link rel="stylesheet" type="text/css" href="css/common.css"/>
	    <link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body class="fx-center">
		<div class="warp clearfloat">
			<!--header star-->
			<div class="header2 clearfloat box-s" id="header">
				<div class="left1 clearfloat fl">
					<a href="javascript:history.go(-1)" class="back">
						<img src="images/left.png"/>
					</a>
				</div>
				<div class="middle clearfloat fl">
					分销中心
				</div>
			</div>
			<!--header end-->
			<!--p-center star-->
			<div id="main" class="clearfloat">
				<div class="p-top p-top1 clearfloat">
					<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'qrcode')?>">
						<div class="tu">
							<img src="img/touxiang.png"/>
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
							<li class="box-s tit">
								<p class="fl icon299">分销中心</p>
							</li>
						</a>
						<a href="dinpu.html">
							<li class="box-s">
								<p class="fl icon222">我的店铺</p>
								<span class="back fr"></span>
							</li>
						</a>
						<a href="shopcar.html">
							<li class="box-s">
								<p class="fl icon223">修改店铺名</p>
								<span class="back fr"></span>
							</li>
						</a>
						<a href="huiyuan.html">
							<li class="box-s">
								<p class="fl icon222">我的会员</p>
								<span class="back fr"></span>
							</li>
						</a>
						
						<a href="#">
							<li class="box-s">
								<p class="fl icon222">分销商品</p>
								<span class="back fr"></span>
							</li>
						</a>
						<a href="#">
							<li class="box-s">
								<p class="fl icon223">已分销商品</p>
								<span class="back fr"></span>
							</li>
						</a>
					</ul>
				</div>
			</div>
			
		</div>
		<!--p-center end-->
			<footer class="page-footer page-footer1 fixed-footer" id="footer">
				<ul style="height: auto;">
					<li>
						<a href="index.html">
							<img src="images/footer001.png"/>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a href="assort.html">
							<img src="images/footer002.png"/>
							<p>分类</p>
						</a>
					</li>
					<li>
						<a href="shopcar.html">
							<img src="images/footer003.png"/>
							<p>购物车</p>
						</a>
					</li>
					<li class="active">
						<a href="self.html">
							<img src="images/footer04.png"/>
							<p>个人中心</p>
						</a>
					</li>
				</ul>
			</footer>
	</body>
</html>
