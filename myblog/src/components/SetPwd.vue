<template>
<div class="main-container">
        <div class="content">
            <div class="form-container">
                <div class="form">
                    <div class="form-element">
                        <label class="form-label">原密码</label>
                        <input class="input pwd" type="password" maxlength="16" value=""/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">新的密码</label>
                        <input class="input pwd" type="password" maxlength="16" value=""/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">确认密码</label>
                        <input class="input pwd" type="password" maxlength="16" value=""/>
                    </div>
                    <div class="form-element">
                        <span class="btn mr-10">确认</span>
                        <span class="btn">取消</span>
                    </div>
                </div>
                <!--内容二 E-->
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
