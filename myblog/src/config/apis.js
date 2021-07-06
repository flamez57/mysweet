/**
 * Created by Administrator on 2020/12/11.
 */
import { baseUrl } from './env'

// api地址
let frontApi = baseUrl + 'm=blogapi&c=index&a='
let manageApi = baseUrl + 'm=blogapi&c=manage&a=' // 管理端

let Apis = {
  // 分类 get code
  fcateList: frontApi + 'cateList',
  // 标签 get code
  ftagList: frontApi + 'tagList',
  // 友联 get
  friendLink: frontApi + 'friendLink',
  // 文章列表 get code page page_size tag_id cate_id keyword
  farticleList: frontApi + 'articleList',
  // 用户信息 get code
  fmemberInfo: frontApi + 'memberInfo',
  // 文章详情 get id
  farticleDetail: frontApi + 'articleDetail',
  // 发表看法 post article_id content nickname
  faddComment: frontApi + 'addComment',
  // 回复 post id content
  freply: frontApi + 'reply',
  // 档案 get code
  fdiary: frontApi + 'diary',
  // 登陆 post code pwd
  flogin: frontApi + 'login',
  // --==管理端接口==--
  // 个人信息详情编辑用 get
  memberInfoForEdit: manageApi + 'memberInfoForEdit',
  // 个人信息编辑保存 post nickname avatar motto home_page github qq email content
  saveMemberInfo: manageApi + 'saveMemberInfo',
  // 修改密码保存 post pwd pwd_new pwd_new2
  setPwd: manageApi + 'setPwd',
  // 文章列表 get keyword page page_size type
  articleList: manageApi + 'articleList',
  // 文章详情 get id
  detail: manageApi + 'detail',
  // 文章保存 post id cate_id title content status tags
  save: manageApi + 'save',
  // 删除文章 post id
  delArticle: manageApi + 'delArticle',
  // 发布退回文章 post id status
  updateStatus: manageApi + 'updateStatus',
  // 标签下拉 get
  tagSelect: manageApi + 'tagSelect',
  // 分类下拉 get
  cateSelect: manageApi + 'cateSelect',
  // 分类列表 get page page_size
  cateList: manageApi + 'cateList',
  // 分类详情 get id
  cateDetail: manageApi + 'cateDetail',
  // 分类保存 post name sort status
  saveCate: manageApi + 'saveCate',
  // 日记列表 get page page_size year mon day
  diaryList: manageApi + 'diaryList',
  // 日记保存 post content
  addDiary: manageApi + 'addDiary',
  // 退出 get
  loginOut: manageApi + 'loginOut',
  // 图片上传
  uploadImg: manageApi + 'uploadImg'
}
export default Apis
