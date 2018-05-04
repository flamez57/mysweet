<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>联系我们</title>
    <?=\hl\HLView::css('iconfont.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('jingdian_.css');?>
    <?=\hl\HLView::css('call_me.css');?>
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
        <span>联系我们</span>
        <span>Contact us</span>
    </div>
    <div class="twopage-inner-r">
        <span class="iconfont address">&#xe876;</span>
        <span>
            您当前的位置：网站首页 > <span class="add-color">联系我们</span>
        </span>
    </div>
</div>
<div class="bottom-line"></div>
<!--主体内容开始-->
    <div class="call-title">联系我们</div>
<ul class="call-box">
        <li >北京乔一碗餐饮管理有限责任公司</li>
        <li class="add-b">北京公司：</li>
        <li>　　电话：01058407366    01058407367</li>
        <li>　　地址：北京市顺义区金蝶软件园318号</li>
        <li class="add-b">哈尔滨公司:</li>
        <li>　　电话：0451-58971188</li>
        <li>　　地址：哈尔滨市松北高新技术开发区世泽路世贸商街17-29号6号</li>
        <li class="add-b">太原公司：</li>
        <li>　　电话：0351-6295415    0351-6285111</li>
        <li>　　地址：太原市迎泽区五龙口东安路45号儒学大厦5楼</li>
        <li class="add-b">南京公司：</li>
    <li>　　电话：025-52117177</li>
    <li>　　地址：南京市江宁区天元东路58号致远大厦8层</li>
    <li class="add-b">全国免费服务电话：<span>400—677—8586</span></li>
    <li class="add-c">乔一碗网址：<span>www.qywlp.com</span></li>
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