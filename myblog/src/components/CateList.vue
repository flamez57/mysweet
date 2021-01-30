<template>

<div>
    <header>
    <div class="header">
        <h1 class="include-title">有关"服务端"的分类</h1>
    </div>
</header>

    <div class="main-container" style="display: block">
    <div class="main-container-content">
        <div class="tags-body">
            <div class="content-body">
                <!--列表内容-->
                <div class="posts-inner">
                    <blockquote class="posts">
                        <h2 class="post-title"><router-link to="/Detail">Apache或者Nginx为PHP设置服务器环境变量</router-link></h2>
                        <div class="marks">
                            <div class="release-time">
                                <span><i class="iconfont iconschedule"></i></span>
                                <span>2020-12-23</span>
                            </div>
                            <div class="tags-item">
                                <i class="iconfont iconlabel_fill"></i>
                                <router-link to="/TagList">环境变量</router-link>
                                <router-link to="/TagList">PHP</router-link>
                            </div>
                            <div class="view">访问数:
                                <div class="view-number"><span>1112</span></div>
                            </div>
                        </div>
                        <p class="post-short-content">在开发项目的时候生产环境和开发环境的配置信息是不一样的，总要切换的话比较麻烦，现在我们可以通过设置服务器环境变量来区分线上生产环境还是本地开发环境，比如我们可以设置 RUNTIME_ENVIROMENT 的为 'DEV'还是'PRO'来区分。然后在PHP端通过$_SERVER['RUNTIME_ENVIROMENT']来获取值。
                            <span class="read-more">...<router-link to="/Detail">Read More</router-link></span></p>
                    </blockquote>
                </div>
                <!--列表内容end-->
            </div>
            <!--下导航 S-->
            <div class="content-nav">
                <nav class="bottom-nav" id="con-nav">
                    <a href="#">
                        <i class="iconfont iconarrow-lift" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="nav-action">1</a>
                    <!--<a href="#">2</a>
                    <a href="#">3</a>
                    <span>…</span>
                    <a href="#">9</a>-->
                    <a href="#">
                        <i class="iconfont iconarrow-right" aria-hidden="true"></i>
                    </a>
                </nav>
            </div>
            <!--下导航 E-->
        </div>
    </div>
</div>
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
