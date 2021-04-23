/**
 * article模块接口列表
 */

import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const base = {
  // 图片上传
  uploadImg (params) {
    return axios.post(Apis.uploadImg, qs.stringify(params))
  }
}

export default base
