<template>

<div class="main-canvas">
  <div class="left-sidebar" id="left-sidebar">
    <div class="sidebar-main-content">
      <div class="header-info">
        <img class="header-info-head" src="../assets/img/head2.png"/>
        <h2 class="header-info-name">小黄人</h2>
        <p class="header-info-desc">欢迎来到我的个人博客</p>
      </div>
      <ul class="left-nav" id="ul1">
      <li class="left-nav-item left-nav-action">
                    <a href="#" class="left-nav-inner">
                        <i class="iconfont icontimerauto" aria-hidden="true"></i>
                        修改个人信息
                    </a>
                </li>
                <li class="left-nav-item">
                    <a href="#" class="left-nav-inner">
                        <i class="iconfont icon-lock" aria-hidden="true"></i>
                        修改密码
                    </a>
                </li>
        <li class="left-nav-item left-nav-action">
          <a href="#" class="left-nav-inner">
            <i class="iconfont iconarticle-line" aria-hidden="true"></i>
            文章
          </a>
        </li>
        <li class="left-nav-item">
          <a href="#" class="left-nav-inner">
            <i class="iconfont iconfolder" aria-hidden="true"></i>
            分类
          </a>
        </li>
        <li class="left-nav-item">
          <a href="#" class="left-nav-inner">
            <i class="iconfont iconsettings" aria-hidden="true"></i>
            设置
          </a>
        </li>
      </ul>
    </div>
    <div class="user-exit">
      <button>退出</button>
    </div>
  </div>
    <div class="top-sidebar">
    <div class="top-nav">
      <ul class="top-icon-menu">
        <li id="control-left-nav">
          <i class="iconfont iconmenu" aria-hidden="true"></i>
        </li>
      </ul>

      <ul class="top-private-menu">
        <li class="private-menu-item"><a class="private-menu-inner" href="../index.html" target="_blank">博客预览</a></li>
        <li class="private-menu-item" id="li1">
          <a class="private-menu-inner open-drop-down" id="oA" href="userInforModify.html" target="_blank">个人中心</a>
          <!--<div class="drop-down" id="drop-down">-->
          <!--<a href="#">个人信息</a>-->
          <!--<a href="#">修改密码</a>-->
          <!--<a href="#">退出</a>-->
          <!--</div>-->
        </li>
      </ul>
    </div>
  </div>

    <div class="main-container" style="display: block;">
    <div class="content">
      <div class="container-title">
        <ul id="arch-manage-title-ul">
          <li class="main-container-titel">文章</li>
        </ul>
      </div>
      <!--内容1.1 管理文章 S-->
      <div class="container-body" style="display: block;" id="manage-container-body1-1">
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
            <a href="#" class="rel-btn" id="add-post">创建文章</a>
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
                  <a href="../view-post.html" target="_blank"><i class="iconfont iconchakan" aria-hidden="true"></i></a>
                  <a class="delete-post" href="#" onclick="confirm('确定删除吗？');">
                    <i class="iconfont iconicon--" aria-hidden="true"></i>
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
