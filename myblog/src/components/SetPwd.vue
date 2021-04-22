<template>
<div class="main-container">
        <div class="content">
            <div class="form-container">
                <div class="form">
                    <div class="form-element">
                        <label class="form-label">原密码</label>
                        <input class="input pwd" type="password" maxlength="16" v-model="setForm.pwd"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">新的密码</label>
                        <input class="input pwd" type="password" maxlength="16" v-model="setForm.pwd_new"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">确认密码</label>
                        <input class="input pwd" type="password" maxlength="16" v-model="setForm.pwd_new2"/>
                    </div>
                    <div class="form-element">
                        <span class="btn mr-10" @click="manageSetPwd">确认</span>
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
      msg: 'about',
      setForm: {
        pwd: '',
        pwd_new: '',
        pwd_new2: ''
      }
    }
  },
  methods: {
    manageSetPwd () {
      let _this = this
      if (this.setForm.pwd === '' || this.setForm.pwd_new === '' || this.setForm.pwd_new2 === '') {
        alert('密码不能为空')
      } else {
        if (this.setForm.pwd_new !== this.setForm.pwd_new2) {
          alert('两次输入密码不一致')
          return
        }
        this.$api.member.manageSetPwd(_this.setForm).then(res => {
          console.log(res.data)
          // 执行某些操作
          alert(res.data.message)
        }).catch(error => {
          alert('错误')
          console.log(error)
        })
      }
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
