<template>

<div>
<header>
    <div class="header">
        <div class="main-post-title">
            <h1>Apache或者Nginx为PHP设置服务器环境变量</h1>
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
        </div>
    </div>
</header>
   <div class="main-container" id="title" style="display: block">
    <div class="main-container-content">
        <!--正文 S-->
        <article class="main-post">
            <div class="main-post-content">
                <p>在开发项目的时候生产环境和开发环境的配置信息是不一样的，总要切换的话比较麻烦，现在我们可以通过设置服务器环境变量来区分线上生产环境还是本地开发环境，比如我们可以设置 RUNTIME_ENVIROMENT 的为 'DEV'还是'PRO'来区分。然后在PHP端通过$_SERVER['RUNTIME_ENVIROMENT']来获取值。</p>
                <h2>一、Nginx （通过fastcgi_param来设置）</h2>
                <pre>
                    # 在nginx的配置文件nginx.conf中配置环境server段location中添加相应的配置信息
                    location ~ \.php($|/) {
                        #......
                        fastcgi_param    RUNTIME_ENVIROMENT 'PRO'; # PRO or DEV
                        #......
                    }
                </pre>
                <p>配置好后重启（nginx -s reload）就好。</p>
                <h2>二、PHP自身(通过php主配置文件php-fpm.conf来设置)</h2>
                <pre>
                    #这个设置必须放在主配置文件php-fpm.conf里（/usr/local/php/etc/php-fpm.conf）
                    #直接在配置文件中添加：
                    env[RUNTIME_ENVIROMENT] = 'PRO'
                </pre>
                <p>添加后重启php-fpm （service restart php-fpm）。</p>
                <h2>三、Apache设置环境变量（SetEnv 变量名 变量值）</h2>
                <pre>
                    &lt;VirtualHost *:80&gt;
                    #......
                        SetEnv RUNTIME_ENVIROMENT DEV
                    #......
                    &lt;/VirtualHost&gt;
                </pre>
                <p></p>
            </div>
        </article>
        <!--正文 E-->

        <!--分类及翻篇 S-->
        <div class="entry-nav">
            <div class="entry-categories">
                分类&nbsp;:&nbsp;<router-link to="/CateList">服务端</router-link>
            </div>
            <div class="entry-location">
                <ul>
                    <li>上一篇&nbsp;:&nbsp;<router-link to="/Detail">点击上一篇</router-link></li>
                    <li>下一篇&nbsp;:&nbsp;<router-link to="/Detail">点击下一篇</router-link></li>
                </ul>
            </div>
        </div>
        <!--分类及翻篇 E-->

        <!--留言板 S-->
        <div class="comments">
            <h2 class="comments-header">留言(x条)</h2>
            <div class="comments-content">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">小黄人</span>
                        说：
                    </div>
                    <div class="comment-content">
                        <p>这篇文章的沙发归我了，这篇文章的沙发归我了，这篇文章的沙发归我了，这篇文章的沙发归我了</p>
                    </div>
                    <div class="comment-footer">
                        <span>2020-1-10</span>
                        <span>回复</span>

                    </div>
                </div>
            </div>
            <div class="comments-content">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">hcl</span>
                        说：
                    </div>
                    <div class="comment-content">
                        <p>这篇文章的凳子归我了，这篇文章的凳子归我了，这篇文章的凳子归我了，这篇文章的凳子归我了</p>
                    </div>
                    <div class="comment-footer">
                        <span>2020-1-10</span>
                        <span>回复</span>

                    </div>
                </div>
            </div>
            <div class="comments-content">
                <div class="comment">
                    <div class="comment-header">
                        <span class="author">巴拉巴拉</span>
                        说：
                    </div>
                    <div class="comment-content">
                        <p>这篇文章的地板归我了，这篇文章的地板归我了，这篇文章的地板归我了，这篇文章的地板归我了</p>
                    </div>
                    <div class="comment-footer">
                        <span>2020-1-10</span>
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
  name: 'Home',
  data () {
    return {
      msg: 'home'
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
