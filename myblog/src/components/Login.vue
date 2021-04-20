<template>

<div class="login-box">
    <h1>管理员登录</h1>
    <form>
        <div class="text-box">
            <i class="iconfont icon-timerauto" aria-hidden="true"></i>
            <input type="text" v-model="loginForm.code" placeholder="请输入用户名"/>
        </div>
        <div class="text-box">
            <i class="iconfont icon-lock" aria-hidden="true"></i>
            <input type="password" v-model="loginForm.pwd" placeholder="输入密码"/>
        </div>
        <div class="save-pwd">
            <input type="checkbox"/>记住密码
        </div>
        <input type="submit" @click="login" value="登录"/>
    </form>
</div>

</template>

<script>
export default {
  name: 'About',
  data () {
    return {
      msg: 'about',
      loginForm: {
        code: '',
        pwd: ''
      }
    }
  },
  methods: {
    login () {
      let _this = this
      if (this.loginForm.code === '' || this.loginForm.pwd === '') {
        alert('账号或密码不能为空')
      } else {
        this.$api.member.toLogin(_this.loginForm.code, _this.loginForm.pwd).then(res => {
          console.log(res.data)
          // 执行某些操作
          if (res.data.code === 0) {
            // 将用户token保存到vuex中
            _this.$api.store.commit('changeLogin', {Authorization: res.data.data.token})
          }
          /*
          _this.$router.push('/home');
          */
          alert(res.data.message)
        }).catch(error => {
          alert('账号或密码错误')
          console.log(error)
        })
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import '../assets/css/layout_login.css';
@import '../assets/iconfont/login/iconfont.css';
</style>
