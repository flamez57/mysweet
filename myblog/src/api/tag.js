/**
 * 标签模块接口列表
 */
import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例

const tag = {
  // 首页标签列表
  frontTagList (code) {
    return axios.get(Apis.ftagList, {params: {code: code}})
  },
  // 分类下拉
  managetagSelect () {
    return axios.get(Apis.tagSelect)
  },
  // 友情链接
  friendLink () {
    return axios.get(Apis.friendLink)
  }
}

export default tag
