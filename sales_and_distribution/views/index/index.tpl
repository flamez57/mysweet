<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>首页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <?=\hl\HLView::js('rem.js');?>
    <?=\hl\HLView::css('iconfont/iconfont.css');?>
    <?=\hl\HLView::css('mui.min.css');?>
    <?=\hl\HLView::css('all.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('style.css');?>
</head>
<body>
    <header class="mui-bar mui-bar-nav" id="header">
        <div class="top-sch-box flex-col">
            <div class="centerflex">
                <i class="fdj iconfont icon-search"></i>
                <div class="sch-txt">连衣裙就是你的女人味儿</div>
                <span class="shaomiao"><i class="iconfont icon-saoma"></i></span>
            </div>
        </div>
        <a class="btn" href="">
            <i class="iconfont icon-tixing"></i>
        </a>
        <a class="btn" href="shopcar.html">
            <i class="iconfont icon-cart"></i>
        </a>
    </header>

<div id="main" class="mui-clearfix">
	 <!-- 搜索层 -->
    <div class="pop-schwrap">
        <div class="ui-scrollview">
            <div class="mui-bar mui-bar-nav clone">
                <a class="btn btn-back" href="javascript:;"></a>
                <div class="top-sch-box flex-col">
                    <div class="centerflex">
                        <input class="sch-input mui-input-clear" type="text" name="" id="" placeholder="连衣裙就是你的女人味儿" />
                    </div>
                </div>
                <a class="mui-btn mui-btn-primary sch-submit" href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'goods', 'list')?>">搜索</a>
            </div>
            <div class="scroll-wrap">
                <div class="mui-scroll">
                    <div class="sch-cont">
                        <div class="section ui-border-b">
                            <div class="tit"><i class="iconfont icon-hot"></i>热门搜索</div>
                            <div class="tags">
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag actice">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag">外套</span><span class="tag actice">连衣裙</span><span class="tag">运动鞋</span>
                            </div>
                        </div>
                        <div class="section">
                            <div class="tit"><i class="iconfont icon-time"></i>最近搜索</div>
                            <div class="tags">
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span><span class="tag">睡衣</span>
                                <span class="tag">外套</span><span class="tag">连衣裙</span><span class="tag">运动鞋</span>
                            </div>
                        </div>
                    </div>
                    <div class="sch-clear">
                        <a href="javascript:void"><i class="iconfont icon-shanchu"></i>清除搜索历史</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mui-content">
        <div class="banner swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="javascript:void(0)"><?=\hl\HLView::img('uploads/banner1.jpg', ['alt' => '', 'class' => 'swiper-lazy', 'data-src' => 'public/sales_and_distribution/img/uploads/banner1.jpg']);?></a></div>
                <div class="swiper-slide"><a href="javascript:void(0)"><?=\hl\HLView::img('uploads/banner1.jpg', ['alt' => '', 'class' => 'swiper-lazy', 'data-src' => 'public/sales_and_distribution/img/uploads/banner1.jpg']);?></a></div>
                <div class="swiper-slide"><a href="javascript:void(0)"><?=\hl\HLView::img('uploads/banner1.jpg', ['alt' => '', 'class' => 'swiper-lazy', 'data-src' => 'public/sales_and_distribution/img/uploads/banner1.jpg']);?></a></div>
                <div class="swiper-slide"><a href="javascript:void(0)"><?=\hl\HLView::img('uploads/banner1.jpg', ['alt' => '', 'class' => 'swiper-lazy', 'data-src' => 'public/sales_and_distribution/img/uploads/banner1.jpg']);?></a></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="home-nav ui-box">
            <div class="ui-flex flex-justify-sb">
                <div><a href=""><?=\hl\HLView::img('homenav1.png');?></a></div>
                <div><a href=""><?=\hl\HLView::img('homenav2.png');?></a></div>
                <div><a href=""><?=\hl\HLView::img('homenav3.png');?></a></div>
                <div><a href=""><?=\hl\HLView::img('homenav4.png');?></a></div>
            </div>
        </div>

        <div class="home-qnav ui-box">
            <div class="ui-flex flex-justify-sb">
                <div><a href="http://www.591zq.com"><?=\hl\HLView::img('qnav1.png', ['class' => 'ico']);?><span class="name">我的店铺</span></a></div>
                <div><a href="http://www.591zq.com"><?=\hl\HLView::img('qnav2.png', ['class' => 'ico']);?><span class="name">招商加盟</span></a></div>
                <div><a href="http://www.591zq.com"><?=\hl\HLView::img('qnav3.png', ['class' => 'ico']);?><span class="name">我的喜欢</span></a></div>
                <div><a href="http://www.591zq.com"><?=\hl\HLView::img('qnav4.png', ['class' => 'ico']);?><span class="name">猜你喜欢</span></a></div>
            </div>
        </div>

        <div class="home-newgoods ui-box">
            <?=\hl\HLView::img('hometit1.jpg', ['class' => 'home-imgtit']);?>
            <div class="list-type1 plist-puzzle">
                <a class="b" href=""><?=\hl\HLView::img('uploads/t1.jpg');?></a>
                <div class="s ui-flex-vt flex-justify-sb">
                    <a class="box" href=""><?=\hl\HLView::img('uploads/t2.jpg', ['alt' => '']);?></a>
                    <a class="box" href=""><?=\hl\HLView::img('uploads/t2.jpg', ['alt' => '']);?></a>
                    <a class="box" href=""><?=\hl\HLView::img('uploads/t2.jpg', ['alt' => '']);?></a>
                </div>
            </div>
            <?=\hl\HLView::img('hometit2.jpg', ['class' => 'home-imgtit']);?>
            <div class="list-type2 ui-flex flex-justify-sb">
                <a class="box" href=""><?=\hl\HLView::img('uploads/t3.jpg', ['class' => 'figure', 'alt' => '']);?><span class="tit">情侣穿搭</span></a>
                <a class="box" href=""><?=\hl\HLView::img('uploads/t3.jpg', ['class' => 'figure', 'alt' => '']);?><span class="tit">约会美搭</span></a>
                <a class="box" href=""><?=\hl\HLView::img('uploads/t3.jpg', ['class' => 'figure', 'alt' => '']);?><span class="tit">全部新款</span></a>
            </div>
        </div>

        <div class="home-fashion ui-box ui-border-t">
            <?=\hl\HLView::img('hometit3.jpg', ['alt' => '', 'class' => 'home-imgtit']);?>
            <a href=""><?=\hl\HLView::img('uploads/t4.jpg', ['alt' => '', 'class' => 'db margin-b-s', 'width' => '100%']);?></a>
            <div class="fastion-plist mui-row">
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
                <div class="mui-col-xs-4">
                    <a class="item">
                        <?=\hl\HLView::img('uploads/t5.jpg', ['alt' => '', 'class' => 'figure']);?><span class="tit">印花卫衣</span>
                    </a>
                </div>
            </div>
        </div>
    </div> <!--mui-content end-->
