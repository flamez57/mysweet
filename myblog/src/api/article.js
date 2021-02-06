/**
 * article模块接口列表
 */

import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const article = {
  // 新闻列表
  articleList () {
    return axios.get(Apis.memberInfo)
  },
  // 新闻详情,演示
  articleDetail (id, params) {
    return axios.get(Apis.memberInfo, {
      params: params
    })
  },
  // post提交
  login (params) {
    return axios.post(Apis.memberInfo, qs.stringify(params))
  }
  // 其他接口…………
}

export default article
