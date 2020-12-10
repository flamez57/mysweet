<template>
  <div>
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
        <!-- 归档 S-->
        <div class="archives-inner">
            <h1 class="archives-limit">
                <div class="limit-point"></div>
                Start
            </h1>
            <h2 class="archives-title">
                <div class="title-point"></div>
                2019
            </h2>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>这是我第一次创建个人博客</span>
                        </a>
                    </span>
                </div>
            </div>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            今天的北京阳光灿烂，风清气爽，气温适宜，好像除了空气中飘着一些烦人的柳絮之外，一切都刚刚好。
                        </a>
                    </span>
                </div>
            </div>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>第一个归档测试做好了</span>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="archives-inner">
            <h2 class="archives-title">
                <div class="title-point"></div>
                2018
            </h2>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>这是我第一次创建个人博客</span>
                        </a>
                    </span>
                </div>
            </div>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>这是我第一次创建个人博客</span>
                        </a>
                    </span>
                </div>
            </div>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>这是我第一次创建个人博客</span>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="archives-inner">
            <h2 class="archives-title">
                <div class="title-point"></div>
                2017
            </h2>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>这是我第一次创建个人博客</span>
                        </a>
                    </span>
                </div>
            </div>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>这是我第一次创建个人博客</span>
                        </a>
                    </span>
                </div>
            </div>
            <div class="archives-content">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">12-25&nbsp;&nbsp;13:31</span>
                    <span class="archive-post-title">
                        <a href="post.html">
                            <span>第一个归档测试做好了</span>
                        </a>
                    </span>
                </div>
            </div>
            <h1 class="archives-limit">
                <div class="limit-point"></div>
                End
            </h1>
        </div>
        <!-- 归档 E-->
    </div>
</div>
  </div>
</template>

<script>
export default {
  name: 'Record',
  data () {
    return {
      msg: 'record'
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
