import Vue from 'vue'
import App from './App'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'


import Home from './components/Home'
import NewGame from './components/NewGame'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)


const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'App',
            component: Home
        },
        {
            path: '/create-game',
            name: 'NewGame',
            component: NewGame
        },
    ]
});


new Vue({
  el: '#app',
  template: '<App/>',
  router,
  components: { App }
})