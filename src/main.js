import Vue from 'vue'
import App from './App.vue'

import Vuetify from 'vuetify'
import router from './router'
import axios from 'axios'

import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
import 'vuetify/dist/vuetify.min'

window.token = localStorage.getItem('token');
window.axios = axios
window.axios.defaults.baseURL = 'http://localhost:8000'
window.axios.defaults.params = {api_token: window.token}

Vue.use(Vuetify)
Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')
