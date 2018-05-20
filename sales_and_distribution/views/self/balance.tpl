<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>消费记录</title>
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
		<div class="warp clearfloat">
			<header class="top-header">
					<a class="icona" href="javascript:history.go(-1)">
							<?=\hl\HLView::img('images/left.png');?>
						</a>
					<h3>消费记录</h3>
					<a class="iconb" href="shopcar.html">
					</a>
			</header>
			<div class="main clearfloat" id="main">
				<div class="balance clearfloat">
					<div class="top clearfloat box-s">
						<p class="dqian">当前余额</p>
						<p class="price">0.00<span>元</span></p>
						<a href="#" class="ba-btn fl">
							充值
						</a>
					</div>
					<div class="bottom clearfloat mt10 box-s">
						<p class="tit box-s">
							最近30天收支明细
						</p>
						<div class="list fl box-s clearfloat">
							<ul>
								<li class="fl">
									<span class="dsan fl">第三方支付消费</span>
									<span class="time fr">2016-1-02</span>
								</li>
								<li class="fl mt5">
									<span class="yue fl">余额：0.00</span>
									<span class="jiage fr">-26.30</span>
								</li>
							</ul>
						</div>
						<div class="list fl box-s clearfloat">
							<ul>
								<li class="fl">
									<span class="dsan fl">优智源账户充值</span>
									<span class="time fr">2016-1-02</span>
								</li>
								<li class="fl mt5">
									<span class="yue fl">余额：0.00</span>
									<span class="jiage jiage1 fr">+26.30</span>
								</li>
							</ul>
						</div>
						<div class="list fl box-s clearfloat">
							<ul>
								<li class="fl">
									<span class="dsan fl">第三方支付消费</span>
									<span class="time fr">2016-1-02</span>
								</li>
								<li class="fl mt5">
									<span class="yue fl">余额：0.00</span>
									<span class="jiage fr">-26.30</span>
								</li>
							</ul>
						</div>
						<div class="list fl box-s clearfloat">
							<ul>
								<li class="fl">
									<span class="dsan fl">优智源账户充值</span>
									<span class="time fr">2016-1-02</span>
								</li>
								<li class="fl mt5">
									<span class="yue fl">余额：0.00</span>
									<span class="jiage jiage1 fr">+26.30</span>
								</li>
							</ul>
						</div>
						<div class="list fl box-s clearfloat">
							<ul>
								<li class="fl">
									<span class="dsan fl">第三方支付消费</span>
									<span class="time fr">2016-1-02</span>
								</li>
								<li class="fl mt5">
									<span class="yue fl">余额：0.00</span>
									<span class="jiage fr">-26.30</span>
								</li>
							</ul>
						</div>
						<div class="list fl box-s clearfloat">
							<ul>
								<li class="fl">
									<span class="dsan fl">优智源账户充值</span>
									<span class="time fr">2016-1-02</span>
								</li>
								<li class="fl mt5">
									<span class="yue fl">余额：0.00</span>
									<span class="jiage jiage1 fr">+26.30</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>	
			<footer class="page-footer fixed-footer">
				<ul>
					<li>
                        <a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'index', 'index')?>">
                            <?=\hl\HLView::img('images/footer001.png');?>
                            <p>首页</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'assort', 'index')?>">
                            <?=\hl\HLView::img('images/footer002.png');?>
                            <p>分类</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'shopcar', 'index')?>">
                            <?=\hl\HLView::img('images/footer003.png');?>
                            <p>购物车</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'index')?>">
                            <?=\hl\HLView::img('images/footer04.png');?>
                            <p>个人中心</p>
                        </a>
                    </li>
				</ul>
			</footer>
	</body>
</html>
