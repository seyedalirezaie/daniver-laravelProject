<template xmlns:v-clipboard="http://www.w3.org/1999/xhtml">

    <div>

        <div class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


                <div class="ui-block">
                    <div class="top-header">
                        <div class="top-header-thumb">
                            <img v-if="profile_user.header.length !== 0" :src="'/images/lg/'+profile_user.header[0].path" alt="nature">
                            <img v-else :src="avatars['user_header']" alt="nature">

                            <div class="right-info-author">
                                <span v-if="profile_user.alias_original !== null && profile_user.alias_original !== ''" class="d-block ml-2">نام مستعار: {{profile_user.alias_original}}</span>
                                <div class="country ml-2">آخرین بازدید :  {{profile_user.lastseen}}</div>
                            </div>
                        </div>
                        <div class="profile-section">
                            <div class="row justify-content-center">
                                <div class="col col-lg-5 col-md-5 col-sm-12 col-12">
                                    <ul class="profile-menu">
                                        <li>
                                            <router-link v-bind:class="{'active': flag_tabs['posts']}" :to="{name:'profile' , params:{user:profile_user.url , section:'posts'}}">
                                            پست ها
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link v-bind:class="{'active': flag_tabs['actions']}" :to="{name:'profile' , params:{user:profile_user.url , section:'actions'}}">
                                            فعالیت ها
                                            </router-link>
                                        </li>
                                        <li>
                                            <router-link v-bind:class="{'active': flag_tabs['information']}" :to="{name:'profile' , params:{user:profile_user.url , section:'information'}}">
                                             مشخصات
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div v-if="auth_user.id !== profile_user.id" class="control-block-button">
                                <div class="btn btn-control bg-blue more" data-toggle="modal" data-target="#modal-message">
                                    <i class="fas fa-envelope text-white"></i>
                                    <ul class="more-dropdown more-with-triangle triangle-bottom-right bg-white">
                                        <li>
                                            <span class="text-grey">ارسال پیام</span>
                                        </li>
                                    </ul>
                                </div>

                                <div v-if="auth_user.id !== profile_user.id" class="btn btn-control bg-primary more" data-toggle="modal" data-target="#edit-widget-pool">
                                    <i class="fas fa-user text-white"></i>

                                    <ul class="more-dropdown more-with-triangle triangle-bottom-right bg-white">
                                        <li>
                                           <span class="text-grey">ارسال درخواست دوستی</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="top-header-author profile-header-info">
                            <a href="02-ProfilePage.html" class="author-thumb">
                                <img :src="profile_user.path_md" :alt="profile_user.family" :title="profile_user.family">
                            </a>
                            <div class="author-content">
                                <span class="author-name user-profile-name fs1-1">{{profile_user.family}}</span>
                                <div v-if="profile_user.status_now !== null && profile_user.status_now !== ''" class="country profile-status-now">وضعیت فعلی |  {{profile_user.status_now}}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Window-popup Edit Widget Pool -->

            <div v-if="auth_user.id !== profile_user.id" dir="rtl" class="modal fade" id="edit-widget-pool" tabindex="-1" role="dialog" aria-labelledby="edit-widget-pool" aria-hidden="true">
                <div class="modal-dialog window-popup edit-widget edit-widget-pool" role="document">
                    <div class="modal-content">
                        <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                            <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                        </a>

                        <div class="modal-header">
                            <h6 class="title">درخواست دوستی</h6>
                        </div>

                        <div class="modal-body">

                            <div class="row" v-if="!flag_isFriend && friendship_status === 'noFriend'">

                                <span class="p-5">آیا مایل به ارسال درخواست دوستی به {{profile_user.family}} هستید؟</span>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <a data-dismiss="modal" aria-label="Close" href="#" class="btn btn-sm btn-green full-width" @click="sendFriendRequest(profile_user.id)">بله</a>
                                </div>
                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <a data-dismiss="modal" aria-label="Close" href="#" class="btn btn-sm btn-secondary full-width">خیر</a>
                                </div>
                            </div>

                            <div class="row" v-if="!flag_isFriend && friendship_status === 'notAuth'">

                                <span class="p-5">برای ارسال درخواست دوستی لازم است به پروفایل خود وارد شوید یا ثبت نام کنید</span>

                                <div class="container-fluid mt-3">
                                    <div class="row">
                                        <div class="col col-lg-4 col-sm-12 col-12">
                                            <span data-dismiss="modal" aria-label="Close" class="btn btn-sm bg-secondary full-width">لغو</span>
                                        </div>

                                        <div class="col col-lg-4 col-sm-12 col-12">
                                            <a href="/register" class="btn btn-sm btn-blue full-width">ثبت نام</a>
                                        </div>

                                        <div class="col col-lg-4 col-sm-12 col-12">
                                            <a href="/login" class="btn btn-sm btn-green full-width">ورود</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="flag_isFriend && friendship_status.accepted === 1">

                                <span class="p-4 text-red">نمی توانید درخواست دوستی ارسال کنید!</span>
                                <span class="p-4 mb-2">شما و {{profile_user.family}} در حال حاضر دوست هستید. اگر تمایل دارید می توانید این دوستی را لغو کنید</span>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm bg-secondary full-width">بستن پنجره</span>
                                </div>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-green full-width" @click="cancelFriendShip(friendship_status.id)">لغو دوستی</span>
                                </div>
                            </div>
                            <div class="row" v-if="flag_isFriend && friendship_status.accepted === 0 && friendship_status.receiver_id === profile_user.id">

                                <span class="p-4 text-red">نمی توانید درخواست دوستی ارسال کنید!</span>
                                <span class="p-4 mb-2">{{profile_user.family}} هنوز به درخواست دوستی شما پاسخ نداده است. با این حال می توانید درخواست دوستی قبلی خود را لغو کنید.</span>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm bg-secondary full-width">بستن پنجره</span>
                                </div>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-primary full-width" @click="cancelFriendShip(friendship_status.id)">لغو درخواست دوستی</span>
                                </div>
                            </div>
                            <div class="row" v-if="flag_isFriend && friendship_status.accepted === 0 && friendship_status.sender_id === profile_user.id">

                                <span class="p-4 text-red">نمی توانید درخواست دوستی ارسال کنید!</span>
                                <span class="p-4 mb-2">شما هنوز به درخواست دوستی {{profile_user.family}} پاسخ نداده اید.</span>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary full-width" @click="cancelFriendShip(friendship_status.id)">رد درخواست دوستی</span>
                                </div>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-green full-width" @click="acceptFriendRequest(friendship_status.id)">پذیرفتن درخواست دوستی</span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!-- ... end Window-popup Edit Widget Pool -->



            <div v-if="auth_user.id !== profile_user.id" dir="rtl" class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
                <div class="modal-dialog window-popup edit-widget edit-widget-pool" role="document">
                    <div class="modal-content">
                        <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                            <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                        </a>

                        <div class="modal-header">
                            <h6 class="title">ارسال پیام</h6>
                        </div>

                        <div v-if="auth_user.id" class="modal-body">


                                <span class="p-4">ارسال پیام به {{profile_user.family}}</span>

                                <div class="p-4 mb-2 form-group w-100">
                                    <textarea v-model="v_message" class="form-control full-width">

                                    </textarea>
                                </div>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm bg-secondary full-width">لغو</span>
                                </div>

                                <div class="col col-lg-6 col-sm-12 col-12">
                                    <span data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-green full-width" @click="sendMessage(profile_user.id)">ارسال پیام</span>
                                </div>

                        </div>

                        <div v-else class="modal-body">

                            <span>برای ارسال پیام لازم است به حساب کاربری خود وارد شوید یا ثبت نام کنید</span>

                            <div class="container-fluid mt-5">
                                <div class="row">
                                    <div class="col col-lg-4 col-sm-12 col-12">
                                         <span data-dismiss="modal" aria-label="Close" class="btn btn-sm bg-secondary full-width">لغو</span>
                                    </div>

                                    <div class="col col-lg-4 col-sm-12 col-12">
                                        <a href="/register" class="btn btn-sm btn-blue full-width">ثبت نام</a>
                                    </div>

                                    <div class="col col-lg-4 col-sm-12 col-12">
                                        <a href="/login" class="btn btn-sm btn-green full-width">ورود</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




        </div>

        <div v-if="flag_tabs['posts']" class="row">

            <div class="col col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 order-xl-1 order-lg-1 order-2 pl-0">

                <div class="container profile-posts">
                    <div class="row justify-content-start" dir="rtl">
                        <div v-for="(post , index) in posts" v-if="index < postItems" class="col col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="ui-block">


                                <!-- Post -->

                                <article class="hentry blog-post multiple-posts-profile">

                                    <a target="_blank" v-if="post.category.sort === 'major'" :href="'/study/posts/'+post.category.slug+'/'+post.slug">
                                    <div class="post-thumb">
                                        <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                        <img v-else width="163" height="163" :src="post_avatar" :alt="post.title" :title="post.title">

                                        <span class="post-category bg-blue-light fs0-7">درس و بحث
                                            <span class="sub-category">
                                                <span class="bg-primary">{{post.category.titles}}</span>
                                                <span v-if="post.is_guest === 1" class="bg-danger">مهمان</span>
                                            </span>
                                        </span>
                                    </div>
                                    </a>
                                    <a v-if="post.category.sort === 'dorm'" :href="'/dormitory/posts/'+post.category.slug+'/'+post.slug">
                                        <div class="post-thumb">
                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                            <img v-else width="163" height="163" :src="post_avatar" :alt="post.title" :title="post.title">

                                            <span class="post-category fs0-7 bg-primary">خوابگاه ها

                                            <span class="sub-category">
                                                <span class="bg-blue">{{post.category.title}}</span>
                                                <span v-if="post.is_guest === 1" class="bg-danger">مهمان</span>
                                            </span>
                                            </span>
                                        </div>
                                    </a>
                                    <a v-if="post.category.sort === 'mate'" :href="'/classmates/posts/'+post.category.slug+'/'+post.slug">
                                        <div class="post-thumb">
                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                            <img v-else width="163" height="163" :src="post_avatar" :alt="post.title" :title="post.title">

                                            <span class="post-category fs0-7 bg-green">هم کلاسی ها

                                                <span class="sub-category">
                                                <span class="bg-blue">{{post.category.title}}</span>
                                                <span v-if="post.is_guest === 1" class="bg-danger">مهمان</span>
                                            </span>

                                            </span>
                                        </div>
                                    </a>

                                    <a v-if="post.category.sort === 'blog'" :href="'/blog/'+post.category.slug+'/'+post.slug">
                                        <div class="post-thumb">
                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[post.photos.length - 1].path" :alt="post.title" :title="post.title">
                                            <img v-else width="163" height="163" :src="avatars['post_profile']" :alt="post.title" :title="post.title">

                                            <span class="post-category fs0-7 bg-green">وبلاگ
                                            <span class="sub-category bg-blue">{{post.category.title}}</span>
                                            </span>
                                        </div>
                                    </a>

                                    <div class="post-content">

                                        <a :href="'/study/posts/'+post.category.slug+'/'+post.slug" class="h6 post-title">{{post.title}}</a>

                                        <div class="author-date">
                                            <div class="post__date">
                                                <time class="published  bg-grey-small rounded p-1" datetime="2017-03-24T18:18">
                                                    {{post.date}}
                                                </time>
                                            </div>
                                        </div>

                                        <div class="post-additional-info inline-items">

                                            <div class="comments-shared">
                                                <a href="#" class="post-add-icon inline-items">
                                                    <i class="far fa-comments fs1-3"></i>
                                                    <span>{{post.comments_count}}</span>
                                                </a>
                                            </div>

                                            <div class="comments-shared">
                                                <a href="#" class="post-add-icon inline-items">
                                                    <i class="far fa-heart fs1-3"></i>
                                                    <span>{{post.likes_count}}</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                </article>

                                <!-- ... end Post -->
                            </div>
                        </div>
                        <div v-if="flag_hasMore" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 order-3 text-center p-2">
                            <div v-on:click="showMorePosts()" class="btn btn-lg btn-green p-2 btn-more-posts">بیشتر

                                <span class="fs0-85 mr-3">(باقی مانده : {{posts.length - postItems}})</span>

                                <div class="inline-items loader-container py-2 posts-loader">
                                    <div v-show="flag_loader" class="spring-spinner">
                                        <div class="spring-spinner-part top">
                                            <div class="spring-spinner-rotator"></div>
                                        </div>
                                        <div class="spring-spinner-part bottom">
                                            <div class="spring-spinner-rotator"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 order-xl-2 order-lg-2 order-1">

                <div class="ui-block">

                    <div class="ui-block-title text-right pr-2">
                        <h6 class="title">در یک هفته گذشته</h6>
                    </div>


                    <!-- W-Activity-Feed -->

                    <ul class="widget w-activity-feed notification-list">
                        <li v-for="action in sorted_actions" v-if="action.mentionable_id">
                            <div class="author-thumb float-right">
                                <img :src="action.mentionable.user.path_sm" alt="author">
                            </div>
                            <div class="notification-event pr-1 pl-0" dir="rtl">
                                <a v-if="action.mentionable.user.alias" class="h6 notification-friend" :href="'/profile/'+action.mentionable.user.alias"> {{action.mentionable.user.family}} </a>
                                <a v-else :href="'/profile/'+action.mentionable.user.id" class="h6 notification-friend"> {{action.mentionable.user.family}} </a>
                                 در پست
                                <a :href="'/'+action.mentionable.category.url+'/posts/'+action.mentionable.category.slug+'/'+action.mentionable.slug" class="notification-link">{{action.mentionable.title}} </a>

                                <span v-if="action.mentionable.user.alias">
                                    <span v-if="action.mentionable.user.alias === profile_user.alias">
                                    خودش را تگ کرد
                                    </span>
                                    <span v-else>
                                        {{profile_user.family}} را تگ کرد
                                    </span>
                                </span>
                                <span v-else>
                                    <span v-if="action.mentionable.user.id === profile_user.id">
                                    خودش را تگ کرد
                                    </span>
                                    <span v-else>
                                        {{profile_user.family}} را تگ کرد
                                    </span>
                                </span>
                                <span class="notification-date"><time class="entry-date updated bg-grey-small p-1 rounded fs0-7">{{action.date}}</time></span>
                            </div>
                        </li>

                        <li v-else-if="action.commentable_id">
                            <div class="author-thumb float-right">
                                <img class="post-avatar-preview" v-if="action.commentable.photos.length > 0" :src="'/images/sm/'+action.commentable.photos[0].path" :alt="action.commentable.title" :title="action.commentable.title">
                                <img class="post-avatar-preview" v-else :src="post_avatar" :alt="action.commentable.title" :title="action.commentable.title">
                            </div>
                            <div class="notification-event pr-1 pl-0" dir="rtl">
                                <span>{{profile_user.family}}</span>
                                <span v-if="action.parent_id === null">برای پست</span>
                                <span v-else>به نظر</span>
                                <a v-if="action.parent_id === null" :href="'/'+action.commentable.category.url+'/posts/'+action.commentable.category.slug+'/'+action.commentable.slug" class="notification-link">{{action.commentable.title}} </a>
                                <span v-if="action.parent_id === null"> نوشته </span>
                                <a v-if="action.commentable.user.alias" class="h6 notification-friend" :href="'/profile/'+action.commentable.user.alias">
                                    <span v-if="action.commentable.user.alias === profile_user.alias">خودش</span>
                                    <span v-else>{{action.commentable.user.family}}</span>
                                </a>
                                <a v-else :href="'/profile/'+action.commentable.user.id" class="h6 notification-friend">
                                    <span v-if="action.commentable.user.id === profile_user.id">خودش</span>
                                    <span v-else>{{action.commentable.user.family}}</span>
                                </a>
                                <span v-if="action.parent_id === null">نظر ارسال کرد.</span>
                                <div v-else>
                                    <span>در پست</span>
                                    <a :href="'/'+action.commentable.category.url+'/posts/'+action.commentable.category.slug+'/'+action.commentable.slug">{{action.commentable.title}}</a>
                                    پاسخ داد.</div>


                                <span class="notification-date"><time class="entry-date updated bg-grey-small p-1 rounded fs0-7">{{action.date}}</time></span>
                            </div>
                        </li>

                        <li v-if="sorted_actions.length === 0">
                            بدون فعالیت
                        </li>

                    </ul>

                    <!-- .. end W-Activity-Feed -->
                </div>

            </div>
        </div>

        <div v-if="flag_tabs['actions']" class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="col col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 order-xl-1 order-lg-1 order-2 float-left">

                    <div class="row">
                        <div class="col-12 bg-white rounded pb-5">

                            <div class="p-5">
                            <span class="fs0-9">زمان باقی مانده تا روز تولد </span>
                            <span class="text-primary fs0-9">
                                {{profile_user.family}}
                            </span>
                            </div>

                            <flip-countdown v-if="profile_user.birthday !== null && profile_user.birthday !== ''" class="flip-timer" :deadline="birthday"
                                            :labels="timerLabels"
                            ></flip-countdown>
                            <span v-else>
                                نامشخص
                            </span>
                        </div>
                    </div>



                        <div class="row py-3" dir="rtl">

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12 pr-0">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
                                    تمام پست های ارسالی
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{profile_user.posts_count}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
									پست های درسی
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{profile_user.study_posts_count}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
									پست های «هم کلاسی ها»
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{profile_user.mates_posts_count}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12 pl-0">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
									پست های خوابگاهی
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{profile_user.dorm_posts_count}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>



                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12 pr-0">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
                                    نظرات ارسالی
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{profile_user.comments_count}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
									نظرات دریافتی
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{received_comments}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
									لایک های گرفته شده
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{received_likes}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12 pl-0">
                                <div class="ui-block stat-block">
                                    <div class="ui-block-content">
                                        <ul class="statistics-list-count">
                                            <li>
                                                <div class="points">
								<span>
									لایک های داده شده
								</span>
                                                </div>
                                                <div class="count-stat text-center">{{profile_user.likes_count}}
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>



                        </div>





                </div>

                <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-xl-2 order-lg-2 order-1 pr-0">

                    <div class="ui-block friends-container">

                        <friends-list-component :user_avatar="user_avatar" :profile_user="profile_user" :avatars="avatars" :type="profile"></friends-list-component>

                        <!-- W-Activity-Feed -->


                        <!-- .. end W-Activity-Feed -->
                    </div>

                </div>

            </div>
        </div>

        <div v-if="flag_tabs['gallery']" class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                gallery
            </div>
        </div>

        <!------------------------------------info tab content---------------------------------------------->

        <div v-if="flag_tabs['information']" class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-fluid">
                    <div class="row" dir="rtl">
                        <div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12 pl-0">
                            <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">علاقه مندی و مهارت ها</h6>
                                </div>
                                <div class="ui-block-content">
                                    <div class="row">
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                            <!-- W-Personal-Info -->

                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span class="title">موسیقی، آهنگ و خواننده مورد علاقه:</span>
                                                    <span v-html="profile_user.favorites_music" class="text">
														</span>
                                                </li>
                                                <li>
                                                    <span class="title">فیلم سینمایی و سریال مورد علاقه:</span>
                                                    <span v-html="profile_user.favorites_movie" class="text"></span>
                                                </li>
                                                <li>
                                                    <span class="title">مهارت های فنی، هنری، علمی و ...:</span>
                                                    <span v-html="profile_user.skills" class="text"></span>
                                                </li>
                                            </ul>

                                            <!-- ... end W-Personal-Info -->
                                        </div>
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                            <!-- W-Personal-Info -->

                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span class="title">کتاب های مورد علاقه:</span>
                                                    <span v-html="profile_user.favorites_book" class="text"></span>
                                                </li>
                                                <li>
                                                    <span class="title">سایر علایق:</span>
                                                    <span v-html="profile_user.favorites" class="text"></span>
                                                </li>
                                                <li>
                                                    <span class="title">رزومه، سوابق، شغل و ...:</span>
                                                    <span v-html="profile_user.cv" class="text"></span>
                                                </li>
                                            </ul>

                                            <!-- ... end W-Personal-Info -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">اطلاعات دانشجویی</h6>
                                </div>
                                <div class="ui-block-content">
                                    <div class="row">
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                            <!-- W-Personal-Info -->

                                            <ul class="widget w-personal-info item-block">
                                                <li v-for="major in profile_user.categories" v-if="major.sort === 'major' && major.pivot.status === 1">
                                                    <span class="title">رشته تحصیلی کنونی در دانشگاه ولی عصر</span>
                                                    <span class="text">{{major.titles}}</span>
                                                    <span class="date text-dark-light">ورودی {{major.pivot.year}}</span>
                                                </li>
                                                <li v-for="major in profile_user.categories" v-if="major.sort === 'major' && major.pivot.status === 2">
                                                    <span class="title">رشته فارغ التحصیلی از دانشگاه ولی عصر</span>
                                                    <span class="text">{{major.titles}}</span>
                                                    <span class="date text-dark-light">ورودی {{major.pivot.year}}</span>
                                                </li>
                                                <li v-for="otherMajor in profile_user.othermajors" v-if="otherMajor.status === 1">
                                                    <span class="title">رشته تحصیلی کنونی در سایر دانشگاه ها</span>
                                                    <span class="text">{{otherMajor.title}}</span>
                                                </li>
                                                <li v-for="otherMajor in profile_user.othermajors" v-if="otherMajor.status === 2">
                                                    <span class="title">رشته فارغ التحصیلی از سایر دانشگاه ها</span>
                                                    <span class="text">{{otherMajor.title}}</span>
                                                </li>
                                            </ul>

                                            <!-- ... end W-Personal-Info -->

                                        </div>
                                        <div class="col col-lg-6 col-md-6 col-sm-12 col-12">


                                            <!-- W-Personal-Info -->

                                            <ul class="widget w-personal-info item-block">
                                                <li>
                                                    <span v-for="major in profile_user.categories" v-if="major.sort === 'major' && major.pivot.status === 1" class="title">محل سکونت دانشجویی</span>
                                                    <span v-if="profile_user.location === 'rafsanjan'" class="text">با خانواده(در رفسنجان)</span>
                                                    <span v-if="profile_user.location === 'dorm-vru'" class="text">خوابگاه دانشجویی دانشگاه</span>
                                                    <span v-if="profile_user.location === 'dorm-other'" class="text">خوابگاه دانشجویی دیگر(غیر از خوابگاه های دانشگاه)</span>
                                                    <span v-if="profile_user.location === 'home-dorm'" class="text">خانه دانشجویی</span>
                                                    <span v-for="dorm in profile_user.categories" v-if="profile_user.location === 'dorm-vru' && dorm.sort === 'dorm'" class="date text-dark-light">{{dorm.titles}}</span>
                                                </li>

                                            </ul>

                                            <!-- ... end W-Personal-Info -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 order-md-2 col-sm-12 col-12 pr-0">
                            <div class="ui-block">
                                <div class="ui-block-title">
                                    <h6 class="title">اطلاعات شخصی</h6>
                                </div>
                                <div class="ui-block-content">


                                    <!-- W-Personal-Info -->

                                    <ul class="widget w-personal-info user-info">
                                        <li>
                                            <span class="title">درباره من:</span>
                                            <span v-if="profile_user.description !== null && profile_user.description !== ''" v-html="profile_user.description" class="text"></span>
                                            <span v-else class="text">-</span>
                                        </li>
                                        <li>
                                            <span class="title">تولد:</span>
                                            <span v-if="profile_user.birthday === null && profile_user.birthday === ''" class="text">نامشخص</span>
                                            <span v-else class="text">{{profile_user.birthday_jalali}}</span>
                                        </li>
                                        <li>
                                            <span class="title">محل تولد:</span>
                                            <span class="text" v-for="birthPlace in profile_user.places" v-if="profile_user.places.length > 0 && birthPlace.type === 'birth' && birthPlace.country === null">{{birthPlace.province.title}}  -  {{birthPlace.city.title}} - {{birthPlace.subcity.title}}</span>
                                            <span class="text" v-for="birthPlace in profile_user.places" v-if="profile_user.places.length > 0 && birthPlace.type === 'birth' && birthPlace.country !== null">{{birthPlace.country}}</span>
                                        </li>
                                        <li>
                                            <span class="title">محل زندگی:</span>
                                            <span class="text" v-for="birthPlace in profile_user.places" v-if="profile_user.places.length > 0 && birthPlace.type === 'live' && birthPlace.country === null">{{birthPlace.province.title}}  -  {{birthPlace.city.title}} - {{birthPlace.subcity.title}}</span>
                                            <span class="text" v-for="birthPlace in profile_user.places" v-if="profile_user.places.length > 0 && birthPlace.type === 'live' && birthPlace.country !== null">{{birthPlace.country}}</span>
                                        </li>
                                        <li>
                                            <span class="title">تاریخ عضویت:</span>
                                            <span class="text">{{profile_user.created_at}}</span>
                                        </li>
                                        <li>
                                            <span class="title">جنسیت:</span>
                                            <span v-if="profile_user.gender === 1" class="text">مرد</span>
                                            <span v-if="profile_user.gender === 0" class="text">زن</span>
                                            <span v-if="profile_user.gender === null || profile_user.gender === ''" class="text">نامشخص</span>
                                        </li>

                                        <li v-for="setting in profile_user.settings" v-if="setting.title === 'no-phone' && profile_user.phone !== null && profile_user.phone !== ''">
                                            <span class="title">شماره موبایل:</span>
                                            <span class="text">{{profile_user.phone}}</span>
                                        </li>
                                    </ul>

                                    <!-- ... end W-Personal-Info -->
                                    <!-- W-Socials -->

                                    <div class="widget w-socials" v-if="profile_user.accounts.length > 0">
                                        <h6 class="title">شبکه های اجتماعی:</h6>
                                        <a v-for="account in profile_user.accounts" target="_blank" v-if="account.type === 'telegram'" :href="'https://t.me/'+account.address" class="social-item bg-twitter">
                                            <i class="fab fa-telegram-plane"></i>
                                            Telegram
                                        </a>
                                        <a v-for="account in profile_user.accounts" target="_blank" v-if="account.type === 'facebook'" class="social-item bg-facebook" :href="'https://www.facebook.com/'+account.address">
                                            <svg class="svg-inline--fa fa-facebook-f fa-w-9" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg=""><path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path></svg><!-- <i class="fab fa-facebook-f" aria-hidden="true"></i> -->
                                            Facebook
                                            <span></span>
                                        </a>
                                        <a v-for="account in profile_user.accounts" target="_blank" v-if="account.type === 'twitter'" :href="'https://twitter.com/'+account.address"  class="social-item bg-twitter">
                                            <svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter" aria-hidden="true"></i> -->
                                            Twitter
                                        </a>
                                        <a v-for="account in profile_user.accounts" target="_blank" v-if="account.type === 'instagram'" :href="'https://www.instagram.com/'+account.address"  class="social-item bg-dribbble">
                                            <i class="fab fa-instagram"></i>
                                            Instagram
                                        </a>
                                        <a v-for="account in profile_user.accounts" target="_blank" v-if="account.type === 'linkedin'" :href="' https://www.linkedin.com/in/'+account.address"  class="social-item bg-linkedin">
                                            <i class="fab fa-linkedin-in"></i>
                                            LinkedIn
                                        </a>

                                        <button
                                                type="button"
                                                v-clipboard:copy="account.address"
                                                v-clipboard:success="onCopy"
                                                v-clipboard:error="onError"
                                                v-for="account in profile_user.accounts" v-if="account.type === 'accountEmail'"  class="btn btn-sm full-width social-item bg-red-light btn-copy-gmail">
                                            <input type="hidden" v-model="account.address">
                                            <i class="fab fa-instagram"></i>
                                            Gmail
                                        </button>
                                    </div>


                                    <!-- ... end W-Socials -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end-----------------------------------info tab content---------------------------------------------->


    </div>

