<template>
    <div class="main-container">
        <div class="content">
            <div class="container-title">
                <ul id="cate-manage-title-ul">
                    <li class="main-container-titel">分类</li>
                </ul>
            </div>
            <!--内容2.1 管理分类 S-->
            <div class="container-body" id="manage-container-body2-1" style="display: block;">
                <div class="select-direction">
                    <!--筛选 S-->
                    <div class="left-direction-inner" id="cate-left-direction-inner">
                        <router-link to="/Manage/CreatCate" class="rel-btn">添加分类</router-link>
                    </div>
                    <!--创建 E-->
                </div>
                <!--表格 S-->
                <div class="table-responsive">
                    <table class="table" id="cate-table">
                        <thead>
                            <tr>
                                <th scope="col">分类名称</th>
                                <th scope="col">文章数量</th>
                                <th scope="col">排序</th>
                                <th scope="col">状态</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cate-tbody">
                            <tr v-for="cate in cates" v-bind:key="cate.id">
                                <td scope="row" class="position-relative">
                                    <div class="media">
                                        <a class="stretched-link" @click="toDetail(cate.id)">
                                            <em class="iconfont iconfolder mr-24"></em>
                                        </a>
                                        <div class="media-body">
                                            <h3 class="media-title">{{cate.name}}</h3>
                                            <span class="media-text">ID:{{cate.id}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{cate.num}}</td>
                                <td>{{cate.sort}}</td>
                                <td>{{cate.status}}</td>
                                <td>
                                    <a @click="toDetail(cate.id)"><i class="iconfont iconeditor"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--表格 E-->
            </div>
            <!--内容2.1 管理分类 E-->
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
      msg: 'about',
      cates: [],
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
      // 获取分页数据 page, pageSize, year, mon, day
      this.$api.cate.manageCateList(this.cur, this.page_size).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          var count = res.data.data.count
          this.all = Math.ceil(count / this.page_size)
          this.cates = res.data.data.list
        }
      })
    },
    toDetail (id) {
      // 直接调用$router.push 实现携带参数的跳转
      this.$router.push({
        path: '/Manage/CreatCate/' + id
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
.content-nav{
    padding-left: 100px;
}
.nav-action{
    color:rebeccapurple;
    font-weight:bolder;
}
</style>
