/**
 * article模块接口列表
 */

import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const article = {
  // 文章列表
  frontArticleList (code, page, pageSize, tagId, cateId, keyword) {
    return axios.get(Apis.farticleList, {params: {code: code, page: page, page_size: pageSize, tag_id: tagId, cate_id: cateId, keyword: keyword}})
  },
  // 文章详情
  frontArticleDetail (id) {
    return axios.get(Apis.farticleDetail, {params: {id: id}})
  },
  // 文章列表
  manageArticleList (keyword, page, pageSize, type) {
    return axios.get(Apis.articleList, {keyword: keyword, page: page, page_size: pageSize, type: type})
  },
  // 文章详情
  manageArticleDetail (id) {
    return axios.get(Apis.detail, {id: id})
  },
  // 文章保存 id cate_id title content status tags
  manageArticleSave (params) {
    return axios.post(Apis.save, qs.stringify(params))
  },
  // 删除文章
  manageArticleDel (id) {
    return axios.post(Apis.delArticle, {id: id})
  },
  // 发布退回文章
  manageUpdateStatus (id, status) {
    return axios.post(Apis.updateStatus, {id: id, status: status})
  }
}

export default article
