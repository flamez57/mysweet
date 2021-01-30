<template>
<!-- 前端入口 -->
    <div>
        <!-- 导航 Start -->
        <header class="top-nav-fiexd">
            <div class="top-nav-inner">
                <div class="top-nav">
                    <router-link to="/">首页</router-link>
                    <router-link to="/Record">档案</router-link>
                    <router-link to="/About">关于我</router-link>
                    <router-link to="/Login">登陆</router-link>
                    <router-link to="/Manage">管理后台</router-link>
                </div>
                <div class="search-box" id="search-box">
                    <input id="search-text" type="text" placeholder="search">
                    <button class="searchbtn" id="search-btn">
                        <i class="iconfont iconsearch" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </header>
        <!-- 导航 End -->

        <router-view></router-view>

        <!-- 页脚 Start -->
        <footer class="footer">
            <div class="footer-copyright">
                <p>Copyright © 2020 杨翔 All Rights Reserved | <a href="https://beian.miit.gov.cn">晋ICP备2020014291号-1</a></p>
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
                <a @click="backTop()">
                    <i class="iconfont icontop" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
        <!-- 右导航 End -->
    </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      msg: 'home'
    }
  },
  methods: {
    backTop () { // 回到顶部
      document.body.scrollTop = 0
      document.documentElement.scrollTop = 0
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
