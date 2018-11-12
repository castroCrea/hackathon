import Vue from 'vue'
import router from './router';
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './App'


Vue.use(VueAxios, axios)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')