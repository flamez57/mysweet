<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>个人信息</title>
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
			<h3>我的资料</h3>
			<a class="iconb" href="shopcar.html">
			</a>
	</header>
	
	<div class="contaniner">
		<ul class="self-data">
			<li>
				<a href="#">
					<p>头像</p>
					<span><?=\hl\HLView::img('images/right.png');?></span>					
					<figure><?=\hl\HLView::img('images/detail-tou.png');?></figure>
				</a>
			</li>
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'namechange')?>">
					<p>昵称</p>
					<span><?=\hl\HLView::img('images/right.png');?></span>
					<small>瑾晨</small>
					
				</a>
			</li>
			<li>
				<a href="#">
					<p>性别</p>
					<span><?=\hl\HLView::img('images/right.png');?></span>
					<select>
						<option>男</option>
						<option>女</option>
					</select>
					
				</a>
			</li>
		</ul>
	</div>
	
	
	
	

</body>
</html>