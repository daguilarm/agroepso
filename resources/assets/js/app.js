/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

require('./jquery/default');

require('./jquery/sections');

require('./vendor/jquery.print');

window.Auto = require('./vendor/autocomplete.js')

require('./jquery/complete');

//window.Vue = require('vue');

/**
 * Default values
 */
window._path = window.location.origin;

/**
 * Cache for one week
 */
window._stored_cache = 60 * 60 * 24 * 7; //One week

/**
 * Max decimals allowed
 */
window._max_decimals = 2;

/**
 * Minimun number of letters to start the ajax query
 */
window._search_length = 2;

/**
 * FontAwesome
 */
window.FontAwesomeConfig = {
    searchPseudoElements: true
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
