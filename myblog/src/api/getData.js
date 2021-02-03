/**
 * Created by Administrator on 2020/12/11.
 */
import fetch from '@/config/fetch'

/*
** 获取用户信息
 */
export const memberInfo = () => fetch('m=blogapi&c=index&a=memberInfo&code=123')
console.log(memberInfo())
