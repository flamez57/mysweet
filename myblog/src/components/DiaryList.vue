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
            <a href="javascript:void(0)" class="inner action">列表</a>
            <a href="#" class="inner">回收站</a>
          </div>
          <!--筛选 E-->

          <!--搜索 及 创建 S-->
          <div class="right-direction-item">
            <div class="search-box" id="cate-search-box">
              <input id="cate-search-text" type="text" placeholder="search">
              <button class="searchbtn" id="cate-search-btn">
                <i class="iconfont iconsearch" aria-hidden="true"></i>
              </button>
            </div>
            <router-link to="/Manage/AddDiary" class="rel-btn">添加日记</router-link>
          </div>
          <!--搜索 及 创建 E-->
        </div>

        <!--表格 S-->
        <div class="table-responsive">
          <table class="table" id="cate-table">
            <thead>
            <tr>
              <th scope="col">分类名称</th>
              <th scope="col">文章数量</th>
              <th></th>
            </tr>
            </thead>
            <tbody id="cate-tbody">
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconfolder mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">生活</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td>6</td>
              <td>
                <div class="edit">
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconfolder mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">前端</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td>6</td>
              <td>
                <div class="edit">
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row" class="position-relative">
                <div class="media">
                  <a class="stretched-link" href="../view-post.html">
                    <em class="iconfont iconfolder mr-24"></em>
                  </a>
                  <div class="media-body">
                    <h3 class="media-title">111</h3>
                    <span class="media-text">— 没有描述</span>
                  </div>
                </div>
              </td>
              <td>6</td>
              <td>
                <div class="edit">
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');"><i class="iconfont iconicon--"
                                                                                  aria-hidden="true"></i></a>
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!--表格 E-->
      </div>
      <!--内容2.1 管理分类 E-->
    </div>
  </div>
</template>

<script>

export default {
  name: 'About',
  data () {
    return {
      msg: 'about'
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
