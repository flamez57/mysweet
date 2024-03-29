<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>商品详情</title>
	<?=\hl\HLView::css('loaders.min.css');?>
    <?=\hl\HLView::css('loading.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('style.css');?>
    <?=\hl\HLView::css('swiper.min.css');?>
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
	<header class="detail-header fixed-header">
		<a href="javascript:history.go(-1)"><?=\hl\HLView::img('images/left.png');?></a>

		<a href="#" class="right"><?=\hl\HLView::img('images/shopbar.png');?></a>
	</header>


	<div class="contaniner fixed-contb">
		<section class="detail">
			<figure class="swiper-container">
				<ul class="swiper-wrapper">
					<li class="swiper-slide">
						<a href="#">
							<?=\hl\HLView::img('images/detail-ban02.png');?>
						</a>
					</li>
					<li class="swiper-slide">
						<a href="#">
							<?=\hl\HLView::img('images/detail-ban01.png');?>
						</a>
					</li>
					<li class="swiper-slide">
						<a href="#">
							<?=\hl\HLView::img('images/detail-ban03.png');?>
						</a>
					</li>
					<li class="swiper-slide">
						<a href="#">
							<?=\hl\HLView::img('images/detail-ban04.png');?>
						</a>
					</li>
				</ul>
				<div class="swiper-pagination">
				</div>
			</figure>
			<dl class="jiage">
				<dt>
					<h3>2015冬季新款韩版加厚中长款小鹿毛呢大衣女系带加厚羊毛呢外套</h3>
					<div class="collect">
						<?=\hl\HLView::img('images/detail-heart-hei.png');?>
						<p>收藏</p>
					</div>
				</dt>
				<dd>
					<b>￥28.99</b>
					<del>￥139</del>
					<input type="button" value="￥10.00" readonly />
					<small>+356积分</small>
				</dd>
			</dl>

			<div class="chose">
				<ul>
					<h3>颜色</h3>
					<li>
						黑色
					</li>
					<li>
						粉色
					</li>
					<li>
						灰色
					</li>
					<li>
						红色
					</li>
				</ul>
				<ul>
					<h3>尺寸</h3>
					<li>
						L
					</li>
					<li>
						XL
					</li>
					<li>
						XXL
					</li>
				</ul>
			</div>

			<a href="#" class="seven">
				<b>7</b>天无理由退换货
				<span id="sss"></span>
			</a>

			<ul class="same">
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'detail')?>">
					<span>
						同类推荐
					</span>
					<li class="one">
						<?=\hl\HLView::img('images/detail-pp01.png');?>
						<p>￥188.00</p>
					</li>
					<li>
						<?=\hl\HLView::img('images/detail-pp02.png');?>
						<p>￥188.00</p>
					</li>
					<li>
						<?=\hl\HLView::img('images/detail-pp03.png');?>
						<p>￥188.00</p>
					</li>
					<li>
						<?=\hl\HLView::img('images/detail-pp04.png');?>
						<p>￥188.00</p>
					</li>
				</a>
			</ul>

			<article class="detail-article">
				<nav>
					<ul class="article">
						<li id="talkbox1" class="article-active">商品详情</li>
						<li id="talkbox2">评价</li>
					</ul>
				</nav>

				<section class="talkbox1">
					会尽快啦辅导费发挥大路口
				</section>

				<section class="talkbox2" style="display: none;">
					<ul class="talk">
						<li>
							<figure><?=\hl\HLView::img('images/detail-tou.png');?></figure>
							<dl>
								<dt>
									<p>瑾晨</p>
									<time>2015.11.17</time>
									<div class="star">
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
									</div>
								</dt>
								<dd>哎哟不错哦，很性感哦！</dd>
								<small>颜色：豹纹凯特</small>
							</dl>
						</li>
						<li>
							<figure><?=\hl\HLView::img('images/detail-tou.png');?></figure>
							<dl>
								<dt>
									<p>瑾晨</p>
									<time>2015.11.17</time>
									<div class="star">
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
									</div>
								</dt>
								<dd>哎哟不错哦，很性感哦！</dd>
								<small>颜色：豹纹凯特</small>
								<div class="picbox">
									<?=\hl\HLView::img('images/detail-pp01.png');?>
									<?=\hl\HLView::img('images/detail-pp02.png');?>
									<?=\hl\HLView::img('images/detail-pp03.png');?>
									<?=\hl\HLView::img('images/detail-pp04.png');?>
								</div>
							</dl>
						</li>
						<li>
							<figure><?=\hl\HLView::img('images/detail-tou.png');?></figure>
							<dl>
								<dt>
									<p>瑾晨</p>
									<time>2015.11.17</time>
									<div class="star">
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
									</div>
								</dt>
								<dd>哎哟不错哦，很性感哦！</dd>
								<small>颜色：豹纹凯特</small>
							</dl>
						</li>
						<li>
							<figure><?=\hl\HLView::img('images/detail-tou.png');?></figure>
							<dl>
								<dt>
									<p>瑾晨</p>
									<time>2015.11.17</time>
									<div class="star">
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn01.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
										<span><?=\hl\HLView::img('images/detail-iocn001.png');?></span>
									</div>
								</dt>
								<dd>哎哟不错哦，很性感哦！</dd>
								<small>颜色：豹纹凯特</small>
								<div class="picbox">
									<?=\hl\HLView::img('images/detail-pp01.png');?>
									<?=\hl\HLView::img('images/detail-pp02.png');?>
									<?=\hl\HLView::img('images/detail-pp03.png');?>
									<?=\hl\HLView::img('images/detail-pp04.png');?>
								</div>
							</dl>
						</li>
					</ul>
				</section>

			</article>
		</section>
	</div>


		<footer class="detail-footer fixed-footer">
			<a href="#" class="go-car">
				<input type="button" value="加入购物车"/>
			</a>
			<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'buy')?>" class="buy">
				立即购买
			</a>
		</footer>
    <!--<?=\hl\HLView::js('jquery.min.js');?>-->
<script type="text/javascript">
	$(window).scroll(function() {
	    if ($(".detail-header").offset().top > 50) {
        $(".detail-header").addClass("change");
    } else {
        $(".detail-header").removeClass("change");
    }
	});
</script>
    <?=\hl\HLView::js('swiper.min.js');?>
<script type="text/javascript">
		$(document).ready(function(){
			var mySwiper = new Swiper('.swiper-container',{
				    loop: true,
				    speed:1000,
					autoplay: 2000,
					pagination: '.swiper-pagination',
				  });
		})
	</script>
<script type="text/javascript">
	$(function(){
		$('.chose li').click(function(){

			$(this).addClass('chose-active').siblings().removeClass('chose-active');

			var tags=document.getElementsByClassName('chose-active');//获取标签

			var tagArr = "";
	        for(var i=0;i < tags.length; i++)
	        {
	            tagArr += tags[i].innerHTML;//保存满足条件的元素

	        }

	        $('#sss').html(tagArr);

		});

		$('.article li').click(function(){

			$(this).addClass('article-active').siblings().removeClass('article-active');
			if($(this).attr("id")=="talkbox1"){
				$('.talkbox1').show();
				$('.talkbox2').hide();
			}else{
				$('.talkbox2').show();
				$('.talkbox1').hide();
			}

		});
	});
</script>
</body>
</html>
