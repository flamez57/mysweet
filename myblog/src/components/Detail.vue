<template>

<div>
<header>
    <div class="header">
        <div class="main-post-title">
            <h1>{{detail.title}}</h1>
            <div class="marks">
                <div class="release-time">
                    <span><i class="iconfont iconschedule"></i></span>
                    <span>{{detail.created_at}}</span>
                </div>
                <div class="tags-item">
                    <i class="iconfont iconlabel_fill"></i>
                    <a v-for="tag in detail.tags" :key="tag.id" @click="toTagList(tag.id)">
                        {{tag.name}}&nbsp;&nbsp;&nbsp;
                    </a>
                </div>
                <div class="view">访问数:
                    <div class="view-number"><span>{{detail.pv}}</span></div>
                </div>
            </div>
        </div>
    </div>
</header>
   <div class="main-container" id="title" style="display: block">
    <div class="main-container-content">
        <!--正文 S-->
        <article class="main-post">
            <div class="main-post-content">
                <pre>{{detail.content}}</pre>
                <p></p>
            </div>
        </article>
        <!--正文 E-->

        <!--分类及翻篇 S-->
        <div class="entry-nav">
            <div class="entry-categories">
                分类&nbsp;:&nbsp;<a @click="toCateList(cate.id)">{{cate.name}}</a>
            </div>
            <div class="entry-location">
                <ul>
                    <li>上一篇&nbsp;:&nbsp;<a @click="toDetail(before.id)">{{before.title}}</a></li>
                    <li>下一篇&nbsp;:&nbsp;<a @click="toDetail(next.id)">{{next.title}}</a></li>
                </ul>
            </div>
        </div>
        <!--分类及翻篇 E-->

        <!--留言板 S-->
        <div class="comments">
            <h2 class="comments-header">留言({{comment_num}}条)</h2>

            <div class="comments-content" v-for="comment in comments" :key="comment.id">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">{{comment.nickname}}</span> 说：
                    </div>
                    <div class="comment-content">
                        <p>{{comment.content}}</p>
                    </div>
                    <div class="comment-footer">
                        <span>{{comment.created_at}}</span>
                        <span>回复</span>

                    </div>
                </div>
            </div>

        </div>
        <!--留言板 E-->

        <!--发表看法 S-->
        <div class="main-comment">
            <h1>发表我的看法</h1>
            <form>
                <p><label>您的留言 （HTML标签部分可用）</label></p>
                <p><textarea name="text" rows="10" cols="=50"></textarea></p>
                <div>
                    <p>您的姓名：</p>
                    <p>
                        <input type="text"/>
                        <span>必填</span>
                    </p>
                </div>
                <div>
                    <p>电子邮件：</p>
                    <p>
                        <input type="text"/>
                        <span>必填</span>
                    </p>
                </div>
                <div>
                    <p>个人网址：</p>
                    <p>
                        <input type="text"/>
                        <span>您可以投放自己的个人博客哦</span>
                    </p>
                </div>
                <div>
                    <p style="display: inline">记住个人信息？</p>
                    <input type="checkbox"/>
                </div>
                <div>
                    <p><input type="submit" value="发表"/>
                    <span>填写完成 请点击这里</span></p>
                </div>
            </form>
        </div>
        <!--发表看法 E-->
    </div>
</div>
  </div>
</template>

<script>
export default {
  name: 'Detail',
  data () {
    return {
      id: this.$route.params.id, // 文章id
      comment_num: 0, // 评论数量
      comments: [], // 评论列表
      cate: {id: '', name: ''}, // 分类
      before: {id: '0', title: ''}, // 上一篇
      next: {id: '0', title: ''}, // 下一篇
      detail: { // 文章内容
        title: '',
        created_at: '',
        pv: '',
        content: '',
        tags: []
      }
    }
  },
  mounted () {
    this.frontArticleDetail(this.id)
  },
  methods: {
    // 页面数据获取
    frontArticleDetail (id) {
      this.$api.article.frontArticleDetail(id).then(res => {
        console.log(res.data)
        // 执行某些操作
        if (res.data.code === 0) {
          this.comment_num = res.data.data.comment_num
          this.comments = res.data.data.comments
          this.detail = res.data.data.detail
          this.cate = res.data.data.detail.cate
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
    },
    toDetail (id) {
      // 直接调用$router.push 实现携带参数的跳转
      this.$router.push({
        path: '/Detail/' + id
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import '../assets/css/layout_head_foot.css';
@import '../assets/css/private_post.css';
@import '../assets/iconfont/blog/iconfont.css';
</style>
