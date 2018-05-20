<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>我的分销</title>
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
	<header class="top-header">
		<a class="icona" href="javascript:history.go(-1)">
				<?=\hl\HLView::img('images/left.png');?>
		</a>
		<h3>购买成为分销商</h3>
		<a class="iconb" href="shopcar.html">
		</a>
	</header>
	
	<div class="login" style="margin-top: 0;">
		<form>
			<div class="buybanner clearfloat">
                <?=\hl\HLView::img('images/fxbanner.jpg');?>
			</div>
			<a href="fx-center.html" class="gobuy-btn">
				立即购买成为分销商
			</a>
		</form>
	</div>

</body>
</html>