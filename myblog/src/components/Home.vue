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
    <div class="main-container" id="main1" style="display: block">
    <div class="main-container-content">
        <!--帖子 S-->
        <div class="alpha">
            <div class="content-body">
                <div class="posts-inner">
                    <blockquote class="posts">
                        <h2 class="post-title"><a href="post.html">这是标题</a></h2>
                        <div class="marks">
                            <div class="release-time">
                                <span><i class="iconfont iconschedule"></i></span>
                                <span>2019-12-23</span>
                            </div>
                            <div class="tags-item">
                                <i class="iconfont iconlabel_fill"></i>
                                <router-link to="/TagList">生活</router-link>
                                <router-link to="/TagList">点滴</router-link>
                            </div>
                            <div class="view">访问数:
                                <div class="view-number"><span>1112</span></div>
                            </div>
                        </div>
                        <p class="post-short-content">今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                            索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的
                            <span class="read-more">...<router-link to="/Detail">Read More</router-link></span></p>
                    </blockquote>
                </div>
                <div class="posts-inner">
                    <blockquote class="posts">
                        <h2 class="post-title"><a href="post.html">这是标题</a></h2>
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
                        <p class="post-short-content">今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                            索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的
                            <span class="read-more">...<a href="post.html">Read More</a></span></p>
                    </blockquote>
                </div>
                <div class="posts-inner">
                    <blockquote class="posts">
                        <h2 class="post-title"><a href="post.html">这是标题</a></h2>
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
                        <p class="post-short-content">今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                            索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的
                            <span class="read-more">...<a href="post.html">Read More</a></span></p>
                    </blockquote>
                </div>
                <div class="posts-inner">
                    <blockquote class="posts">
                        <h2 class="post-title"><a href="post.html">这是标题</a></h2>
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
                        <p class="post-short-content">今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                            索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的
                            <span class="read-more">...<a href="post.html">Read More</a></span></p>
                    </blockquote>
                </div>
                <div class="posts-inner">
                    <blockquote class="posts">
                        <h2 class="post-title"><a href="post.html">这是标题</a></h2>
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
                        <p class="post-short-content">今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                            索性去了趟玉渊潭公园，活动活动筋骨。通往公园的桥边上站着一群上了年纪的大爷们守着鱼竿，通往公园的路上各色的人群攒动，耳朵里是小贩的叫卖声，协警的指引声，人群里除了各种寒暄声还夹杂着孩童的哭闹声。这种浓烈喧闹的市民生活气息好像已经很久没有感受过了，工作以来的我一到周末就愿意宅家，躺着不想出门，像在学校读书的
                            <span class="read-more">...<a href="post.html">Read More</a></span></p>
                    </blockquote>
                </div>
            </div>
            <!--下导航 S-->
            <div class="content-nav">
                <nav class="bottom-nav" id="con-nav">
                    <a href="#">
                        <i class="iconfont iconarrow-lift" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="nav-action">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <span>…</span>
                    <a href="#">9</a>
                    <a href="#">
                        <i class="iconfont iconarrow-right" aria-hidden="true"></i>
                    </a>
                </nav>
            </div>
            <!--下导航 E-->
        </div>
        <!--帖子 E-->

        <!--文章分类 S-->
        <div class="beta">
            <div class="note-aside">
                <h3>分类</h3>
                <div class="cate-ul-item">
                    <ul class="cate-ul">
                        <li>
                            <router-link to="/CateList">生活</router-link>
                            <span> (16)</span>
                        </li>
                        <li><a href="categories.html">前端开发</a><span> (7)</span></li>
                        <li><a href="categories.html">文学类</a><span> (2)</span></li>
                        <li><a href="categories.html">编程笔记</a><span> (9)</span></li>
                    </ul>
                </div>
            </div>
            <div class="note-aside">
                <h3>标签</h3>
                <div class="tags-ul-item">
                    <ul class="tags-ul">
                        <li><a href="tags.html">Git</a></li>
                        <li><a href="tags.html">javascript</a></li>
                        <li><a href="tags.html">前端开发</a></li>
                        <li><a href="">jQuery</a></li>
                        <li><a href="#">Git</a></li>
                        <li><a href="#">Git</a></li>
                        <li><a href="#">Git</a></li>
                        <li><a href="#">Git</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--文章分类 E-->
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
        <router-link to="/">
            <i class="iconfont iconhome" aria-hidden="true"></i>
        </router-link>
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
@import '../assets/css/content_home_layout.css';
@import '../assets/iconfont/blog/iconfont.css';
</style>
