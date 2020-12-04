<template>

      <div class="login-box">
    <h1>管理员登录</h1>
    <form>
        <div class="text-box">
            <i class="iconfont icon-timerauto" aria-hidden="true"></i>
            <input type="text" placeholder="请输入用户名"/>
        </div>
        <div class="text-box">
            <i class="iconfont icon-lock" aria-hidden="true"></i>
            <input type="password" placeholder="输入密码"/>
        </div>
        <div class="save-pwd">
            <input type="checkbox"/>记住密码
        </div>
        <input type="submit" value="登录"/>
    </form>
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
@import '../assets/css/layout_login.css';
@import '../assets/iconfont/login/iconfont.css';
</style>
