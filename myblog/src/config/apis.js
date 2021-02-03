/**
 * Created by Administrator on 2020/12/11.
 */
import { baseUrl } from './env'

//api地址
let frontApi = baseUrl + 'm=blogapi&c=index&a='
let manageApi = baseUrl + 'm=blogapi&c=manage&a=' // 管理端

let Apis = {
    // 用户信息
    memberInfo: frontApi + 'memberInfo',
}
export default Apis
