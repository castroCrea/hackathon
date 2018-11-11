import Vue from 'vue';
import VueRouter from 'vue-router'

import Home from '../components/Home'
import NewGame from '../components/NewGame'

Vue.use(VueRouter)


const routes = [
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

export default new Router({
  routes,
});