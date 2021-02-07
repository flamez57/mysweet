/**
 * 评论模块接口列表
 */
import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const comment = {
  // 发表看法 post article_id content nickname
  frontAddComment (params) {
    return axios.post(Apis.faddComment, qs.stringify(params))
  },
  // 回复 post id content
  frontReply (params) {
    return axios.post(Apis.freply, qs.stringify(params))
  }
}

export default comment
