

    <!-- Header Standard -->
    <div class="container-fluid search-box-container-main bg-white">
        <div class="container">
            <div class="row">
                <div class="search-box-header col col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <search-component></search-component>
                </div>
                <div class="search-box-header col col-xl-8 col-lg-8 col-md-12 col-sm-12">

                    @if(Auth::check())

                        <profile-header-component :user="{{$user}}"></profile-header-component>
                        <notifications group="profile-header"
                                       position="bottom left"
                                       width="400"
                                       :speed="500"></notifications>

                        @can('enter-admin-panel')
                            <div class="mt-1 admin-header">
                                <a href="{{route('admin.home')}}" class="btn btn-sm btn-secondary">صفحه ی مدیریت</a>
                            </div>
                        @endcan

                    @else

                        <div class="text-right p-2 mt-1">
                            <a href="/login" class="">ورود</a>
                            <a href="/register" class="mr-4">ثبت نام</a>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="header--standard" id="header--standard">

        <div class="container">
            <div class="header--standard-wrap">

                {{--<a href="02-ProfilePage.html" class="logo">
                    <div class="img-wrap">
                        <img src="/frontend/img/logo-colored-small.png" alt="Olympus">
                    </div>
                    <div class="title-block">
                        <h6 class="logo-title">olympus</h6>
                        <div class="sub-title">SOCIAL NETWORK</div>
                    </div>
                </a>--}}


                <div class="nav nav-pills nav1 header-menu col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" dir="rtl">
                    <div class="mCustomScrollbar">
                        <ul>
                            <li class="nav-item">
                                <a href="/" class="nav-link">صفحه اصلی</a>
                            </li>
                            <li class="nav-item dropdown dropdown-has-megamenu">
                                <a href="/study" class="nav-link dropdown-toggle" data-hover="dropdown" {{--data-toggle="dropdown"--}} role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>درس و بحث</a>
                                <div class="dropdown-menu megamenu header-menu-main">
                                    <div class="row">

                                        @foreach($majors as $college)
                                            <a href="/{{$college->url}}/college/{{$college->slug}}" class="col col-sm-3 menu-majors p-0">
                                                <h6 class="column-tittle fs0-8 cursor-pointer">{{$college->title}}</h6>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-has-megamenu">
                                <a href="#" class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>خوابگاه</a>
                                <div class="dropdown-menu megamenu header-menu-main">
                                    <div class="row">

                                        @foreach($dorms as $dorm)
                                            <a href="/{{$dorm->url}}/posts/{{$dorm->slug}}" class="col col-sm-3 menu-majors p-0">
                                                <h6 class="column-tittle fs0-8 cursor-pointer">{{$dorm->titles}}</h6>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-has-megamenu">
                                <a href="#" class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>هم کلاسی</a>
                                <div class="dropdown-menu megamenu header-menu-main">
                                    <div class="row">

                                        @foreach($classmatesMajors as $college)
                                            <a href="/{{$college->url}}/college/{{$college->slug}}" class="col col-sm-3 menu-majors p-0">
                                                <h6 class="column-tittle fs0-8 cursor-pointer">{{$college->title}}</h6>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">بازارچه</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>