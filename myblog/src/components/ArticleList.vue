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
            <a href="javascript:void(0)" class="inner action">全部</a>
            <a href="javascript:void(0)" class="inner">草稿</a>
            <a href="javascript:void(0)" class="inner">发布</a>
            <a href="#" class="inner">回收站</a>
          </div>
          <!--筛选 E-->

          <!--搜索 及 创建 S-->
          <div class="right-direction-item">
            <div class="search-box" id="post-search-box">
              <input id="post-search-text" type="text" placeholder="search">
              <button class="searchbtn" id="post-search-btn">
                <i class="iconfont iconsearch" aria-hidden="true"></i>
              </button>
            </div>
            <router-link to="/Manage/CreatArticle" class="rel-btn">
                创建文章
                </router-link>
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
