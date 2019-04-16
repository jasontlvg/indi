
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./addUser');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';

window.Swal= Swal;

window.Form= Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})

window.Fire= new Vue();

import Gate from './Gate';
Vue.prototype.$gate= new Gate(window.user);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Components for SPA
// Vue.component('starforce', require('./components/Starforce.vue').default);
// Vue.component('cygnus', require('./components/Cygnus.vue').default);
// Vue.component('shield', require('./components/Shield.vue').default);
Vue.component('ninja', require('./components/NotFound.vue').default);


// Router Components

const routes = [
    { path: '/fakeusers', component: require('./components/Starforce.vue').default},
    { path: '/cygnus', component: require('./components/Cygnus.vue').default },
    { path: '/usersapi', component: require('./components/usersAPI.vue').default },
    { path: '/profile', component: require('./components/profile.vue').default },
]

const router= new VueRouter({
    mode: 'history',
    routes
});



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    methods: {
        emisor: function () {
            // Fire.$emit('AfterCreated')
            Fire.$emit('AfterCreated')
        }
    }
});
