<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8" />
		<title>最家</title>
        <?=\hl\HLView::css('public.css');?>
        <?=\hl\HLView::css('mygxin.css');?>
	</head>
	<body>
		<!------------------------------head------------------------------>
		<div class="head ding">
			<div class="wrapper clearfix">
				<div class="clearfix" id="top">
					<h1 class="fl"><a href="index.html"><?=\hl\HLView::img('logo.png');?></a></h1>
					<div class="fr clearfix" id="top1">
						<p class="fl">
							<a href="login.html" id="login">登录</a>
							<a href="reg.html" id="reg">注册</a>
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
		<!------------------------------idea------------------------------>
		<div class="address mt">
			<div class="wrapper clearfix">
				<a href="index.html" class="fl">首页</a>
				<span>/</span>
				<a href="mygxin.html">个人中心</a>
				<span>/</span>
				<a href="address.html" class="on">地址管理</a>
			</div>
		</div>

		<!------------------------------Bott------------------------------>
		<div class="Bott">
			<div class="wrapper clearfix">
				<div class="zuo fl">
					<h3>
						<a href="#"><?=\hl\HLView::img('tx.png');?></a>
						<p class="clearfix"><span class="fl">[羊羊羊]</span><span class="fr">[退出登录]</span></p>
					</h3>
					<div>
						<h4>我的交易</h4>
						<ul>
							<li><a href="cart.html">我的购物车</a></li>
							<li><a href="myorderq.html">我的订单</a></li>
							<li><a href="myprod.html">评价晒单</a></li>
						</ul>
						<h4>个人中心</h4>
						<ul>
							<li><a href="mygxin.html">我的中心</a></li>
							<li class="on"><a href="address.html">地址管理</a></li>
						</ul>
						<h4>账户管理</h4>
						<ul>
							<li><a href="mygrxx.html">个人信息</a></li>
							<li><a href="remima.html">修改密码</a></li>
						</ul>
					</div>
				</div>
				<div class="you fl">
					<h2>收货地址</h2>
					<div class="add">
						<div>
							<a href="#2" id="addxad"><?=\hl\HLView::img('jia.png');?></a>
							<span>添加新地址</span>
						</div>
						<div id="dizhi">
							<p>六六六</p>
							<p>1573****666</p>
							<p>河北省 唐山市 路北区</p>
							<p>唐山市大学生公寓村（063000）</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--编辑弹框-->
		<!--遮罩-->
		<div class="mask"></div>
		<div class="adddz">
			<form action="#" method="get">
				<input type="text" placeholder="姓名" class="on" />
				<input type="text" placeholder="手机号" />
				<div class="city">
					<select name="">
						<option value="省份/自治区">省份/自治区</option>
					</select>
					<select>
						<option value="城市/地区">城市/地区</option>
					</select>
					<select>
						<option value="区/县">区/县</option>
					</select>
					<select>
						<option value="配送区域">配送区域</option>
					</select>
				</div>
				<textarea name="" rows="" cols="" placeholder="详细地址"></textarea>
				<input type="text" placeholder="邮政编码" />
				<div class="bc">
					<input type="button" value="保存" />
					<input type="button" value="取消" />
				</div>
			</form>
		</div>
		<div class="readd">
			<form action="#" method="get">
				<input type="text"  class="on" value="六六六" />
				<input type="text" value="157****0022" />
				<div class="city">
					<select name="">
						<option value="省份/自治区">河北省</option>
					</select>
					<select>
						<option value="城市/地区">唐山市</option>
					</select>
					<select>
						<option value="区/县">路北区</option>
					</select>
					<select>
						<option value="配送区域">火炬路</option>
					</select>
				</div>
				<textarea name="" rows="" cols="" placeholder="详细地址">高新产业园</textarea>
				<input type="text" placeholder="邮政编码" value="063000"/>
				<div class="bc">
					<input type="button" value="保存" />
					<input type="button" value="取消" />
				</div>
			</form>
		</div>
		<!--返回顶部-->
		<div class="gotop">
			<a href="cart.html">
			<dl>
				<dt><?=\hl\HLView::img('gt1.png');?></dt>
				<dd>去购<br />物车</dd>
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
			<a href="#" class="toptop" style="display: none">
			<dl>
				<dt><?=\hl\HLView::img('gt4.png');?></dt>
				<dd>返回<br />顶部</dd>
			</dl>
			</a>
			<p>400-800-8200</p>
		</div>


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
			违法和不良信息举报电话：400-800-8200，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试</p>
		</div>
        <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
        <?=\hl\HLView::js('public.js');?>
        <?=\hl\HLView::js('user.js');?>
	</body>
</html>
