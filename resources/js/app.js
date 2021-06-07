require('./bootstrap');

// window.Vue = require('vue');

import Vue from 'vue'

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App';
import Home from './components/Home.vue';
import Admin from './components/Admin.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
    ]
})

new Vue({
    el: '#app',
    components: { App },
    router,
});
