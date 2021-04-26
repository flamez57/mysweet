<template>
    <div class="main-container">
        <div class="content">
            <div class="container-title">
                <ul id="cate-manage-title-ul">
                    <li class="main-container-titel">记录日记</li>
                </ul>
            </div>
            <!--内容2.2 添加管理 S-->
            <div class="container-body" id="manage-container-body2-2">
                <div class="edit-cate-info">
                    <em class="iconfont iconfolder"></em>
                    <div>
                        <textarea class="textarea" v-model="formData.content"></textarea>
                    </div>
                </div>
                <div class="arch-container">
                    <a href="#" class="rel-btn" @click="save">点我添加</a>
                </div>
            </div>
            <!--内容2.2 添加管理 E-->
        </div>
    </div>
</template>

<script>

export default {
  name: 'AddDiary',
  data () {
    return {
      formData: {
        content: ''
      }
    }
  },
  methods: {
    save () {
      this.$api.diary.manageAddDiary(this.formData).then(res => {
        console.log(res)
        // 执行某些操作
        this.$router.push('/Manage/DiaryList')
      })
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
