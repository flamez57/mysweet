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
        <!--帖子 E-->

        <!--文章分类 S-->
        <div class="beta">
            <div class="note-aside">
                <h3>分类</h3>
                <div class="cate-ul-item">
                    <ul class="cate-ul">
                        <li>
                            <router-link to="/CateList">服务端</router-link>
                            <span> (1)</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="note-aside">
                <h3>标签</h3>
                <div class="tags-ul-item">
                    <ul class="tags-ul">
                        <li><router-link to="/TagList">环境变量</router-link></li>
                        <li><router-link to="/TagList">PHP</router-link></li>
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
//import { memberInfos } from '../api/api';// 导入我们的api接口
export default {
  name: 'Home',
  data () {
    return {
      msg: '爱学习后生'
    }
  },
  mounted() {
    //this.loadModuleData();
      this.send()
  },
  methods: {
    loadModuleData() {
      /*let params = {
          code: '123'
      }
      this.$request.memberInfo(
          params
      ).then((data)=>{ // 直接拿到的就是成功数据，其他情况封装的时候统一处理
          console.log(data)
          data.forEach(data => {
              this.tableData.push({
                  id: data.id || '',
                  name: data.name || '',
                  desc: data.desc || '',
              })
          })
      });*/
    },
    send () {
        this.$api.article.articleDetail(1, {
            code: 123
        }).then(res=> {
            console.log(res)
            // 执行某些操作
        })
//        memberInfos({
//                code: '123154'
//            }).then(res => {
//                // 获取数据成功后的其他操作
//            console.log(res)
//            })
       /*this.$http({// 格式a
        method: 'get',
        url: 'http://mysweet.cc/index.php?m=blogapi&c=index&a=memberInfo&code=123',
        headers: {'X-Requested-With': 'XMLHttpRequest'}
      }).then(function (resp) {
        console.log(resp.data)
      }).catch(resp => {
        console.log('请求失败：' + resp.status + ',' + resp.statusText)
      })*/
    }
  },
  created () {
    //this.send()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import '../assets/css/layout_head_foot.css';
@import '../assets/css/content_home_layout.css';
@import '../assets/iconfont/blog/iconfont.css';
</style>
