import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

//admin project pages
import dashboard from './admin/pages/dashboard';
import post from './admin/pages/post';
import albums from './admin/pages/albums';
import photos from './admin/pages/photos';
import comments from './admin/pages/comments';
import users from './admin/pages/users';
import todos from './admin/pages/todos';


const routes = [
  
    {
        path:'/dashboard',
        component: dashboard,

    },
    {
        path:'/',
        component: dashboard,

    },
    {
        path:'/post',
        component: post,

    },
    {
        path:'/comments',
        component: comments,

    },
    {
        path:'/albums',
        component: albums,

    },
    {
        path:'/photo',
        component: photos,

    },
    {
        path:'/todos',
        component: todos,

    },
      {
        path:'/users',
        component: users,

    }
]

export default new Router({
    mode: 'history',
    routes
})