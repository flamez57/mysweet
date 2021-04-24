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
        <!-- 归档 S-->
        <div class="archives-inner">
            <h1 class="archives-limit">
                <div class="limit-point"></div>
                Start
            </h1>
        </div>
        <div class="archives-inner" v-for="diary in diarys" v-bind:key="diary.year">
            <h2 class="archives-title">
                <div class="title-point"></div>
                {{diary.year}}
            </h2>
            <div class="archives-content" v-for="day in diary.list" v-bind:key="day.id">
                <div class="content-point"></div>
                <div class="post-entry">
                    <span class="post-release-time">{{day.created_at}}</span>
                    <span class="archive-post-title">
                        <a href="/">
                            <span>{{day.content}}</span>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="archives-inner">
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
      default_code: 'flamez',
      diarys: []
    }
  },
  mounted () {
    this.frontMemberInfo()
    this.diaryList()
  },
  methods: {
    // 页面数据获取
    frontMemberInfo () {
      this.$api.member.frontMemberInfo(this.default_code).then(res => {
        console.log(res.data)
        // 执行某些操作
        if (res.data.code === 0) {
          this.$api.store.commit('changefNickname', res.data.data.member_info.nickname)
          this.$api.store.commit('changefAvatar', res.data.data.member_info.avatar)
          this.$api.store.commit('changefMotto', res.data.data.member_info.motto)
        }
      })
    },
    // 档案数据
    diaryList () {
      this.$api.diary.frontDiary(this.default_code).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.diarys = res.data.data.list
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
