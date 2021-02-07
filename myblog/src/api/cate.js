/**
 * 分类模块接口列表
 */
import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const cate = {
  // 首分类
  frontCateList (code) {
    return axios.get(Apis.fcateList, {code: code})
  },
  // 分类下拉
  manageCateSelect () {
    return axios.get(Apis.cateSelect)
  },
  // 分类列表
  manageCateList (page, pageSize) {
    return axios.get(Apis.cateList, {page: page, page_size: pageSize})
  },
  // 分类详情
  manageCateDetail (id) {
    return axios.get(Apis.cateDetail, {id: id})
  },
  // 分类保存 name sort status
  manageSaveCate (params) {
    return axios.post(Apis.saveCate, qs.stringify(params))
  }
}

export default cate
