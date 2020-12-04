import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Record from '@/components/Record'
import About from '@/components/About'
import CateList from '@/components/CateList'
import TagList from '@/components/TagList'
import Detail from '@/components/Detail'
// 管理
import Login from '@/components/Login'
import Manage from '@/components/Manage'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    }, {
      path: '/Record',
      name: 'Record',
      component: Record
    }, {
      path: '/About',
      name: 'About',
      component: About
    }, {
      path: '/CateList',
      name: 'CateList',
      component: CateList
    }, {
      path: '/TagList',
      name: 'TagList',
      component: TagList
    }, {
      path: '/Detail',
      name: 'Detail',
      component: Detail
    }, {
      path: '/Login',
      name: 'Login',
      component: Login
    }, {
      path: '/Manage',
      name: 'Manage',
      component: Manage
    }
  ]
})
