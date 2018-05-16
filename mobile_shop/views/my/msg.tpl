<!DOCTYPE html>
<html>
	
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>个人资料</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('kind.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>

	<body>
		<div class="det er">
			<header>
				<a class="fl" href="#"><i class="iconfont">&#xe600;</i></a>
				<h2>个人资料</h2>
				<a href="#"><i class="iconfont">&#xe64b;</i></a>
			</header>
		</div>
		<ul class="msgList">
			<li><span>个人头像</span><span><?=\hl\HLView::img('temp/pic.jpg');?><i class="iconfont">&#xe64b;</i></span></li>
			<li><span>会员名</span><span>尤物范儿<i class="iconfont">&#xe64b;</i></span></li>
			<li><span>性别</span><span><i class="iconfont">&#xe64b;</i></span></li>
			<li><span>生日</span><span>1995-06-06<i class="iconfont">&#xe64b;</i></span></li>
		</ul>
		
	<?=\hl\HLView::js('rem.js');?>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
	</body>
</html>