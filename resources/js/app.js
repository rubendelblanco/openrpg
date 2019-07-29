
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import Router from 'vue-router';
const BootstrapVue = require('bootstrap-vue');

Vue.use(BootstrapVue);
Vue.use(Router);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sidebar-admin-component', require('./components/SidebarAdminComponent.vue').default);
Vue.component('user-table', require('./components/UserTable.vue').default);
Vue.component('content-editable', require('./components/ContentEditable.vue').default);
Vue.component('change-password', require('./components/ChangePassword.vue').default);
Vue.component('submit-button', require('./components/SubmitButton.vue').default);

let router = new Router({
    routes: [
        {   
            name:'name_index',
            path:'/users',
            component: require('./views/users/index').default
        },
        {
            name: 'user_show',
            path: '/users/:id(\\d+)',
            component: require('./views/users/show').default
        },
        {
            name: 'user_edit',
            path: '/users/:id/edit',
            component: require('./views/users/edit').default
        },
        {
            name: 'user_create',
            path: '/users/create',
            component: require('./views/users/create').default
        }
    ],
    linkExactActiveClass: 'active'
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
