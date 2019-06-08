@extends('frontend.layout.master')

@section('content')

    <div class="container">
        <div class="row mt50">

            <div class="col col-xl-8 m-auto col-lg-12 col-md-12 col-sm-12 col-12">
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
                                    <span class="h6 date">{{$post->full_date}}</span>
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
                                <blog-post-content-show-component :post="{{$post}}"></blog-post-content-show-component>
                            </div>
                        </div>

                        <div class="choose-reaction">
                            <div class="title">Choose your <span>Reaction!</span></div>

                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat13.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="LOL">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat15.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="Amazed">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat9.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="ANGER">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat4.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="joy">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat6.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="BAD">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat26.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="LIKE">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat27.png" alt="icon" data-toggle="tooltip" data-placement="top" data-original-title="COOL">
                                    </a>
                                </li>
                            </ul>

                        </div>

                        <div class="socials-shared">
                            <a href="#" class="social-item bg-facebook">
                                <svg class="svg-inline--fa fa-facebook-f fa-w-9" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg=""><path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path></svg><!-- <i class="fab fa-facebook-f" aria-hidden="true"></i> -->
                            </a>
                            <a href="#" class="social-item bg-twitter">
                                <svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter" aria-hidden="true"></i> -->
                            </a>
                            <a href="#" class="social-item bg-google">
                                <svg class="svg-inline--fa fa-google-plus-g fa-w-20" aria-hidden="true" data-prefix="fab" data-icon="google-plus-g" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z"></path></svg><!-- <i class="fab fa-google-plus-g" aria-hidden="true"></i> -->
                            </a>
                        </div>

                    </article>

                    <!-- ... end Single Post -->


                    <!-- Comments -->

                    <ul class="comments-list">
                        <li class="comment-item">
                            <div class="post__author author vcard inline-items">
                                <img src="/frontend/img/avatar10-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Elaine Dreyfuss</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            5 mins ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="more">
                                    <svg class="olymp-three-dots-icon">
                                        <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                    </svg>
                                </a>

                            </div>

                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque laudantium.</p>

                            <a href="#" class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                </svg>
                                <span>8</span>
                            </a>
                            <a href="#" class="reply">Reply</a>
                        </li>
                        <li class="comment-item has-children">
                            <div class="post__author author vcard inline-items">
                                <img src="/frontend/img/avatar5-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            1 hour ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="more">
                                    <svg class="olymp-three-dots-icon">
                                        <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                    </svg>
                                </a>

                            </div>

                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugiten, sed quia
                                consequuntur magni dolores eos qui ratione voluptatem sequi en lod nesciunt. Neque porro
                                quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur adipisci velit en lorem ipsum der.
                            </p>

                            <a href="#" class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                </svg>
                                <span>5</span>
                            </a>
                            <a href="#" class="reply">Reply</a>

                            <ul class="children">
                                <li class="comment-item">
                                    <div class="post__author author vcard inline-items">
                                        <img src="/frontend/img/avatar8-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Diana Jameson</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    39 mins ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more">
                                            <svg class="olymp-three-dots-icon">
                                                <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                            </svg>
                                        </a>

                                    </div>

                                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                            <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>2</span>
                                    </a>
                                    <a href="#" class="reply">Reply</a>
                                </li>
                                <li class="comment-item">
                                    <div class="post__author author vcard inline-items">
                                        <img src="/frontend/img/avatar2-sm.jpg" alt="author">

                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="#">Nicholas Grisom</a>
                                            <div class="post__date">
                                                <time class="published" datetime="2017-03-24T18:18">
                                                    24 mins ago
                                                </time>
                                            </div>
                                        </div>

                                        <a href="#" class="more">
                                            <svg class="olymp-three-dots-icon">
                                                <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                            </svg>
                                        </a>

                                    </div>

                                    <p>Excepteur sint occaecat cupidatat non proident.</p>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-heart-icon">
                                            <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                        </svg>
                                        <span>0</span>
                                    </a>
                                    <a href="#" class="reply">Reply</a>

                                </li>
                            </ul>

                        </li>

                        <li class="comment-item">
                            <div class="post__author author vcard inline-items">
                                <img src="/frontend/img/avatar4-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Chris Greyson</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            1 hour ago
                                        </time>
                                    </div>
                                </div>

                                <a href="#" class="more">
                                    <svg class="olymp-three-dots-icon">
                                        <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use>
                                    </svg>
                                </a>

                            </div>

                            <p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>

                            <a href="#" class="post-add-icon inline-items">
                                <svg class="olymp-heart-icon">
                                    <use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
                                </svg>
                                <span>7</span>
                            </a>
                            <a href="#" class="reply">Reply</a>

                        </li>
                    </ul>

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