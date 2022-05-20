/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// components
Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('body-component', require('./components/BodyComponent.vue').default);
Vue.component('leftbody-component', require('./components/LeftBodyComponent.vue').default);
Vue.component('rightbody-component', require('./components/RightBodyComponent.vue').default);

// vue js
const app = new Vue({
    el: '#app',
});
