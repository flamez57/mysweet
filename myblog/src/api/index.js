/*
** api接口的统一出口
*/
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

// 导出接口
export default {
  article,
  cate,
  tag,
  member,
  comment,
  diary
}