</div>
   

    <footer class="page-footer fixed-footer" id="footer">
		<ul>
			<li class="active">
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'index', 'index')?>">
                    <?=\hl\HLView::img('images/footer01.png');?>
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
			<li>
				<a href="<?=\hl\HLRoute::makeUrl('sales_and_distribution', 'self', 'index')?>">
                    <?=\hl\HLView::img('images/footer004.png');?>
					<p>个人中心</p>
				</a>
			</li>
		</ul>
	</footer>

</body>
<?=\hl\HLView::js('jquery-1.8.3.min.js');?>
<?=\hl\HLView::js('fastclick.js');?>
<?=\hl\HLView::js('mui.min.js');?>
<?=\hl\HLView::js('hmt.js');?>
<!--插件-->
<?=\hl\HLView::css('swiper.min.css');?>
<?=\hl\HLView::js('swiper/swiper.jquery.min.js');?>
<!--插件-->
<?=\hl\HLView::js('global.js');?>
<script >
    $(function () {
        var banner = new Swiper('.banner',{
            autoplay: 5000,
            pagination : '.swiper-pagination',
            paginationClickable: true,
            lazyLoading : true,
            loop:true
        });

         mui('.pop-schwrap .sch-input').input();
        var deceleration = mui.os.ios?0.003:0.0009;
         mui('.pop-schwrap .scroll-wrap').scroll({
                bounce: true,
                indicators: true,
                deceleration:deceleration
        });
        $('.top-sch-box .fdj,.top-sch-box .sch-txt,.pop-schwrap .btn-back').on('click',function () {
            $('html,body').toggleClass('holding');
            $('.pop-schwrap').toggleClass('on');
            if($('.pop-schwrap').hasClass('on')) {
                $('.pop-schwrap .sch-input').focus();
            }
        });

    });
</script>
</html>
