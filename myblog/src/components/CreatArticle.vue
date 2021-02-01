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
          <select class="select-cate">
            <option>请选择分类</option>
            <option value="生活">生活</option>
            <option value="文学">文学</option>
          </select>
          <a href="#" class="del-btn">删除</a>
          <a href="../view-post.html" class="view-btn" target="_blank">预览</a>
          <a href="#" class="save-btn">存草稿</a>
          <a href="#" class="rel-btn">发布</a>
        </div>
        <!--文章编辑 S-->
        <div class="edit-area">
          <div class="arch-title">
            <!--<span>标题:</span>-->
            <input type="text" placeholder="文章标题"/>
          </div>
          <div class="arch-desc">
            <!--<span>描述:</span>-->
            <input type="text" placeholder="文章描述"/>
          </div>
          <div class="arch-main-body">
            <!--<textarea rows="20" cols="70"></textarea>-->
            <editor-bar v-model="detail" :isClear="isClear" @change="change"></editor-bar>
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
  name: 'edit',
  components: { EditorBar },
  data () {
    return {
      msg: 'about',
      isClear: false,
      detail: ''
    }
  },
  methods: {
    change (val) {
      console.log(val)
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
