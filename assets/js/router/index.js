import Vue from 'vue';
import VueRouter from 'vue-router'

import Home from '../components/GameList'
import NewGame from '../components/GameCreate'

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

export default new VueRouter({
    routes,
    mode: 'history'
});