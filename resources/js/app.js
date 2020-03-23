/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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

Vue.component('top', require('./components/Top.vue').default);
Vue.component('tweets', require('./components/Tweet.vue').default);
Vue.component('insUser', require('./components/Popup/pages.vue').default);
Vue.component('instagram', require('./components/Instagram.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$eventBus = new Vue();

const app = new Vue({
    el: '#app',
    data: {
        data: {},
        isInstagram: false,
        ig_user_id: '',
        messages: '',
        showDownload: false,
        loadingData: false,
        date: '',
        username: '',
        ERR: false
    },
    created: function(){
        this.$eventBus.$on('newAccount', (loading) => {
            this.ERR = false;
            this.data = [];
            this.messages = '';
            this.loadingLogin = loading;
            this.showDownload = false;
        });
        this.$eventBus.$on('applyClick', (click) => {
            this.loadingData = click;
            this.loadingLogin = false;
            this.data = [];
            this.messages = '';
            this.ERR = false;
        });
        this.$eventBus.$on('dataEvent', this.eventData );
        this.$eventBus.$on('ERR', () => {
            this.loadingData = false;
            this.ERR = true;
        });
    },
    methods:{
        eventData: function(response, form, user, isInstagram) {
            this.ig_user_id = form.username;
            this.isInstagram = isInstagram;
            this.data = response;
            this.loadingData =  false;
            this.date = form.date.replace('/', '-');
            this.username = user.username;
            this.showDownload = this.data.length;
        }
    }
});
