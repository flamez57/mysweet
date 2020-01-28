<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>我的积分</title>
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
		<h3>我的积分</h3>

			<a class="iconb" href="#">
			</a>
	</header>

	<div class="contaniner fixed-conta">
		<section class="integral">
			<h3>3600</h3>
			<dl>
				<dd>
					<p>购物返积分</p>
					<time>2015-12-04 14:53</time>
				</dd>
				<dt>+50积分</dt>
			</dl>
			<dl>
				<dd>
					<p>购物返积分</p>
					<time>2015-12-04 14:53</time>
				</dd>
				<dt>+50积分</dt>
			</dl>
			<dl>
				<dd>
					<p>购物返积分</p>
					<time>2015-12-04 14:53</time>
				</dd>
				<dt>+50积分</dt>
			</dl>
			<dl>
				<dd>
					<p>购物返积分</p>
					<time>2015-12-04 14:53</time>
				</dd>
				<dt>+50积分</dt>
			</dl>
			<dl>
				<dd>
					<p>购物返积分</p>
					<time>2015-12-04 14:53</time>
				</dd>
				<dt>+50积分</dt>
			</dl>
		</section>
	</div>





</body>
</html>
