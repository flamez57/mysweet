<template>
<div class="main-container">
        <div class="content">
            <div class="form-container">
                <!--内容一 S-->
                <div class="form">
                    <div class="form-element">
                        <label class="form-label">姓名</label>
                        <input class="input" type="text" v-model="memberForm.nickname"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">主页地址</label>
                        <input class="input" type="text" v-model="memberForm.home_page"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">GitHub</label>
                        <input class="input" type="text" v-model="memberForm.github"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">QQ</label>
                        <input class="input" type="text" v-model="memberForm.qq"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">邮箱</label>
                        <input class="input" type="text" v-model="memberForm.email"/>
                    </div>
                    <div class="form-element">
                        <label class="form-label">个性签名</label>
                        <textarea class="textarea" v-model="memberForm.motto"></textarea>
                    </div>
                    <div class="form-element">
                        <label class="form-label">头像</label>
                        <div class="form-message">请选择小于1M的图片</div>
                        <div class="form-img">
                            <upload :uploadType="`head`" :imgWidth="`140px`" :imgHeight="`140px`" :imgUrl="memberForm.avatar" @upload="getImgUrl"></upload>
                        </div>
                    </div>
                    <div class="form-element">
                        <span class="btn mr-10" @click="saveMemberInfo">保存</span>
                        <span class="btn">取消</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Upload from './Upload'
export default {
  name: 'About',
  components: { Upload },
  data () {
    return {
      msg: 'about',
      memberForm: {
        nickname: '',
        home_page: '',
        github: '',
        qq: '',
        email: '',
        motto: '',
        avatar: ''
      }
    }
  },
  mounted () {
    this.memberInfo()
  },
  methods: {
    memberInfo () {
      this.$api.member.manageMemberInfoForEdit().then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.memberForm.nickname = res.data.data.member_info.nickname
          this.memberForm.home_page = res.data.data.member_info.home_page
          this.memberForm.github = res.data.data.member_info.github
          this.memberForm.qq = res.data.data.member_info.qq
          this.memberForm.email = res.data.data.member_info.email
          this.memberForm.motto = res.data.data.member_info.motto
          this.memberForm.avatar = res.data.data.member_info.avatar
        }
      })
    },
    saveMemberInfo () {
      this.$api.member.manageSaveMemberInfo(this.memberForm).then(res => {
        console.log(res)
        // 执行某些操作
      })
    },
    // 接收子组件emit的事件
    getImgUrl (data) {
      // data  得到的就是返回的图片路径的相关参数
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
