<template>
  <div>
    <header>
        <div class="header" id="header">
            <div class="header-inner">
                <div class="header-info">
                    <img class="header-info-head" :src="this.$api.store.state.f_avatar"/>
                    <h2 class="header-info-name">{{this.$api.store.state.f_nickname}}</h2><!--vuex两种不通取值-->
                    <p class="header-info-desc">{{this.$api.store.getters.getfMotto}}</p> <!--vuex两种不通取值-->
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
                    <p>{{member_info.content}}</p>
                </div>
            </div>
        </div>
        <div class="beta">
            <div class="author-side">
                <div class="author-side-basic">
                    <div class="author-side-basic-bg" :style="'background-image: url('+member_info.avatar+'); '"></div>
                    <div class="author-side-basic-box">
                        <img class="author-aside-basic-cover" :src="member_info.avatar"/>
                        <h2 class="author-aside-basic-name">{{member_info.nickname}}</h2>
                        <p class="author-aside-basic-addr">{{member_info.motto}}</p>
                    </div>
                </div>
                <div class="author-side-contact">
                    <a :href="member_info.home_page">
                        <i class="iconfont iconhome" aria-hidden="true"></i>
                        <span class="author-side-contact-label">主页</span>
                        <span class="author-side-contact-addr">{{member_info.home_page}}</span>
                    </a>
                    <a :href="member_info.github">
                        <i class="iconfont icongithub" aria-hidden="true"></i>
                        <span class="author-side-contact-label">GitHub</span>
                        <span class="author-side-contact-addr">{{member_info.github}}</span>
                    </a>
                    <a :href="'http://wpa.qq.com/msgrd?v=3&uin='+member_info.qq+'&site=qq&menu=yes'">
                        <i class="iconfont iconqq" aria-hidden="true"></i>
                        <span class="author-side-contact-label">QQ</span>
                        <span class="author-side-contact-addr">{{member_info.qq}}</span>
                    </a>
                    <a href="#">
                        <i class="iconfont iconemail" aria-hidden="true"></i>
                        <span class="author-side-contact-label">邮箱</span>
                        <span class="author-side-contact-addr">{{member_info.email}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
</template>

<script>
export default {
  name: 'About',
  data () {
    return {
      default_code: 'flamez',
      member_info: {}
    }
  },
  mounted () {
    this.frontMemberInfo()
  },
  methods: {
    // 页面数据获取
    frontMemberInfo () {
      this.$api.member.frontMemberInfo(this.default_code).then(res => {
        console.log(res.data)
        // 执行某些操作
        if (res.data.code === 0) {
          this.member_info = res.data.data.member_info
          this.$api.store.commit('changefNickname', res.data.data.member_info.nickname)
          this.$api.store.commit('changefAvatar', res.data.data.member_info.avatar)
          this.$api.store.commit('changefMotto', res.data.data.member_info.motto)
        }
      })
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
