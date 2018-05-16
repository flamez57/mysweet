<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<title>搭配</title>
		<?=\hl\HLView::css('base.css')?>
        <?=\hl\HLView::css('kind.css')?>
		<!--[if lt IE 9]>
            <?=\hl\HLView::js('html5shiv.js')?>
            <?=\hl\HLView::js('respond.js')?>
	    <![endif]-->
	</head>
	<body>
		<div class="match">
			<header>
				<a class="fl" href="#"><i class="iconfont">&#xe600;</i></a>
				<h2>搭配</h2>
				<a href="#"><i class="iconfont">&#xe64b;</i></a>
			</header>
			<div class="matchCon">
				<div class="sec">
					<a href="#"><?=\hl\HLView::img('temp/match01.jpg');?></a>
					<div class="txt padding">
						<p class="clearfix"><span>客厅</span><span>壁画</span></p>
						<p>客厅墙上的北欧风格壁画增添几分时尚和优雅</p>
					</div>
				</div>
				<div class="sec">
					<a href="#"><?=\hl\HLView::img('temp/match02.jpg');?></a>
					<div class="txt padding">
						<p class="clearfix"><span>卧室</span><span>壁画</span></p>
						<p>这样的条纹抱枕你是不是“种草”了呢</p>
					</div>
				</div>
				<div class="sec">
					<a href="#"><?=\hl\HLView::img('temp/match03.jpg');?></a>
					<div class="txt padding">
						<p class="clearfix"><span>餐桌</span><span>摆件</span></p>
						<p>灯光下的花瓶壁画多了几分唯美</p>
					</div>
				</div>
			</div>
		</div>
	</body>
    <?=\hl\HLView::js('jquery-1.12.4.min.js');?>
    <?=\hl\HLView::js('public.js');?>
</html>
