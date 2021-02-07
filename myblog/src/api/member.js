/**
 * 用户模块接口列表
 */
import Apis from '../config/apis'
import axios from './http' // 导入http中创建的axios实例
import qs from 'qs' // 根据需求是否导入qs模块

const member = {
  // 首页分类列表用户信息
  frontMemberInfo (code) {
    return axios.get(Apis.fmemberInfo, {code: code})
  },
  // 登陆
  toLogin (code, pwd) {
    return axios.post(Apis.flogin, {code: code, pwd: pwd})
  },
  // 退出
  toLoginOut () {
    return axios.get(Apis.loginOut)
  },
  // 个人信息详情编辑用 get
  manageMemberInfoForEdit () {
    return axios.get(Apis.memberInfoForEdit)
  },
  // 个人信息编辑保存 post nickname avatar motto home_page github qq email content
  manageSaveMemberInfo (params) {
    return axios.post(Apis.saveMemberInfo, qs.stringify(params))
  },
  // 修改密码保存 post pwd pwd_new pwd_new2
  manageSetPwd (params) {
    return axios.post(Apis.setPwd, qs.stringify(params))
  }
}

export default member
