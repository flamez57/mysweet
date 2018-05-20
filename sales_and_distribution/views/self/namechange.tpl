<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>修改个人信息</title>
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
		<h3>修改昵称</h3>
			
			<a class="iconb" href="shopcar.html">
			</a>
	</header>
	
	<div class="contaniner">
		<form action="" method="post" class="nameform">
			<div class="namechange">
                <?=\hl\HLView::img('images/a-icon01.png');?>
				<input type="text" placeholder="瑾晨"/>
			</div>
			<p>推荐使用中文，5-25个字符</p>
			<input type="submit" value="保存"/>
		</form>
		
	</div>
	
	

</body>
</html>