<template>

    <div>

        <div class="container-fluid">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                    <div class="ui-block responsive-flex mb-2">
                        <div class="ui-block-title" dir="rtl">
                            <div class="w-search col col-lg-4 col-md-6 col-sm-12 col-12 pr-0 pl-0">

                                <div class="form-group with-button is-empty">
                                    <input v-model="v_searchQuery" class="form-control input-search-posts" type="text" placeholder="جستجو میان کاربران...">
                                    <button class="btn-search-posts" @click="doSearch()">
                                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                    </button>
                                    <span class="material-input"></span></div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row" dir="rtl">


        </div>


    </div>
</template>

<script>


    /*jquery inside vue component*/
    $(document).ready(function () {


    })



    /**dropzone plugin**/
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    /**multi select for tags**/
    import Multiselect from 'vue-multiselect'
    // register globally
    Vue.component('multiselect', Multiselect)

    /**vue paginate**/
    import VuePaginateAl from 'vue-paginate-al'

    import comment from './comment.vue';

    import Vue from 'vue';




    export default {
        data(){
            return{
                selectedPostId: '',
                selectedPostArray: [],
                flag_createPost: false,
                /*dropzone plugin*/
                dropzoneOptions: {
                    url: '/study/photoUpload',
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    },
                    addRemoveLinks: true,
                    maxFiles: 10,
                    acceptedFiles: 'application/pdf ,.DOC , .DOCX , .XLS , .XLSX , .PPT , .PPTX , .RAR , .ZIP , .rtf'

                },
                /*end dropzone plugin*/
                uploadedFile: [],
                /*multi select for tags*/
                value: [],
                options: [],
                taggable: true,
                /*end multi select for tags*/
                v_postTitle: '',
                v_postDescription: '',
                flag_hasError: false,
                posts: [],
                currentPage: 1,
                totalPage: '',
                v_searchQuery: '',
                v_searchTitle: true,
                v_searchDescription: true,
                v_searchUser: false,
                searchType: '',
                v_timeFilter: 'all',
                v_otherFilters: 'all',
                flag_isAuth: false,
                yearsLoop: [],
                v_selectedYear: 'select',
                flag_hasCategory: true,
                v_postItems: 20,
                isLiked: '',
                postComments: [],
                v_order: 'id',
                value_search: 0,
                v_year: 'select',
                keyWord: '',
                postsCount: '',
                myText: '',
                user: ''
            }
        },
        components: {
            vueDropzone: vue2Dropzone,
            Multiselect,
            VuePaginateAl,
            'comment': comment,
        },
        props: [
            'categoryid' , 'year'
        ],

        watch : {
            value_search:function (val) {

                if (val === null){
                    this.value_search = 0
                } else {
                    this.goToFunction(1);
                }
            },

            v_otherFilters:function (val) {
                if (val !== 'special'){
                    this.v_year = 'select'
                }
            },

        },

        mounted() {
            this.checkAuth();
            this.createYearsLoop();
            this.getTags();
            /**remember last post on page refresh**/
            if(sessionStorage.getItem('lastPost')){
                    this.selectedPostArray = JSON.parse(sessionStorage.getItem('lastPost'));
                    this.getAllChildren(this.selectedPostArray.comments , 0);
            }
            if (sessionStorage.getItem('createPost')){
                this.createPost();
            }
            this.selectSearchType();
            this.goToFunction(1);
        },

        methods: {

            selectPost: function (postId) {

                this.$Progress.start()

                axios.get('/api/post/'+postId).then(res=>{
                    this.$Progress.finish()
                    this.selectedPostArray = res.data.post;
                    this.hasLike();
                }).catch(err=>{
                    console.log(err);
                })

                this.selectedPostId = postId;

              /*  for (var i=0; i<this.posts.length; i++){
                    if (this.posts[i].id === postId){
                        this.selectedPostArray = this.posts[i];
                        this.getAllChildren(this.selectedPostArray.comments , 0);
                        const parsedPost = JSON.stringify(this.posts[i]);
                        sessionStorage.clear();
                        sessionStorage.setItem('lastPost', parsedPost);
                    }
                }*/

            },

            createPost: function () {
                this.$Progress.start()
                setTimeout(() => {
                    this.$Progress.finish()
                },2000);
                this.flag_createPost = true;
                this.selectedPostArray = []
                this.getTags();
                sessionStorage.clear();
                sessionStorage.setItem('createPost' , 'true');

            },

            filesUploaded: function (event) {
                var uploadedFile = JSON.parse(event.xhr.response);
                this.uploadedFile.push(uploadedFile.file);
            },

            /**multi select for tags**/
            addTag (newTag) {
                const tag = {
                    name: newTag,
                    code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
                }
                this.options.push(tag)
                this.value.push(tag)
            },
            /**end multi select for tags**/

            getTags: function () {
                axios.get('/api/tags').then(res=>{
                    console.log(res.data.tags);
                    var tags = res.data.tags;
                    this.options = tags;
                }).catch(err=>{
                    console.log(err);
                })
            },

            storePost: function () {
                this.$Progress.start()
                setTimeout(() => {
                    var description = $('#editor').html();
                    var editorPhotoIds = $('.photo-ids').val();
                    var editorPhotosPath = $('.photos-path').val();

                    axios.post('/api/storePost' , {'title':this.v_postTitle , 'description':description , 'tags':this.value , 'uploadedFiles':this.uploadedFile , 'editorPhotos':editorPhotoIds , 'editorPhotosPath':editorPhotosPath , 'categoryId':this.posts[0].category_id}).then(res=>{
                        console.log(res);
                        this.flag_createPost = false;
                        this.$Progress.finish();
                        this.selectPost(res.data);
                        this.goToFunction(1);
                    }).catch(err=>{
                        console.log(err);
                    })
                },2500);

            },

            /**vue paginate**/
            goToFunction : function(n)
            {
                this.$Progress.start();
                var searchKeyword = this.v_searchQuery;
                if (this.v_searchQuery === ''){
                    searchKeyword = 'noSearch';
                }
                var searchTag = this.value_search.id;

                this.currentPage = n;
                axios.get('/api/posts/'+ this.categoryid + '/' + searchKeyword + '/' + this.searchType + '/' + this.v_timeFilter + '/' + this.v_otherFilters + '/' + this.v_order + '/' + searchTag + '/' + this.v_postItems + '/?page='+n).then(res=>{

                        this.posts = res.data.posts.data;
                        this.totalPage = res.data.posts.last_page;
                        this.postsCount = res.data.posts.total;
                        this.currentPage = res.data.posts.current_page;

                    this.$Progress.finish();


                }).catch(err=>{
                    console.log(err);
                })
            },

            goToFuncWithData : function(n, data)
            {
                console.log(n, data);
            },

            goToFuncWithMultipleData : function(n, data)
            {
                console.log(n, data[0], data[1]);
            },
            /**end vue paginate**/

            doSearch: function () {

                this.keyWord = 'با کلید واژه' + ' «' + this.v_searchQuery + '»'

                this.goToFunction(1);
            },

            selectSearchType: function () {
                var typeT = '';
                var typeD = '';
                var typeU = '';
                if (this.v_searchTitle === true){
                    typeT = 't';
                }
                if (this.v_searchDescription === true){
                    typeD = 'd';
                }
                if (this.v_searchUser === true){
                    typeU = 'u';
                }
                this.searchType = typeT+typeD+typeU;
            },

            doFilter: function (event) {

                console.log(event.target.value)
                this.goToFunction(1);
                if (event.target.value === 'mates'){
                    this.checkAuth();
                    if (!this.flag_isAuth){
                        this.$notify({
                            group: 'auth',
                            type: 'error',
                            duration: 40000,
                            text: 'شما هنوز به پروفایل خود وارد نشده اید یا ثبت نام نکرده اید'
                        });
                        this.v_otherFilters = 'all';
                    } else {
                        this.checkCategory();

                        if (!this.flag_hasCategory){
                            this.$notify({
                                group: 'auth',
                                type: 'error',
                                duration: 10000,
                                text: 'برای مشاهده پست های هم ورودی های خود به رشته ی تحصیلی خودتان وارد شوید'
                            });
                            this.v_otherFilters = 'all';
                        }
                    }
                }
            },

            checkAuth: function () {
                axios.post('/api/checkAuth').then(res=>{
                    if (res.data.auth === 'yes'){
                        this.flag_isAuth = true;
                        this.user = res.data.user;
                    } else {
                        this.flag_isAuth = false;
                    }
                }).catch(err=>{
                    console.log(err);
                })
            },

            checkCategory: function () {
                axios.get('/api/checkCategory/' + this.categoryid).then(res=>{
                    if (res.data === 0){
                        this.flag_hasCategory = false;
                    } else {
                        this.flag_hasCategory = true;
                    }
                }).catch(err=>{
                    console.log(err);
                })
            },

            createYearsLoop: function () {
                for (var i=this.year; i>=1370; i--){
                    this.yearsLoop.push(i);
                }
            },

            doFilterYear: function (event) {
                this.$Progress.start();
                var searchKeyword = this.v_searchQuery;
                if (this.v_searchQuery === ''){
                    searchKeyword = 'noSearch';
                }

                var searchTag = this.value_search.id;

                var n = 1;
                this.currentPage = 1;
                axios.get('/api/posts/'+ this.categoryid + '/' + searchKeyword + '/' + this.searchType + '/' + this.v_timeFilter + '/' + this.v_year + '/' + this.v_order + '/' + searchTag + '/' + this.v_postItems + '/?page='+n).then(res=>{

                        this.posts = res.data.posts.data;
                        this.totalPage = res.data.posts.last_page
                        this.postsCount = res.data.posts.total;
                        this.currentPage = res.data.posts.current_page;

                    this.$Progress.finish();

                }).catch(err=>{
                    console.log(err);
                })
            },

            /*multi select plugin method for search by tag*/
            nameWithLang ({ name, language }) {
                return `${name} — [${language}]`
            },

            hasLike: function(){

                   /* for (var i=0; i<this.posts.length; i++){
                        if (this.posts[i].id === this.selectedPostId){*/
                            
                            for (var i3=0; i3<this.selectedPostArray.likes.length; i3++) {
                                if (this.selectedPostArray.likes[i3].user_id === this.user.id) {
                                    /*this.posts[i].liked = 1;*/
                                    /*Vue.set(this.selectedPostArray, liked, 1)*/
                                    this.selectedPostArray['liked'] = 1;
                                } else {
                                    this.selectedPostArray['liked'] = 0;
                                    /*Vue.set(this.selectedPostArray, liked, 0)*/
                                }
                            }


                            for (var i2 = 0; i2 < this.selectedPostArray.comments.length; i2++) {

                                        for (var i4=0; i4<this.selectedPostArray.comments[i2].likes.length; i4++) {
                                            if (this.selectedPostArray.comments[i2].likes[i4].user_id === this.user.id) {
                                                /*this.sele.comments[i2].liked = 1;*/
                                                this.selectedPostArray.comments[i2]['liked'] = 1;

                                            } else {
                                                /*this.posts[i].comments[i2].liked = 0;*/
                                                this.selectedPostArray.comments[i2]['liked'] = 0;
                                        }
                                    }

                            }
                   /*     }
                    }*/
                

            },

            doLike: function (likedId , type) {
                axios.post('/api/doLike' , {'id':likedId , 'type':type , 'postId':this.selectedPostId}).then(res=>{
                    console.log(res);
                    this.selectPost(this.selectedPostId);

                }).catch(err=>{
                    if(err.response.data.message === 'Unauthenticated.') {
                        this.$notify({
                            group: 'auth',
                            type: 'error',
                            duration: 20000,
                        text: 'برای لایک کردن پست ها باید به حساب کاربری خود وارد شوید یا در سایت ثبت نام کنید'
                        });
                    } else {
                        this.$notify({
                            group: 'auth',
                            type: 'error',
                            duration: 20000,
                            text: 'مشکلی در برقراری ارتباط پیش آمده، لطفا لحظاتی دیگر امتحان کنید'
                        });
                    }
                });
            },

            deleteUploadedFile: function (fileId , index) {
                this.uploadedFile.splice(index , 1)
            },

            doOrder: function () {
                this.goToFunction();
            },

            /**vue emoji**/
            onInput(event) {
                this.myText = event.data;
                //event.data contains the value of the textarea
            },

            postComment: function () {
                axios.post('/api/postComment' , {
                    'comment' : this.myText,
                    'postId' : this.selectedPostId,
                }).then(res=>{
                    this.selectPost(this.selectedPostId);
                }).catch(err=>{
                    if(err.response.data.message === 'Unauthenticated.') {
                            this.$notify({
                                group: 'auth',
                                type: 'error',
                                duration: 20000,
                                text: 'برای ارسال نظر باید به حساب کاربری خود وارد شوید یا در سایت ثبت نام کنید'
                            });
                    }
                })
            }

        }
    }
</script>

<!--multi select for tags style-->
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>