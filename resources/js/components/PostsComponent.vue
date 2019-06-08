<template>

    <div>

        <div class="container-fluid">
            <div class="row">
                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                    <div class="ui-block responsive-flex mb-2">
                        <div class="ui-block-title" dir="rtl">
                            <div class="w-search col col-lg-4 col-md-6 col-sm-12 col-12 pr-0 pl-0">
                                <span>جستجو در</span>
                                <div class="form-group d-inline-block">
                                <label class="mr-2">عنوان پست ها</label>
                                <input @change="selectSearchType()" v-model="v_searchTitle" type="checkbox" class="d-inline-block mt-1" style="width: unset">
                                </div>
                                <div class="form-group d-inline-block">
                                    <label class="mr-2">متن پست ها</label>
                                    <input @change="selectSearchType()" v-model="v_searchDescription" type="checkbox" class="d-inline-block mt-1" style="width: unset">
                                </div>
                                <div class="form-group d-inline-block">
                                    <label class="mr-2">نام ارسال کننده</label>
                                    <input @change="selectSearchType()" v-model="v_searchUser" type="checkbox" class="d-inline-block mt-1" style="width: unset">
                                </div>

                                <div class="form-group with-button is-empty">
                                    <input v-model="v_searchQuery" class="form-control input-search-posts" type="text" placeholder="جستجو میان پست ها...">
                                    <button class="btn-search-posts" @click="doSearch()">
                                        <svg class="olymp-magnifying-glass-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-magnifying-glass-icon"></use></svg>
                                    </button>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="form-group col col-lg-2 col-md-6 col-sm-12 col-12 pl-0">
                                <label class="mr-2">فیلتر بر اساس زمان</label>
                                <select @change="doFilter($event)" class="form-control form-input-sm mt-1 custom-select-size" v-model="v_timeFilter">
                                    <option value="all" selected>تمامی پست ها</option>
                                    <option value="today">پست های امروز</option>
                                    <option value="yesterday">پست های امروز و دیروز</option>
                                    <option value="lastweek">پست های هفته گذشته</option>
                                </select>
                            </div>

                            <div class="form-group col col-lg-2 col-md-6 col-sm-12 col-12 pl-0">
                                <label class="mr-2">نظرات-لایک ها</label>
                                <select @change="doOrder()" class="form-control form-input-sm mt-1 custom-select-size" v-model="v_order">
                                    <option value="id" selected>تمامی پست ها</option>
                                    <option value="comments_count">پر بحث ترین پست ها</option>
                                    <option value="likes_count">محبوب ترین پست ها</option>
                                </select>
                            </div>


                            <div class="form-group col col-lg-2 col-md-6 col-sm-12 col-12 pl-0">
                                <label class="mr-2">سایر فیلترها</label>
                                <select @change="doFilter($event)" class="form-control form-input-sm mt-1 custom-select-size" v-model="v_otherFilters">
                                    <option value="all" selected>تمامی پست ها</option>
                                    <option value="mates">پست های هم ورودی های من</option>
                                    <option value="special">پست های یک ورودی خاص</option>
                                    <option value="endstudy">پست های فارغ التحصیلان</option>
                                    <option value="guests">پست های مهمانان</option>
                                </select>
                            </div>



                            <div class="form-group col col-lg-1 col-md-6 col-sm-12 col-12 pl-0 pr-0">
                                <div v-if="this.v_otherFilters === 'special'">
                                <label class="mr-2">ورودی سال...</label>
                                <select @change="doFilterYear($event)" class="form-control form-input-sm mt-1 custom-select-size" v-model="v_year">
                                    <option value="select">انتخاب کنید</option>
                                    <option v-for="year in yearsLoop" :value="year">{{year}}</option>
                                </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">
                    <div class="ui-block responsive-flex mb-2">
                        <div class="ui-block-title row" dir="rtl">
                            <div class="form-group col col-lg-2 col-md-6 col-sm-10 col-12 items-select-container">
                                <label>تعداد نمایش</label>
                                <select v-model="v_postItems" @change="doSearch()" class="form-control form-input-sm mt-1 custom-select-size number-show-select">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <div class="form-group col col-lg-3 col-md-6 col-sm-10 col-12 search-tags">
                                <div class="multiselect-search-tag">
                                    <label class="typo__label">جستجو بر اساس هشتگ</label>
                                    <multiselect :select-label="''" :selectedLabel="'انتخاب شده'" :deselectLabel="'برای حذف کلیک کنید'" v-model="value_search" :options="options" placeholder="تگ مورد نظر" label="name" tag-position="bottom" track-by="name"><span class="fs0-65" slot="noResult">تگ مورد نظر شما در میان تگ ها وجود ندارد.</span></multiselect>
                                </div>
                            </div>

                            <div class="fs0-75 form-group col col-lg-7 col-md-6 col-sm-10 col-12 bg-search-result rounded search-result">
                                <span>نمایش </span>
                                <span v-if="v_order === 'comments_count'">پر بحث ترین</span>
                                <span v-if="v_order === 'likes_count'">محبوب ترین</span>
                                <span>پست ها</span>
                                <span v-if="v_timeFilter !== 'all' || v_otherFilters !== 'all'">ی</span>
                                <span v-if="v_timeFilter === 'today'">امروز </span>
                                <span v-if="v_timeFilter === 'yesterday'">امروز و دیروز </span>
                                <span v-if="v_timeFilter === 'lastweek'">هفته ی گذشته </span>
                                <span v-if="v_otherFilters === 'mates' && flag_isAuth && flag_hasCategory">هم ورودی های من </span>
                                <span v-if="v_otherFilters === 'special' && v_year !== 'select'">ورودی های سال {{v_year}} </span>
                                <span>{{keyWord}}</span>
                                <span v-if="value_search!== 0 && keyWord !== ''">و تگ «{{value_search.name}}»</span>
                                <span v-if="value_search!== 0 && keyWord === ''">با تگ «{{value_search.name}}»</span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row" dir="rtl">

            <div class="col col-xl-4 order-xl-4 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                <div class="ui-block">
                    <div class="ui-block-title posts-titlebar p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 p-3">
                                    <div class="row">
                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <h6 class="title d-inline-block">پست ها</h6>
                                        <strong class="result-number text-green">تعداد نتایج: {{postsCount}}</strong>
                                        <strong class="result-number-empty text-red">بدون نتیجه</strong>
                                    </div>

                                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                        <router-link v-if="posts[0]" :to="{name:'post' , params:{category:posts[0].category.slug , slug:'create-post'}}">
                                    <span @click="createPost()" class="btn btn-grey btn-sm float-left btn-create-post">افزودن پست جدید<div class="ripple-container"></div></span>
                                        </router-link>
                                    </div>
                                    </div>
                                </div>

                            <div class="paginate-container col-12 text-center">
                                <vue-paginate-al :currentPage="currentPage" customActiveBGColor="#888da8" nextText="بعدی" prevText="قبلی" :totalPage="totalPage" @btnClick="goToFunction"></vue-paginate-al>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- W-Playlist -->

                    <ol class="widget w-playlist pr-0">

                        <transition-group name="fadeRight" tag="ul" class="list-group sidebar-scroll" v-if="posts.length > 0">
                        <li class="post-item-list" v-for="post in posts" v-bind:key="post.id" v-on:click.self="selectPost(post.id , post.slug)" v-bind:class="{'selected-post-list' : selectedPostId === post.id}" :id="'post'+post.id">

                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-3">
                                        <router-link v-if="posts[0]" :to="{name:'post' , params:{category:posts[0].category.slug , slug:post.slug}}">
                                        <img v-if="post.photos.length > 0" width="60px" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                        <img v-else width="60px" :src="postimages" :alt="post.title" :title="post.title">
                                        </router-link>
                                    </div>

                                    <div class="composition col-9">
                                        <router-link v-if="posts[0]" :to="{name:'post' , params:{category: posts[0].category.slug , slug:post.slug}}">
                                        <span class="composition-name" @click="selectPost(post.id , post.slug)">{{post.title}}</span>
                                        </router-link>
                                        <span class="composition-author mt-2 position-relative">
                                            <img width="30px" class="rounded-circle" :src="post.user.path_sm" :alt="post.user.family" :title="post.user.family" @error="avatarSRC">
                                             نوشته {{post.user.family}}
                                            <span class="badge badge-primary badge-guest" v-if="post.is_guest === 1">مهمان</span>
                                             <span class="more">
                                            <svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                            <ul class="more-dropdown more-with-triangle card-main-container">
                                                <li>
                                                    <aside class="profile-card">
                                                        <header>
                                                              <a><img class="rounded-circle img-card-user" :src="post.user.path_sm"></a>
                                                              <p>{{post.user.family}}</p>
                                                        </header>
                                                            <a class="profile-bio">

                                                                <ul>
                                                                     <li class="fs0-7" v-for="major in post.user.categories"
                                                                         v-if="major.sort === 'major' && major.pivot.status === 1">
                                                                          <span class="badge badge-primary">در حال تحصیل</span>
                                                                         {{major.titles}}  {{major.pivot.year}}
                                                                </li>
                                                                    <li class="fs0-7" v-for="major in post.user.categories"
                                                                        v-if="major.sort === 'major' && major.pivot.status === 2">
                                                                         <span class="badge badge-primary">فارغ التحصیل</span>
                                                                        {{major.titles}}  {{major.pivot.year}}
                                                                </li>
                                                                </ul>
                                                            </a>
                                                    </aside>
                                                </li>
                                            </ul>
                                        </span>
                                        </span>

                                    </div>

                                    <div class="col-12 mt-3">

                                        <span class="notification-date time-post-list float-left"><span class="entry-date updated">{{post.date}}</span>
                                        </span>

                                        <div class="comments-shared d-inline-block float-right"><span class="post-add-icon inline-items mr-0"><svg class="olymp-speech-balloon-icon small-icons-post"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg> <span>{{post.comments_count}}</span></span> <span class="post-add-icon inline-items"><svg class="olymp-heart-icon small-icons-post"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg> <span>{{post.likes_count}}</span></span></div>
                                    </div>

                                </div>
                            </div>

                        </li>

                        </transition-group>

                        <li class="show-no-result">
                            هیچ پستی با مشخصات مورد نظر شما وجود ندارد
                        </li>

                    </ol>

                    <!-- .. end W-Playlist -->
                </div>
            </div>

            <div style="height: 88vh; overflow-y: auto; overflow-x:unset" class="col col-xl-8 order-xl-8 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12" v-if="selectedPostArray.id" v-sticky="{ zIndex: 1, stickyTop: 60, disabled: false}">
                <div class="ui-block selected-post-container">

                    <div class="ui-block-title selected-post"><h1 class="fs1-6">{{selectedPostArray.title}}</h1></div>

                    <!-- Post -->

                    <article class="hentry post post-content">

                        <div class="post__author author vcard inline-items mb-5">
                            <img width="40" height="40" :src="selectedPostArray.user.path_md" :title="selectedPostArray.user.family" :alt="selectedPostArray.user.family">

                            <div class="author-date">
                                <a class="h6 post__author-name fn fs0-8" href="02-ProfilePage.html">{{selectedPostArray.user.family}}</a>
                                <div class="post__date">
                                    <time class="published fs0-7" datetime="2017-03-24T18:18">
                                        {{selectedPostArray.full_date}}
                                    </time>
                                </div>
                            </div>


                        </div>

                        <div v-html="selectedPostArray.description"></div>


                        <!--attached files-->

                        <div class="container pt-5">
                            <div class="row">

                                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 attach-files" v-if="selectedPostArray.mentions.length > 0">
                                <div class="ui-block">
                                    <div class="ui-block-title">
                                        <span class="title">کاربران تگ شده</span>
                                    </div>
                                    <div class="ui-block-content">

                                        <ul class="widget w-faved-page js-zoom-gallery newest-users">

                                            <li class="mentions-post" v-for="mention in selectedPostArray.mentions">
                                                <a v-if="mention.user.alias !== null" :href="'/profile/'+mention.user.alias">
                                                    <img width="40" v-if="mention.user.photo" :src="'/images/sm/'+mention.user.photo.path" :title="mention.user.family" :alt="mention.user.family" @error="avatarSRC">
                                                    <img width="40" v-else :src="images" :title="mention.user.family" :alt="mention.user.family">
                                                </a>
                                                <a v-else :href="'/profile/'+mention.user.id">
                                                    <img width="40" v-if="mention.user.photo" :src="'/images/sm/'+mention.user.photo.path" :title="mention.user.family" :alt="mention.user.family" @error="avatarSRC">
                                                    <img width="40" v-else :src="images" :title="mention.user.family" :alt="mention.user.family">
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


                                        <ul class="notification-list friend-requests">


                                            <li class="file-items" v-for="postFile in selectedPostArray.photos" v-if="postFile.type !== null">


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

                                <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4" dir="rtl" v-if="selectedPostArray.tags.length > 0">
                                <span>هشتگ ها</span>
                                <ul class="tags-show" dir="rtl">
                                    <li v-for="tag in selectedPostArray.tags"><a href="#" class="tag-show">{{tag.name}}</a></li>
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
                                <span>{{selectedPostArray.likes_count}}</span>
                            </span>

                            <ul v-if="selectedPostArray.likes.length > 0" class="friends-harmonic">
                                <li v-for="(like , index) in selectedPostArray.likes" v-if="index < 4">
                                    <a href="#">
                                        <img :src="'/images/sm/'+like.user.photo.path" alt="friend">
                                    </a>
                                </li>
                            </ul>

                            <div class="names-people-likes" v-if="selectedPostArray.likes_count > 4">
                                <a href="#">{{selectedPostArray.likes[0].user.family}}</a>، <a href="#">{{selectedPostArray.likes[1].user.family}}</a> و
                                <br>{{selectedPostArray.likes_count - 2}} نفر دیگر این پست را لایک کردند
                            </div>
                            <div class="names-people-likes" v-if="selectedPostArray.likes_count === 3">
                                <a href="#">{{selectedPostArray.likes[0].user.family}}</a>، <a href="#">{{selectedPostArray.likes[1].user.family}}</a>
                                و <a href="#">{{selectedPostArray.likes[2].user.family}}</a>
                                <br> این پست را لایک کردند
                            </div>
                            <div class="names-people-likes" v-if="selectedPostArray.likes_count === 2">
                                <a href="#">{{selectedPostArray.likes[0].user.family}}</a> و <a href="#">{{selectedPostArray.likes[1].user.family}}</a>
                                <br> این پست را لایک کردند
                            </div>
                            <div class="names-people-likes" v-if="selectedPostArray.likes_count === 1">
                                <a href="#">{{selectedPostArray.likes[0].user.family}}</a>
                                <br> این پست را لایک کرد
                            </div>


                            <div class="comments-shared mr-3">
                                <span class="post-add-icon inline-items">
                                    <svg class="olymp-speech-balloon-icon">
                                        <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                    </svg>
                                    <span>{{selectedPostArray.comments_count}}</span>
                                </span>
                            </div>


                        </div>

                        <div class="control-block-button post-control-button">



                            <span v-bind:class="{'liked-circle': selectedPostArray['liked'] === 1}" href="#" class="btn btn-control" @click="doLike(selectedPostArray.id , 'post')">
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

                    </article>

                    <!-- .. end Post -->

                    <!-- Comments -->

                    <div class="col-12 p-3">
                        <span class="fs0-9">
                        نظرات
                            </span>
                        <i class="fas fa-comment-alt"></i>
                    </div>


                    <ul class="comments-list style-2">

                        <li class="comment-item has-children" v-for="comment in selectedPostArray.comments" v-if="comment.parent_id === null">
                            <div class="post__author author vcard">
                                <img :src="comment.user.path_sm" alt="author">

                                <div class="author-date">
                                    <div class="comment-show" v-html="comment.description"><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{comment.user.family}}</span>
                                    </div>

                                    <span v-bind:class="{'post-comment-like': comment.liked === 1}" class="post-add-icon inline-items cursor-pointer" @click="doLike(comment.id , 'comment')">
                                        <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>{{comment.likes_count}}</span>
                                    </span>
                                    <span @click="answerCommentBoxShow(comment.id)" class="reply cursor-pointer text-grey-lighter">پاسخ دادن</span>

                                    <div class="post__date">
                                        <time class="published fs0-75 text-grey-lighter" datetime="">
                                            {{comment.date}}
                                        </time>
                                    </div>

                                    <div :class="'answer-comment-box-'+comment.id+' mt-3 mb-2'" v-show="flag_answerComment === comment.id">
                                    <textareas class="emoji-editor"></textareas>

                                        <button @click="postComment(comment.id)" class="btn btn-sm btn-green">ارسال پاسخ</button>
                                        <button class="btn btn-sm btn-secondary">لغو</button>
                                    </div>

                                </div>

                            </div>

                            <slot></slot>
                            <comment v-on:send_comment="sendCommentFromChild" v-if="comment.child.length > 0" :post_id="selectedPostId" :children="comment.child"></comment>
                        </li>
                    </ul>

                    <!-- Comment Form  -->

                    <form class="comment-form inline-items">

                        <div class="post__author author vcard inline-items">
                            <img class="ml-2" v-if="user !== ''" :src="'/images/sm/'+user.photo.path" alt="author">
                            <img class="ml-2" v-else src="'/frontend/img/avatar5-sm.jpg" alt="author">

                            <div class="form-group with-icon-right is-empty main-comment-box">

                                <textarea class="emoji-editor"></textarea>

                                <div class="add-options-message">

                                </div>
                                <span class="material-input"></span></div>
                        </div>

                        <button type="button" class="btn btn-md-2 btn-green" @click="postComment()">ارسال نظر</button>

                        <button type="button" class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">لغو</button>

                    </form>

                    <!-- ... end Comment Form  -->			</div>
            </div>

            <div class="col col-xl-8 order-xl-8 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12" v-if="flag_createPost">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="ui-block-title bg-white px-2">
                        <h6 class="presentation-margin">ایجاد پست جدید</h6></div>

                    <div class="ui-block post-limiter">
                        <!-- News Feed Form  -->

                        <div class="news-feed-form">
                            <!-- Nav tabs -->
                            <div class="nav nav-tabs" role="tablist">
                                <div class="nav-item">
                                    <a class="nav-link inline-items active show" data-toggle="tab" href="#blog" role="tab" aria-expanded="false" aria-selected="true">
                                        <svg class="olymp-blog-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-blog-icon"></use></svg>

                                        <span>عنوان پست</span>
                                        <div class="ripple-container"></div></a>
                                </div>
                                <div class="form-group label-floating is-empty post-title-custom">
                                    <label class="control-label">عنوان پست را وارد کنید...</label>
                                    <input v-model="v_postTitle" class="form-control" type="text" placeholder="">
                                    <span class="material-input"></span></div>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active show" id="blog" role="tabpanel" aria-expanded="true">
                                    <form>
                                        <div class="author-thumb post-user-avatar">
                                            <img class="img-circle-40" :src="'/images/sm/'+user.photo.path" :alt="user.family" :title="user.family" @error="avatarSRC">
                                        </div>
                                        <div class="with-icon label-floating is-empty create-post-container">
                                            <label class="control-label">متن پست را وارد کنید...</label>

                                            <ckeditor></ckeditor>

                                            <input type="hidden" class="photo-ids">
                                            <input type="hidden" class="photos-path">

                                            <div class="select-tag pt-4">
                                            <label class="typo__label">هشتگ گذاری</label>
                                            <multiselect :selectedLabel="'انتخاب شده'" :deselectLabel="'برای حذف کلیک کنید'" :select-label="''" v-model="value" tag-placeholder="به عنوان یک تگ جدید اضافه کن" placeholder="جستجو یا افزودن تگ" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag" tag-position="bottom" max="6"></multiselect>
                                            </div>

                                            <span class="material-input"></span></div>
                                        <div class="add-options-message bg-white">

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

                                            <div class="row p-3 mt-3">
                                            <span @click="storePost()" class="btn btn-green btn-md-2 btn-insert-post">ثبت پست
                                            </span>
                                            <span class="btn btn-md-2 btn-primary mr-2">لغو</span>
                                            </div>

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

        <!--upload image modal-->

        <div dir="rtl" class="modal fade" id="edit-widget-twitter" tabindex="-1" role="dialog" aria-labelledby="edit-widget-twitter" style="display: none; padding-right: 17px;">
            <div class="modal-dialog window-popup edit-widget edit-widget-twitter modal-upload-files" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>

                    <div class="modal-header">
                        <h6 class="title">بارگذاری فایل ها</h6>
                    </div>

                    <div class="modal-body">

                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="filesUploaded"></vue-dropzone>

                        <span data-dismiss="modal" aria-label="Close" class="btn btn-primary btn-lg full-width">بستن</span>
                    </div>
                </div>

            </div>
        </div>

        <!--end upload image modal-->

        <!--post store error modal-->

      <!--  <div class="modal fade" v-bind:class="{show : flag_hasError}" id="edit-widget-blog-post" tabindex="-1" role="dialog" aria-labelledby="edit-widget-blog-post" style="display: block; padding-right: 17px;" v-bind:style="{style_display}">
            <div class="modal-dialog window-popup edit-widget edit-widget-blog-post" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>

                    <div class="modal-header">
                        <h6 class="title">Edit Blog Posts</h6>
                    </div>

                    <div class="modal-body">
                        <fieldset class="form-group label-floating is-select">
                            <label class="control-label">Amount of Blog Posts</label>
                            <div class="btn-group bootstrap-select form-control"><button type="button" class="btn dropdown-toggle btn-secondary" data-toggle="dropdown" role="button" title="Show 3 Blog Posts"><span class="filter-option pull-left">Show 3 Blog Posts</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class=" dropdown-item" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Show 3 Blog Posts</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class=" dropdown-item" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Show 6 Blog Posts</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class=" dropdown-item" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Show 9 Blog Posts</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div><select class="selectpicker form-control" tabindex="-98">
                                <option value="AL">Show 3 Blog Posts</option>
                                <option value="2">Show 6 Blog Posts</option>
                                <option value="WY">Show 9 Blog Posts</option>
                            </select></div>
                            <span class="material-input"></span></fieldset>

                        <fieldset class="form-group label-floating is-select">
                            <label class="control-label">Organize Posts</label>
                            <div class="btn-group bootstrap-select form-control"><button type="button" class="btn dropdown-toggle btn-secondary" data-toggle="dropdown" role="button" title="By Date (Newest to Oldest)"><span class="filter-option pull-left">By Date (Newest to Oldest)</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open" role="combobox"><ul class="dropdown-menu inner" role="listbox" aria-expanded="false"><li data-original-index="0" class="selected"><a tabindex="0" class=" dropdown-item" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">By Date (Newest to Oldest)</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="1"><a tabindex="0" class=" dropdown-item" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">By Favorites</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li><li data-original-index="2"><a tabindex="0" class=" dropdown-item" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">By Repost</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li></ul></div><select class="selectpicker form-control" tabindex="-98">
                                <option value="AL">By Date (Newest to Oldest)</option>
                                <option value="2">By Favorites</option>
                                <option value="WY">By Repost</option>
                            </select></div>
                            <span class="material-input"></span></fieldset>

                        <a href="#" class="btn btn-primary btn-lg full-width">Save all Changes</a>
                    </div>
                </div>
            </div>
        </div>-->

        <!--end post store error modal-->


    </div>
