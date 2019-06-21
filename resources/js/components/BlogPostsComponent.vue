<template xmlns:v-clipboard="http://www.w3.org/1999/xhtml">

    <div>

        <div class="ui-block blog-posts-home" v-for="post in posts">


            <!-- Post -->

            <article class="hentry blog-post blog-post-v3">

                <a class="post-thumb img-blog-main" :href="post.category.url+'/posts/'+post.category.slug+'/'+post.slug">
                    <img :src="post.path_md" :alt="post.title" :title="post.title">
                    <span class="dark-on-img"></span>
                    <a href="#" class="post-category bg-purple fs0-8">{{post.category.title}}</a>
                </a>

                <div class="post-content position-relative post-blog-main">

                    <div class="author-date p-1 rounded" dir="rtl">
                        نوشته
                        <a class="h6 post__author-name fn ml-3 mr-1 fw-400" :href="'/profile/'+post.user.url">{{post.user.family}}</a>
                        <div class="post__date">
                            تاریخ انتشار
                            <time class="published" datetime="2017-03-24T18:18">
                                {{post.displayed_at}}
                            </time>
                        </div>
                    </div>

                    <a :href="post.category.url+'/posts/'+post.category.slug+'/'+post.slug" class="h4 post-title">{{post.title}}</a>
                    <p v-html="post.description_preview">
                    </p>

                    <div class="post-additional-info inline-items position-absolute">

                        <span class="post-add-icon inline-items">
                                <i class="far fa-heart fs1-2"></i>
                                <span>{{post.likes_count}}</span>
                            </span>

                        <div class="comments-shared mr-3 d-inline-block">
                                <span class="post-add-icon inline-items">
                                    <i class="far fa-comment fs1-2"></i>
                                    <span>{{post.comments_count}}</span>
                                </span>
                        </div>

                    </div>
                </div>

            </article>

            <!-- ... end Post -->

        </div>


        <div v-show="flag_hasMore" @click="showMorePosts()" class="btn btn-md-2 btn-border-think custom-color c-grey full-width btn-more-posts-blog">پست های بیشتر
            <div class="ripple-container">
                <div v-show="flag_loader" class="spring-spinner loader-wrapper">
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

</template>

<script>

    /*loader*/
    import {AtomSpinner} from 'epic-spinners'


    export default {
        data(){
            return{
                flag_loader: false,
                flag_hasMore: false,
                postsList: [],
                posts: [],
                v_searchQuery: '',
                currentPage: 1
            }
        },
        components: {
            AtomSpinner,
        },
        props: [
        ],
        mounted() {
            this.getPosts();
        },

        watch : {

        },
        methods: {

            getPosts:function () {
                axios.get('/api/blog/posts' + this.v_searchQuery.trim() + '?page=' + this.currentPage).then(res => {
                    this.postsList = [];
                    this.postsList = res.data.posts.data;
                    for (var i = 0; i < this.postsList.length; i++) {
                        this.posts.push(this.postsList[i])
                    }
                    this.flag_hasMore = res.data.posts.next_page_url;
                    this.flag_hasMore = (res.data.posts.next_page_url !== null);
                    this.flag_loader = false;
                }).catch(err => {
                    console.log(err);
                })
            },

            showMorePosts:function(){
                this.currentPage++;
                this.flag_loader = true;
                setTimeout(() => {
                    this.getPosts();
                    this.flag_loader = false;
                }, 3000);
            },

        }
    }
</script>
