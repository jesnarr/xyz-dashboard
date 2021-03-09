import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

import firstPage from './components/pages/myFirstVuePage';
import newRoutePage from './components/pages/newRoutePage';

import hooks from './components/pages/basic/hooks.vue';
import methods from './components/pages/basic/methods.vue';

//admin project pages
import home from './components/pages/home';
import tags from './admin/pages/tags';
import category from './admin/pages/category';
import reports from './admin/pages/reports';
import records from './admin/pages/records';

import certificates from './admin/certificates/certificates';

import officials from './admin/barangay/officials';
import events from './admin/barangay/events';
import announcements from './admin/barangay/announcements';
import batch from './admin/barangay/batch';
import about from './admin/barangay/about';

import login from './admin/auth/login';
// components vuex
import usecom from './vuex/usecom';

const routes = [
    // projects routes

    {
        path:'/login',
        component: login,

    },
    {
        path:'/testvuex',
        component: usecom,

    },
    {
        path:'/dashboard',
        component: home,

    },
    {
        path:'/tags',
        component: tags,

    },
    {
        path:'/category',
        component: category,

    },
    {
        path:'/reports',
        component: reports,

    },
    {
        path:'/certificates',
        component: certificates,

    },
    {
        path:'/records',
        component: records,

    },
    {
        path:'/officials',
        component: officials,

    },
    {
        path:'/batch',
        component: batch,

    },
    {
        path:'/events',
        component: events,

    },
    {
        path:'/announcements',
        component: announcements,

    },
    {
        path:'/about',
        component: about,

    },
    // basic tutorial routes
    {
        path:'/my-new-vue-route',
        component: firstPage,
    },
    {
        path:'/new-route',
        component: newRoutePage
    },
    // vue hooks
    {
        path:'/hooks',
        component: hooks
    },
     // more basics
     {
        path:'/methods',
        component: methods
    },
]

export default new Router({
    mode: 'history',
    routes
})