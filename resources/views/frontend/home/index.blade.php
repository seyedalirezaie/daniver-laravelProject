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
                    <img class="icons-main" width="45%" src="/frontend/svg-icons/books.svg" alt="درس و بحث" title="درس و بحث">
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

            <a href="{{route('dormitory')}}" class="crumina-module crumina-info-box p-5" data-mh="box--classic" style="height: 299.4px;">
                <div class="info-box-image">
                    <img class="icons-main" width="45%" src="/frontend/svg-icons/bed.svg" alt="خوابگاه ها" title="خوابگاه ها">
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
                    <img class="icons-main" width="45%" src="/frontend/svg-icons/store.svg" alt="بازارچه" title="بازارچه">
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

            <a href="{{route('classmates')}}" class="crumina-module crumina-info-box p-5" data-mh="box--classic" style="height: 299.4px;">
                <div class="info-box-image">
                    <img class="icons-main" width="45%" src="/frontend/svg-icons/school.svg" alt="هم کلاسی ها" title="هم کلاسی ها">
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


            <div class="ui-block bg-transparent">

                <div class="ui-block-title bg-white mb-3 text-right rounded"><h6 class="title">
                        <i class="fas fa-question-circle fs1-2 guid-item" data-type="activest"></i>
                        فعال ترین گروه ها</h6>
                </div>

                <div class="container-fluid" dir="rtl">
                <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 pr-0">

                    <div class="p-2 bg-white text-center mb-2">
                        درس و بحث
                    </div>

                    <ul class="widget w-friend-pages-added notification-list friend-requests bg-white">
                        @foreach($sortedStudies as $group)
                            <li class="inline-items p-2" dir="rtl">
                                <div class="author-thumb">
                                    <img class="img-category-home" src="{{$group->path}}" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="{{$group->url}}/posts/{{$group->slug}}" class="notification-friend">{{$group->titles}}</a>
                                    <span class="chat-message-item d-block">{{$group->scores}} امتیاز</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">

                        <div class="p-2 bg-white text-center mb-2">
                            خوابگاه ها
                        </div>

                        <ul class="widget w-friend-pages-added notification-list friend-requests bg-white">
                            @foreach($sortedDorms as $group)
                                <li class="inline-items p-2" dir="rtl">
                                    <div class="author-thumb">
                                        <img class="img-category-home" src="/images/avatars/{{$group->photo ? $group->photo->path : ''}}" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        <a href="{{$group->url}}/posts/{{$group->slug}}" class="notification-friend">{{$group->titles}}</a>
                                        <span class="chat-message-item d-block">{{$group->scores}} امتیاز</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 pl-0">

                        <div class="p-2 bg-white text-center mb-2">
                            هم کلاسی ها
                        </div>

                        <ul class="widget w-friend-pages-added notification-list friend-requests bg-white">
                            @foreach($sortedMates as $group)
                                <li class="inline-items p-2" dir="rtl">
                                    <div class="author-thumb">
                                        <img class="img-category-home" src="/images/avatars/{{$group->photo ? $group->photo->path : ''}}" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        <a href="{{$group->url}}/posts/{{$group->slug}}" class="notification-friend">{{$group->titles}}</a>
                                        <span class="chat-message-item d-block">{{$group->scores}} امتیاز</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                </div>


            </div>

            <div class="ui-block-title bg-white mb-3 text-right rounded blog-hover"><h6 class="title">
                    <i class="fas fa-question-circle fs1-2 guid-item" data-type="blog-main"></i>
                    وبلاگ</h6></div>

            <blog-posts-component></blog-posts-component>

        </div>

        <div class="col col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <aside>
                <div class="ui-block">
                    <div class="ui-block-title">
                        <span class="title text-right">جدیدترین اعضای سایت</span>
                    </div>
                    <div class="ui-block-content">
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
                                        <i class="far fa-heart fs1-3 text-grey-lighter"></i>
                                        <span>{{$post->likes_count}}</span>
                                    </a>
                                </div>

                                <div class="comments-shared">
                                    <a href="#" class="post-add-icon inline-items">
                                        <i class="far fa-comments fs1-3 text-grey-lighter"></i>
                                        <span>{{$post->comments_count}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                @endif
            </aside>
        </div>
    </div>
@endsection