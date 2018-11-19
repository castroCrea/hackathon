import VueRouter from 'vue-router'
import Game from '../pages/Game'
import GameDescription from '../pages/GameDescription'
import GameCreate from '../pages/GameCreate'
import GameList from '../pages/GameList'
import PlayerCreate from '../pages/PlayerCreate'


const routes = [
    {
        path: '/',
        name: 'home',
        component: GameList,
        children: [
            {
                path: 'games',
                name: 'Games',
                component: GameList,
            },
        ]
    },
    {
        path: '/game',
        component: Game,
        children: [
            {
                name: 'Game',
                path: '',
                component: GameList
            },
            {
                path: 'create',
                name: 'GameCreate',
                component: GameCreate
            },
            {
                path: ':gameId/description',
                name: 'GameDescription',
                component: GameDescription
            },
            {
                path: ':gameId/player/create',
                name: 'PlayerCreate',
                component: PlayerCreate
            }
        ]
    }
]

export default new VueRouter({
    routes,
    mode: 'history'
});