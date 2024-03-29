<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8" />
		<title>干花花艺</title>
		<?=\hl\HLView::css('public.css');?>
		<?=\hl\HLView::css('proList.css');?>
	</head>
	<body>
		<!------------------------------head------------------------------>
		<div class="head">
			<div class="wrapper clearfix">
				<div class="clearfix" id="top">
					<h1 class="fl"><a href="index.html"><?=\hl\HLView::img('logo.png');?></a></h1>
					<div class="fr clearfix" id="top1">
						<p class="fl">
							<a href="#" id="login">登录</a>
							<a href="#" id="reg">注册</a>
						</p>
						<form action="#" method="get" class="fl">
							<input type="text" placeholder="搜索" />
							<input type="button" />
						</form>
						<div class="btn fl clearfix">
							<a href="mygxin.html"><?=\hl\HLView::img('grzx.png');?></a>
							<a href="#" class="er1"><?=\hl\HLView::img('ewm.png');?></a>
							<a href="cart.html"><?=\hl\HLView::img('gwc.png');?></a>
							<p><a href="#"><?=\hl\HLView::img('smewm.png');?></a></p>
						</div>
					</div>
				</div>
				<ul class="clearfix" id="bott">
					<li><a href="index.html">首页</a></li>
					<li>
						<a href="#">所有商品</a>
						<div class="sList">
							<div class="wrapper  clearfix">
								<a href="paint.html">
									<dl>
										<dt><?=\hl\HLView::img('nav1.jpg');?></dt>
										<dd>浓情欧式</dd>
									</dl>
								</a>
								<a href="paint.html">
									<dl>
										<dt><?=\hl\HLView::img('nav2.jpg');?></dt>
										<dd>浪漫美式</dd>
									</dl>
								</a>
								<a href="paint.html">
									<dl>
										<dt><?=\hl\HLView::img('nav3.jpg');?></dt>
										<dd>雅致中式</dd>
									</dl>
								</a>
								<a href="paint.html">
									<dl>
										<dt><?=\hl\HLView::img('nav6.jpg');?></dt>
										<dd>简约现代</dd>
									</dl>
								</a>
								<a href="paint.html">
									<dl>
										<dt><?=\hl\HLView::img('nav7.jpg');?></dt>
										<dd>创意装饰</dd>
									</dl>
								</a>
							</div>
						</div>
					</li>
					<li>
						<a href="flowerDer.html">装饰摆件</a>
						<div class="sList2">
							<div class="clearfix">
								<a href="proList.html">干花花艺</a>
								<a href="vase_proList.html">花瓶花器</a>
							</div>
						</div>
					</li>
					<li>
						<a href="decoration.html">布艺软饰</a>
						<div class="sList2">
							<div class="clearfix">
								<a href="zbproList.html">桌布罩件</a>
								<a href="bzproList.html">抱枕靠垫</a>
							</div>
						</div>
					</li>
					<li><a href="paint.html">墙式壁挂</a></li>
					<li><a href="perfume.html">蜡艺香薰</a></li>
					<li><a href="idea.html">创意家居</a></li>
				</ul>
			</div>
		</div>
		<!------------------------------banner------------------------------>
		<div class="banner">
			<a href="#"><?=\hl\HLView::img('temp/banner1.jpg');?></a>
		</div>
		<!-----------------address------------------------------->
		<div class="address">
			<div class="wrapper clearfix">
				<a href="index.html">首页</a>
				<span>/</span>
				<a href="flowerDer.html">装饰摆件</a>
				<span>/</span>
				<a href="proList.html" class="on">干花花艺</a>
			</div>
		</div>
		<!-------------------current---------------------->
		<div class="current">
			<div class="wrapper clearfix">
				<h3 class="fl">干花花艺</h3>
				<div class="fr choice">
					<p class="default">排序方式</p>
					<ul class="select">
						<li>新品上市</li>
						<li>销量从高到低</li>
						<li>销量从低到高</li>
						<li>价格从高到低</li>
						<li>价格从低到高</li>
					</ul>
				</div>
			</div>
		</div>
		<!----------------proList------------------------->
		<ul class="proList wrapper clearfix">
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro01.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro02.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro03.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro04.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro05.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro06.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro07.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro08.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro01.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro02.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro03.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro04.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro05.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro06.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro07.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
			<li>
				<a href="proDetail.html">
					<dl>
						<dt><?=\hl\HLView::img('temp/pro08.jpg');?></dt>
						<dd>【最家】跳舞兰仿真花干花</dd>
						<dd>￥17.90</dd>
					</dl>
				</a>
			</li>
		</ul>
		<!----------------mask------------------->
		<div class="mask"></div>
		<!-------------------mask内容------------------->
		<div class="proDets">
			<?=\hl\HLView::img('temp/off.jpg', ['class' => 'off']);?>
			<div class="tit clearfix">
				<h4 class="fl">【最家】非洲菊仿真花干花</h4>
				<span class="fr">￥17.90</span>
			</div>
			<div class="proCon clearfix">
				<div class="proImg fl">
					<?=\hl\HLView::img('temp/proDet.jpg', ['class' => 'list']);?>
					<div class="smallImg clearfix">
						<?=\hl\HLView::img('temp/proDet01.jpg', ['data-src' => 'temp/proDet01_big.jpg']);?>
						<?=\hl\HLView::img('temp/proDet02.jpg', ['data-src' => 'temp/proDet02_big.jpg']);?>
						<?=\hl\HLView::img('temp/proDet03.jpg', ['data-src' => 'temp/proDet03_big.jpg']);?>
						<?=\hl\HLView::img('temp/proDet04.jpg', ['data-src' => 'temp/proDet04_big.jpg']);?>
					</div>
				</div>
				<div class="fr">
					<div class="proIntro">
						<p>颜色分类</p>
						<div class="smallImg clearfix categ">
							<p class="fl"><?=\hl\HLView::img('temp/prosmall01.jpg', ['alt' => '白瓷花瓶+20支快乐花', 'data-src' => 'temp/proBig01.jpg']);?></p>
							<p class="fl"><?=\hl\HLView::img('temp/prosmall02.jpg', ['alt' => '白瓷花瓶+20支兔尾巴草', 'data-src' => 'temp/proBig02.jpg']);?></p>
							<p class="fl"><?=\hl\HLView::img('temp/prosmall03.jpg', ['alt' => '20支快乐花', 'data-src' => 'temp/proBig03.jpg']);?></p>
							<p class="fl"><?=\hl\HLView::img('temp/prosmall04.jpg', ['alt' => '20支兔尾巴草', 'data-src' => 'temp/proBig04.jpg']);?></p>
						</div>
						<p>数量&nbsp;&nbsp;库存<span>2096</span>件</p>
						<div class="num clearfix">
							<?=\hl\HLView::img('temp/sub.jpg', ['class' => 'fl sub']);?>
							<span class="fl" contentEditable="true">1</span>
							<?=\hl\HLView::img('temp/add.jpg', ['class' => 'fl add']);?>
							<p class="please fl">请选择商品属性!</p>
						</div>
					</div>
					<div class="btns clearfix">
						<a href="#2"><p class="buy fl">立即购买</p></a>
						<a href="#2"><p class="cart fr">加入购物车</p></a>
					</div>
				</div>
			</div>
			<a class="more" href="proDetail.html">查看更多细节</a>
		</div>
		<!--返回顶部-->
		<div class="gotop">
			<a href="cart.html">
			<dl class="goCart">
				<dt><?=\hl\HLView::img('gt1.png');?></dt>
				<dd>去购<br />物车</dd>
				<span>1</span>
			</dl>
			</a>
			<a href="#" class="dh">
			<dl>
				<dt><?=\hl\HLView::img('gt2.png');?></dt>
				<dd>联系<br />客服</dd>
			</dl>
			</a>
			<a href="mygxin.html">
			<dl>
				<dt><?=\hl\HLView::img('gt3.png');?></dt>
				<dd>个人<br />中心</dd>
			</dl>
			</a>
			<a href="#" class="toptop" style="display: none;">
			<dl>
				<dt><?=\hl\HLView::img('gt4.png');?></dt>
				<dd>返回<br />顶部</dd>
			</dl>
			</a>
			<p>400-800-8200</p>
		</div>
		<div class="msk"></div>
		<!--footer-->
		<div class="footer">
			<div class="top">
				<div class="wrapper">
					<div class="clearfix">
						<a href="#2" class="fl"><?=\hl\HLView::img('foot1.png');?></a>
						<span class="fl">7天无理由退货</span>
					</div>
					<div class="clearfix">
						<a href="#2" class="fl"><?=\hl\HLView::img('foot2.png');?></a>
						<span class="fl">15天免费换货</span>
					</div>
					<div class="clearfix">
						<a href="#2" class="fl"><?=\hl\HLView::img('foot3.png');?></a>
						<span class="fl">满599包邮</span>
					</div>
					<div class="clearfix">
						<a href="#2" class="fl"><?=\hl\HLView::img('foot4.png');?></a>
						<span class="fl">手机特色服务</span>
					</div>
				</div>
			</div>
			<p class="dibu">最家家居&copy;2013-2017公司版权所有 京ICP备080100-44备0000111000号<br />
			违法和不良信息举报电话：188-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</p>
		</div>
		<?=\hl\HLView::js('jquery-1.12.4.min.js');?>
		<?=\hl\HLView::js('public.js');?>
		<?=\hl\HLView::js('nav.js');?>
		<?=\hl\HLView::js('pro.js');?>
		<?=\hl\HLView::js('cart.js');?>
	</body>
</html>
