<template>

    <div>

        <div class="col col-xl-12 order-xl-8 col-lg-12 order-lg-3 col-md-12 col-sm-12 col-12">
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">


                <div class="ui-block">
                    <!-- News Feed Form  -->

                    <div class="news-feed-form">
                        <!-- Nav tabs -->
                        <div class="nav nav-tabs" role="tablist">
                            <div class="nav-item">
                                <a class="nav-link inline-items active show" data-toggle="tab" href="#blog" role="tab" aria-expanded="false" aria-selected="true">


                                    <div class="ripple-container"></div></a>
                            </div>
                            <div class="form-group label-floating is-empty post-title-custom">
                                <br/>
                                <label class="control-label">عنوان پست</label>
                                <input v-model="v_postTitle" class="form-control" type="text" placeholder="">
                                <span class="material-input"></span></div>

                            <div class="form-group">
                                <label>دسته بندی</label>
                                <select class="form-control" name="category_id[]" v-model="category_selected">
                                    <option value="select">انتخاب کنید</option>
                                    <option v-for="category in nestedCategories" :value="category.id">{{category.title}}</option>
                                </select>
                            </div>

                            <div class="form-group label-floating is-empty post-title-custom">
                                <br/>
                                <label class="control-label">نام مستعار(اسلاگ)</label>
                                <input v-model="v_slug" class="form-control" type="text" placeholder="">
                                <span class="material-input"></span></div>
                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="blog" role="tabpanel" aria-expanded="true">
                                <form>
                                    <div class="with-icon label-floating is-empty">
                                        <label class="control-label">متن پست را وارد کنید...</label>

                                        <ckeditor></ckeditor>

                                        <input type="hidden" class="photo-ids">
                                        <input type="hidden" class="photos-path">

                                        <!--<textarea v-model="v_postDescription" class="form-control post-textarea" placeholder=""></textarea>-->


                                        <div class="form-group">
                                            <label>متن پیش نمایش</label>
                                            <textarea @keyup="remaincharCount(description_preview , maxcharacterPreview , 'preview')" name="description_preview" class="form-control" v-model="description_preview"></textarea>
                                            <span>{{remaincharactersPreview}}</span>
                                        </div>


                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                            تصویر پیش نمایش پست
                                        </div>

                                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">

                                            <input type="range" @input="onSliderChange" :min="sliderMin" :max="sliderMax" step=".001" v-model="sliderVal">

                                            <croppa @file-choose="handleFileChoose" @zoom="onZoom"  v-model="croppa" @new-image-drawn="onNewImage"
                                                    :placeholder="'تصویر را انتخاب کنید'"
                                                    :placeholder-font-size="14"
                                                    :accept="'image/*'"
                                                    :file-size-limit="0"
                                                    :prevent-white-space="true"
                                                    :width="600"
                                                    :height="420"
                                                    :quality="1.2">
                                                ></croppa>

                                            <!--<span v-if="" class="btn btn-blue mb-4" @click="croppa.chooseFile()">تغییر تصویر...</span>-->

                                        </div>


                                        <div class="form-group label-floating is-empty post-title-custom">
                                            <br/>
                                            <label class="control-label">متا توضیحات</label>
                                            <input v-model="v_metaDescription" class="form-control" type="text" placeholder="">
                                            <span class="material-input"></span></div>

                                        <div class="form-group label-floating is-empty post-title-custom">
                                            <br/>
                                            <label class="control-label">متا کلیدواژه ها</label>
                                            <input v-model="v_metaKeywords" class="form-control" type="text" placeholder="">
                                            <span class="material-input"></span></div>

                                        <div class="select-tag">
                                            <label class="typo__label">تگ گذاری</label>
                                            <multiselect v-model="value" tag-placeholder="به عنوان یک تگ جدید اضافه کن" placeholder="جستجو یا افزودن تگ" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag" tag-position="bottom" max="6"></multiselect>
                                        </div>

                                        <div class="form-group">
                                            <label>وضعیت نمایش</label>
                                            <div>
                                                <span>نمایش</span>
                                                <input class="" type="radio" name="status" value="1" checked v-model="v_status">
                                                <span>عدم نمایش</span>
                                                <input class="" type="radio" name="status" value="0" v-model="v_status">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>وضعیت دریافت نظرات</label>
                                            <div>
                                                <span>قابل ثبت نظر</span>
                                                <input class="" type="radio" name="commentable" value="1" checked v-model="v_commentable">
                                                <span>عدم قابلیت ثبت نظر</span>
                                                <input class="" type="radio" name="commentable" value="0" v-model="v_commentable">
                                            </div>
                                        </div>

                                        <span class="material-input"></span></div>
                                    <div class="add-options-message">

                                        <div class="ui-block-content">


                                        </div>

                                        <div class="container-fluid">
                                            <div class="row">
                                                <div v-for="(postFile , index) in uploadedFile" class="col col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                                    <div class="ui-block" dir="ltr">
                                                        <div class="birthday-item inline-items">
                                                            <div v-if="postFile.type === 'pdf'" class="author-thumb text=center">
                                                                <i class="text-danger fas fa-file-pdf fs1-6"></i>
                                                            </div>
                                                            <div v-if="postFile.type === 'ppt' || postFile.type === 'pptx'" class="author-thumb text=center">
                                                                <i class="text-primary fas fa-file-powerpoint fs1-6"></i>
                                                            </div>
                                                            <div v-if="postFile.type === 'xls' || postFile.type === 'xlsx'" class="author-thumb text=center">
                                                                <i class="text-green fas fa-file-excel fs1-6"></i>
                                                            </div>
                                                            <div v-if="postFile.type === 'doc' || postFile.type === 'docx' || postFile.type === 'rtf'" class="author-thumb text=center">
                                                                <i class="text-blue fas fa-file-word fs1-6"></i>
                                                            </div>
                                                            <div v-if="postFile.type === 'zip' || postFile.type === 'rar'" class="author-thumb text=center">
                                                                <i class="fas fa-file-archive fs1-6"></i>
                                                            </div>
                                                            <div class="birthday-author-name mr-3">
                                                                <input class="form-control" v-model="postFile.original_name">
                                                            </div>
                                                            <span class="btn btn-sm bg-danger" @click="deleteUploadedFile(postFile.id , index)">حذف</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <a href="#" data-toggle="modal" data-target="#edit-widget-twitter" class="options-message mr-4">
                                                <span data-toggle="tooltip" data-placement="top" data-original-title="بارگذاری">
                                                <i class="fas fa-file mr-3 fs1-2"></i>
                                                </span>
                                        </a>
                                        <span>بارگذاری فایل(PDF,پاورپوینت,فایل متنی,اکسل,فایل فشرده)</span>

                                        <upload-image url="" name="" max_files=""></upload-image>

                                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="filesUploaded"></vue-dropzone>

                                        <span @click="storePost()" class="btn btn-green btn-md-2 btn-insert-post">ثبت پست
                                            </span>
                                        <span class="btn btn-md-2 btn-primary">لغو</span>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ... end News Feed Form  -->
                </div>
            </div>
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

    import Vue from 'vue';




    export default {
        data(){
            return{
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
                nestedCategories: [],
                category_selected: 'select',
                /*croppa*/
                croppa: {},
                sliderVal: 0,
                sliderMin: 0,
                sliderMax: 0,
                /*end croppa*/
                v_status: 1,
                v_commentable: 1,
                description_preview: '',
                remaincharactersPreview: '',
                maxcharacterPreview: 255
            }
        },
        components: {
            Multiselect,
            vueDropzone: vue2Dropzone,
        },
        props: [
            'categories' , 'tags'
        ],

        watch : {

        },

        mounted() {
            this.getAllChildren(this.categories);
            this.options = this.tags;

        },

        methods: {
            getAllChildren: function (currentValue , level=1) {
                for(var i=0; i<currentValue.length; i++){
                    var current = currentValue[i];
                    this.nestedCategories.push({
                        id: current.id,
                        title: Array(level+1).join("----------") + " " + current.title
                    })
                    if (current.children_recursive && current.children_recursive.length > 0){
                        this.getAllChildren(current.children_recursive , level + 1)
                    }
                }
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

            /**image croppa**/

            upload() {
                if (!this.croppa.hasImage()) {
                    alert('no image to upload')
                    return
                }

                this.croppa.generateBlob((blob) => {
                    var fd = new FormData()

                    fd.append('file', blob, this.fileName)
                    fd.append('other', 'blahblahblah')
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'http://localhost:8000/api/administrator/post/upload',
                        data: fd,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            alert(data)
                        }
                    })
                })

            },
            handleFileChoose(file) {
                this.fileName = file.name;
            },

            showRequired: function () {
                this.flag_justRequiredFields = !this.flag_justRequiredFields
            },

            onNewImage() {
                this.sliderVal = this.croppa.scaleRatio
                this.sliderMin = this.croppa.scaleRatio / 2
                this.sliderMax = this.croppa.scaleRatio * 2
            },

            onSliderChange(evt) {
                var increment = evt.target.value
                this.croppa.scaleRatio = +increment
            },

            onZoom() {
                // To prevent zooming out of range when using scrolling to zoom
                // if (this.sliderMax && this.croppa.scaleRatio >= this.sliderMax) {
                //   this.croppa.scaleRatio = this.sliderMax
                // } else if (this.sliderMin && this.croppa.scaleRatio <= this.sliderMin) {
                //   this.croppa.scaleRatio = this.sliderMin
                // }

                this.sliderVal = this.croppa.scaleRatio
            },

            storePost: function () {
                setTimeout(() => {
                    var description = $('#editor').html();
                    var editorPhotoIds = $('.photo-ids').val();
                    var editorPhotosPath = $('.photos-path').val();

                    axios.post('/api/administrator/blog/store' , {
                        'title':this.v_postTitle ,
                        'slug' : this.v_slug ,
                        'description_preview' : this.description_preview ,
                        'description':description ,
                        'meta_description' : this.v_metaDescription,
                        'meta_keywords' : this.v_metaKeywords,
                        'tags':this.value ,
                        'uploadedFiles':this.uploadedFile ,
                        'editorPhotos':editorPhotoIds ,
                        'editorPhotosPath':editorPhotosPath ,
                        'categoryId':this.category_selected ,
                        'status':this.v_status,
                        'commentable':this.v_commentable
                    }).then(res=>{
                        this.upload();
                    }).catch(err=>{
                        console.log(err);
                    })
                },2500);

            },

            remaincharCount: function(context , limit , type){

                if(context.length > limit){
                    if (type === 'preview') {
                        var remainCharacters = limit - context.length;
                        this.remaincharactersPreview = remainCharacters + " کاراکتر بیش از حد مجاز.";
                    }

                }else{
                    if (type === 'preview') {
                        var remainCharacters = limit - context.length;
                        this.remaincharactersPreview = remainCharacters + " کاراکتر باقی مانده.";
                    }


                }

            }





        }
    }
</script>

<!--multi select for tags style-->
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>