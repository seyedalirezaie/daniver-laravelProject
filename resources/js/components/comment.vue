<template>
    <div>

        <ul>
            <li class="comment-item child-comments-item" v-for="child in children">
                <div class="post__author author vcard">
                    <img :src="'/images/sm/'+child.user.photo.path" alt="author">

                    <div class="author-date">
                        <div class="comment-show" v-html="child.description"><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{child.user.family}}</span>
                        </div>

                        <span v-bind:class="{'post-comment-like': child.liked === 1}" class="post-add-icon inline-items" @click="doLike(child.id , 'comment')">
                            <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                            <span>{{child.likes_count}}</span>
                        </span>

                        <span @click="answerCommentBoxShow(child.id)" class="reply cursor-pointer">پاسخ دادن</span>

                        <div class="post__date">
                            <time class="published fs0-75" datetime="">
                                {{child.date}}
                            </time>
                        </div>

                        <div :class="'answer-comment-box-'+child.id+' mt-3 mb-2'" v-show="flag_answerComment === child.id">
                            <textareas class="emoji-editor"></textareas>

                            <button @click="postComment(child.id)" class="btn btn-sm btn-green">ارسال پاسخ</button>
                            <button class="btn btn-sm btn-secondary">لغو</button>
                        </div>

                    </div>


                </div>

                <comment v-on:send_comment="sendCommentFromChild" :post_id="post_id" v-if="child.child.length > 0" :children="child.child"></comment>
            </li>
        </ul>

    </div>
</template>

<script>

    var _ = require('lodash');

    import comment from './comment.vue';

    export default {
        data(){
            return{
                flag_answerComment: ''
            }
        },
        name: 'comment',
        props: [
            'children' , 'post_id'
        ],
        components: {
            'comment': comment
        },
        mounted() {

        },
        methods: {
            postComment: function (commentParentId=null) {
                setTimeout(() => {
                    var commentContent = '';
                    if (commentParentId !== null){
                        commentContent = $('.answer-comment-box-'+commentParentId).find('.emojionearea-editor').html();
                    } else {
                        commentContent = $('.main-comment-box .emojionearea-editor').html();
                    }

                    axios.post('/api/postComment' , {
                        'comment' : commentContent,
                        'postId' : this.post_id,
                        'parent_id' : commentParentId
                    }).then(res=>{
                        this.flag_answerComment = '';
                        this.$emit('send_comment', 'sent');
                    }).catch(err=>{
                        if(err.response.data.message === 'Unauthenticated.') {
                            this.$emit('send_comment', 'sent-error-auth');
                        }
                    });
                },1000);
            },

            doLike: function (likedId , type) {
                axios.post('/api/doLike' , {'id':likedId , 'type':type , 'postId':this.post_id}).then(res=>{
                    this.$emit('send_comment', 'liked');
                }).catch(err=>{
                    if(err.response.data.message === 'Unauthenticated.') {
                        this.$emit('send_comment', 'not-auth');
                    } else {
                        this.$emit('send_comment', 'error');
                    }
                });
            },

            answerCommentBoxShow:function (commentId){
                this.flag_answerComment = commentId;
            },

            sendCommentFromChild(response) {
                this.$emit('send_comment', 'sent');
            }
        }
    }
</script>
