<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="format-detection" content="telephone=no" />
    <title>去结算</title>
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
		<h3>去结算</h3>
		<a class="iconb" href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'index')?>">
		</a>
	</header>

	<div class="contaniner fixed-cont">
		<section class="to-buy">
			<header>
				<div class="now">
					<span><?=\hl\HLView::img('images/map-icon.png');?></span>
						<dl>
							<dt>
								<b>瑾晨</b>
								<strong>13035059860</strong>
							</dt>
							<dd>安徽省合肥市XXXXXXXX</dd>
							<p>其他地址</p>
						</dl>
				</div>

				<div class="to-now">
					<div class="tonow">
							<label for="tonow"  onselectstart="return false" ></label>
							<input type="checkbox" id="tonow"/>
					</div>
					<dl>
							<dt>
								<b>瑾晨</b>
								<strong>13035059860</strong>
							</dt>
							<dd>安徽省合肥市XXXXXXXX</dd>
					</dl>
					<h3><a href="go-address.html"><?=\hl\HLView::img('images/write.png');?></a></h3>
				</div>
			</header>
			<div class="buy-list">
				<ul>
					<a href="detail.html">
						<figure>
							<?=\hl\HLView::img('images/detail-pp01.png');?>
						</figure>
						<li>
							<h3>超级大品牌服装，现在够买只要998</h3>
							<span>
								颜色：经典绮丽款
								<br />
								尺寸：M
							</span>
							<b>￥32.00</b>
							<small>×3</small>
						</li>
					</a>
				</ul>
				<dl>
					<dd>
						<span>运费</span>
						<small>包邮</small>
					</dd>
					<dd>
						<span>商品总额</span>
						<small>￥98.00</small>
					</dd>
					<dt>
						<textarea rows="4" placeholder="给卖家留言（50字以内）"></textarea>
					</dt>
				</dl>
			</div>

		</section>
		<!--底部不够-->
		<div style="margin-bottom: 9%;"></div>
	</div>

	<footer class="buy-footer fixed-footer">
			<p>
				<small>总金额</small>
				<b>￥98.00</b>
			</p>

				<input type="button" value="去付款"/>
	</footer>

	<script type="text/javascript">
		$(".to-now .tonow label").on('touchstart',function(){
			if($(this).hasClass('ton')){
				$(".to-now .tonow label").removeClass("ton")
			}else{
				$(".to-now .tonow label").addClass("ton")
			}
		})
	</script>

</body>
</html>
