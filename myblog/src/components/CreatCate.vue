<template>
    <div class="main-container">
        <div class="content">
            <div class="container-title">
                <ul id="cate-manage-title-ul">
                    <li class="main-container-titel">分类</li>
                </ul>
            </div>

            <!--内容2.2 添加管理 S-->
            <div class="container-body" id="manage-container-body2-2">
                <div class="edit-cate-info">
                    <em class="iconfont iconfolder"></em>
                    <div>
                        <input class="cate-title" type="text" placeholder="添加标题..." v-model="cateForm.name"/>
                        <input class="cate-desc" type="number" placeholder="排序" v-model="cateForm.sort"/>
                        <div class="toggle-button-wrapper">
                            <input type="checkbox" id="toggle-button" name="switch" :checked="cateForm.status == 1 ? 'checked' : ''" @click="checkedSwitch">
                            <label for="toggle-button" class="button-label">
                                <span class="circle"></span>
                                <span class="text on">ON</span>
                                <span class="text off">OFF</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="arch-container">
                    <a class="rel-btn" @click="save">点我保存</a>
                </div>

            </div>
            <!--内容2.2 添加管理 E-->
        </div>
    </div>
</template>

<script>

export default {
  name: 'CreateCate',
  data () {
    return {
      id: this.$route.params.id, // 类目id
      cateForm: {
        id: '0',
        name: '',
        sort: '',
        status: ''
      }
    }
  },
  mounted () {
    this.info()
  },
  methods: {
    info () {
      this.$api.cate.manageCateDetail(this.id).then(res => {
        console.log(res)
        // 执行某些操作
        if (res.data.code === 0) {
          this.cateForm.id = res.data.data.id
          this.cateForm.name = res.data.data.name
          this.cateForm.sort = res.data.data.sort
          this.cateForm.status = res.data.data.status
        }
      })
    },
    save () {
      this.$api.cate.manageSaveCate(this.cateForm).then(res => {
        console.log(res)
        // 执行某些操作
        this.$router.push('/Manage/ManageCate')
      })
    },
    checkedSwitch () {
      this.cateForm.status ^= 1
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
#toggle-button{ display: none; }
.button-label{
    position: relative;
    display: inline-block;
    width: 80px;
    height: 30px;
    background-color: #ccc;
    box-shadow: #ccc 0px 0px 0px 2px;
    border-radius: 30px;
    overflow: hidden;
}
.circle{
    position: absolute;
    top: 0;
    left: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #fff;
}
.button-label .text {
    line-height: 30px;
    font-size: 18px;
    text-shadow: 0 0 2px #ddd;
}
.on { color: #fff; display: none; text-indent: 10px;}
.off { color: #fff; display: inline-block; text-indent: 34px;}
.button-label .circle{
    left: 0;
    transition: all 0.3s;
}
#toggle-button:checked + label.button-label .circle{
    left: 50px;
}
#toggle-button:checked + label.button-label .on{ display: inline-block; }
#toggle-button:checked + label.button-label .off{ display: none; }
#toggle-button:checked + label.button-label{
    background-color: #51ccee;
}
</style>
