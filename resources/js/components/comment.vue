<template>
    <div>

        <ul>
            <li class="comment-item child-comments-item" v-for="child in children">
                <div class="post__author author vcard">
                    <img :src="'/images/sm/'+child.user.photo.path" alt="author">

                    <div class="author-date">
                        <p><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer">{{child.user.family}}</span>
                             {{child.description}}</p>

                        <span v-bind:class="{'post-comment-like': child.liked === 1}" class="post-add-icon inline-items" @click="doLike(child.id , 'comment')">
                            <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                            <span>{{child.likes_count}}</span>
                        </span>
                        <span class="reply">Reply</span>

                        <div class="post__date">
                            <time class="published fs0-75" datetime="">
                                {{child.date}}
                            </time>
                        </div>

                    </div>


                </div>

                <comment v-if="child.child.length > 0" :children="child.child"></comment>
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

            }
        },
        name: 'comment',
        props: [
            'children'
        ],
        components: {
            'comment': comment
        },
        mounted() {

        },
        methods: {

        }
    }
</script>
