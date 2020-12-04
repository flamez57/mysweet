<template>
  <div>
      <header class="top-nav-fiexd">
        <div class="top-nav-inner">
            <div class="top-nav" id="top-nav">
                <router-link to="/">首页</router-link>
                <router-link to="/Record">档案</router-link>
                <router-link to="/About" class="nav-action">关于我</router-link>
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
        <div class="header" id="header">
            <div class="header-inner">
                <div class="header-info">
                    <img class="header-info-head" src="../assets/img/head2.png"/>
                    <h2 class="header-info-name">{{msg}}</h2>
                    <p class="header-info-desc">欢迎来到我的个人博客</p>
                </div>
            </div>
        </div>
    </header>
<div class="main-container" style="display: block">
    <div class="main-container-content">
        <div class="alpha">
            <div class="main-content">
                <h2 class="main-content-title">关于自己</h2>
                <div class="main-content-desc">
                    一个学习java的程序员想走前端，因为后台实在是费头脑，逻辑性较差的我不适合。我还是比较喜欢看得见的东西，所以这个博客就此诞生了，嘿嘿嘿……况且后台还费头发，长得都还没脱的快
                </div>
            </div>
            <div class="main-content">
                <h2 class="main-content-title">关于自己</h2>
                <div class="main-content-desc">
                    今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                    索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的
                </div>
            </div>
            <div class="main-content">
                <h2 class="main-content-title">关于自己</h2>
                <div class="main-content-desc">
                    一个学习java的程序员想走前端，因为后台实在是费头脑，逻辑性较差的我不适合。我还是比较喜欢看得见的东西，所以这个博客就此诞生了，嘿嘿嘿……况且后台还费头发，长得都还没脱的快
                </div>
            </div>
            <div class="main-content">
                <h2 class="main-content-title">关于自己</h2>
                <div class="main-content-desc">
                    一个学习java的程序员想走前端，因为后台实在是费头脑，逻辑性较差的我不适合。我还是比较喜欢看得见的东西，所以这个博客就此诞生了，嘿嘿嘿……况且后台还费头发，长得都还没脱的快
                </div>
            </div>
            <div class="main-content">
                <h2 class="main-content-title">版权声明</h2>
                <div class="main-content-desc">
                    特别声明：本站所有源于网络的内容都会注明出处，如果发现本站有任何侵犯您利益的内容，请及时邮件或留言联系，我会第一时间删除所有相关内容。<br/>
                    当然，作者是个喜欢分享的人，如果您转载或者分享本站的内容，请务必以超链接形式标明源文出处，非常感谢！
                </div>
            </div>
        </div>
        <div class="beta">
            <div class="author-side">
                <div class="author-side-basic">
                    <div class="author-side-basic-bg" style="background-image: url(../assets/img/head2.jpg); "></div>
                    <div class="author-side-basic-box">
                        <img class="author-aside-basic-cover" src="../assets/img/head2.png"/>
                        <h2 class="author-aside-basic-name">小黄人</h2>
                        <p class="author-aside-basic-addr">欢迎来到小黄人的博客</p>
                    </div>
                </div>
                <div class="author-side-contact">
                    <a href="index.html">
                        <i class="iconfont iconhome" aria-hidden="true"></i>
                        <span class="author-side-contact-label">主页</span>
                        <span class="author-side-contact-addr">Bronny</span>
                    </a>
                    <a href="https://github.com/CharlesHu24">
                        <i class="iconfont icongithub" aria-hidden="true"></i>
                        <span class="author-side-contact-label">GitHub</span>
                        <span class="author-side-contact-addr">CharlesHu24</span>
                    </a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2736934369&site=qq&menu=yes">
                        <i class="iconfont iconqq" aria-hidden="true"></i>
                        <span class="author-side-contact-label">QQ</span>
                        <span class="author-side-contact-addr">2736934369</span>
                    </a>
                    <a href="#">
                        <i class="iconfont iconemail" aria-hidden="true"></i>
                        <span class="author-side-contact-label">邮箱</span>
                        <span class="author-side-contact-addr">2736934369@qq.com</span>
                    </a>
                </div>
            </div>
        </div>
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
  name: 'About',
  data () {
    return {
      msg: 'about'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import '../assets/css/layout_head_foot.css';
@import '../assets/css/content_home_layout.css';
@import '../assets/iconfont/blog/iconfont.css';
</style>
