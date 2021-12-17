require('./bootstrap');

require('alpinejs');


import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';


Vue.use(VueRouter)
Vue.config.productionTip = false;
Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;
import App from './views/App'
        import Hello from './views/Hello'
        import Home from './views/Home'
        import CompaniesIndex from './components/companies/CompaniesIndex'
        import CompaniesEdit from './components/companies/CompaniesEdit'
        import CompaniesCreate from './components/companies/CompaniesCreate'
         import Forms from './components/forms/Fomrs'
        const router = new VueRouter({
            mode: 'history',
            routes: [
                {
                    path: '/',
                    name: 'home',
                    component: Home
                },
                {
                    path: '/hello',
                    name: 'hello',
                    component: Hello,
                },
                {
                    path: '/companies',
                    name: 'companies',
                    component: CompaniesIndex,
                },
                {
                    path: '/companies/create',
                    name: 'createCompany',
                    component: CompaniesCreate,
                },
                {
                    path: '/companies/edit',
                    name: 'editCompany',
                    component: CompaniesEdit,
                },
                  {
                    path: '/forms',
                    name: 'forms',
                    component: Forms,
                },
            ],
        });

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});