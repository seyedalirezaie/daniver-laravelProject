@extends('frontend.layout.master' , ['container' => 'container-fluid'])

@section('styles')
    <link rel="stylesheet" href="/js/emojionearea-master/dist/emojionearea.min.css">
@endsection

@section('content')

    <div class="container-fluid pl-5">
        <div class="row mt50">

            <div class="col col-xl-8 m-auto col-lg-8 col-md-12 col-sm-12 col-12">
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
                                <svg class="olymp-calendar-icon">
                                    <use xlink:href="#olymp-calendar-icon"></use>
                                </svg>
                                <div class="post-date text-right">
                                    <span>تاریخ انتشار:</span>
                                    <span class="h6 date">{{$post->displayed_at ? $post->displayed_at : ''}}</span>
                                </div>
                            </div>
                            <div class="post-comments-wrap inline-items post-comments-count">
                                <svg class="olymp-comments-post-icon">
                                    <use xlink:href="#olymp-comments-post-icon"></use>
                                </svg>
                                <div class="post-comments text-right">
                                    <span>نظرات</span>
                                    <span class="h6 comments">{{$post->comments_count}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="post-thumb">
                            <img src="{{$post->path_lg}}" alt="{{$post->title}}" title="{{$post->title}}">
                        </div>


                        <div class="post-content-wrap">



                            <div class="post-content text-right">
                                <div><?php echo $post->description ?></div>
                            </div>
                        </div>

                        <div class="choose-reaction text-right">

                            <span class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                </svg>
                                <span>{{$post->likes_count}}</span>
                            </span>

                            <div class="comments-shared mr-3 d-inline-block">
                                <span class="post-add-icon inline-items">
                                    <svg class="olymp-speech-balloon-icon">
                                        <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use>
                                    </svg>
                                    <span>{{$post->comments_count}}</span>
                                </span>
                            </div>

                        </div>

                        @if(!empty($post->tags))
                        <div class="choose-reaction">
                            <div class="title text-right">هشتگ ها</div>

                            <ul class="tags-show" dir="rtl">
                                @foreach($post->tags as $tag)
                                <li><a href="#" class="tag-show">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>

                        </div>
                        @endif

                        @if($hasFile == 1)
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
                        @endif

                        @if(count($post->mentions) > 0)
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
                        @endif



                    </article>

                    <!-- ... end Single Post -->


                    <!-- Comments -->

                    <div class="fs0-9 p-4">
                        <i class="fas fa-comments mr-4"></i>
                        نظرات
                    </div>



                    <ul class="comments-list style-2">
                        @foreach($post->comments as $comment)
                        @if($comment->parent_id == '')
                        <li class="comment-item has-children">
                            <div class="post__author author vcard">
                                <img src="{{$comment->user->path_sm}}" alt="{{$comment->user->family}}">

                                <div class="author-date pt-0">
                                    <div class="comment-show"><span class="post__author-name fn fs0-8 text-primary mr-1 cursor-pointer ml-2">{{$comment->user->family}}</span>
                                        <?php echo $comment->description ?>
                                    </div>
                                    <span {{--v-bind:class="{'post-comment-like': comment.liked === 1}"--}} class="post-add-icon inline-items cursor-pointer" {{--@click="doLike(comment.id , 'comment')"--}}>
                                        <svg class="olymp-heart-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                        <span>{{$comment->likes_count}}</span>
                                    </span>
                                    <span {{--@click="answerCommentBoxShow(comment.id)"--}} class="reply cursor-pointer text-grey-lighter btn-reply-comment">پاسخ دادن</span>

                                    <div class="post__date">
                                        <time class="published fs0-75 text-grey-lighter" datetime="">
                                            {{$comment->date}}
                                        </time>
                                    </div>

                                    <div class="{{--answer-comment-box-{{$comment->id}}--}} mt-3 mb-2 emoji-comment-answer">

                                        <textarea class="emoji-area-editor"></textarea>

                                        <button {{--@click="postComment(comment.id)"--}} class="btn btn-sm btn-green mt-2">ارسال پاسخ</button>
                                        <button class="btn btn-sm btn-secondary mt-2 btn-cancel-answer">لغو</button>
                                    </div>

                                </div>

                            </div>

                            @if(!empty($comment->child))
                                @include('partials.comment' , ['children' => $comment->child])
                            @endif
                            {{--<comment v-on:send_comment="sendCommentFromChild" v-if="comment.child.length > 0" :post="selectedPostArray" :children="comment.child" :user_id="user.id"></comment>--}}
                        </li>
                        @endif
                        @endforeach
                    </ul>

                    <div class="{{--answer-comment-box-{{$comment->id}}--}} mt-3 mb-2">

                        <textarea class="emoji-area-editor"></textarea>

                        <button {{--@click="postComment(comment.id)"--}} class="btn btn-sm btn-green mt-2">ارسال پاسخ</button>
                    </div>

                    <!-- ... end Comments -->

                    <a href="#" class="more-comments">View more comments <span>+</span></a>


                    <!-- Comment Form  -->

                    <form class="comment-form inline-items">

                        <div class="post__author author vcard inline-items">
                            <img src="/frontend/img/author-page.jpg" alt="author">

                            <div class="form-group with-icon-right is-empty">
                                <textarea class="form-control" placeholder=""></textarea>
                                <div class="add-options-message">
                                    <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                                        <svg class="olymp-camera-icon">
                                            <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-camera-icon"></use>
                                        </svg>
                                    </a>
                                </div>
                                <span class="material-input"></span></div>
                        </div>

                        <button class="btn btn-md-2 btn-primary">Post Comment</button>

                        <button class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">Cancel</button>

                    </form>

                    <!-- ... end Comment Form  -->
                </div>
            </div>

            <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <aside>
                    <div class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">Featured Posts</h6>
                        </div>
                    </div>

                    <div class="ui-block">


                        <!-- Post -->

                        <article class="hentry blog-post blog-post-v3 featured-post-item">

                            <div class="post-thumb">
                                <img src="/frontend/img/post13.jpg" alt="photo">
                                <a href="#" class="post-category bg-purple">INSPIRATION</a>
                            </div>

                            <div class="post-content">

                                <div class="author-date">
                                    by
                                    <a class="h6 post__author-name fn" href="#">JACK SCORPIO</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            - 5 MONTHS ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="h4 post-title">We went lookhunting in all the California bay area</a>

                                <div class="post-additional-info inline-items">

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat26.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat27.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat2.png" alt="icon">
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="names-people-likes">
                                        206
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>97</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </article>

                        <!-- ... end Post -->

                    </div>

                    <div class="ui-block">


                        <!-- Post -->

                        <article class="hentry blog-post blog-post-v3 featured-post-item">

                            <div class="post-thumb">
                                <img src="/frontend/img/post14.jpg" alt="photo">
                                <a href="#" class="post-category bg-blue-light">THE COMMUNITY</a>
                            </div>

                            <div class="post-content">

                                <div class="author-date">
                                    by
                                    <a class="h6 post__author-name fn" href="#">JACK SCORPIO</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            - 2 MONTHS ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="h4 post-title">We went lookhunting in all the California bay area</a>

                                <div class="post-additional-info inline-items">

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat6.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat7.png" alt="icon">
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="names-people-likes">
                                        37
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>62</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </article>

                        <!-- ... end Post -->

                    </div>

                    <div class="ui-block">


                        <!-- Post -->

                        <article class="hentry blog-post blog-post-v3 featured-post-item">

                            <div class="post-thumb">
                                <img src="/frontend/img/post15.jpg" alt="photo">
                                <a href="#" class="post-category bg-purple">INSPIRATION</a>
                            </div>

                            <div class="post-content">

                                <div class="author-date">
                                    by
                                    <a class="h6 post__author-name fn" href="#">MADDY SIMMONS </a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            - 3 MONTHS ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="h4 post-title">Check out this 10 yummy breakfast recipes</a>

                                <div class="post-additional-info inline-items">

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat20.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat11.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat9.png" alt="icon">
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="names-people-likes">
                                        88
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>39</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </article>

                        <!-- ... end Post -->
                    </div>

                    <div class="ui-block">


                        <!-- Post -->

                        <article class="hentry blog-post blog-post-v3 featured-post-item">

                            <div class="post-thumb">
                                <img src="/frontend/img/post16.jpg" alt="photo">
                                <a href="#" class="post-category bg-primary">OLYMPUS NEWS</a>
                            </div>

                            <div class="post-content">

                                <div class="author-date">
                                    by
                                    <a class="h6 post__author-name fn" href="#">JACK SCORPIO</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            - 6 MONTHS ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="h4 post-title">We optimized the Olympus App for better navigation</a>

                                <div class="post-additional-info inline-items">

                                    <ul class="friends-harmonic">
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat1.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat26.png" alt="icon">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="/frontend/img/icon-chat27.png" alt="icon">
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="names-people-likes">
                                        93
                                    </div>

                                    <div class="comments-shared">
                                        <a href="#" class="post-add-icon inline-items">
                                            <svg class="olymp-speech-balloon-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                            <span>105</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </article>

                        <!-- ... end Post -->

                    </div>

                </aside>
            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{asset('/js/emojionearea-master/dist/emojionearea.min.js')}}"></script>

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


    </script>

@endsection