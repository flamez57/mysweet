<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
         <meta name="format-detection" content="telephone=no" />
    <title>管理地址</title>
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
		<h3>地址管理</h3>
			
			<a class="text-top" href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'goAddress')?>">
				添加
			</a>
	</header>
	
	<div class="contaniner fixed-conta">
		<dl class="address">
			<a href="go-address.html">
				<dt>
					<p>瑾晨</p>
					<span>13035059860</span>
					<small>默认</small>
				</dt>
				<dd>安徽省合肥市XXXXXXXX</dd>
			</a>
		</dl>
	</div>
	
	
	
	

</body>
</html>
