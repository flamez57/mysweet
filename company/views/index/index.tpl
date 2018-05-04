<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>企业站</title>
    <?=\hl\HLView::css('iconfont.css');?>
    <?=\hl\HLView::css('base.css');?>
    <?=\hl\HLView::css('index-eat_.css');?>
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
<div class="food-title">
    <div>经典美食</div>
    <span>Classic food</span>
</div>
<!--内容标题结束-->
<!--图片内容开始-->
<ul class="img-box">
    <li class="img-txt-box">
        <div class="img-txt">
            <span>—</span>
            <h4>凉皮系列</h4>
            <span>—</span>
            <div class="txt-word"> Cold noodle series</div>
            <div class="txt-img">
                <?=\hl\HLView::img('taoxin.png', ['alt' => '']);?>
            </div>
        </div>
        <div class="read-more"><a href="jingdian.html">查看更多+</a></div>
    </li>
    <li class="suofang">
        <a href="jingdian.html"><?=\hl\HLView::img('food-pc1.jpg', ['alt' => '']);?></a>
    </li>
    <li class="img-txt-box">
        <div class="img-txt">
            <span>—</span>
            <h4>凉皮系列</h4>
            <span>—</span>
            <div class="txt-word"> Cold noodle series</div>
            <div class="txt-img">
                <?=\hl\HLView::img('taoxin.png', ['alt' => '']);?>
            </div>
        </div>
        <div class="read-more"><a href="jingdian.html">查看更多+</a></div>
    </li>
    <li class="suofang">
        <a href="jingdian.html"><?=\hl\HLView::img('food-pc2.jpg', ['alt' => '']);?></a>
    </li>
    <li class="suofang">
        <a href="jingdian.html"><?=\hl\HLView::img('food-pc3.jpg', ['alt' => '']);?></a>
    </li>
    <li class="img-txt-box">
        <div class="img-txt">
            <span>—</span>
            <h4>凉皮系列</h4>
            <span>—</span>
            <div class="txt-word"> Cold noodle series</div>
            <div class="txt-img">
                <?=\hl\HLView::img('taoxin.png', ['alt' => '']);?>
            </div>
        </div>
        <div class="read-more"><a href="jingdian.html">查看更多+</a></div>
    </li>

    <li  class="suofang">
        <a href="jingdian.html"><?=\hl\HLView::img('food-pc4.jpg', ['alt' => '']);?></a>
    </li>
    <li class="img-txt-box">
        <div class="img-txt">
            <span>—</span>
            <h4>凉皮系列</h4>
            <span>—</span>
            <div class="txt-word"> Cold noodle series</div>

            <div class="txt-img">
                <?=\hl\HLView::img('taoxin.png', ['alt' => '']);?>
            </div>
        </div>
        <div class="read-more"><a href="jingdian.html">查看更多+</a></div>
    </li>
</ul>
<!--图片内容结束-->
<!--品牌开始-->
<div class="pinpai">
    <div class="pinpai-title">品牌溯源 <br>
        <span>Brand traceability</span>
    </div>
    <div class="pinpai-inner">
        <div class="pinpai-inner-left suofang">
            <?=\hl\HLView::img('video.jpg', ['alt' => '']);?>
        </div>
        <div class="pinpai-inner-right">
            <h1>乔一碗简介</h1>
            <h4>ABOUT US</h4>
            <p>　　成功客户催生的新锐品牌</p>
            <p>　　“乔一碗”品牌的创立者麦上食品机械公司是全国最早生产凉皮机和刀削面机的专业企业，从2001年成立以来，为数以千计的客户提供过专业的开店、办厂一体化服务，帮助他们取得了良好的经济效益。</p>
            <p>　　在公司购买食品机械的客户中，除从事食品生产批发外，开店的成功者也比比皆是——尽管他们的品牌各异，尽管他们缺乏标准化意识，尽管他们操作方法大相径庭，尽管他们的产品组合各有千秋，相同的是，他们都取得了超乎想象的经济效益，有的甚至开设多家连锁店，成为富甲一方的老板。</p>
            <div id="more-read"><a href="pinpai.html">查看更多</a></div>
        </div>
    </div>
</div>
<!--品牌结束-->
<!--咨询开始-->
<div class="message-title">
    资讯中心
    <br> <span>Information Center</span>
