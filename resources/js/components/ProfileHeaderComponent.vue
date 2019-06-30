<template>

    <div>

        <div class="control-block panel-header">



            <div class="control-icon more has-items">

                <div class="cursor-pointer alert-icon" v-bind:class="{'text-teal alert-light': friendRequests.length !== 0}">
                    <i class="fas fa-user-plus fs1-25"></i>
                </div>

                <div v-if="friendRequests.length > 0" class="label-avatar bg-green alerts-count">{{friendRequests.length}}</div>

                <div class="more-dropdown more-with-triangle triangle-top-center" dir="rtl">
                    <div class="ui-block-title ui-block-title-small">
                        <h6 class="title fs0-8">درخواست های دوستی جدید</h6>
                        <span v-if="friendRequests.length > 0" @click="readNotifications('friendRequests')" class="float-left see-all">همه را خواندم</span>
                    </div>

                    <div class="mCustomScrollbar ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="50eac76a-25e9-1ba0-4544-43ce8da59774">
                        <ul class="notification-list" v-if="friendRequests.length > 0">

                            <li v-for="requests in friendRequests" class="with-comment-photo">
                                <div class="author-thumb">
                                    <img :src="requests.sender.path_sm" :alt="requests.sender.family" :title="requests.sender.family">
                                </div>
                                <div class="notification-event">
                                    <div><a :href="'/profile/'+requests.sender.url" class="notification-friend fs0-75">{{requests.sender.family}}</a> برای شما درخواست دوستی ارسال کرد.</div>
                                    <span class="notification-date ml-1"><time class="entry-date updated">{{requests.full_date}}</time></span>
                                </div>


                                <div class="more" @click="readNotifications(requests , 1)">
                                    <svg class="olymp-little-delete"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>

                                <div class="pt-3">
                                <span class="btn btn-sm btn-green" @click="acceptFriendShip(requests.id , requests.sender.family)">پذیرفتن</span>
                                <span class="btn btn-sm btn-danger" @click="refuseFriendShip(requests.id , requests.sender.family)">رد کردن</span>
                                </div>

                            </li>

                        </ul>

                        <ul v-else>
                            <li class="fs0-8">
                                هیچ درخواست دوستی جدیدی وجود ندارد
                            </li>
                        </ul>

                        <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 300px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 148px;"></div></div></div>

                    <a href="/panel/friend-requests" class="view-all bg-teal btn-show-all">نمایش همه درخواست های دوستی</a>
                </div>
            </div>

            <div class="control-icon more has-items">

                <div class="cursor-pointer alert-icon" v-bind:class="{'text-gold alert-light': messages.length !== 0}">
                <i class="fas fa-envelope fs1-25"></i>
                </div>

                <div v-if="messages.length > 0" class="label-avatar bg-primary alerts-count">{{messages.length}}</div>

                <div class="more-dropdown more-with-triangle triangle-top-center" dir="rtl">
                    <div class="ui-block-title ui-block-title-small">
                        <h6 class="title fs0-8">پیام های خوانده نشده</h6>
                        <span v-if="messages.length > 0" @click="readNotifications('messages')" class="float-left see-all">همه را خواندم</span>
                    </div>

                    <div class="mCustomScrollbar ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="50eac76a-25e9-1ba0-4544-43ce8da59774">
                        <ul class="notification-list" v-if="messages.length > 0">

                            <li v-for="message in messages" class="with-comment-photo">
                                <div class="author-thumb">
                                    <img :src="message.sender.path_sm" :alt="message.sender.family" :title="message.sender.family">
                                </div>
                                <div class="notification-event">
                                    <div><a :href="'/profile/'+message.sender.url" class="notification-friend fs0-75">{{message.sender.family}}</a> یک پیام جدید برای شما ارسال کرد.</div>
                                    <span class="notification-date ml-1"><time class="entry-date updated">{{message.full_date}}</time></span>
                                </div>

                                <div class="comment-photo">
                                    <img src="/frontend/img/comment-photo1.jpg" alt="photo">
                                    <div class="fs0-7 p-1 comment-preview" v-html="message.description.substring(0,500)"></div><span>{{message.description.length > 500 ? '...' : ''}}</span>
                                </div>

                                <div class="more" @click="readNotifications(message , 1)">
                                    <svg class="olymp-little-delete"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>
                            </li>

                        </ul>

                        <ul v-else>
                            <li class="fs0-8">
                                هیچ پیام جدیدی وجود ندارد
                            </li>
                        </ul>
                        <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 300px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 148px;"></div></div></div>

                    <a href="/panel/messages" class="view-all bg-gold btn-show-all">نمایش همه پیام ها</a>
                </div>
            </div>

            <div class="control-icon more has-items">
                <div class="cursor-pointer alert-icon" v-bind:class="{'text-tomato alert-light': notifications.length !== 0}">
                    <i class="fas fa-bell fs1-25"></i>
                </div>

                <div v-if="notifications.length > 0" class="label-avatar bg-blue alerts-count">{{notifications.length}}</div>

                <div class="more-dropdown more-with-triangle triangle-top-center" dir="rtl">
                    <div class="ui-block-title ui-block-title-small">
                        <h6 class="title fs0-8">اعلان ها</h6>
                        <span v-if="notifications.length > 0" @click="readNotifications('notifications')" class="float-left see-all">همه را خواندم</span>
                    </div>

                    <div class="mCustomScrollbar ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="50eac76a-25e9-1ba0-4544-43ce8da59774">
                        <ul class="notification-list" v-if="notifications.length > 0">

                            <li v-for="notification in notifications" v-if="notification.commentable_id" class="with-comment-photo">
                                <div class="author-thumb">
                                    <img :src="notification.user.path_sm" :alt="notification.user.family" :title="notification.user.family">
                                </div>
                                <div class="notification-event">
                                    <div v-if="notification.is_answer"><a :href="'/profile/'+notification.user.url" class="notification-friend fs0-75">{{notification.user.family}}</a> یک پاسخ برای نظر شما در <a :href="notification.commentable.category.url+'/posts/'+notification.commentable.category.slug+'/'+notification.commentable.slug" class="mx-1"> پست {{notification.commentable.title}}</a> ارسال کرد.</div>
                                    <div v-else><a :href="'/profile/'+notification.user.url" class="notification-friend fs0-75">{{notification.user.family}}</a> یک نظر تازه برای <a :href="notification.commentable.category.url+'/posts/'+notification.commentable.category.slug+'/'+notification.commentable.slug" class=""> پست {{notification.commentable.title}}</a> شما ارسال کرد.</div>
                                    <span class="notification-date ml-1"><time class="entry-date updated">{{notification.full_date}}</time></span>
                                </div>
                                <span class="notification-icon">
										<svg class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
									</span>

                                <div class="comment-photo">
                                    <img src="/frontend/img/comment-photo1.jpg" alt="photo">
                                    <div class="fs0-7 p-1 comment-preview" v-html="notification.description.substring(0,200)"></div><span>{{notification.description.length > 200 ? '...' : ''}}</span>
                                </div>

                                <div class="more" @click="readNotifications(notification , 1)">
                                    <svg class="olymp-little-delete"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>
                            </li>

                            <li v-else-if="notification.mentionable_id" class="with-comment-photo">
                                <div class="author-thumb">
                                    <img :src="notification.mentionable.user.path_sm" :alt="notification.mentionable.user.family" :title="notification.mentionable.user.family">
                                </div>
                                <div class="notification-event">
                                    <div v-if="notification.mentionable_type === 'App\\Post'"><a :href="'/profile/'+notification.mentionable.user.url" class="notification-friend fs0-75">{{notification.mentionable.user.family}}</a> شما را در <a :href="notification.mentionable.category.url+'/posts/'+notification.mentionable.category.slug+'/'+notification.mentionable.slug" class="notification-link mx-1">پست {{notification.mentionable.title}}</a>خود تگ کرد.</div>
                                    <div v-if="notification.mentionable_type === 'App\\Comment'"><a :href="'/profile/'+notification.mentionable.user.url" class="notification-friend fs0-75">{{notification.mentionable.user.family}}</a> شما را در یک نظر در <a :href="notification.mentionable.commentable.category.url+'/posts/'+notification.mentionable.commentable.category.slug+'/'+notification.mentionable.commentable.slug" class="notification-link mx-1">پست {{notification.mentionable.commentable.title}}</a>تگ کرد.</div>
                                    <span class="notification-date"><time class="entry-date updated">{{notification.full_date}}</time></span>
                                </div>
                                <span class="notification-icon">
										<i class="fas fa-tag ml-1"></i>
									</span>

                                <div class="more" @click="readNotifications(notification , 1)">
                                    <svg class="olymp-little-delete"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>
                            </li>

                            <li v-else-if="notification.accepted" class="with-comment-photo">
                                <div class="author-thumb">
                                    <img :src="notification.receiver.path_sm" :alt="notification.receiver.family" :title="notification.receiver.family">
                                </div>
                                <div class="notification-event">
                                    <div><a :href="'/profile/'+notification.receiver.url" class="notification-friend fs0-75">{{notification.receiver.family}}</a> درخواست دوستی شما را پذیرفت.</div>
                                    <span class="notification-date"><time class="entry-date updated">{{notification.full_date_accept}}</time></span>
                                </div>
                                <span class="notification-icon">
										<i class="fas fa-check-circle ml-1"></i>
									</span>

                                <div class="more" @click="readNotifications(notification , 1)">
                                    <svg class="olymp-little-delete"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                </div>
                            </li>
                        </ul>

                        <ul v-else>
                            <li class="fs0-8">
                                هیچ اعلانی وجود ندارد
                            </li>
                        </ul>
                        <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 300px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 148px;"></div></div></div>

                    <a href="/panel/notifications" class="view-all bg-tomato btn-show-all">نمایش همه اعلان ها</a>
                </div>
            </div>



            <div class="author-page author vcard inline-items more" dir="rtl">
                <div class="author-thumb">
                    <img alt="author" :src="user.path_sm" class="avatar img-login-header">
                    <span class="icon-status online"></span>
                    <div class="more-dropdown more-with-triangle">
                        <div class="mCustomScrollbar ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="3ea55468-58d4-7ec0-afd2-e0b909ebe4bf">


                            <ul class="account-settings account-preview">
                                <li>
                                    <a href="/panel">

                                        <i class="fas fa-user fs1 text-grey-custom ml-2"></i>

                                        <a href="/panel">پروفایل</a>
                                    </a>
                                </li>
                                <li>
                                    <a href="/panel/friends">

                                        <i class="fas fa-bookmark fs1 text-grey-custom ml-2"></i>
                                        <span>دوستان من</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/panel/bookmarks">

                                        <i class="fas fa-bookmark fs1 text-grey-custom ml-2"></i>
                                        <span>صفحات نشان شده</span>
                                    </a>
                                </li>
                                <li>
                                    <h6 class="cursor-pointer fs0-8 mt-3" @click="logout()">

                                        <i class="fas fa-sign-out-alt fs1 text-red ml-2 icon-logout"></i>
                                        <span>خروج</span>
                                    </h6>
                                </li>
                            </ul>


                            <div class="ui-block-title ui-block-title-small">
                                <span class="fs0-7">وضعیت فعلی شما</span>
                            </div>

                            <form class="form-group with-button custom-status">
                                <input class="form-control fs0-7" placeholder="" type="text" v-model="userStatusNow">

                                <button type="button" class="bg-purple" @click="changeStatusNow()">
                                    <svg class="olymp-check-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-check-icon"></use></svg>
                                </button>
                                <span class="material-input"></span></form>


                            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 614px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 540px;"></div></div></div>

                    </div>
                </div>
                <a href="02-ProfilePage.html" class="author-name fn">
                    <div class="author-title text-dark-light fw-400">
                        {{user.family}} <svg class="olymp-dropdown-arrow-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                    </div>
                    <span class="author-subtitle mt-1 fs0-6">{{latestUserStatusNow}}</span>
                </a>
            </div>

        </div>

    </div>
