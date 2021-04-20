/*
** api接口的统一出口
*/
import Vue from 'vue'
import Vuex from 'vuex'

// 文章模块接口
import article from './article'
// 分类模块
import cate from './cate'
// 标签模块
import tag from './tag'
// 用户模块
import member from './member'
// 评论
import comment from './comment'
// 日记档案
import diary from './diary'

Vue.use(Vuex)
// 状态存储
const store = new Vuex.Store({
  state: {
    // 存储token
    Authorization: localStorage.getItem('Authorization') ? localStorage.getItem('Authorization') : ''
  },

  mutations: {
    // 修改token，并将token存入localStorage
    changeLogin (state, user) {
      state.Authorization = user.Authorization
      localStorage.setItem('Authorization', user.Authorization)
    }
  }
})

// 导出接口
export default {
  article,
  cate,
  tag,
  member,
  comment,
  diary,
  store
}
