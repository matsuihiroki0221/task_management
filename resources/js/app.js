/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import HeaderComponent from "./components/HeaderComponent";
window.Vue = require('vue').default;
import App from "./App.vue";
import router from "./router";
import MyTaskListComponent from "./components/MyTaskListComponent";
import ProjectComponent from "./components/ProjectComponent";
import CompleteTaskComponent from "./components/CompleteTaskComponent";
import { ValidationProvider, extend, ValidationObserver } from 'vee-validate';
import { required, email ,numeric } from 'vee-validate/dist/rules';
import Vue from "vue";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.config.productionTip = false;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
extend('required', required);
extend('numeric',numeric);
extend('email', email);

Vue.component('header-component', HeaderComponent);
Vue.component('my-task-list-component',MyTaskListComponent);
Vue.component('project-component',ProjectComponent);
Vue.component('complete-task-component',CompleteTaskComponent);
Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer',ValidationObserver)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    render:h=>h(App),
    el: '#app',
    router,
    
    },
    {
      data: ()=> ({
        value:''
    })
});