</template>

<script>


    /*jquery inside vue component*/




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

    import VueEmoji from 'emoji-vue'

    import VueSticky from 'vue-sticky' // Es6 module
    Vue.use(VueSticky)

    import Vue from 'vue';


    import {scroller} from 'vue-scrollto/src/scrollTo'

    var options = {
        container: 'body',
        easing: 'ease-in',
        offset: -60,
        force: true,
        cancelable: true,
        onStart: function(element) {
        },
        onDone: function(element) {
            // scrolling is done
        },
        onCancel: function() {
            // scrolling has been interrupted
        },
        x: false,
        y: true
    }



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
                posts: 0,
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
                user: '',
                postSlug: '',
                flag_noResult: false,
                flag_hasFile: false,
                flag_answerComment: ''
            }
        },
        created: {

        },
        components: {
            vueDropzone: vue2Dropzone,
            Multiselect,
            VuePaginateAl,
            'comment': comment,
            VueEmoji,
        },
        props: [
            'categoryid' , 'year' , 'images' , 'postimages'
        ],

        directives: {
            'sticky': VueSticky,
        },

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

            posts:function (val) {
                if (val.length === 0){
                    $('.sidebar-scroll').css('display' , 'none');
                    $('.result-number').css('display' , 'none');
                    $('.result-number-empty').css('display' , 'block');
                    $('.show-no-result').css('display' , 'block');
                } else {
                    $('.sidebar-scroll').css('display' , 'flex');
                    $('.result-number').css('display' , 'block');
                    $('.result-number-empty').css('display' , 'none');
                    $('.show-no-result').css('display' , 'none');
                }
            },

            v_postItems:function (val) {
                localStorage.setItem('pageItems' , val);
            },

        },

        mounted() {

            this.checkAuth();

            if (localStorage.getItem('pageItems')){
                this.v_postItems = localStorage.getItem('pageItems');
            }

            if (this.$route.params.slug){

                if (this.$route.params.slug === 'create-post'){
                    this.flag_createPost = true;
                    this.selectedPostArray = [];
                    this.selectSearchType();
                    this.goToFunction(this.currentPage);
                } else {
                    this.postSlug = this.$route.params.slug;
                    this.$Progress.start();
                    this.selectSearchType();

                    axios.get('/api/postBySlug/'+this.postSlug + '/' + this.v_postItems).then(res=>{
                        this.$Progress.finish();
                        this.selectedPostArray = res.data.post;
                        this.selectedPostId = res.data.post.id;
                        this.currentPage = res.data.page;
                        this.hasLike();
                        this.checkPostFiles();
                        this.goToFunction(this.currentPage);
                        setTimeout(() => {
                            const firstScrollTo = scroller();
                            firstScrollTo('#post'+this.selectedPostId)
                        } , 1000);


                    }).catch(err=>{
                        alert();
                        console.log(err);
                    })
                }
            } else {
                this.selectSearchType();
                this.goToFunction(1);
                this.checkPostFiles();
            }

            this.createYearsLoop();
            this.getTags();


        },
        computed: {

        },

        methods: {

            selectPost: function (postId) {

                this.flag_createPost = false;

                this.$Progress.start()

                axios.get('/api/post/'+postId).then(res=>{
                    this.$Progress.finish()
                    this.selectedPostArray = res.data.post;
                    this.hasLike();
                    this.checkPostFiles();
                }).catch(err=>{
                    console.log(err);
                })

                this.selectedPostId = postId;



            },

            createPost: function () {
                if (!this.flag_isAuth){
                    this.$notify({
                        group: 'auth',
                        type: 'error',
                        duration: 40000,
                        text: 'برای ایجاد پست باید به پروفایل خود وارد شوید یا ثبت نام کنید'
                    });
                    return;
                }
                this.$Progress.start()
                setTimeout(() => {
                    this.$Progress.finish()
                },2000);
                this.flag_createPost = true;
                this.selectedPostArray = []
                this.getTags();

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

                    axios.post('/api/storePost' , {'title':this.v_postTitle , 'description':description , 'tags':this.value , 'uploadedFiles':this.uploadedFile , 'editorPhotos':editorPhotoIds , 'editorPhotosPath':editorPhotosPath , 'categoryId':this.categoryId}).then(res=>{
                        console.log(res);
                        this.flag_createPost = false;
                        this.$Progress.finish();
                        this.selectPost(res.data);
                        this.goToFunction(1);
                        this.$notify({
                            group: 'auth',
                            type: 'success',
                            duration: 25000,
                            text: 'پست شما با موفقیت ثبت شد'
                        });
                    }).catch(err=>{
                        console.log(err);
                    })
                },2500);

            },


            goToFunction : function(n)
            {
                this.$Progress.start();
                var searchKeyword = this.v_searchQuery;
                if (this.v_searchQuery === ''){
                    searchKeyword = 'noSearch';
                }
                var searchTag = this.value_search.id;

                this.currentPage = n;
                axios.get('/api/posts/'+ this.categoryid + '/' + searchKeyword + '/' + this.searchType + '/' + this.v_timeFilter + '/' + this.v_otherFilters + '/' + this.v_order + '/' + searchTag + '/' + this.v_postItems + '/' + '/?page='+n).then(res=>{

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
                        this.$Progress.fail();
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
                            this.$Progress.fail();
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
                            for (var i3=0; i3<this.selectedPostArray.likes.length; i3++) {
                                if (this.selectedPostArray.likes[i3].user_id === this.user.id) {
                                    this.selectedPostArray['liked'] = 1;
                                } else {
                                    this.selectedPostArray['liked'] = 0;
                                }
                            }

                            for (var i2 = 0; i2 < this.selectedPostArray.comments.length; i2++) {
                                        for (var i4=0; i4<this.selectedPostArray.comments[i2].likes.length; i4++) {
                                            if (this.selectedPostArray.comments[i2].likes[i4].user_id === this.user.id) {
                                                this.selectedPostArray.comments[i2]['liked'] = 1;
                                            } else {
                                                this.selectedPostArray.comments[i2]['liked'] = 0;
                                        }
                                    }
                            }
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
                    'postId' : this.selectedPostId,
                    'parent_id' : commentParentId
                }).then(res=>{
                    this.flag_answerComment = '';
                    this.selectPost(this.selectedPostId);
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        duration: 20000,
                        text: 'نظر شما با موفقیت ثبت شد'
                    });
                }).catch(err=>{
                    if(err.response.data.message === 'Unauthenticated.') {
                            this.$notify({
                                group: 'auth',
                                type: 'error',
                                duration: 20000,
                                text: 'برای ارسال نظر باید به حساب کاربری خود وارد شوید یا در سایت ثبت نام کنید'
                            });
                    }
                });
                },1000);
            },

            avatarSRC(event) {
                event.target.src = this.images;
            },

            checkPostFiles:function(){
                this.flag_hasFile = false;
                    if (this.selectedPostArray.photos.length > 0){
                        for(var i=0; i<this.selectedPostArray.photos.length; i++){
                            if (this.selectedPostArray.photos[i].type !== null){
                                this.flag_hasFile = true;
                            }
                        }
                    }

            },

            answerCommentBoxShow:function (commentId){
                this.flag_answerComment = commentId;
            },

            sendCommentFromChild(response) {
                if(response === 'sent'){
                    this.selectPost(this.selectedPostId);
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        duration: 20000,
                        text: 'نظر شما با موفقیت ثبت شد'
                    });
                } else if (response === 'sent-error-auth'){
                    this.$notify({
                        group: 'auth',
                        type: 'error',
                        duration: 20000,
                        text: 'برای ارسال نظر باید به حساب کاربری خود وارد شوید یا در سایت ثبت نام کنید'
                    });
                }  else if(response === 'liked'){
                    this.selectPost(this.selectedPostId);
                } else if (response === 'not-auth'){
                    this.$notify({
                        group: 'auth',
                        type: 'error',
                        duration: 20000,
                        text: 'برای لایک کردن پست ها باید به حساب کاربری خود وارد شوید یا در سایت ثبت نام کنید'
                    });
                } else if (response === 'error') {
                    this.$notify({
                        group: 'auth',
                        type: 'error',
                        duration: 20000,
                        text: 'مشکلی در برقراری ارتباط پیش آمده، لطفا لحظاتی دیگر امتحان کنید'
                    });
                }
            }


        }
    }
</script>

<!--multi select for tags style-->
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>