import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter)


const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import/* webpackChunkName: "GameList" */ ('../components/GameList')
    },
    {
        path: '/create-game',
        name: 'GameCreate',
        component: () => import/* webpackChunkName: "GameCreate" */ ('../components/GameCreate')
    },
]

export default new VueRouter({
    routes,
    mode: 'history'
});