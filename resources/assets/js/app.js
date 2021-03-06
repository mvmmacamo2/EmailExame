
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 Vue.use(require('vue-resource'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


 // import customers from './components/Customers.vue';
 // components:{ customers, usuarios}

 Vue.http.headers.common['X-CSRF-TOKEN']=$('meta[name="csrf-token"]').attr('content');
 Vue.component('example-component', require('./components/ExampleComponent.vue'));
 import emails from './components/Email.vue';

 const app = new Vue({
 	el: '#app',
 	components: { emails}
 });
