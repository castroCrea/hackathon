import Vue from 'vue'
import router from './router';
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import VueCookies from 'vue-cookies'
import App from './App'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(Vuelidate)
Vue.use(VueCookies)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')