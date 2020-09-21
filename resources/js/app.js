require ('./core/bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './core/routes';

require ('./core/components');

Vue.use(VueRouter);

const VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo);

const app = new Vue({
    el: '#app',

    router: new VueRouter(routes)
});
