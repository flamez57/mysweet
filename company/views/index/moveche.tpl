<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>移动店车</title>
    <?=\hl\HLView::css('iconfont.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('move_che.css');?>
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
        <span>移动店车 </span>
        <span>Mobile shop car</span>
    </div>
    <div class="twopage-inner-r">
        <span class="iconfont address">&#xe876;</span>
        <span>
            您当前的位置：网站首页 > <span class="add-color">移动店车</span>
        </span>
    </div>
</div>
<div class="bottom-line"></div>
<!--主体内容开始-->
<!--标题开始-->
<ul class="five-nav">
    <li class="first-nav">凉皮系列</li>
    <li>面食系列</li>
</ul>
<!--标题结束-->
<!--图片列表开始-->
<ul class="img-list-move">
    <li>
        <?=\hl\HLView::img('mengmian-pc1.jpg', ['alt' => '']);?>
    </li>
    <li>
        <?=\hl\HLView::img('mengmian-pc1.jpg', ['alt' => '']);?>
    </li>
    <li>
        <?=\hl\HLView::img('mengmian-pc1.jpg', ['alt' => '']);?>
    </li>
    <li>
        <?=\hl\HLView::img('mengmian-pc1.jpg', ['alt' => '']);?>
    </li>
    <li>
        <?=\hl\HLView::img('mengmian-pc1.jpg', ['alt' => '']);?>
    </li>
    <li>
        <?=\hl\HLView::img('mengmian-pc1.jpg', ['alt' => '']);?>
    </li>
</ul>
<!--图片列表结束-->
<!--文字内容开始-->
<ul class="move-box">
    <li class="add-txt-b">当“小吃”遇上“电动车”……</li>
    <li>特色小吃脍炙人口，移动经营本小利大</li>
    <li>固定成本最小化，移动经营利更大</li>
    <li>
        <p>对店铺生意而言，最大的固定成本是房租，加盟“乔一碗”移动店，不仅可以节省占销售收入15～20%的房租,更重要的是能够实现在客流量大或顾客集中的地段经营，同时实现收入和利润最大化。</p>
    </li>
    <li class="add-txt-b">· 投入最小化</li>
    <li>加盟固定店，除加盟费外，还要投入相当于加盟费3～5倍的租赁、装修、设备费，至少得有一个月的筹建期。</li>
    <li>选择移动店，无需在选址、租赁、装修上投入时间和金钱，就能获得一个具有盈利潜力的移动店，几乎无需筹建期。</li>
    <li class="add-txt-b">· 位置最优化</li>
    <li>开店成功的制胜条件：第一是地段、第二是地段，第三还是地段，好地段，就等于成功了一半，因为地段是能否获得充足客源的关键。</li>
    <li>移动经营使店铺具有“捕获”顾客的能力，哪人多，往那开;哪好卖，往那摆;哪赚钱，往那开。黄金地段，都可以成为你的经营点。</li>
    <li>设计新颖的“店车”还是一道流动的风景线，引人注目，促进销售。</li>
    <li class="add-txt-b">· 产出最大化</li>
    <li>0房租，0装修费、低人工费，费用降低20%，利润率提高20%，人效和坪效最大化。</li>
    <li>移动经营，开到顾客集中的地段，产品多样化，营业方式更灵活，实现销售收入最大化，利润最大化。</li>
</ul>
<!--文字内容结束-->
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