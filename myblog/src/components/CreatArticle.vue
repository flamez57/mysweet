<template>

<div class="main-canvas">
<manage-menu></manage-menu>

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
            <div class="edit-func">
              <span class="edit-func-item">
                <a href="#"><i class="iconfont iconcuti" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconxieti" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconUnderline" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconshanchuxian" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconh1" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconh" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconh2" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconimage" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconyinyong-" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconul" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconol" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconlink" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont icondaima" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont icongongshi" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconvideo" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconfengexian" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconziyuan" aria-hidden="true"></i></a>
                <a href="#"><i class="iconfont iconziyuan1" aria-hidden="true"></i></a>
              </span>
              <span>
                <a href="#"><i class="iconfont iconweibiaoti10" aria-hidden="true"></i></a>
              </span>
            </div>
            <div class="content-canvas">
              <div class="content-body">
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
                <p>巴拉巴拉。。</p>
              </div>
              <!--<div style="height: 400px;"></div>-->
            </div>
          </div>
        </div>
        <!--文章编辑 E-->
      </div>
      <!--内容1.2 创建文章 E-->
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
