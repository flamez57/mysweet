<!DOCTYPE html>
<html>
	
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>我的名片</title>
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
				<h2>我的名片</h2>
				<a href="#"><i class="iconfont">&#xe64b;</i></a>
			</header>
		</div>
		<p class="userName"><?=\hl\HLView::img('temp/pic.jpg');?><br/>尤物范儿</p>
		<div class="er">
            <?=\hl\HLView::img('temp/er.jpg');?>
			<p>扫一扫二维码，加我为好友</p>
		</div>
	<?=\hl\HLView::js('rem.js');?>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
    <?=\hl\HLView::js('public.js');?>
	</body>
</html>