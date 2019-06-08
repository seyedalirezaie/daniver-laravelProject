<template xmlns:v-clipboard="http://www.w3.org/1999/xhtml">

    <div>

        <div class="ui-block blog-posts-home" v-for="post in posts">


            <!-- Post -->

            <article class="hentry blog-post blog-post-v3">

                <div class="post-thumb">
                    <img v-if="post.photo_preview !== null" :src="'/images/md/'+post.photo_preview.path" :alt="post.title" :title="post.title">
                    <a href="#" class="post-category bg-blue-light fs0-8">{{post.category.title}}</a>
                </div>

                <div class="post-content position-relative">

                    <div class="author-date">
                        نوشته
                        <a class="h6 post__author-name fn" href="#">{{post.user.family}}</a>
                        <div class="post__date">
                            <time class="published" datetime="2017-03-24T18:18">
                                {{post.date}}
                            </time>
                        </div>
                    </div>

                    <a href="#" class="h4 post-title">{{post.title}}</a>
                    <p v-html="post.description_preview">
                    </p>

                    <div class="post-additional-info inline-items position-absolute">

                        <div class="names-people-likes">
                            26
                        </div>
                        <div class="names-people-likes">
                            26
                        </div>
                        <div class="names-people-likes">
                            26
                        </div>

                        <div class="comments-shared">
                            <a href="#" class="post-add-icon inline-items">
                                <svg class="olymp-speech-balloon-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                <span>0</span>
                            </a>
                        </div>

                    </div>
                </div>

            </article>

            <!-- ... end Post -->

        </div>


        <a @click="showMorePosts()" href="#" class="btn btn-md-2 btn-border-think custom-color c-grey full-width">پست های بیشتر
            <div class="ripple-container">
        </div>
        </a>


    </div>

</template>

<script>

    /*loader*/
    import {AtomSpinner} from 'epic-spinners'


    export default {
        data(){
            return{
                postItems: 15,
                flag_loader: false,
                flag_hasMore: false,
                postsList: [],
                posts: [],
                hasNextPage: '',
                v_searchQuery: ''
            }
        },
        components: {
            AtomSpinner,
        },
        props: [
        ],
        mounted() {
            this.getPosts();

            /*if (this.postItems >= this.posts.length){
                this.flag_hasMore = false;
            } else {
                this.flag_hasMore = true;
            }*/

        },

        watch : {

        },
        methods: {

            getPosts:function () {
                var n = 1;
                axios.get('/api/blog/posts' + this.v_searchQuery.trim() + '?page=' + n).then(res => {
                    this.postsList = [];
                    this.postsList = res.data.posts.data;
                    for (var i = 0; i < this.postsList.length; i++) {
                        this.posts.push(this.postsList[i])
                    }
                    this.hasNextPage = res.data.posts.next_page_url;
                    this.flag_loader = false;
                }).catch(err => {
                    console.log(err);
                })
            },

           /* showMorePosts:function(){

                this.flag_loader = true;
                setTimeout(() => {
                    this.flag_loader = false;
                    this.postItems = this.postItems + 15;
                    if (this.postItems >= this.posts.length){
                        this.flag_hasMore = false;
                    }
                }, 2500);
            },*/

        }
    }
</script>
