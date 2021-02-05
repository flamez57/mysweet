/**
 * Created by Administrator on 2020/12/11.
 */
import Apis from './apis'
import axios from 'axios'

const METHOD = {
  GET: 'get',
  POST: 'post'
}
/**
 * 网络请求
 * @param method 方法
 * @param url 接口地址
 * @param params 参数
 * @param showError 是否展示错误信息
 * @returns {Promise<any>}
 */
// 错误和失败信息都在这里进行处理，界面中调用的时候只处理正确数据即可
function request (method, url, params, showError) {
  if (showError || showError === undefined) { // 是否展示错误信息
    showError = true
  } else {
    showError = false
  }
  return new Promise((resolve, reject) => {
    axios({
      method: method,
      url: url,
      params: params,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    }).then((res) => {
      if (res.data.code === 0) { // 0 是请求成功
        resolve(res.data.data)
      } else { // 其他情况返回错误信息，根据需要处理
        reject(res.data)
        if (showError) {
          console.log(res.data.message)
        }
      }
    }).catch(() => {
      if (showError) {
        console.log('请求失败，请稍后再试')
      }
    })
  })
}

function get (url, params, showError) {
  return request(METHOD.GET, url, params, showError)
}

function post (url, params, showError) {
  return request(METHOD.POST, url, params, showError)
}

function fetch (url, params, type = 'GET', showError = false) {
  type = type.toUpperCase()
  return type(url, params, showError)
}
const API = {
  // 产品
  memberInfo: (params) => post(Apis.memberInfo, params),
  memberName: (params) => post(Apis.memberName, params)
}

function install (Vue) {
  Vue.prototype.$request = API
}
export default install