</div>
<a href="new-xiangqing.html"><div class="message-inner">
    <div class="mess-inner-l">
        <h4>06-23</h4>
        <div>2017</div>
    </div>
    <div class="mess-inner-c">
        <h4>父亲节拿来就能用的7个营销妙招，让你的餐厅顾客盈门！</h4>
        <span>对餐饮行业来说，节日是做品牌营销的好机会。父亲节马上到了，作为一个没有那么热门的节日，可能很多餐企老板都没有在这上面花心思。但也有不少餐饮品牌没有放过这个营销的好机会，为此推出了父亲节套餐、父亲节优惠活动。</span>
    </div>
    <div class="mess-inner-r">
        <span class="iconfont jiantou-icon">&#xe680;</span>
    </div>
</div></a>
<a href="new-xiangqing.html"><div class="message-inner" id="del-bottomline1">
    <div class="mess-inner-l">
        <h4>06-23</h4>
        <div>2017</div>
    </div>
    <div class="mess-inner-c">
        <h4>父亲节拿来就能用的7个营销妙招，让你的餐厅顾客盈门！</h4>
        <span>对餐饮行业来说，节日是做品牌营销的好机会。父亲节马上到了，作为一个没有那么热门的节日，可能很多餐企老板都没有在这上面花心思。但也有不少餐饮品牌没有放过这个营销的好机会，为此推出了父亲节套餐、父亲节优惠活动。</span>
    </div>
    <div class="mess-inner-r">
        <span class="iconfont jiantou-icon">&#xe680;</span>
    </div>
</div></a>
<a href="new-xiangqing.html"><div class="message-inner" id="del-bottomline2">
    <div class="mess-inner-l">
        <h4>06-23</h4>
        <div>2017</div>
    </div>
    <div class="mess-inner-c">
        <h4>父亲节拿来就能用的7个营销妙招，让你的餐厅顾客盈门！</h4>
        <span>对餐饮行业来说，节日是做品牌营销的好机会。父亲节马上到了，作为一个没有那么热门的节日，可能很多餐企老板都没有在这上面花心思。但也有不少餐饮品牌没有放过这个营销的好机会，为此推出了父亲节套餐、父亲节优惠活动。</span>
    </div>
    <div class="mess-inner-r">
        <span class="iconfont jiantou-icon">&#xe680;</span>
    </div>
</div></a>
<!--咨询结束-->
<!--查看更多-->
<div class="read-more">查看更多</div>
<!--长图-->
<div class="long-pc">
    <h4>乔一碗 · 期待您的加盟</h4>
    <span>qiaoyiwan · Look forward to your joining</span>
</div>
<!--长图结束-->
<!--在线留言开始-->
<div class="message-title">
   在线留言
    <br> <span>Message</span>
</div>
<div class="text">
    <div class="row">
        <span>姓名：</span>
        <input type="text" >
        <span class="text-one">标题：</span>
        <input type="text">
    </div>
    <div class="row">
        <span>电话：</span>
        <input type="text" >
        <span class="text-one">邮箱：</span>
        <input type="text">
    </div>
    <div class="row-long">
        <span>姓名：</span>
        <input type="text" >
    </div>
    <div class="row">
        <span id="text-last1">验证码：</span>
        <input type="text" id="text-last">
        <div class="row-pc"></div>
    </div>
</div>
<!--在线留言结束-->
<!--两个按钮开始-->
<div class="btn-box">
    <div class="btn1">提交留言</div>
    <div class="btn2">重置留言</div>
</div>
<!--两个按钮结束-->
<!--底部开始-->
<div class="footer">
    <div class="footer-inner">
        <div class="foot-left">
            <ul class="foot-left-inner">
                <li>服务支持</li>
                <li  class="foot-txt">开店服务</li>
                <li  class="foot-txt">全程支持</li>
            </ul>
            <ul class="foot-left-inner">
                <li>加盟咨询</li>
                <li  class="foot-txt">加盟须知</li>
                <li  class="foot-txt">加盟政策</li>
                <li  class="foot-txt">经济效益</li>
            </ul>
            <ul class="foot-left-inner">
                <li>联系方式</li>
                <li  id="call"></li>
                <li  class="foot-txt">
                    周一到周日08:00-22:00</li>
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
<div class="footer-bottom">版权所有：北京乔一碗餐饮管理有限公司    技术支持：龙采科技</div>
<!--底部结束-->
</body>
<?=\hl\HLView::js('qy.js');?>
</html>