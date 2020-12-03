import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Record from '@/components/Record'
import About from '@/components/About'
import CateList from '@/components/CateList'
import TagList from '@/components/TagList'
import Detail from '@/components/Detail'

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
    }
  ]
})
