
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;


let AppLayout = require('./components/App');

const Posts = Vue.component('Posts' , require('./components/PostsComponent'));

Vue.use(VueRouter , VueAxios , axios);

const routes = [
    {
        name: 'post',
        path: '/study/posts/:category/:slug',
        component: Posts
    },
]


const router = new VueRouter({
    mode: 'history',
    routes: routes // short for `routes: routes`
})

/*new Vue(
    Vue.util.extend(
        {router},
        AppLayout
    )
).$mount('#app')*/

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('posts-component', require('./components/PostsComponent.vue').default);
Vue.component('comment', require('./components/comment.vue').default);
Vue.component('ckeditor', require('./components/ckeditor.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);
Vue.component('profile-component', require('./components/ProfileComponent.vue').default);
Vue.component('users-component', require('./components/UsersComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('profile-header-component', require('./components/ProfileHeaderComponent.vue').default);
Vue.component('friends-list-component', require('./components/FriendsListComponent.vue').default);
Vue.component('blog-posts-component', require('./components/BlogPostsComponent.vue').default);
Vue.component('panel-component', require('./components/PanelComponent.vue').default);
Vue.component('blog-post-content-show-component', require('./components/BlogPostContentShowComponent.vue').default);
/*admin*/
Vue.component('create-post-component', require('./components/AdminCreatePost.vue').default);
Vue.component('admin-users-component', require('./components/AdminUsers.vue').default);
Vue.component('blog-category-component', require('./components/BlogCategoryComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router'
Vue.use(VueRouter)


/**imported plugins**/

/**vue paginate******************************************************************/
import Vue from 'vue'
import VuePaginateAl from 'vue-paginate-al'
Vue.component('vue-paginate-al', VuePaginateAl)
/**end vue paginate**/

/**persian datepicker**/
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
Vue.component('date-picker', VuePersianDatetimePicker);
/**end persian datepicker**/

/**vue validation**/
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);
/**end vue validation**/

/**image croppa**/

import Croppa from 'vue-croppa';
Vue.use(Croppa);
import 'vue-croppa/dist/vue-croppa.css';

/**end image croppa**/

/*jquery inside vue*/
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;
/*end jquery inside vue*/

/**vue notifications**/
import Notifications from 'vue-notification'

Vue.use(Notifications)
/**end vue notifications**/

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(34,230,65)',
    failedColor: 'red',
    height: '3px'
})

import UploadImage from 'vue-upload-image';

new Vue({
    template: '<upload-image url=""></upload-image>',
    components: {
        UploadImage
    }
})

require('vue2-animate/dist/vue2-animate.min.css')


/**vue stiky*/

import VueSticky from 'vue-sticky' // Es6 module
Vue.use(VueSticky)

/*vue algoliasearch*/

import algoliasearch from 'algoliasearch/lite';
window.algoliasearch = algoliasearch;

import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch)

/*vue copy to clipboard*/
import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)

/*vue scroll to*/
var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo)

/**end imported plugins************************************************************/

document.addEventListener("DOMContentLoaded", () => {
    const app = new Vue({
        el: '#app',
        router,
        data:{
        },
        mounted(){
            this.setUserLastSeen();
        },
        created(){

        },

        methods:{
            setUserLastSeen: function () {
                var lastseen = setInterval(function () {
                    axios.post('/api/lastSeen').then(res=>{
                    }).catch(err=>{
                        console.log(err.response.data.message);
                        if (err.response.data.message === 'Unauthenticated.') {
                            clearInterval(lastseen);
                        }
                    })
                } , 25000)
            },
        }
    });

});
