<template>

    <div>

        <div v-on-clickaway="away" class="ui-block search-box-container">
            <div class="ui-block-title" dir="rtl">
                <div class="form-group with-button is-empty">
                    <input @focus="showSearchBox" v-model="v_searchQuery" class="form-control input-search-posts" type="text" placeholder="جستجو میان کاربران...">
                    <button class="btn-search-posts">
                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                    </button>
                    <span class="material-input"></span></div>
            </div>

            <!-- W-Friend-Pages-Added -->

            <ul v-slimscroll="options" v-show="!flag_closeSearchBox" @scroll="onScroll" class="widget w-friend-pages-added notification-list friend-requests search-users-header">
                <li v-for="(user , index) in users" v-if="index < showItemsNumber" class="inline-items">
                    <div class="author-thumb">
                        <img class="img-search-hearder" v-if="user.photo !== null" :src="'/images/sm/'+user.photo.path" alt="author">
                    </div>
                    <div class="notification-event">
                        <a :href="'/profile/'+user.url" target="_blank" class="h6 notification-friend">{{user.family}}</a>
                        <span v-if="user.alias_original !== null" href="#" class="fs0-75"> ({{user.alias_original}}) </span>
                        <span v-for="major in user.categories" v-if="major.sort==='major' && major.pivot.status===1" class="chat-message-item d-block">{{major.titles}} / {{major.pivot.year}}</span>
                        <span v-for="major in user.categories" v-if="major.sort==='major' && major.pivot.status===2" class="chat-message-item d-block">{{major.titles}} / {{major.pivot.year}}</span>
                    </div>
                </li>

            </ul>

            <div v-show="flag_showLoader" class="inline-items loader-container py-2 bg-white">
                <div class="looping-rhombuses-spinner"> <div class="rhombus"></div> <div class="rhombus"></div> <div class="rhombus"></div> </div>
            </div>

            <!-- .. end W-Friend-Pages-Added -->
        </div>

    </div>
</template>

<script>


    /**multi select for tags**/
    import Multiselect from 'vue-multiselect'
    // register globally
    Vue.component('multiselect', Multiselect)


    import Vue from 'vue';

    /*loader*/
    import {AtomSpinner} from 'epic-spinners'

    /*click outside element*/
    import { mixin as clickaway } from 'vue-clickaway';

    import VueSlimScroll from 'vue-slimscroll'
    Vue.use(VueSlimScroll);

    export default {
        data(){
            return{
                users: [],
                showItemsNumber: 10,
                flag_showLoader: false,
                currentPage : '',
                hasNextPage: '',
                listUsers: [],
                v_searchQuery: '',
                flag_closeSearchBox: true,
                flag_doSearch: null,
                /*slim scroll*/
                options:{
                    height:'400px',
                    size: '8px',
                    alwaysVisible: true,
                    position: 'left',
                    disableFadeOut: true,
                    railOpacity: 0.1,
                    railColor: '#0b82b1',
                }
                /*end slim scroll*/


            }
        },
        components: {
            Multiselect,
            AtomSpinner,
        },
        mixins: [ clickaway ],
        props: [
        ],

        watch : {
           /* showItemsNumber:function(val){
                if(val >= this.users.length){
                    this.flag_showLoader = false;
                }
            }*/
            v_searchQuery:function(val) {
                clearTimeout(this.flag_doSearch);
                this.flag_doSearch =  setTimeout(() => {
                    this.getUsers(1);
                },1500)

                this.flag_closeSearchBox = false;
                this.flag_showLoader = true;
                this.users = []
            },
        },

        mounted() {
            this.getUsers(1);
        },

        methods: {

            getUsers:function(n){
                this.currentPage = n;
                if (n === 1){
                    this.users = []
                }

                    axios.get('/api/getUsers/' + this.v_searchQuery.trim() + '?page=' + n).then(res => {
                        this.listUsers = []
                        this.listUsers = res.data.users.data;
                        for (var i = 0; i < this.listUsers.length; i++) {
                            this.users.push(this.listUsers[i])
                        }
                        this.hasNextPage = res.data.users.next_page_url;
                        this.flag_showLoader = false;
                    }).catch(err => {
                        console.log(err);
                    })

            },

            onScroll ({ target: { scrollTop, clientHeight, scrollHeight }}) {
                if (scrollTop + clientHeight >= scrollHeight) {
                    if (this.showItemsNumber < this.users.length) {
                        setTimeout(() => {
                            this.flag_showLoader = true;
                            setTimeout(() => {
                                this.flag_showLoader = false;
                                this.showItemsNumber = this.showItemsNumber + 10;
                            }, 2500);
                        }, 800);
                    } else {
                        if (this.hasNextPage !== null) {
                            this.flag_showLoader = true;
                            setTimeout(() => {
                               this.getUsers(this.currentPage + 1)
                               this.flag_showLoader = false;
                               this.showItemsNumber = this.showItemsNumber + 5;
                            }, 2500);
                        }
                    }
                }
            },

            away: function() {
                this.flag_closeSearchBox = true;
                $('.search-box-container .slimScrollDiv').fadeOut();
            },

            showSearchBox: function () {
                this.flag_closeSearchBox = false;
                $('.search-box-container .slimScrollDiv').fadeIn();
            }


        }
    }
</script>

<!--multi select for tags style-->
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>