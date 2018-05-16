<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>分类</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('kind.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<div class="kind">
			<header class="clearfix">
				<a class="fl" href="#"><i class="iconfont">&#xe600;</i></a>
			</header>
            <?=\hl\HLView::img('temp/kindBg.jpg');?>
			<div class="kindCon clearfix padding">
				<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'detail')?>" class="fl"><?=\hl\HLView::img('temp/kind01.jpg');?></a>
				<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'detail')?>" class="fr"><?=\hl\HLView::img('temp/kind02.jpg');?></a>
				<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'detail')?>" class="fl"><?=\hl\HLView::img('temp/kind03.jpg');?></a>
				<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'detail')?>" class="fr"><?=\hl\HLView::img('temp/kind04.jpg');?></a>
				<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'detail')?>" class="fl"><?=\hl\HLView::img('temp/kind05.jpg');?></a>
				<a href="<?=\hl\HLRoute::makeUrl('mobile_shop', 'index', 'detail')?>" class="fr"><?=\hl\HLView::img('temp/kind06.jpg');?></a>
			</div>
		</div>
	</body>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
    <?=\hl\HLView::js('public.js');?>
</html>
