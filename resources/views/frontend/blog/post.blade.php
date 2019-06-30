@extends('frontend.layout.master'/* , ['container' => 'container-fluid']*/)

@section('titleTag')
    <title>{{$post->title}}</title>
@endsection
@section('metaDescription')
    <meta name="description" content="{{$post->meta_description}}">
@endsection
@section('metaKeywords')
    <meta name="keywords" content="{{$post->meta_keywords}}">
@endsection

@section('styles')
    <link rel="stylesheet" href="/js/emojionearea-master/dist/emojionearea.min.css">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row mt50">

            <div class="col col-xl-9 m-auto col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="ui-block" dir="rtl">


                    <!-- Single Post -->

                    <article class="hentry blog-post single-post single-post-v2">

                        <a href="#" class="post-category bg-blue-light fs0-8">{{$post->category->title}}</a>
                        <h1 class="h1 post-title fs2">{{$post->title}}</h1>

                        <div class="single-post-additional inline-items">
                            <div class="post__author author vcard inline-items">
                                <img title="{{$post->user->familly}}" alt="{{$post->user->familly}}" src="{{$post->user->path_sm}}" class="avatar">
                                <div class="author-date not-uppercase text-right">
                                    <div class="author_prof">
                                        نوشته
                                    </div>
                                    <a class="h6 post__author-name fn" href="#">{{$post->user->family}}</a>

                                </div>
                            </div>
                            <div class="post-date-wrap inline-items post-date-center">
                                <div class="post-date text-center">
                                    <span>تاریخ انتشار:</span>
                                    <span class="h6 date">{{$post->displayed_at ? $post->displayed_at : ''}}</span>
                                </div>
                            </div>
                            <div class="post-comments-wrap inline-items post-comments-count">
                                <div class="post-comments text-center">
                                    <span>نظرات</span>
                                    <span class="h6 comments">{{$post->comments_count}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="post-thumb">
                            <img src="{{$post->path_lg}}" alt="{{$post->title}}" title="{{$post->title}}">
                        </div>


                        <div class="post-content-wrap">



                            <div class="post-content text-right p-0">
                                <div><?php echo $post->description ?></div>
                            </div>
                        </div>

                    </article>
                </div>

                <div class="ui-block" dir="rtl">
                    <div class="choose-reaction text-right border-0 mt-3 position-relative">


                        <div class="control-block-button post-control-button like-bookmark">
                            <span onclick="doLike('{{$post->id}}' , 'post')" class="btn btn-control d-inline-block btn-like {{$post->liked == 1 ? 'liked-circle' : ''}}"><svg class="svg-inline--fa fa-heart fa-w-18" aria-hidden="true" data-prefix="far" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M257.3 475.4L92.5 313.6C85.4 307 24 248.1 24 174.8 24 84.1 80.8 24 176 24c41.4 0 80.6 22.8 112 49.8 31.3-27 70.6-49.8 112-49.8 91.7 0 152 56.5 152 150.8 0 52-31.8 103.5-68.1 138.7l-.4.4-164.8 161.5a43.7 43.7 0 0 1-61.4 0zM125.9 279.1L288 438.3l161.8-158.7c27.3-27 54.2-66.3 54.2-104.8C504 107.9 465.8 72 400 72c-47.2 0-92.8 49.3-112 68.4-17-17-64-68.4-112-68.4-65.9 0-104 35.9-104 102.8 0 37.3 26.7 78.9 53.9 104.3z"></path></svg><!-- <i class="far fa-heart"></i> --></span>
                            <span onclick="bookmarkPost('{{$post->id}}')" class="btn btn-control btn-comment-circle btn-bookmark d-inline-block {{$post->bookmarked == 1 ? 'liked-circle' : ''}}"><svg class="svg-inline--fa fa-bookmark fa-w-12" aria-hidden="true" data-prefix="far" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M336 0H48C21.49 0 0 21.49 0 48v464l192-112 192 112V48c0-26.51-21.49-48-48-48zm0 428.43l-144-84-144 84V54a6 6 0 0 1 6-6h276c3.314 0 6 2.683 6 5.996V428.43z"></path></svg><!-- <i class="far fa-bookmark"></i> --></span>
                        </div>

                            <span class="post-add-icon inline-items">
                                <i class="far fa-heart fs1-3"></i>
                                <span class="likes-count">{{$post->likes_count}}</span>
                            </span>

                        <div class="comments-shared mr-3 d-inline-block">
                                <span class="post-add-icon inline-items">
                                    <i class="far fa-comments fs1-3"></i>
                                    <span class="comments-count">{{$post->comments_count}}</span>
                                </span>
                        </div>

                    </div>
                </div>

                    @if(count($post->tags) > 0)
                    <div class="ui-block" dir="rtl">
                        <div class="choose-reaction border-0">
                            <div class="title text-right">هشتگ ها</div>

                            <ul class="tags-show" dir="rtl">
                                @foreach($post->tags as $tag)
                                    <li><a href="#" class="tag-show">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    @endif

                    @if($hasFile == 1)
                    <div class="ui-block" dir="rtl">
                        <div class="choose-reaction">
                            <div class="title text-right">فایل های ضمیمه</div>

                            <ul class="notification-list friend-requests">

                                @foreach($post->photos as $postFile)
                                    @if($postFile->type != '')
                                        <li class="file-items">


                                                <span class="notification-icon btn-download-file">
                                                    <a href="/files/{{$postFile->path}}" class="accept-request request-del" title="دانلود">
												        <span class="icon-minus minus-delete">
													        <i class="fas fa-download fs1-4"></i>
												        </span>
                                                    </a>
                                                </span>


                                            <div class="author-thumb text-center">
                                                @if($postFile->type === 'pdf')
                                                    <i class="text-danger fas fa-file-pdf fs1-6 mt-1"></i>
                                                @elseif($postFile->type === 'ppt' || $postFile->type === 'pptx')
                                                    <i class="text-primary fas fa-file-powerpoint fs1-6 mt-1"></i>
                                                @elseif($postFile->type === 'xls' || $postFile->type === 'xlsx')
                                                    <i class="text-green fas fa-file-excel fs1-6 mt-1"></i>
                                                @elseif($postFile->type === 'doc' || $postFile->type === 'docx' || $postFile->type === 'rtf')
                                                    <i class="text-blue fas fa-file-word fs1-6 mt-1"></i>
                                                @elseif($postFile->type === 'zip' || $postFile->type === 'rar')
                                                    <i class="fas fa-file-archive fs1-6 mt-1"></i>
                                                @endif
                                            </div>

                                            <div class="notification-event">
                                                <p href="#" class="h6 notification-friend fs0-8 m-0">{{$postFile->original_name}}</p>


                                                @if($postFile->size < 512)
                                                    <span class="chat-message-item mr-3 fs0-7">{{$postFile->size}}
                                            کیلوبایت</span>
                                                @else
                                                    <span class="chat-message-item mr-3 fs0-85">{{round(($postFile->size * 0.0009765625) , 2)}} مگابایت</span>
                                                @endif
                                            </div>

                                        </li>
                                    @endif
                                @endforeach


                            </ul>
                        </div>
                     </div>
                    @endif

                    @if(count($post->mentions) > 0)
                    <div class="ui-block" dir="rtl">
                        <div class="choose-reaction">
                            <div class="title text-right">کاربران تگ شده</div>

                            <ul class="widget w-faved-page js-zoom-gallery newest-users">

                                @foreach($post->mentions as $mention)
                                    <li class="mentions-post">
                                        <a href="/profile/{{$mention->user->url}}">
                                            <img width="40" src="{{$mention->user->path_sm}}" title="{{$mention->user->family}}" alt="{{$mention->user->family}}">
                                        </a>
                                        <a class="fs0-7 cursor-pointer">{{$mention->user->familyy}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endif


                    <!-- ... end Single Post -->

                <div class="ui-block blog-comment-container" dir="rtl">

                    <!-- Comments -->

                    <div class="fs0-9 p-4">
                        <i class="fas fa-comments mr-4"></i>
                        نظرات
                    </div>



                    <ul class="comments-list style-2">
                        @foreach($post->comments as $comment)
                        @if($comment->parent_id == '')
                        <li class="comment-item has-children blog-comment">
                            <div class="post__author author vcard">
                                <img src="{{$comment->user->path_sm}}" alt="{{$comment->user->family}}">

                                <div class="author-date pt-0">
                                    <div class="comment-show"><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{$comment->user->family}}:</span>
                                        <?php echo $comment->description ?>
                                    </div>
                                    <span onclick="doLike('{{$comment->id}}' , 'comment' , this)" class="post-add-icon inline-items cursor-pointer {{$comment->liked == 1 ? 'post-comment-like' : ''}}" {{--@click="doLike(comment.id , 'comment')"--}}>
                                        <i class="far fa-heart fs1-3"></i>
                                        <span>{{$comment->likes_count}}</span>
                                    </span>
                                    <span class="reply cursor-pointer text-grey-lighter btn-reply-comment">پاسخ دادن</span>

                                    <div class="post__date">
                                        <time class="published fs0-75 text-grey-lighter" datetime="">
                                            {{$comment->date}}
                                        </time>
                                    </div>

                                    <div class="mt-3 mb-2 emoji-comment-answer">

                                        <textarea class="emoji-area-editor form-control" placeholder="متن نظر"></textarea>

                                        <button onclick="postComment(this , '{{$post->id}}' , '{{$comment->id}}')" class="btn btn-sm btn-green mt-2">ارسال پاسخ</button>
                                        <button class="btn btn-sm btn-secondary mt-2 btn-cancel-answer">لغو</button>
                                    </div>

                                </div>

                            </div>

                            @if(!empty($comment->child))
                                @include('partials.comment' , ['children' => $comment->child , 'postId' => $post->id])
                            @endif
                        </li>
                        @endif
                        @endforeach
                    </ul>

                    <div class="{{--answer-comment-box-{{$comment->id}}--}} mt-3 mb-2">

                        <textarea class="emoji-area-editor form-control" placeholder="متن نظر"></textarea>

                        <button onclick="postComment(this , '{{$post->id}}')" {{--@click="postComment(comment.id)"--}} class="btn btn-sm btn-green mt-2 mr-3">ارسال نظر</button>
                    </div>

                    <!-- ... end Comments -->

                </div>
            </div>


            <div class="col col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <aside>

                    <aside>
                        <div class="ui-block">
                            <div class="ui-block-title">
                                <span class="title text-right">جدیدترین اعضای سایت</span>
                            </div>
                            <div class="ui-block-content newest-users-block">
                                <ul class="widget w-faved-page newest-users">
                                    @foreach($newestUsers as $user)
                                        <li>
                                            <a target="_blank" href="/profile/{{$user->alias ? $user->alias : $user->id}}" class="latest-users">
                                                <img src="{{$user->path_sm}}" alt="{{$user->family}}" title="{{$user->family}}">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @if(count($favoritePosts) > 0)
                            <div class="ui-block">
                                <div class="ui-block-title px-2">
                                    <h6 class="title fs0-8">محبوب ترین های پست های هفته گذشته</h6>
                                </div>
                            </div>

                            <div class="ui-block bg-transparent" dir="rtl">

                                <ul class="list-group sidebar-scroll favorite-posts">
                                    @foreach($favoritePosts as $post)
                                        <li class="post-item-list pt-1 pr-1 mb-2 more-liked-posts">

                                            <div class="container-fluid">
                                                <div class="row">

                                                    <div class="col-12 p-1 mb-2 text-right more-liked-posts-category">
                                                        <span class="bg-primary text-white px-1 ml-0 fs0-7">{{$post->category->name}}</span>
                                                        <span class="bg-purple text-white px-1 mr-0 fs0-7">{{$post->category->titles}}</span>
                                                    </div>

                                                    <div class="col-3">
                                                        <a href="/{{$post->category->url}}/posts/{{$post->category->slug}}/{{$post->slug}}">
                                                            <img width="60px" class="favorite-posts-preview" src="{{$post->path_sm}}" alt="{{$post->title}}" title="{{$post->title}}">
                                                        </a>
                                                    </div>

                                                    <div class="composition col-9">
                                                        <a href="/{{$post->category->url}}/posts/{{$post->category->slug}}/{{$post->slug}}" class="composition-name">{{$post->title}}</a>
                                                        <a href="/profile/{{$post->user->url}}" target="_blank" class="composition-author mt-2 position-relative">
                                                            <img width="30px" class="rounded-circle" src="{{$post->user->path_sm}}" alt="{{$post->user->family}}" title="{{$post->user->family}}">
                                                            {{$post->user->family}}
                                                            @if($post->is_guest == 1)
                                                                <span class="badge badge-primary badge-guest h6 text-white">مهمان</span>
                                                            @endif
                                                        </a>

                                                    </div>

                                                    <div class="col-12 mt-3">

                                        <span class="notification-date time-post-list float-left"><span class="entry-date updated">{{$post->date}}</span>
                                        </span>

                                                        <div class="comments-shared d-inline-block float-right"><span class="post-add-icon inline-items mr-0"><i class="far fa-comments fs1-2"></i><span>{{$post->comments_count}}</span></span> <span class="post-add-icon inline-items"><i class="far fa-heart fs1-2"></i> <span>{{$post->likes_count}}</span></span></div>
                                                    </div>

                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="ui-block">
                            <div class="ui-block-title text-right">
                                <h6 class="title">پست های ویژه</h6>
                            </div>
                        </div>

                        @if(count($featuredPosts) > 0)
                            <div class="ui-block bg-transparent">


                                <!-- Post -->

                                @foreach($featuredPosts as $post)
                                    <article class="hentry blog-post blog-post-v3 featured-post-item bg-white mb-3">

                                        <div class="post-thumb">
                                            <img src="{{$post->path_md}}" alt="photo">
                                            <span class="dark-on-img"></span>
                                            <a href="#" class="post-category bg-purple fs0-7">{{$post->category->title}}</a>
                                        </div>

                                        <div class="post-content">

                                            <div class="author-date" dir="rtl">
                                                نوشته
                                                <a class="post__author-name fn mr-1 ml-3" target="_blank" href="/profile/{{$post->user->url}}">{{$post->user->family}}</a>
                                                <div class="post__date">
                                                    <time class="published" datetime="2017-03-24T18:18">
                                                        {{$post->date}}
                                                    </time>
                                                </div>
                                            </div>

                                            <a href="{{$post->category->url}}/posts/{{$post->category->slug}}/{{$post->slug}}" class="h6 post-title">{{$post->title}}</a>

                                            <div dir="rtl" class="post-additional-info inline-items">
                                                <div class="comments-shared">
                                                    <a href="#" class="post-add-icon inline-items">
                                                        <i class="far fa-heart fs1-3"></i>
                                                        <span>{{$post->likes_count}}</span>
                                                    </a>
                                                </div>

                                                <div class="comments-shared">
                                                    <a href="#" class="post-add-icon inline-items">
                                                        <i class="far fa-comments fs1-3"></i>
                                                        <span>{{$post->comments_count}}</span>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </article>
                            @endforeach

                            <!-- ... end Post -->

                            </div>
                        @endif

                    </aside>


                </aside>
            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{asset('/js/emojionearea-master/dist/emojionearea.min.js')}}"></script>
    <script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script src="/js/ckeditor/translations/fa.js"></script>
    <script src="{{asset('/js/notifyjs.js')}}"></script>
    <script>

        $(document).ready(function () {
            $(".emoji-area-editor").emojioneArea({
                attributes: {
                    dir: "rtl",
                }
            });
        });

        $(document).on('click', '.btn-reply-comment', function () {
            $('.emoji-comment-answer').slideUp(0);
            $(this).parent().find('.emoji-comment-answer').slideDown();
        });

        $(document).on('click', '.btn-cancel-answer', function () {
            $('.emoji-comment-answer').slideUp();
        })

        function doLike(itemId , type , tag=null){
            $.ajax({
                type: 'POST',
                url: '/api/doLike' +'?_token=' + '{{ csrf_token() }}',
                data: {'id': itemId , 'type':type},
                success: function (data){
                    if (type === 'post'){
                        var likeBtn = $('.btn-like');
                        likeBtn.toggleClass('liked-circle');
                        var oldLikes = parseFloat($('.likes-count').text());
                        if (likeBtn.hasClass('liked-circle')){
                            var newLikes = oldLikes + 1;
                        } else {
                            var newLikes = oldLikes - 1;
                        }
                        $('.likes-count').text(newLikes);

                    }

                    if (type === 'comment'){
                        var thisTag = $(tag);
                        thisTag.toggleClass('post-comment-like');

                        var oldLikes = parseFloat(thisTag.find('span').text());
                        if (thisTag.hasClass('post-comment-like')){
                            var newLikes = oldLikes + 1;
                        } else {
                            var newLikes = oldLikes - 1;
                        }
                        thisTag.find('span').text(newLikes);
                    }


                },
                error: function(e) {
                    if (e.responseJSON.message === 'Unauthenticated.'){
                        $.notify("برای لایک کردن پست ها و نظرات لازم است وارد حساب کاربری خود شوید یا ثبت نام کنید", {
                            autoHideDelay: 15000,
                            globalPosition: 'bottom left',
                            className: 'error',
                        });
                    }
                }});
        }

        function bookmarkPost(itemId) {
            $.ajax({
                type: 'POST',
                url: '/api/doBookmark' +'?_token=' + '{{ csrf_token() }}',
                data: {'postId': itemId},
                success: function (data){
                    $('.btn-bookmark').toggleClass('liked-circle');
                },
                error: function(e) {
                    if (e.responseJSON.message === 'Unauthenticated.'){
                        $.notify("برای نشان کردن پست ها لازم است وارد حساب کاربری خود شوید یا ثبت نام کنید", {
                            autoHideDelay: 15000,
                            globalPosition: 'bottom left',
                            className: 'error',
                        });
                    }
                }});
        }

        function postComment(tag , postId , parentId=null) {
            var thisTag = $(tag);
            var description = thisTag.parent().find('.emojionearea-editor').html();
            $.ajax({
                type: 'POST',
                url: '/api/postComment' +'?_token=' + '{{ csrf_token() }}',
                data: {'comment' : description , 'postId': postId , 'parent_id' : parentId},
                success: function (data){
                    window.location.reload();
                },
                error: function(e) {
                    if (e.responseJSON.message === 'Unauthenticated.'){
                        $.notify("برای ارسال نظر لازم است وارد حساب کاربری خود شوید یا ثبت نام کنید", {
                            autoHideDelay: 15000,
                            globalPosition: 'bottom left',
                            className: 'error',
                        });
                    }
                }});

        }






    </script>

@endsection