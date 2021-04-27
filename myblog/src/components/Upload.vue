<template>
    <div class="avatar">
        <div @mouseover="showBg=true" @mouseleave="showBg=false">
            <div class="bg" v-if="showBg" :style="`line-height:${imgHeight}`">点击上传</div>
            <input type="file" class="input-file" :style="`width:${imgWidth};height:${imgHeight};`" name="avatar" ref="avatarInput" @change="changeImage($event)" accept="image/gif,image/jpeg,image/jpg,image/png">
            <img class="form-img-inner" :src="avatar?avatar:require('../assets/img/head2.png')" alt="" :style="`width:${imgWidth};height: ${imgHeight};`" name="avatar">
        </div>
    </div>
</template>

<script>
export default {
  name: 'upload',
  data () {
    return {
      avatar: '',
      file: '',
      showBg: false
    }
  },
  // uploadType: 上传类型
  // width: 图片显示的宽度
  // height: 图片显示的高度
  // imgUrl: 如果之前有图片，图片的路径地址
  props: ['uploadType', 'imgUrl', 'imgWidth', 'imgHeight'],
  created () {
    this.avatar = this.imgUrl
    console.log('图：' + this.avatar)
  },
  watch: { // 监控imgUrl变化
    imgUrl (val, oldVal) {
      this.avatar = val
      console.log(oldVal)
    }
  },
  methods: {
    changeImage: function (e) {
      let file = e.target.files[0]
      if (file) {
        this.file = file
        console.log(this.file)
        let reader = new FileReader()
        let that = this
        reader.readAsDataURL(file)
        reader.onload = function (e) {
          // 这里的this 指向reader
          that.avatar = this.result
          that.upload()
        }
      }
    },
    upload: function () {
      let files = this.$refs.avatarInput.files
      let fileData = {}
      if (files instanceof Array) {
        fileData = files[0]
      } else {
        fileData = this.file
      }
      // console.log('fileData', typeof fileData, fileData)
      let data = new FormData()
      data.append('img', fileData)
      data.append('operaType', this.uploadType)
      this.$api.base.uploadImg(data).then(res => {
        console.log(res)
        this.file = ''
        let data = res.data.data
        this.$emit('upload', data)
        alert('上传成功')
      }).catch(err => {
        console.log(err)
        alert('上传失败')
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.form-img-inner{
    vertical-align: middle;
    width: 100%;
    height: 100%;
    border-radius: 50%;
}
.avatar {
    cursor: pointer;
    position: relative;
}
.input-file {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}
.bg {
    width: 100%;
    height: 100%;
    color: #fff;
    background-color: rgba(0,0,0,0.3);
    text-align: center;
    cursor: pointer;
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 50%;
}
</style>
