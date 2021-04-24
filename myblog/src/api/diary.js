/**
 * 分类模块接口列表
 */
import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const diary = {
  // 档案
  frontDiary (code) {
    return axios.get(Apis.fdiary, {params: {code: code}})
  },
  // 日记列表
  manageDiaryList (page, pageSize, year, mon, day) {
    return axios.get(Apis.diaryList, {params: {page: page, page_size: pageSize}})
  },
  // 日记保存 post content
  manageAddDiary (params) {
    return axios.post(Apis.addDiary, qs.stringify(params))
  }
}

export default diary
