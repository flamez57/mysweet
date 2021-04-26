<template>
    <div class="main-container">
        <div class="content">
            <div class="container-title">
                <ul id="arch-manage-title-ul">
                    <li class="main-container-titel">文章</li>
                </ul>
            </div>
            <!--内容1.1 管理文章 S-->
            <div class="container-body" id="manage-container-body1-1">
                <div class="select-direction">
                    <!--筛选 S-->
                    <div class="left-direction-inner" id="post-left-direction-inner">
                        <a href="javascript:void(0)" :class="type == 0 ? 'inner action' : 'inner'" @click="changeType(0)">全部</a>
                        <a href="javascript:void(0)" :class="type == 1 ? 'inner action' : 'inner'" @click="changeType(1)">草稿</a>
                        <a href="javascript:void(0)" :class="type == 2 ? 'inner action' : 'inner'" @click="changeType(2)">发布</a>
                        <a href="javascript:void(0)" :class="type == 3 ? 'inner action' : 'inner'" @click="changeType(3)">回收站</a>
                    </div>
                    <!--筛选 E-->
                    <!--搜索 及 创建 S-->
                    <div class="right-direction-item">
                        <div class="search-box" id="post-search-box">
                            <input id="post-search-text" type="text" placeholder="search" v-model="keywords">
                            <button class="searchbtn" id="post-search-btn" @click="pageClick(1)">
                                <i class="iconfont iconsearch" aria-hidden="true"></i>
                            </button>
                        </div>
                        <router-link to="/Manage/CreatArticle/0" class="rel-btn">创建文章</router-link>
                    </div>
                    <!--搜索 及 创建 E-->
                </div>

        <!--table S-->
        <div class="table-responsive">
          <table class="table" id="post-table">
            <thead>
            <tr>
              <th>文章名</th>
              <th>状态</th>
              <th>浏览量</th>
              <th>更新时间</th>
              <th></th>
            </tr>
            </thead>
            <tbody id="post-tbody">
            <tr v-for="article in articles" :key="article.id">
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" @click="toDetail(article.id)">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">{{article.title}}</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-cg">草稿</td>
              <td>{{article.pv}}</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block"><img src="../assets/img/head2.png" class="sm-avatar"></a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="../view-post.html" target="_blank"><i class="iconfont iconchakan"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');">
                    <i class="iconfont iconicon"></i>
                  </a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">222</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-cg">草稿</td>
              <td>0</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="用户0306"><img src="../assets/img/head2.png" class="sm-avatar">
                </a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="#"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">文章标题</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-cg">草稿</td>
              <td>0</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="用户0306"><img src="../assets/img/head2.png" class="sm-avatar">
                </a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="#"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">111</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-fb">发布</td>
              <td>0</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="用户0306"><img src="../assets/img/head2.png" class="sm-avatar">
                </a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="#"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">111</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-fb">发布</td>
              <td>0</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="用户0306"><img src="../assets/img/head2.png" class="sm-avatar">
                </a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="#"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">111</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-fb">发布</td>
              <td>0</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="用户0306"><img src="../assets/img/head2.png" class="sm-avatar">
                </a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="#"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconarticle-line mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">111</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td class="tanmer-status tanmer-status-fb">发布</td>
              <td>0</td>
              <td class="tanmer-white-nowrap">
                <a class="d-inline-block" data-toggle="tooltip" data-placement="top" title=""
                   data-original-title="用户0306"><img src="../assets/img/head2.png" class="sm-avatar">
                </a>
                <span>2 天前</span>
              </td>
              <td>
                <div class="edit">
                  <a href="#"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--" aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!--table E-->
      </div>
      <!--内容1.1 管理文章 E-->
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
        </div>
    </div>
</template>

<script>

export default {
  name: 'About',
  data () {
    return {
      keywords: '',
      type: '0', // 0全部 1草稿  2发布  3回收站
      articles: [],
      // 分页列表
      all: '10', // 总页数
      cur: '1', // 当前页
      page_size: '20' // 页容量
    }
  },
  mounted () {
    this.pageClick(this.cur)
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
    pageClick (index = 0) {
      if (index !== 0 && this.cur !== index) {
        this.cur = index
      }
      // 获取分页数据 keyword, page, pageSize, type
      this.$api.article.manageArticleList(this.keyword, this.cur, this.page_size, this.type).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          var count = res.data.data.count
          this.all = Math.ceil(count / this.page_size)
          this.articles = res.data.data.list
        }
      })
    },
    toDetail (id) {
      // 直接调用$router.push 实现携带参数的跳转
      this.$router.push({
        path: '/Manage/CreatArticle/' + id
      })
    },
    changeType (type) {
      this.type = type
      this.pageClick()
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
.content-nav{
    padding-left: 100px;
}
.nav-action{
    color:rebeccapurple;
    font-weight:bolder;
}
</style>
