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
    <div class="main-container" id="main1" style="display: block">
    <div class="main-container-content">
        <!--帖子 S-->
        <div class="alpha">
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
                    <a v-if="cur>1" v-on:click="cur--,pageClick()">
                        <i class="iconfont iconarrow-lift" aria-hidden="true"></i>
                    </a>
                    <a v-for="index in indexs" v-bind:key="index" v-bind:class="{ 'nav-action': cur == index}" v-on:click="pageClick(index)">{{index}}</a>
                    <a v-if="cur!=all" v-on:click="cur++,pageClick()">
                        <i class="iconfont iconarrow-right" aria-hidden="true"></i>
                    </a>
                    <a>共<i>{{all}} </i>页</a>
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
                        <li v-for="cate in cates" :key="cate.id" @click="toCateList(cate.id)">
                            {{cate.name}}<span> ({{cate.num}})</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="note-aside">
                <h3>标签</h3>
                <div class="tags-ul-item">
                    <ul class="tags-ul">
                        <li v-for="tag in tags" :key="tag.id" @click="toTagList(tag.id)">
                            {{tag.name}}&nbsp;&nbsp;&nbsp;
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--文章分类 E-->
    </div>
</div>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      default_code: 'flamez', // 默认code
      msg: '爱学习后生',
      cates: [{id: '', name: '', num: '0'}],
      tags: [{id: '', name: ''}],
      // 分页列表
      all: '10', // 总页数
      cur: '1', // 当前页
      page_size: '20', // 页容量
      tagId: '0', // 标签id
      cateId: '0', // 分类id
      keyword: '' // 关键字
    }
  },
  mounted () {
    this.cateList()
    this.tagList()
    this.loadModuleData2()
  },
  computed: {
    // 分页
    indexs: function () {
      var left = 1
      var right = this.all
      var ar = []
      if (this.all >= 5) {
        if (this.cur > 3 && this.cur < this.all - 2) {
          left = this.cur - 2
          right = this.cur + 2
        } else {
          if (this.cur <= 3) {
            left = 1
            right = 5
          } else {
            right = this.all
            left = this.all - 4
          }
        }
      }
      while (left <= right) {
        ar.push(left)
        left++
      }
      return ar
    }
  },
  methods: {
    // 页面数据获取
    loadModuleData2 () {
      this.$api.member.frontMemberInfo(this.default_code).then(res => {
        console.log(res)
        // 执行某些操作
      })
    },
    // 分类
    cateList () {
      this.$api.cate.frontCateList(this.default_code).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.cates = res.data.data.list
        }
      })
    },
    // 标签
    tagList () {
      this.$api.tag.frontTagList(this.default_code).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.tags = res.data.data.list
        }
      })
    },
    pageClick (index = 0) {
      if (index !== 0 && this.cur !== index) {
        this.cur = index
      }
      // 获取分页数据 tagId, cateId, keyword
      this.$api.article.frontArticleList(this.default_code, this.cur, this.page_size, this.tagId, this.cateId, this.keyword).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          // res.data.data.list
        }
      })
    },

    // 链接跳转
    toCateList (id) {
      // 直接调用$router.push 实现携带参数的跳转
      this.$router.push({
        path: '/CateList/' + id
      })
    },
    toTagList (id) {
      // 直接调用$router.push 实现携带参数的跳转
      this.$router.push({
        path: '/TagList/' + id
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
