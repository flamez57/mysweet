<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>服务支持 </title>
    <?=\hl\HLView::css('iconfont.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('service_.css');?>
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
        <span>服务支持 </span>
        <span>Service support</span>
    </div>
    <div class="twopage-inner-r">
        <span class="iconfont address">&#xe876;</span>
        <span>
            您当前的位置：网站首页 > <span class="add-color">服务支持</span>
        </span>
    </div>
</div>
<div class="bottom-line"></div>
<!--标题开始-->
<ul class="three-nav">
    <li class="first-nav">开店服务</li>
    <li>全程支持</li>
</ul>
<!--标题结束-->
<!--主体内容开始-->
<ul class="service-inner">
    <li class="add-service-b">扶您上马  送您全程  专业服务  助您成功</li>
    <li>公司通过全程服务和系统支持，助力加盟商从零起步，获得成功。</li>
    <li>
        <p>公司为加盟商提供一体化开店服务，包括：选址咨询、店址评估、店面设计、筹建指导、技术培训、开业支持、终端促销、员工培训、料包供应、营运督导，另外，加盟商还能获得公司全方位的营销支持，包括新品、广告、形象代言、最佳实践经验等资源的共享。</p>
    </li>
    <li class="add-service-b"> 传帮带全程支持 <br>制作技术:</li>
    <li>1.传授 营运知识</li>
    <li>2.管理经验</li>
    <li class="add-service-b">筹建：</li>
    <li>1.协助选址、店铺设计、施工督导;</li>
    <li>2.帮助 开业：帮助加盟商进行开业准备和开业典礼;</li>
    <li>3.促销：帮助加盟商开展促销活动，实现经营目标。</li>
    <li class="add-service-b">带领：</li>
    <li>1. 加盟商实施生产，直至能独立操作;</li>
    <li>2.带领 加盟商开展营业，直至能独立营业;</li>
    <li>3.店铺进入正常经营轨道。</li>
</ul>
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