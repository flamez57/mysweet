import Vue from 'vue'
import Router from 'vue-router'
import Front from '@/components/Front'
import Home from '@/components/Home'
import Record from '@/components/Record'
import About from '@/components/About'
import CateList from '@/components/CateList'
import TagList from '@/components/TagList'
import Detail from '@/components/Detail'
// 管理
import Login from '@/components/Login'
import Manage from '@/components/Manage'
import UserInfo from '@/components/UserInfo'
import SetPwd from '@/components/SetPwd'
import ArticleList from '@/components/ArticleList'
import CreatArticle from '@/components/CreatArticle'
import ManageCate from '@/components/ManageCate'
import CreatCate from '@/components/CreatCate'

Vue.use(Router)

const router = new Router({
  routes: [
    {
      path: '/',
      component: Front,
      children: [
        { path: '/', name: 'Home', component: Home },
        { path: 'Record', name: 'Record', component: Record },
        { path: 'About', name: 'About', component: About },
        { path: 'CateList', name: 'CateList', component: CateList },
        { path: 'TagList', name: 'TagList', component: TagList },
        { path: 'Detail', name: 'Detail', component: Detail }
      ]
    }, {
      path: '/Login',
      name: 'Login',
      component: Login
    }, {
      path: '/Manage',
      component: Manage,
      children: [
        { path: '/', name: 'UserInfo', component: UserInfo },
        { path: 'SetPwd', name: 'SetPwd', component: SetPwd },
        { path: 'ArticleList', name: 'ArticleList', component: ArticleList },
        { path: 'CreatArticle', name: 'CreatArticle', component: CreatArticle },
        { path: 'ManageCate', name: 'ManageCate', component: ManageCate },
        { path: 'CreatCate', name: 'CreatCate', component: CreatCate }
      ]
    }
  ]
})

// 导航守卫
// 使用 router.beforeEach 注册一个全局前置守卫，判断用户是否登陆
router.beforeEach((to, from, next) => {
  if (to.path === '/Login') {
    next()
  } else {
    let token = localStorage.getItem('Authorization')

    if (token === 'null' || token === '') {
      next('/Login')
    } else {
      next()
    }
  }
})

export default router
