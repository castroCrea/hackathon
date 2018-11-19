import Vue from 'vue'
import router from './router';
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import App from './App'

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


Vue.use(VueAxios, axios)
Vue.use(VueRouter)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')