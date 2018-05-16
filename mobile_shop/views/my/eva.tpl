<!DOCTYPE html>
<html>

	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>评价</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('swiper.css')?>
        <?=\hl\HLView::css('kind.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>

	<body>
		<div class="det">
			<header>
				<a class="fl" href="#"><i class="iconfont">&#xe600;</i></a>
				<h2>创意白瓷干花花瓶摆件</h2>
				<a href="#"><i class="iconfont">&#xe64b;</i></a>
			</header>
		</div>
	<?=\hl\HLView::js('swiper.jquery.min.js');?>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
    <?=\hl\HLView::js('public.js');?>
	<script>
	$(function(){
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			slidesPerView: 1.1,
			centeredSlides: true,
			paginationClickable: true,
			spaceBetween: 10
		});
	})
		
	</script>
	</body>
</html>