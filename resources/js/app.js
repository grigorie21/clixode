import Vue from 'vue'
import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'


Vue.use(VueRouter);
Vue.use(BootstrapVue);

Vue.component('index', require('./components/Index').default);

import routes from "./routes";

const app = new Vue({
    el: '#app',
    router: new VueRouter({routes}),
});