</template>

<script>

    import FlipCountdown from 'vue2-flip-countdown'



    /*loader*/
    import {AtomSpinner} from 'epic-spinners'


    export default {
        data(){
            return{
                flag_tabs:{
                    posts: false,
                    actions: false,
                    gallery: false,
                    information: true,
                },
                postItems: 15,
                flag_loader: false,
                flag_hasMore: false,
                timerLabels: {'days':'روز' , 'hours':'ساعت' , 'minutes':'دقیقه' , 'seconds':'ثانیه'},
                flag_isFriend: '',
                friendship_status: '',
                v_message: ''
            }
        },
        components: {
            AtomSpinner,
            FlipCountdown
        },
        props: [
            'profile_user' , 'posts' , 'birthday' , 'post_avatar' , 'sorted_actions' , 'user_avatar' , 'avatars' , 'received_comments' , 'received_likes' , 'auth_user'
        ],
        mounted() {
            if (this.$route.params.section) {
                var tab = this.$route.params.section;

                this.$Progress.start();
                setTimeout(() => {
                    this.$Progress.finish()
                }, 1500);
                Object.keys(this.flag_tabs).forEach(key => this.flag_tabs[key] = false);
                this.flag_tabs[tab] = true;
            }


            this.checkFriendShip();
            this.flag_hasMore = !(this.postItems >= this.posts.length);

        },

        watch : {
            '$route'(to, from) {
                var tab = to.params.section;

                this.$Progress.start();
                setTimeout(() => {
                    this.$Progress.finish()
                }, 1500);
                Object.keys(this.flag_tabs).forEach(key => this.flag_tabs[key] = false);
                this.flag_tabs[tab] = true;

            }
        },
        methods: {

            changeTab:function(tab){
                this.$Progress.start();
                setTimeout(() => {
                    this.$Progress.finish()
                },1500);
                Object.keys(this.flag_tabs).forEach(key => this.flag_tabs[key] = false);
                this.flag_tabs[tab] = true;
                sessionStorage.setItem('tab' , tab);

            },

            showMorePosts:function(){

                this.flag_loader = true;
                setTimeout(() => {
                    this.flag_loader = false;
                    this.postItems = this.postItems + 15;
                    if (this.postItems >= this.posts.length){
                        this.flag_hasMore = false;
                    }
                }, 2500);
            },

            sendFriendRequest:function (friendId) {
                axios.post('/api/friends/friendRequest' , {'friendId':friendId}).then(res => {
                    this.$notify({
                        group: 'alert',
                        type: 'success',
                        duration: 20000,
                        text: 'درخواست دوستی با موفقیت ارسال شد'
                    })
                    this.checkFriendShip();
                }).catch(err => {
                    console.log(err);
                })
            },

            cancelFriendShip:function (friendShipId) {
                axios.post('/api/friends/cancelFriendShip' , {'friendShipId':friendShipId}).then(res => {
                    this.$notify({
                        group: 'alert',
                        type: 'success',
                        duration: 20000,
                        text: 'دوستی با موفقیت لغو شد'
                    })
                    this.checkFriendShip();
                }).catch(err => {
                    console.log(err);
                })
            },

            checkFriendShip:function () {
                axios.post('/api/profile/checkFriendShip' , {'userId':this.profile_user.id}).then(res => {
                    this.friendship_status = res.data;
                    this.flag_isFriend = !(this.friendship_status === 'noFriend' || this.friendship_status === 'notAuth');
                }).catch(err => {
                    console.log(err);
                })
            },

            acceptFriendRequest:function (requestId) {
                axios.post('/api/profile/acceptFriendShip' , {'requestId':requestId}).then(res => {
                    this.$notify({
                        group: 'alert',
                        type: 'success',
                        duration: 20000,
                        text: 'درخواست دوستی با موفقیت پذیرفته شد'
                    })
                    this.checkFriendShip();
                }).catch(err => {
                    console.log(err);
                })
            },

            sendMessage:function (audienceId) {
                axios.post('/panel/messages/send', {
                    'audienceId': audienceId,
                    'description': this.v_message
                }).then(res => {
                    this.v_message ='';
                    this.$notify({
                        group: 'alert',
                        type: 'success',
                        duration: 20000,
                        text: 'پیام شما با موفقیت ارسال شد'
                    })
                }).catch(err => {
                })
            },

            onCopy: function (e) {
                this.$notify({
                    group: 'alert',
                    type: 'success',
                    duration: 20000,
                    text: 'ایمیل کاربر کپی شد'
                })
            },

        }
    }
</script>