</template>

<script>




    import Vue from 'vue';

    /*loader*/
    import {AtomSpinner} from 'epic-spinners'

    /*click outside element*/
    import { mixin as clickaway } from 'vue-clickaway';




    export default {
        data(){
            return{
                notifications: [],
                messages: [],
                friendRequests: [],
                userStatusNow: '',
                latestUserStatusNow: ''
            }
        },
        components: {
            AtomSpinner
        },
        mixins: [ clickaway ],
        props: [
            'user'
        ],

        watch : {

        },

        mounted() {
            this.initNotifications();
            this.userStatusNow = this.user.status_now;
            this.latestUserStatusNow = this.user.status_now;
        },

        methods: {

            initNotifications: function () {
                axios.get('/api/notifications/init').then(res => {
                    this.notifications = res.data.notifications;
                    this.messages = res.data.messages;
                    this.friendRequests = res.data.friendRequests;
                }).catch(err => {
                    console.log(err);
                })
            },

            readNotifications: function (notifications, items = null) {
                axios.post('/api/notifications/read', {'notifications': notifications, 'items': items}).then(res => {
                    this.initNotifications();
                }).catch(err => {
                    console.log(err);
                })
            },

            acceptFriendShip: function (requestId , friendFamily) {
                axios.post('/api/profile/acceptFriendShip', {'requestId': requestId}).then(res => {
                    this.initNotifications();
                    this.$notify({
                        group: 'profile-header',
                        type: 'success',
                        duration: 20000,
                        text: friendFamily+' به لیست دوستان شما اضافه شد'
                    });
                    }).catch(err => {
                        console.log(err);
                    })
            },

            refuseFriendShip: function (requestId , friendFamily) {
                axios.post('/api/friends/cancelFriendShip', {'friendShipId': requestId}).then(res => {
                    this.initNotifications();
                    this.$notify({
                        group: 'profile-header',
                        type: 'error',
                        duration: 20000,
                        text: 'درخواست دوستی' + ' ' +friendFamily+ ' ' + 'رد شد'
                    });
                }).catch(err => {
                    console.log(err);
                })
            },

            changeStatusNow: function () {
                axios.post('/api/status/change', {'status_now': this.userStatusNow}).then(res => {
                    this.initNotifications();
                    this.latestUserStatusNow = this.userStatusNow;
                    this.$notify({
                        group: 'profile-header',
                        type: 'success',
                        duration: 20000,
                        text: 'وضعیت فعلی شما با موفقیت تغییر کرد'
                    });
                }).catch(err => {
                    console.log(err);
                })
            },

            logout:function(){
                axios.post('logout').then(response => {
                    if (response.status === 302 || 401) {
                        window.location.reload();
                    }
                    else {
                        // throw error and go to catch block
                    }
                }).catch(error => {

                });
            },
        }
    }
</script>
