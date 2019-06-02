@extends('frontend.layout.master')

@section('titleTag')
    <title>شبکه اجتماعی دانشگاه ولی عصر رفسنجان</title>
@endsection
@section('metaDescription')
    <meta name="description" content="در شبکه اجتماعی دانشگاه ولی عصر رفسنجان با دوستان خود گفتگو کنید اجناس دست دوم خود را در بفروشید سوالات درسی خود را مطرح کنید از اتفاقات خوابگاه ها باخبر شوید">
@endsection
@section('metaKeywords')
    <meta name="keywords" content="دانشگاه ولی عصر رفسنجان,شبکه اجتماعی رفسنجان,دانشگاه رفسنجان,دانشجویان رفسنجان,اخبار دانشگاه ولی عصر رفسنجان,بچه های دانشگاه ولی عصر رفسنجان,رفسنجان,رفسنجون,دانشگاه ولیعصر,دانشگاه رفسنجون">
@endsection

@section('content')

    <div class="row py-4" dir="rtl">
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">


            <!-- Info Box  -->

            <a href="{{route('study')}}" class="crumina-module crumina-info-box p-5" data-mh="box--classic" style="height: 299.4px;">
                <div class="info-box-image">
                    <img width="45%" src="/frontend/svg-icons/books.svg" alt="icon">
                </div>
                <div class="info-box-content">
                    <h4 class="info-box-title">درس و بحث</h4>
                    <p class="info-box-text text-dark-light">جایی برای به اشتراک گذاشتن دانش و تجربیات درسی با دیگر دانشجویان. در گروه رشته ی خود مطالب درسی را دنبال کنید و با سوال و جواب دانش خود را ارتقا دهید.</p>
                </div>
            </a>

            <!-- ... end Info Box  -->

        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">


            <!-- Info Box  -->

            <a class="crumina-module crumina-info-box p-5" data-mh="box--classic" style="height: 299.4px;">
                <div class="info-box-image">
                    <img width="45%" src="/frontend/svg-icons/bed.svg" alt="icon">
                </div>
                <div class="info-box-content">
                    <h4 class="info-box-title">خوابگاه ها</h4>
                    <p class="info-box-text text-dark-light">خاطرات خود در خوابگاه را با دوستانتان به اشتراک بگذارید و شادی هایتان را دوچندان کنید.</p>
                </div>
            </a>

            <!-- ... end Info Box  -->

        </div>
        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">


            <!-- Info Box  -->

            <a class="crumina-module crumina-info-box p-5" data-mh="box--classic" style="height: 299.4px;">
                <div class="info-box-image">
                    <img width="45%" src="/frontend/svg-icons/store.svg" alt="icon">
                </div>
                <div class="info-box-content">
                    <h4 class="info-box-title mb-0">بازارچه</h4>
                    <span class="text-primary">(به زودی)</span>
                    <p class="info-box-text text-dark-light mt-4">لوازم نو یا دست دوم قابل استفاده خود را در معرض دید دانشجویان دیگر قرار دهید و با هم خرید و فروش یا مبادله کنید.</p>
                </div>
            </a>

            <!-- ... end Info Box  -->

        </div>

        <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">

            <!-- Info Box  -->

            <a class="crumina-module crumina-info-box p-5" data-mh="box--classic" style="height: 299.4px;">
                <div class="info-box-image">
                    <img width="45%" src="/frontend/svg-icons/school.svg" alt="icon">
                </div>
                <div class="info-box-content">
                    <h4 class="info-box-title">هم کلاسی</h4>
                    <p class="info-box-text text-dark-light">محلی برای گپ با هم دانشکده ای هایتان. دایره ی دوستان دوره تحصیلی خود را بزرگتر کنید.</p>
                </div>
            </a>

            <!-- ... end Info Box  -->

        </div>


    </div>

    <div class="row">

        <div class="col col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">

            <div class="ui-block-title bg-white mb-3 text-right rounded"><h6 class="title">وبلاگ</h6></div>

            <blog-posts-component></blog-posts-component>

            <!-- Pagination -->

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1<div class="ripple-container"><div class="ripple ripple-on ripple-out" style="left: -10.3833px; top: -16.8333px; background-color: rgb(255, 255, 255); transform: scale(16.7857);"></div></div></a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">12</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>

            <!-- ... end Pagination -->
        </div>

        <div class="col col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <aside>

                <div class="ui-block">
                    <div class="ui-block-title">
                        <span class="title text-right">جدیدترین اعضای سایت</span>
                    </div>
                    <div class="ui-block-content">

                        <!-- W-Faved-Page -->

                        <ul class="widget w-faved-page newest-users">
                            @foreach($newestUsers as $user)
                            <li>
                                <a href="/profile/{{$user->alias ? $user->alias : $user->id}}">
                                    @if($user->photo)
                                        <img src="/images/sm/{{$user->photo->path}}" alt="{{$user->family}}" title="{{$user->family}}">
                                    @elseif($user->gender)
                                        <img src="{{$user->gender == 1 ? Constants::$img['user_avatar_male'] : Constants::$img['user_avatar_female']}}" alt="{{$user->family}}" title="{{$user->family}}">
                                    @else
                                        <img src="{{Constants::$img['user_avatar_unknown']}}" alt="{{$user->family}}" title="{{$user->family}}">
                                    @endif
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="ui-block">
                    <div class="ui-block-title">
                        <span class="title text-right">فعال ترین گروه ها</span>
                    </div>

                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                        @foreach($bestGroupsByScore as $group)
                        <li class="inline-items p-2" dir="rtl">
                            <div class="author-thumb">
                                <img src="/images/sm/{{$group->photo ? $group->photo->path : ''}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">{{$group->titles}}</a>
                                <span class="chat-message-item">{{$group->scores}} امتیاز</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

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

@endsection