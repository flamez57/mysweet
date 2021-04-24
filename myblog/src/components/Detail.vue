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
                    <li v-if="before.id">上一篇&nbsp;:&nbsp;<a @click="toDetail(before.id)">{{before.title}}</a></li>
                    <li v-if="next.id">下一篇&nbsp;:&nbsp;<a @click="toDetail(next.id)">{{next.title}}</a></li>
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
                        <span v-if="comment.allow_reply == 1" @click="toReply(comment.id)">回复</span>
                    </div>
                    <div class="comment-content" v-if="comment.reply_content">
                        <h5>作者回复：</h5>
                        <p>{{comment.reply_content}}---{{comment.reply_at}}</p>
                    </div>
                    <div class="reply-box" width="100%" v-if="comment.id == reply_data.id">
                        <input type="text" placeholder="回复内容" v-model="reply_data.content">
                        <button @click="frontReply">
                            <i class="iconfont iconeditor" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <!--留言板 E-->

        <!--发表看法 S-->
        <div class="main-comment">
            <h1>发表我的看法</h1>
            <div>
                <p><label>您的留言</label></p>
                <p><textarea name="text" rows="10" cols="=50" v-model="comment_data.content"></textarea></p>
                <div>
                    <p>您的姓名：</p>
                    <p>
                        <input type="text" v-model="comment_data.nickname"/>
                        <span>必填</span>
                    </p>
                </div>
                <div>
                    <p><input type="submit" value="发表" @click="frontAddComment"/>
                    <span>填写完成 请点击这里</span></p>
                </div>
            </div>
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
      before: {}, // 上一篇
      next: {}, // 下一篇
      detail: { // 文章内容
        title: '',
        created_at: '',
        pv: '',
        content: '',
        tags: []
      },
      comment_data: {
        article_id: this.$route.params.id, // 文章id
        content: '',
        nickname: ''
      },
      reply_data: {
        id: '', // 评论id
        content: ''
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
          this.before = res.data.data.detail.before
          this.next = res.data.data.detail.next
        }
      })
    },
    // 发表看法 post article_id content nickname
    frontAddComment () {
      if (this.comment_data.nickname === '' || this.comment_data.content === '') {
        alert('名称或内容不能为空')
      } else {
        this.$api.comment.frontAddComment(this.comment_data).then(res => {
          console.log(res.data)
          // 执行某些操作
          if (res.data.code === 0) {
            //
          }
        })
      }
    },
    // 回复 post id content
    frontReply () {
      this.$api.comment.frontReply(this.reply_data).then(res => {
        console.log(res.data)
        // 执行某些操作
        if (res.data.code === 0) {
          //
        }
      })
    },
    toReply (id) {
      this.reply_data.id = id
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
.reply-box{
    position: relative;
    display: inline-block;
    margin:3px;
    width: 100%;
    height: 34px;
    border-radius: 20px;
    border: 1px solid #5c5c5c;
}
.reply-box input{
    width: 85%;
    height: 34px;
    border: none;
    background: none;
    outline: none;
    padding: 0 10px;
    font-size: 12px;
    color:#303030;
}
.reply-box button{
    width: 10%;
    height: 34px;
    border: none;
    background: none;
    outline: none;
    cursor: pointer;
    color: #111;
}
</style>
