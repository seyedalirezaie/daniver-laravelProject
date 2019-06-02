<template>

    <div>

        <div v-if="type !== 'panel'" class="ui-block-title text-right pr-1 pl-2">
            <div class="badge badge-success p-2" dir="rtl">
                <span>{{friendsCount}}
                </span>
                <span>نفر</span>
            </div>
            <h6 class="title fs0-8 pr-2">دوستان {{profile_user.family}}</h6>

        </div>

        <div class="ui-block search-box-container">
            <div class="ui-block-title" dir="rtl">
                <div class="form-group with-button is-empty">
                    <input v-model="v_searchQuery" class="form-control input-search-posts" type="text" placeholder="جستجو...">
                    <span class="material-input"></span></div>
            </div>

            <!-- W-Friend-Pages-Added -->
            <div v-show="flag_showLoader" class="inline-items loader-container py-2 bg-white">
                <div class="looping-rhombuses-spinner"> <div class="rhombus"></div> <div class="rhombus"></div> <div class="rhombus"></div> </div>
            </div>
            <ul @scroll="onScrollFriends" class="widget w-friend-pages-added notification-list friend-requests search-users-header" style="overflow-y: auto; max-height: 600px!important;">
                <li v-for="(userFriend , index) in listFriends" v-if="index < showItemsNumber" class="inline-items">
                    <a :href="'/profile/'+userFriend.url" target="_blank" class="author-thumb">
                        <img class="img-search-hearder" v-if="userFriend.photo !== null" :src="'/images/sm/'+userFriend.photo.path" :alt="userFriend.family" :title="userFriend.family">
                        <img class="img-search-hearder" v-else-if="userFriend.gender === null" :src="avatars['user_avatar_unknown']" :alt="userFriend.family" :title="userFriend.family">
                        <img class="img-search-hearder" v-else-if="userFriend.gender === 1" :src="avatars['user_avatar_male']" :alt="userFriend.family" :title="userFriend.family">
                        <img class="img-search-hearder" v-else-if="userFriend.gender === 0" :src="avatars['user_avatar_female']" :alt="userFriend.family" :title="userFriend.family">
                    </a>
                    <a :href="'/profile/'+userFriend.url" target="_blank" class="notification-event">
                        <a :href="'/profile/'+userFriend.url" target="_blank" class="h6 notification-friend">{{userFriend.family}}</a>
                        <span v-if="userFriend.alias_original !== null" href="#" class="fs0-75 text-grey"> ({{userFriend.alias_original}}) </span>
                        <span v-for="major in userFriend.categories" v-if="major.sort==='major' && major.pivot.status===1" class="chat-message-item d-block">{{major.titles}} / {{major.pivot.year}}</span>
                        <span v-for="major in userFriend.categories" v-if="major.sort==='major' && major.pivot.status===2" class="chat-message-item d-block">{{major.titles}} / {{major.pivot.year}}</span>
                    </a>

                    <span @click="cancelFriendShip(userFriend.pivot.id)" v-if="type === 'panel'" class="btn btn-sm btn-primary float-left btn-cancel-friendship">لغو دوستی</span>

                </li>

            </ul>



            <!-- .. end W-Friend-Pages-Added -->
        </div>

    </div>
</template>

<script>
    import Vue from 'vue';

    /*loader*/
    import {AtomSpinner} from 'epic-spinners'


    export default {
        data(){
            return{
                showItemsNumber: 50,
                flag_showLoader: false,
                v_searchQuery: '',
                flag_doSearch: null,
                listFriends: [],
                friendsCount: ''
            }
        },
        components: {
            AtomSpinner
        },
        props: [
            'profile_user' , 'type' , 'avatars'
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
                    this.getUsers();
                },1500);

                this.flag_showLoader = true;
            },
        },

        mounted() {
            this.getUsers();
        },

        methods: {

            /*customLabel ({ title, desc }) {
                return `${title} – ${desc}`
            },*/

            getUsers:function(){

                    axios.get('/api/getFriends/' + this.profile_user.id + '/' + this.v_searchQuery.trim()).then(res => {
                        this.listFriends = [];
                        this.listFriends = res.data.users;
                        this.friendsCount = res.data.friends_count;
                        /*for (var i = 0; i < this.listFriends.length; i++) {
                            this.friends.push(this.listFriends[i])
                        }*/
                        this.flag_showLoader = false;
                    }).catch(err => {
                        console.log(err);
                    })

            },

            onScrollFriends ({ target: { scrollTop, clientHeight, scrollHeight }}) {
                if (scrollTop + clientHeight >= scrollHeight) {
                    if (this.showItemsNumber < this.listFriends.length) {
                        setTimeout(() => {
                            this.flag_showLoader = true;
                            setTimeout(() => {
                                this.flag_showLoader = false;
                                this.showItemsNumber = this.showItemsNumber + 50;
                            }, 2500);
                        }, 800);
                    }
                }
            },

            cancelFriendShip:function (friendShipId) {
                axios.post('/api/friends/cancelFriendShip' , {'friendShipId':friendShipId}).then(res => {
                    this.getUsers();
                    this.$notify({
                        group: 'alert-panel',
                        type: 'success',
                        duration: 20000,
                        text: 'دوستی با موفقیت لغو شد'
                    })
                }).catch(err => {
                    console.log(err);
                })
            }



        }
    }
</script>