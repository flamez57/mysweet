<template>
    <div class="main-container">
        <div class="content">
            <div class="container-title">
                <ul id="arch-manage-title-ul">
                    <li class="main-container-titel">文章</li>
                </ul>
            </div>
            <!--内容1.2 创建文章 S-->
            <div class="container-body" id="manage-container-body1-2">
                <div class="post-func">
                    <select class="select-cate" v-model="articleForm.cate_id">
                        <option value="0">请选择分类</option>
                        <option v-for="cate in cates" :key="cate.id" :value="cate.id">{{cate.name}}</option>
                    </select>
                    <a class="del-btn" @click="deleted(id)">删除</a>
                    <a class="view-btn" @click="toDetail(id)">预览</a>
                    <a class="save-btn" @click="save">存草稿</a>
                    <a class="rel-btn" @click="publish(id)">发布</a>
                </div>
                <!--文章编辑 S-->
                <div class="edit-area">
                    <div class="arch-title">
                        <!--<span>标题:</span>-->
                        <input type="text" placeholder="文章标题" v-model="articleForm.title"/>
                    </div>
                    <div class="arch-desc">
                        <!--<span>描述:</span>-->
                        <input type="text" placeholder="文章描述"/>
                    </div>
                    <div class="arch-main-body">
                        <editor-bar v-model="articleForm.content" :isClear="isClear" @change="change"></editor-bar>
                    </div>
                </div>
                <!--文章编辑 E-->
            </div>
            <!--内容1.2 创建文章 E-->
        </div>
    </div>
</template>

<script>
import EditorBar from './WangEnduit'
export default {
  name: 'CreateArticle',
  components: { EditorBar },
  data () {
    return {
      id: this.$route.params.id, // 文章id
      cates: [],
      tags: [],
      articleForm: {
        id: '0',
        cate_id: '0',
        content: '',
        tags: '',
        title: ''
      },
      isClear: false,
      detail: '文章内容'
    }
  },
  mounted () {
    this.cateList()
    this.tagList()
    this.info()
  },
  methods: {
    change (val) {
      console.log(val)
      this.articleForm.content = val
    },
    // 分类
    cateList () {
      this.$api.cate.manageCateSelect().then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.cates = res.data.data.list
        }
      })
    },
    // 标签
    tagList () {
      this.$api.tag.managetagSelect().then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.tags = res.data.data.list
        }
      })
    },
    info () {
      this.$api.article.manageArticleDetail(this.id).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.articleForm.id = res.data.data.id
          this.articleForm.cate_id = res.data.data.cate_id
          this.articleForm.content = res.data.data.drafts_content
          this.articleForm.tags = res.data.data.tags
          this.articleForm.title = res.data.data.title
        }
      })
    },
    save () {
      this.$api.article.manageArticleSave(this.articleForm).then(res => {
        console.log(res)
        // 执行某些操作
        this.$router.push('/Manage/ArticleList')
      })
    },
    publish (id) {
      this.$api.article.manageArticleSave(this.articleForm).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.$api.article.manageUpdateStatus(id, 1).then(res => {
            console.log(res)
            // 执行某些操作
            if (res.data.code === 0) {
              this.$router.push('/Detail/' + id)
            }
          })
        }
      })
    },
    deleted (id) {
      this.$api.article.manageArticleDel(id).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.info()
        }
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
@import '../assets/css/layout_manage_index.css';
@import '../assets/css/layoutInforModify.css';
@import '../assets/iconfont/blog/iconfont.css';
@import '../assets/iconfont/blog-edit/iconfont.css';
@import '../assets/iconfont/login/iconfont.css';
</style>
