<template>
    <div class="main-canvas">
        <!--导航 Start-->
        <div class="left-sidebar" id="left-sidebar">
            <div class="sidebar-main-content">
                <div class="header-info">
                    <img class="header-info-head" :src="this.$api.store.getters.getmAvatar"/>
                    <h2 class="header-info-name">{{this.$api.store.getters.getmNickname}}</h2>
                    <p class="header-info-desc">{{this.$api.store.getters.getmMotto}}</p>
                </div>
                <ul class="left-nav" id="ul1">
                    <li :class="'/Manage' === path ? 'left-nav-item left-nav-action' : 'left-nav-item'" @click="selectNav('/Manage')">
                        <router-link to="/Manage" class="left-nav-inner">
                            <i class="iconfont icontimerauto" aria-hidden="true"></i>修改个人信息
                        </router-link>
                    </li>
                    <li :class="'/Manage/SetPwd' === path ? 'left-nav-item left-nav-action' : 'left-nav-item'" @click="selectNav('/Manage/SetPwd')">
                        <router-link to="/Manage/SetPwd" class="left-nav-inner">
                            <i class="iconfont icon-lock" aria-hidden="true"></i>修改密码
                        </router-link>
                    </li>
                    <li :class="'/Manage/ArticleList' === path ? 'left-nav-item left-nav-action' : 'left-nav-item'" @click="selectNav('/Manage/ArticleList')">
                        <router-link to="/Manage/ArticleList" class="left-nav-inner">
                            <i class="iconfont iconarticle-line" aria-hidden="true"></i>文章
                        </router-link>
                    </li>
                    <li :class="'/Manage/ManageCate' === path ? 'left-nav-item left-nav-action' : 'left-nav-item'" @click="selectNav('/Manage/ManageCate')">
                        <router-link to="/Manage/ManageCate" class="left-nav-inner">
                            <i class="iconfont iconfolder" aria-hidden="true"></i>分类
                        </router-link>
                    </li>
                    <li :class="'/Manage/DiaryList' === path ? 'left-nav-item left-nav-action' : 'left-nav-item'" @click="selectNav('/Manage/DiaryList')">
                        <router-link to="/Manage/DiaryList" class="left-nav-inner">
                            <i class="iconfont iconeditor" aria-hidden="true"></i>日记
                        </router-link>
                    </li>
                    <li :class="'/Manage/Set' === path ? 'left-nav-item left-nav-action' : 'left-nav-item'" @click="selectNav('/Manage/Set')">
                        <a href="#" class="left-nav-inner">
                            <i class="iconfont iconsettings" aria-hidden="true"></i>设置
                        </a>
                    </li>
                </ul>
            </div>
            <div class="user-exit">
                <button @click="loginOut">退出</button>
            </div>
        </div>
        <!--导航 End-->
        <router-view></router-view>
    </div>
</template>

<script>
export default {
  name: 'Manage',
  data () {
    return {
      msg: 'manage',
      path: '/Manage'
    }
  },
  mounted () {
    this.path = this.$router.currentRoute.fullPath
    this.memberInfo()
  },
  methods: {
    selectNav (path) { // 接受路由地址选中当前菜单
      this.path = path
    },
    memberInfo () {
      this.$api.member.manageMemberInfoForEdit().then(res => {
        console.log(res.data)
        // 执行某些操作
        if (res.data.code === 0) {
          this.$api.store.commit('changemNickname', res.data.data.member_info.nickname)
          this.$api.store.commit('changemAvatar', res.data.data.member_info.avatar)
          this.$api.store.commit('changemMotto', res.data.data.member_info.motto)
        }
      })
    },
    loginOut () {
      this.$api.member.toLoginOut().then(res => {
        // 执行某些操作
        if (res.data.code === 0) {
          // 将用户token从vuex中清除
          localStorage.removeItem('Authorization')
          this.$router.push('/')
        }
        alert(res.data.message)
      }).catch(error => {
        alert('退出失败')
        console.log(error)
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import '../assets/css/layout_manage_index.css';
@import '../assets/css/layoutInforModify.css';
@import '../assets/iconfont/blog/iconfont.css';
@import '../assets/iconfont/blog-edit/iconfont.css';
@import '../assets/iconfont/login/iconfont.css';
</style>
