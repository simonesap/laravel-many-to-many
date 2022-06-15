
 window.Vue = require('vue');
//  axios = require('axios');

import Vue from 'vue';
import App from './components/App.vue';

const app = new Vue({
    el: '#root',
    render: h => h(App)
})
