/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import vuetify from './plugins/vuetify' // path to vuetify export
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
  load: {
    key: "",
    libraries: "places" // necessary for places input
  }
});

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('app', require('./components/App.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('transaction-form', require('./components/TransactionForm.vue').default);
Vue.component('google-map', require('./components/GoogleMap.vue').default);
Vue.component('charging-station', require('./components/ChargingStation.vue').default);
Vue.component('wallet', require('./components/Wallet.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify
});
