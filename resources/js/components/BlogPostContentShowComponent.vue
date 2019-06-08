<template>

    <div>


        <div v-html="post.description"></div>

        <!--attached files-->

        <div class="container pt-5">
            <div class="row">

                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 attach-files" v-if="post.mentions.length > 0">
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <span class="title">کاربران تگ شده</span>
                        </div>
                        <div class="ui-block-content">

                            <ul class="widget w-faved-page js-zoom-gallery newest-users">

                                <li class="mentions-post" v-for="mention in post.mentions">
                                    <a :href="'/profile/'+mention.user.url">
                                        <img width="40" :src="mention.user.path_sm" :title="mention.user.family" :alt="mention.user.family">
                                    </a>
                                    <a class="fs0-7 cursor-pointer">{{mention.user.family}}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 attach-files" v-if="flag_hasFile">
                    <div class="ui-block bg-aliceblue">
                        <div class="ui-block-title p-2">
                            <h6 class="title fs0-85">فایل های ضمیمه
                                <i class="fas fa-paperclip"></i>
                            </h6>
                        </div>


                        <ul class="notification-list friend-requests" v-if="post.photos.length > 0">


                            <li class="file-items" v-for="postFile in post.photos" v-if="postFile.type !== null">


                                                <span class="notification-icon btn-download-file">

                                                    <a :href="'/files/'+postFile.path" class="accept-request request-del" title="دانلود">
												<span class="icon-minus minus-delete">
													<i class="fas fa-download fs1-4"></i>
												</span>
                                                </a>
                                                    </span>


                                <div v-if="postFile.type === 'pdf'" class="author-thumb text-center">
                                    <i class="text-danger fas fa-file-pdf fs1-6 mt-1"></i>
                                </div>
                                <div v-if="postFile.type === 'ppt' || postFile.type === 'pptx'" class="author-thumb text-center">
                                    <i class="text-primary fas fa-file-powerpoint fs1-6 mt-1"></i>
                                </div>
                                <div v-if="postFile.type === 'xls' || postFile.type === 'xlsx'" class="author-thumb text-center">
                                    <i class="text-green fas fa-file-excel fs1-6 mt-1"></i>
                                </div>
                                <div v-if="postFile.type === 'doc' || postFile.type === 'docx' || postFile.type === 'rtf'" class="author-thumb text-center">
                                    <i class="text-blue fas fa-file-word fs1-6 mt-1"></i>
                                </div>
                                <div v-if="postFile.type === 'zip' || postFile.type === 'rar'" class="author-thumb text-center">
                                    <i class="fas fa-file-archive fs1-6 mt-1"></i>
                                </div>


                                <div class="notification-event">
                                    <p href="#" class="h6 notification-friend fs0-8 m-0">{{postFile.original_name}}</p>
                                    <span class="chat-message-item mr-3 fs0-7" v-if="postFile.size < 512">{{postFile.size}} کیلوبایت</span>
                                    <span class="chat-message-item mr-3 fs0-85" v-else>{{(postFile.size * 0.0009765625).toFixed(2)}} مگابایت</span>
                                </div>

                            </li>

                        </ul>

                    </div>

                </div>

                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4" dir="rtl" v-if="post.tags.length > 0">
                    <span>هشتگ ها</span>
                    <ul class="tags-show" dir="rtl">
                        <li v-for="tag in post.tags"><a href="#" class="tag-show">{{tag.name}}</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <!--end attached files-->



        <div class="post-additional-info inline-items">

                            <span href="/frontend/#" class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                </svg>
                                <span>{{post.likes_count}}</span>
                            </span>

            <ul v-if="post.likes.length > 0" class="friends-harmonic">
                <li v-for="(like , index) in post.likes" v-if="index < 4">
                    <a href="#">
                        <img :src="like.user.photo.path_sm" :alt="like.user.family">
                    </a>
                </li>
            </ul>

            <div class="names-people-likes" v-if="post.likes_count > 4">
                <a href="#">{{post.likes[0].user.family}}</a>، <a href="#">{{post.likes[1].user.family}}</a> و
                <br>{{post.likes_count - 2}} نفر دیگر این پست را لایک کردند
            </div>
            <div class="names-people-likes" v-if="post.likes_count === 3">
                <a href="#">{{post.likes[0].user.family}}</a>، <a href="#">{{post.likes[1].user.family}}</a>
                و <a href="#">{{post.likes[2].user.family}}</a>
                <br> این پست را لایک کردند
            </div>
            <div class="names-people-likes" v-if="post.likes_count === 2">
                <a href="#">{{post.likes[0].user.family}}</a> و <a href="#">{{post.likes[1].user.family}}</a>
                <br> این پست را لایک کردند
            </div>
            <div class="names-people-likes" v-if="post.likes_count === 1">
                <a href="#">{{post.likes[0].user.family}}</a>
                <br> این پست را لایک کرد
            </div>


            <div class="comments-shared mr-3">
                                <span class="post-add-icon inline-items">
                                    <svg class="olymp-speech-balloon-icon">
                                        <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                    </svg>
                                    <span>{{post.comments_count}}</span>
                                </span>
            </div>


        </div>

        <div class="control-block-button post-control-button">



                            <span v-bind:class="{'liked-circle': post['liked'] === 1}" href="#" class="btn btn-control">
                                <svg class="olymp-like-post-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-like-post-icon"></use>
                                </svg>
                            </span>

            <span class="btn btn-control btn-comment-circle">
                                <svg class="olymp-comments-post-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use>
                                </svg>
                            </span>


        </div>


        <!-- .. end Post -->

        <!-- Comments -->

        <div class="col-12 p-3">
                        <span class="fs0-9">
                        نظرات
                            </span>
            <i class="fas fa-comment-alt"></i>
        </div>


        <ul class="comments-list style-2">

            <li class="comment-item has-children" v-for="comment in post.comments" v-if="comment.parent_id === null">
                <div class="post__author author vcard">
                    <img :src="'/images/sm/'+comment.user.photo.path" alt="author">

                    <div class="author-date">
                        <p><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{comment.user.family}}</span>
                            {{comment.description}}
                        </p>

                        <span v-bind:class="{'post-comment-like': comment.liked === 1}" class="post-add-icon inline-items cursor-pointer">
                                        <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>{{comment.likes_count}}</span>
                                    </span>
                        <span class="reply cursor-pointer text-grey-lighter">پاسخ دادن</span>

                        <div class="post__date">
                            <time class="published fs0-75 text-grey-lighter" datetime="">
                                {{comment.date}}
                            </time>
                        </div>

                    </div>

                </div>

                <slot></slot>
                <comment v-if="comment.child.length > 0" :children="comment.child"></comment>
            </li>
        </ul>





        <!-- Comment Form  -->

        <form class="comment-form inline-items">

            <div class="post__author author vcard inline-items">
                <img class="ml-2" v-if="user !== ''" :src="'/images/sm/'+user.photo.path" alt="author">
                <img class="ml-2" v-else src="'/frontend/img/avatar5-sm.jpg" alt="author">

                <div class="form-group with-icon-right is-empty">
                    <!--<textarea class="form-control text-comment" placeholder=""></textarea>-->

                    <!--<VueEmoji @input="onInput" :value="myText"/>-->

                    <div class="add-options-message">

                    </div>
                    <span class="material-input"></span></div>
            </div>

            <button class="btn btn-md-2 btn-green">ارسال نظر</button>

            <button class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">لغو</button>

        </form>

    </div>

</template>

<script>

    export default {
        data(){
            return{
                flag_hasFile: ''
            }
        },
        components: {

        },

        props: [
            'post'
        ],

        watch : {

        },

        mounted() {
            this.checkPostFiles();
        },

        methods: {
            checkPostFiles:function(){
                this.flag_hasFile = false;
                if (this.post.photos.length > 0){
                    for(var i=0; i<this.post.photos.length; i++){
                        if (this.post.photos[i].type !== null){
                            this.flag_hasFile = true;
                        }
                    }
                }

            },

        }
    }
</script>