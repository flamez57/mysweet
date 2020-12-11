<template>
<div class="main-container">
        <div class="content">
            <div class="form-container">
                <!--内容一 S-->
                <div class="form">
                    <div class="form-element">
                        <label class="form-label">姓名</label>
                        <input class="input" type="text" value="胡成3黎"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">主页地址</label>
                        <input class="input" type="text" value="index.html"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">GitHub</label>
                        <input class="input" type="text" value="https://github.com/CharlesHu24"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">QQ</label>
                        <input class="input" type="text" value="2736934369"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">邮箱</label>
                        <input class="input" type="text" value="2736934369@qq.com"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">个性签名</label>
                        <textarea class="textarea" value="123">123</textarea>
                    </div>
                    <div class="form-element">
                        <label class="form-label">头像</label>
                        <div class="form-message">请选择小于1M的图片</div>
                        <div class="form-img">
                            <img class="form-img-inner" src="../assets/img/head2.png"/>
                        </div>
                    </div>
                    <div class="form-element">
                        <span class="btn mr-10">保存</span>
                        <span class="btn">取消</span>
                    </div>
                </div>
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
