<template>

<div>
    <header class="top-nav-fiexd">
        <div class="top-nav-inner">
            <div class="top-nav" id="top-nav">
                <router-link to="/" class="nav-action">首页</router-link>
                <router-link to="/Record">档案</router-link>
                <router-link to="/About">关于我</router-link>
            </div>
            <div class="search-box" id="search-box">
                <input id="search-text" type="text" placeholder="search">
                <button class="searchbtn" id="search-btn">
                    <i class="iconfont iconsearch" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </header>
<header>
    <div class="header">
        <div class="main-post-title">
            <h1>北京的一天</h1>
            <div class="marks">
                <div class="release-time">
                    <span><i class="iconfont iconschedule"></i></span>
                    <span>2019-12-23</span>
                </div>
                <div class="tags-item">
                    <i class="iconfont iconlabel_fill"></i>
                    <a href="tags.html">生活</a>
                    <a href="tags.html">点滴</a>
                </div>
                <div class="view">访问数:
                    <div class="view-number"><span>1112</span></div>
                </div>
            </div>
        </div>
    </div>
</header>
   <div class="main-container" id="title" style="display: block">
    <div class="main-container-content">
        <!--正文 S-->
        <article class="main-post">
            <div class="main-post-content">
                <h2>圣菲满大街的艺术商品</h2>
                <p>今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。</p>
                <p>索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的时候一样，仿佛在一个属于自己的小角落里与世隔离很久。所以那种喧闹咋一来仿佛还挺新鲜，把我从安静的独居拽入一个仿佛真实仿佛也不那么真实的群体环境里。也许人独处久了，就会希望将自己置身于一个群体中，哪怕这个群体对你而言很陌生，甚至无需与之交流。</p>
                <p>回来的路上，我看着出租车外面那灿烂阳光照耀下的北京，一条条从未觉得如此干净的街道，旁边一棵棵长出嫩绿的小树，周边一幢幢整齐排列的居民楼，还有远处反光的高楼表面，这些画面组合的那一刻，我仿佛感受到了这座城市从所未有的美，似乎这座城市是带有温情的，是一个你愿意安定下来的地方。</p>
                <p>当你感到生活乏味找不到意义时，我建议你挑个天气好的日子出去走走，其实只要自己尝试着放慢自己，细细地去发掘这座城市，你会发现生活其实没有那么无聊糟糕，所在的城市好像也没有那么冰冷无情。我们常在探索生命的意义而未果，而今天的我觉得生命的意义或许就像是树枝上刚长出来的新芽，我们都知道总将有一天它会老化脱落、不复存在，然后周而复始地开始重复着，但此时此刻你看，这些嫩芽就在阳光下闪烁着它的光辉，让人欢欣鼓舞。怀抱着希望并给予身边的人希望，或许就是生命的意义。</p>
                <p>现在的我，则希望能凭借自身的努力在这片土地上找到一个归属的角落。</p>
            </div>
        </article>
        <!--正文 E-->

        <!--分类及翻篇 S-->
        <div class="entry-nav">
            <div class="entry-categories">
                分类&nbsp;:&nbsp;<a href="categories.html">生活</a>
            </div>
            <div class="entry-location">
                <ul>
                    <li>上一篇&nbsp;:&nbsp;<a href="#">点击上一篇</a></li>
                    <li>下一篇&nbsp;:&nbsp;<a href="#">点击下一篇</a></li>
                </ul>
            </div>
        </div>
        <!--分类及翻篇 E-->

        <!--留言板 S-->
        <div class="comments">
            <h2 class="comments-header">留言(x条)</h2>
            <div class="comments-content">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">小黄人</span>
                        说：
                    </div>
                    <div class="comment-content">
                        <p>这篇文章的沙发归我了，这篇文章的沙发归我了，这篇文章的沙发归我了，这篇文章的沙发归我了</p>
                    </div>
                    <div class="comment-footer">
                        <span>2020-1-10</span>
                        <span>回复</span>

                    </div>
                </div>
            </div>
            <div class="comments-content">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">hcl</span>
                        说：
                    </div>
                    <div class="comment-content">
                        <p>这篇文章的凳子归我了，这篇文章的凳子归我了，这篇文章的凳子归我了，这篇文章的凳子归我了</p>
                    </div>
                    <div class="comment-footer">
                        <span>2020-1-10</span>
                        <span>回复</span>

                    </div>
                </div>
            </div>
            <div class="comments-content">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">巴拉巴拉</span>
                        说：
                    </div>
                    <div class="comment-content">
                        <p>这篇文章的地板归我了，这篇文章的地板归我了，这篇文章的地板归我了，这篇文章的地板归我了</p>
                    </div>
                    <div class="comment-footer">
                        <span>2020-1-10</span>
                        <span>回复</span>

                    </div>
                </div>
            </div>
        </div>
        <!--留言板 E-->

        <!--发表看法 S-->
        <div class="main-comment">
            <h1>发表我的看法</h1>
            <form>
                <p><label>您的留言 （HTML标签部分可用）</label></p>
                <p><textarea name="text" rows="10" cols="=50"></textarea></p>
                <div>
                    <p>您的姓名：</p>
                    <p>
                        <input type="text"/>
                        <span>必填</span>
                    </p>
                </div>
                <div>
                    <p>电子邮件：</p>
                    <p>
                        <input type="text"/>
                        <span>必填</span>
                    </p>
                </div>
                <div>
                    <p>个人网址：</p>
                    <p>
                        <input type="text"/>
                        <span>您可以投放自己的个人博客哦</span>
                    </p>
                </div>
                <div>
                    <p style="display: inline">记住个人信息？</p>
                    <input type="checkbox"/>
                </div>
                <div>
                    <p><input type="submit" value="发表"/>
                    <span>填写完成 请点击这里</span></p>
                </div>
            </form>
        </div>
        <!--发表看法 E-->
    </div>
</div>
<footer class="footer">
    <div class="footer-copyright">
        <p>Copyright © 2019-2020 Bronny. All Rights Reserved.</p>
    </div>
</footer>
<!-- 页脚 End -->

<!-- 右导航 Start -->
<ul class="fixbar">
    <li>
        <a href="index.html">
            <i class="iconfont iconhome" aria-hidden="true"></i>
        </a>
    </li>
    <li>
        <a href="#toTop">
            <i class="iconfont icontop" aria-hidden="true"></i>
        </a>
    </li>
</ul>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      msg: 'home'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import '../assets/css/layout_head_foot.css';
@import '../assets/css/private_post.css';
@import '../assets/iconfont/blog/iconfont.css';
</style>
