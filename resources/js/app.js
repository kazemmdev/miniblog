import Vue from "vue"
import router from "./router.config"
import store from "./store";

import "./bootstrap"
import "./components/index"
import "./filters"

import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

window.Vue = Vue;

const app = new Vue({
    el: '#app',
    router,
    store,
    beforeCreate(){
        store.dispatch('fetchCurrentUser')
    }
});
