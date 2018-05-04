<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>加盟咨询</title>
    <?=\hl\HLView::css('iconfont.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('jia_meng.css');?>
</head>
<body>
<header>
    <div class="head-left">
        <?=\hl\HLView::img('logo.jpg');?>
    </div>
    <ul class="head-right">
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'index')?>">网站首页</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'pinpai')?>">品牌溯源</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'jingdian')?>">经典美食</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'menmiancaifeng')?>">门店风采</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'moveche')?>">移动店车</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'jiameng')?>">加盟咨询</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'service')?>">服务支持</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'new')?>">资讯中心</a></li>
        <li><a href="<?=\hl\HLRoute::makeUrl('company', 'index', 'callme')?>">联系我们</a></li>
    </ul>
</header>
<!--导航结束-->
<!--banner开始-->
<div class="banner-box">
    <ul class="banner">
        <li class="qy-active"><?=\hl\HLView::img('banner-pc1.jpg', ['alt' => '']);?></li>
        <li><?=\hl\HLView::img('banner-pc2.jpg', ['alt' => '']);?></li>
        <li><?=\hl\HLView::img('banner-pc3.jpg', ['alt' => '']);?></li>
    </ul>
    <ul class="qy-dianbox">
        <li class="dian-active"></li>
        <li></li>
        <li></li>
    </ul>
</div>
<!--banner结束-->
<!--内容标题开始-->
<div class="twopage-title">
    <div class="twopage-inner-l">
        <span>加盟咨询 </span>
        <span>Join consulting</span>
    </div>
    <div class="twopage-inner-r">
        <span class="iconfont address">&#xe876;</span>
        <span>
            您当前的位置：网站首页 > <span class="add-color">加盟咨询</span>
        </span>
    </div>
</div>
<div class="bottom-line"></div>
<!--标题开始-->
<ul class="three-nav">
    <li class="first-nav">加盟须知</li>
    <li>加盟政策</li>
    <li>经济效益</li>
</ul>
<!--标题结束-->
<!--主体内容开始-->
<div class="txt-title">加盟条件</div>
<div class="jia-meng-img">
    <?=\hl\HLView::img('jia-meng-pc1.jpg', ['alt' => '']);?>
</div>
<div class="txt-title" id="txt-title2">服务流程</div>
<div class="jia-meng-img" id="jia-meng-img2">
    <?=\hl\HLView::img('jia-meng-pc2.jpg', ['alt' => '']);?>
</div>
<!--主体内容结束-->
<!--底部开始-->
<div class="footer">
    <div class="footer-inner">
        <div class="foot-left">
            <ul class="foot-left-inner">
                <li>服务支持</li>
                <li class="foot-txt">开店服务</li>
                <li class="foot-txt">全程支持</li>
            </ul>
            <ul class="foot-left-inner">
                <li>加盟咨询</li>
                <li class="foot-txt">加盟须知</li>
                <li class="foot-txt">加盟政策</li>
                <li class="foot-txt">经济效益</li>
            </ul>
            <ul class="foot-left-inner">
                <li>咨询热线</li>
                <li id="call"></li>
                <li class="foot-txt">
                    周一到周日08:00-22:00
                </li>
            </ul>
        </div>
        <div class="foot-right-pc1">
            <?=\hl\HLView::img('erweima-pc1.png', ['alt' => '']);?>
        </div>
        <div class="foot-right-pc2">
            <?=\hl\HLView::img('erweima-pc2.png', ['alt' => '']);?>
        </div>
    </div>
</div>
<div class="footer-bottom">版权所有：北京乔一碗餐饮管理有限公司 技术支持：龙采科技</div>
<!--底部结束-->
</body>
<?=\hl\HLView::js('qy.js');?>
</html>