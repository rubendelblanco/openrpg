
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import Router from 'vue-router';
import VueFormGenerator from 'vue-form-generator';
const BootstrapVue = require('bootstrap-vue');

Vue.use(BootstrapVue);
Vue.use(Router);
Vue.use(VueFormGenerator);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('sidebar-admin-component', require('./components/SidebarAdminComponent.vue').default);
Vue.component('user-table', require('./components/UserTable.vue').default);
Vue.component('content-editable', require('./components/ContentEditable.vue').default);
Vue.component('validation-errors', require('./components/alerts/ValidationErrors.vue').default);
Vue.component('success-message', require('./components/alerts/SuccessMessage.vue').default);
Vue.component('desktop-menu', require('./components/desktop_menu/RadialMenu.vue').default);
Vue.component('overlay', require('./components/layers/overlay.vue').default);
Vue.component('hamburguer-menu', require('./components/desktop_menu/Hamburguer.vue').default);
Vue.component('character-table', require('./components/CharacterTable.vue').default);

let router = new Router({
    routes: [
        {   
            name:'user_index',
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
        },
        {
            name: 'character_index',
            path: '/characters',
            component: require('./views/characters/index').default
        },
        {
            name: 'character_create',
            path: '/characters/create',
            component: require('./views/characters/create').default
        },
        {
            name: 'character_edit',
            path: '/characters/:id/edit',
            component: require('./views/characters/edit').default
        },
        {
            name: 'character_show',
            path: '/characters/:id(\\d+)',
            component: require('./views/characters/show').default
        },
        {
            name: 'home',
            path: '/',
            component: require('./views/home/index').default
        },
        {
            name: 'xp',
            path: '/xp',
            component: require('./views/experience/index').default
        },
        {
            name: 'spells',
            path: '/spells',
            component: require('./views/spells/index').default
        },
        {
            name: 'spells',
            path: '/spells/search',
            component: require('./views/spells/index').default
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
