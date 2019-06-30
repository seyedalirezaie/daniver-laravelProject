<template>
    <div>

        <ul>
            <li class="comment-item child-comments-item" v-for="child in children">
                <div class="post__author author vcard">
                    <img :src="child.user.path_sm" :alt="child.user.family" :title="child.user.family">
                    <a class="text-primary fs0-75 mr-1" :href="'/profile/'+child.user.url">{{child.user.family}}</a>
                    <div class="author-date">
                        <div class="comment-show" v-html="child.description"><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{child.user.family}}</span>
                        </div>

                        <span v-bind:class="{'post-comment-like': child.liked === 1}" class="post-add-icon inline-items cursor-pointer" @click="emitCommentId(child.id)">
                            <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                            <span>{{child.likes_count}}</span>
                        </span>

                        <span @click="emitParentId(child.id)" class="reply cursor-pointer reply-post-comment">پاسخ دادن</span>

                        <div class="post__date">
                            <time class="published fs0-75" datetime="">
                                {{child.date}}
                            </time>
                        </div>

                    </div>


                </div>

                <comment ref="childAccess" v-on:liked_id="getLikedCommentId" v-on:parent_id="getChildCommentParentId" :post="post" :user_id="user_id" v-if="child.child.length > 0" :children="child.child"></comment>
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
            'children' , 'post' , 'user_id'
        ],
        components: {
            'comment': comment
        },
        mounted() {

        },
        methods: {

            emitParentId:function (parentId) {
                this.$emit('parent_id', parentId);
            },

            getChildCommentParentId(response) {
                this.$emit('parent_id', response);
            },

            emitCommentId:function (commentId) {
                this.$emit('liked_id' , commentId)
            },

            getLikedCommentId(response) {
                this.$emit('liked_id', response);
            },
        }

    }
</script>
