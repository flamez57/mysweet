<template>

<div class="main-canvas">
<manage-menu></manage-menu>
  <div class="main-container">
    <div class="content">
      <div class="container-title">
        <ul id="cate-manage-title-ul">
          <li class="main-container-titel">分类</li>
        </ul>
      </div>

      <!--内容2.2 添加管理 S-->
      <div class="container-body" id="manage-container-body2-2">


        <div class="edit-cate-info">
          <em class="iconfont iconfolder"></em>
          <div>
            <input class="cate-title" type="text" placeholder="添加标题..." value="默认文件夹"/>
            <input class="cate-desc" type="text" placeholder="添加描述..." value="简单描述"/>
          </div>
        </div>

        <div class="arch-container">
          <a href="#" class="rel-btn">点我添加</a>
        </div>

      </div>
      <!--内容2.2 添加管理 E-->
    </div>
  </div>

</div>

</template>

<script>
import ManageMenu from './ManageMenu'
export default {
  name: 'About',
  data () {
    return {
      msg: 'about'
    }
  },
  components: {
    ManageMenu
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
