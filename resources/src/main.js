import Vue from 'vue'
import App from './App.vue'
import "@/assets/main.css";

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueConfetti from 'vue-confetti'
Vue.use(VueConfetti)

import Index from "./components/Index"

const routes = [
    { path: "/", component: Index },
    { path: "/:id", component: Index }
]

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.config.productionTip = false


const VUE_APP_API_URL_DEV = "http://wheel.test";
const VUE_APP_API_URL_PROD = "http://wheelofwhatever.com";

switch (true) {
    case window.location.hostname.includes('.test'):
        window.APP_API_URL = VUE_APP_API_URL_DEV;
        break;
  
    case (process.env.NODE_ENV === 'development'):
        window.APP_API_URL = ''; // <-- proxy being used here
        break;
  
    default:
        window.APP_API_URL = VUE_APP_API_URL_PROD;
  }

new Vue({
    router,
  render: h => h(App),
}).$mount('#app')
