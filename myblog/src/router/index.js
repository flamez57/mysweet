import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Record from '@/components/Record'
import About from '@/components/About'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },{
      path: '/Record',
      name: 'Record',
      component: Record
    },{
      path: '/About',
      name: 'About',
      component: About
    }
  ]
})
