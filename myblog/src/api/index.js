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
// 公共
import base from './base'

Vue.use(Vuex)
// 状态存储
const store = new Vuex.Store({
  state: {
    // 存储token
    Authorization: localStorage.getItem('Authorization') ? localStorage.getItem('Authorization') : '',
    // 展视端
    f_code: 'flamez57', // 账号
    f_nickname: '爱学习后生', // 昵称
    f_avatar: 'https://avatars.githubusercontent.com/u/19811152?v=4', // 头像
    f_motto: '欢迎来到我的个人博客', // 座右铭
    // 管理端
    m_code: 'flamez57', // 账号
    m_nickname: '爱学习后生', // 昵称
    m_avatar: 'https://avatars.githubusercontent.com/u/19811152?v=4', // 头像
    m_motto: '欢迎来到我的个人博客' // 座右铭
  },
  getters: { // 实时监听state值的变化（最新状态）
    getAuthorization (state) { // 承载变化的Authorization值
      return state.Authorization
    },
    getfMotto (state) {
      return state.f_motto
    },
    getmNickname (state) {
      return state.m_nickname
    },
    getmAvatar (state) {
      return state.m_avatar
    },
    getmMotto (state) {
      return state.m_motto
    }
  },

  mutations: {
    // 修改token，并将token存入localStorage
    changeLogin (state, user) {
      state.Authorization = user.Authorization
      localStorage.setItem('Authorization', user.Authorization)
    },
    changefNickname (state, value) { // 改变昵称的初始值
      state.f_nickname = value
    },
    changefAvatar (state, value) {
      state.f_avatar = value
    },
    changefMotto (state, value) {
      state.f_motto = value
    },
    changemNickname (state, value) { // 改变昵称的初始值
      state.m_nickname = value
    },
    changemAvatar (state, value) {
      state.m_avatar = value
    },
    changemMotto (state, value) {
      state.m_motto = value
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
  store,
  base
}
