/**
 * article模块接口列表
 */

import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例

const base = {
  // 图片上传
  uploadImg (params) {
    return axios.post(Apis.uploadImg, params)
  }
}

export default base
