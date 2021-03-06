<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>我的</title>
        <?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('address.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<div class="my">
			<header>
				<a class="fl" href="#"><i class="iconfont">&#xe624;</i></a>
				<h2>管理收货地址</h2>
				<a href="#"><i class="iconfont">&#xe62b;</i></a>
			</header>
			<div class="address">
				<div class="addlist">
					<div class="top">
						<p>杨大黄 157****2222</p>
						<p>河北省唐山市高新产业开发区</p>
					</div>
					<div class="bott clearfix">
						<div class="pro clearfix fl">
							<label class="fl">
								<input type="checkbox"/>
								<span></span>
							</label>
							<span>设为默认</span>
						</div>
						<div class="fr">
							<a href="#" class="bj fl"><i class="iconfont">&#xe62b;</i>编辑</a>
							<a href="#" class="del fl"><i class="iconfont">&#xe62b;</i>删除</a>
						</div>
					</div>
				</div>
				<div class="addlist">
					<div class="top">
						<p>杨二黄 157****2222</p>
						<p>河北省唐山市高新产业开发区</p>
					</div>
					<div class="bott clearfix">
						<div class="pro clearfix fl">
							<label class="fl">
								<input type="checkbox"/>
								<span></span>
							</label>
							<span>设为默认</span>
						</div>
						<div class="fr">
							<a href="#" class="bj fl"><i class="iconfont">&#xe62b;</i>编辑</a>
							<a href="#" class="del fl"><i class="iconfont">&#xe62b;</i>删除</a>
						</div>
					</div>
				</div>
				<div class="addlist">
					<div class="top">
						<p>杨小黄 157****2222</p>
						<p>河北省唐山市高新产业开发区</p>
					</div>
					<div class="bott clearfix">
						<div class="pro clearfix fl">
							<label class="fl">
								<input type="checkbox"/>
								<span></span>
							</label>
							<span>设为默认</span>
						</div>
						<div class="fr">
							<a href="#" class="bj fl"><i class="iconfont">&#xe62b;</i>编辑</a>
							<a href="#" class="del fl"><i class="iconfont">&#xe62b;</i>删除</a>
						</div>
					</div>
				</div>
			</div>
			
			
		<!--编辑弹框-->
		<!--遮罩-->
		<div class="mask"></div>
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
		<!--删除的弹框-->
		<div class="delmask">
			<div class="deltk">
				<p>确认删除订单？</p>
				<p>删除之后可以从电脑端订单回收站恢复</p>
				<p>
					<a class="dqx" href="#">取消</a>
					<a class="dqr" href="#">确认</a>
				</p>
			</div>
		</div>
			
			
		<div style="padding-top: 4rem;"></div>
		<!--------------------------footer----------------------->
		<footer>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'index')?>" class="on"><i class="iconfont">&#xe60d;</i><br /><span>首页</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'goods', 'list')?>"><i class="iconfont">&#xe6f4;</i><br /><span>分类</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'match', 'index')?>"><i class="iconfont">&#xe601;</i><br /><span>搭配</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'cart', 'index')?>"><i class="iconfont">&#xe6cc;</i><br /><span>购物车</span></a>
			<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'my', 'index')?>"><i class="iconfont">&#xe607;</i><br /><span>我</span></a>
		</footer>
		
	</body>
    <?=\hl\HLView::js('rem.js');?>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
    <?=\hl\HLView::js('public.js');?>
</html>
