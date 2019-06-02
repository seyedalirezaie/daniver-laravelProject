<!DOCTYPE html>
<html lang="en">
<head>

    @yield('titleTag')
    @yield('metaDescription')
    @yield('metaKeywords')


    <!-- Required meta tags always come first -->
    <meta charset="utf-8">

        <meta name="geo.region" content="IR-15" />
        <meta name="geo.placename" content="Rafsanjan" />
        <meta name="geo.position" content="30.386498;55.92386" />
        <meta name="ICBM" content="30.386498, 55.92386" />


        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Main Font -->
    <script src="/frontend/js/webfontloader.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ['Roboto:300,400,500,700:latin']
            }
        });
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/frontend/Bootstrap/dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="/frontend/Bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/frontend/Bootstrap/dist/css/bootstrap-grid.css">

    @yield('styles')

    <!-- Main Styles CSS -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/main.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts.min.css">

    <meta name="csrf-token" content="{{csrf_token()}}">

</head>
<body class="has-standard-header body-bg-white">
<div id="app">

<!-- Fixed Sidebar Left -->


<!-- ... end Fixed Sidebar Left -->


<!-- Fixed Sidebar Left -->


<!-- ... end Fixed Sidebar Left -->


<!-- Fixed Sidebar Right -->

{{--<div class="fixed-sidebar right">
    <div class="fixed-sidebar-right sidebar--small" id="sidebar-right">

        <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="chat-users">
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar67-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar62-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                </li>

                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar68-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                </li>

                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar69-sm.jpg" class="avatar">
                        <span class="icon-status away"></span>
                    </div>
                </li>

                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar70-sm.jpg" class="avatar">
                        <span class="icon-status disconected"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar64-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar71-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar72-sm.jpg" class="avatar">
                        <span class="icon-status away"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar63-sm.jpg" class="avatar">
                        <span class="icon-status status-invisible"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">
                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar72-sm.jpg" class="avatar">
                        <span class="icon-status away"></span>
                    </div>
                </li>
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar71-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="search-friend inline-items">
            <a href="#" class="js-sidebar-open">
                <svg class="olymp-menu-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>
            </a>
        </div>

        <a href="#" class="olympus-chat inline-items js-chat-open">
            <svg class="olymp-chat---messages-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
        </a>

    </div>

    <div class="fixed-sidebar-right sidebar--large" id="sidebar-right-1">

        <div class="mCustomScrollbar" data-mcs-theme="dark">

            <div class="ui-block-title ui-block-title-small">
                <a href="#" class="title">Close Friends</a>
                <a href="#">Settings</a>
            </div>

            <ul class="chat-users">
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar67-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Carol Summers</a>
                        <span class="status">ONLINE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>

                </li>
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar62-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Mathilda Brinker</a>
                        <span class="status">AT WORK!</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>

                </li>

                <li class="inline-items js-chat-open">


                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar68-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Carol Summers</a>
                        <span class="status">ONLINE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>


                </li>

                <li class="inline-items js-chat-open">


                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar69-sm.jpg" class="avatar">
                        <span class="icon-status away"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Michael Maximoff</a>
                        <span class="status">AWAY</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>


                </li>

                <li class="inline-items js-chat-open">


                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar70-sm.jpg" class="avatar">
                        <span class="icon-status disconected"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Rachel Howlett</a>
                        <span class="status">OFFLINE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>


                </li>
            </ul>


            <div class="ui-block-title ui-block-title-small">
                <a href="#" class="title">MY FAMILY</a>
                <a href="#">Settings</a>
            </div>

            <ul class="chat-users">
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar64-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Sarah Hetfield</a>
                        <span class="status">ONLINE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>


            <div class="ui-block-title ui-block-title-small">
                <a href="#" class="title">UNCATEGORIZED</a>
                <a href="#">Settings</a>
            </div>

            <ul class="chat-users">
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar71-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Bruce Peterson</a>
                        <span class="status">ONLINE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>


                </li>
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar72-sm.jpg" class="avatar">
                        <span class="icon-status away"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Chris Greyson</a>
                        <span class="status">AWAY</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>

                </li>
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar63-sm.jpg" class="avatar">
                        <span class="icon-status status-invisible"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Nicholas Grisom</a>
                        <span class="status">INVISIBLE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>
                </li>
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar72-sm.jpg" class="avatar">
                        <span class="icon-status away"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Chris Greyson</a>
                        <span class="status">AWAY</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>
                </li>
                <li class="inline-items js-chat-open">

                    <div class="author-thumb">
                        <img alt="author" src="/frontend/img/avatar71-sm.jpg" class="avatar">
                        <span class="icon-status online"></span>
                    </div>

                    <div class="author-status">
                        <a href="#" class="h6 author-name">Bruce Peterson</a>
                        <span class="status">ONLINE</span>
                    </div>

                    <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>

                        <ul class="more-icons">
                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-add-to-conversation-icon"></use></svg>
                            </li>

                            <li>
                                <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-block-from-chat-icon"></use></svg>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>

        </div>

        <div class="search-friend inline-items">
            <form class="form-group" >
                <input class="form-control" placeholder="Search Friends..." value="" type="text">
            </form>

            <a href="29-YourAccount-AccountSettings.html" class="settings">
                <svg class="olymp-settings-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-settings-icon"></use></svg>
            </a>

            <a href="#" class="js-sidebar-open">
                <svg class="olymp-close-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>
        </div>

        <a href="#" class="olympus-chat inline-items js-chat-open">

            <h6 class="olympus-chat-title">OLYMPUS CHAT</h6>
            <svg class="olymp-chat---messages-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-chat---messages-icon"></use></svg>
        </a>

    </div>
</div>--}}

<!-- ... end Fixed Sidebar Right -->


<!-- Fixed Sidebar Right-Responsive -->

<!-- ... end Fixed Sidebar Right-Responsive -->

<!-- Header Standard -->
<div class="container-fluid search-box-container-main bg-white">
    <div class="container">
    <div class="row">
    <div class="search-box-header col col-xl-4 col-lg-4 col-md-6 col-sm-12">
        <search-component></search-component>
    </div>
        <div class="search-box-header col col-xl-8 col-lg-8 col-md-6 col-sm-12">

            @if(Auth::check())

                <profile-header-component :user="{{$user}}"></profile-header-component>

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


            <a href="#" class="open-responsive-menu js-open-responsive-menu">
                <svg class="olymp-menu-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-menu-icon"></use></svg>
            </a>

            <div class="nav nav-pills nav1 header-menu col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" dir="rtl">
                <div class="mCustomScrollbar">
                    <ul>
                        <li class="nav-item">
                            <a href="/" class="nav-link">صفحه اصلی</a>
                        </li>
                        <li class="nav-item dropdown dropdown-has-megamenu">
                            <a href="#" class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>درس و بحث</a>
                            <div class="dropdown-menu megamenu header-menu-main">
                                <div class="row">

                                    @foreach($majors as $college)
                                    <div class="col col-sm-3 mb-1 menu-majors">
                                        <h6 class="column-tittle cursor-pointer">{{$college->title}}</h6>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-has-megamenu">
                            <a href="#" class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>خوابگاه</a>
                            <div class="dropdown-menu megamenu header-menu-main">
                                <div class="row">

                                    @foreach($dorms as $dorm)
                                        <div class="col col-sm-3 mb-5 menu-majors">
                                            <h6 class="column-tittle cursor-pointer">{{$dorm->titles}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown dropdown-has-megamenu">
                            <a href="#" class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>هم کلاسی</a>
                            <div class="dropdown-menu megamenu header-menu-main">
                                <div class="row">

                                    @foreach($majors as $college)
                                        <div class="col col-sm-3 mb-5 menu-majors">
                                            <h6 class="column-tittle cursor-pointer">{{$college->title}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" tabindex='1'>کاربران</a>
                            {{--<div class="dropdown-menu">
                                <a class="dropdown-item" href="#">جست</a>
                                <a class="dropdown-item" href="#">Newsfeed</a>
                                <a class="dropdown-item" href="#">Post Versions</a>
                            </div>--}}
                        </li>

                        <li class="close-responsive-menu js-close-responsive-menu">
                            <svg class="olymp-close-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>




<!-- ... end Header Standard -->


<div class="header-spacer--standard"></div>



<div class="container">
    <div class="row mt50">

        <div align="right" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @yield('content')
            <router-view></router-view>
        </div>


    </div>

</div>


<!-- Footer -->

<div class="footer footer--dark has-not-copyright" id="footer" dir="rtl">
    <div class="container">
        <div class="row">

            <div class="col col-lg-4 col-md-4 col-sm-6 col-6" dir="rtl">
                <div class="widget w-list text-right">
                    <h6 class="title fs0-85">تماس با ما</h6>
                    <div class="form-group contact-us" dir="rtl">
                        <input class="form-control" name="name" placeholder="نام و نام خانوادگی">
                        <input class="form-control" name="email" placeholder="ایمیل">
                        <input class="form-control" name="title" placeholder="موضوع">
                        <textarea class="form-control" name="description" placeholder="متن پیام"></textarea>
                        <span class="btn btn-sm btn-transparent border mt-3 btn-send-msg">ارسال</span>
                    </div>

                </div>
            </div>

            <div class="col col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget w-list">
                    <h6 class="title">لینک های اصلی</h6>
                    <ul>
                        <li>
                            <a href="#">ثبت نام</a>
                        </li>
                        <li>
                            <a href="#">ورود</a>
                        </li>
                        <li>
                            <a href="#">وبلاگ</a>
                        </li>
                        <li>
                            <a href="#">درس و بحث</a>
                        </li>
                        <li>
                            <a href="#">خوابگاه ها</a>
                        </li>
                        <li>
                            <a href="#">هم کلاسی ها</a>
                        </li>
                        <li>
                            <a href="#">بازارچه</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget w-list">
                    <h6 class="title">درس و بحث</h6>
                    <ul>
                        @foreach($majors as $major)
                            <li>
                                <a href="#">دانشکده {{$major->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget w-list">
                    <h6 class="title">خوابگاه ها</h6>
                    <ul>
                        @foreach($dorms as $dorm)
                            <li>
                                <a href="#">خوابگاه {{$dorm->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget w-list">
                    <h6 class="title">لینک های مفید</h6>
                    <ul>
                            <li>
                                <a href="#">دانشگاه ولی عصر (عج) رفسنجان</a>
                            </li>
                    </ul>
                </div>
            </div>

            {{--<div class="col col-lg-4 col-md-4 col-sm-6 col-6">
--}}{{--
                <div class="widget w-about">
                    <a href="02-ProfilePage.html" class="logo">
                        <div class="img-wrap">
                            <img src="/frontend/img/logo-colored.png" alt="Olympus">
                        </div>
                        <div class="title-block">
                            <h6 class="logo-title">olympus</h6>
                            <div class="sub-title">SOCIAL NETWORK</div>
                        </div>
                    </a>
                    <p>Lorem ipsum dolor sit amet, consect adipisicing elit, sed do eiusmod por incidid ut labore et lorem.</p>
                    <ul class="socials">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook-square" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-google-plus-g" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
--}}{{--
            </div>--}}


        </div>
    </div>
</div>

<!-- ... end Footer -->


<!-- Window-popup-CHAT for responsive min-width: 768px -->

<div class="ui-block popup-chat popup-chat-responsive" tabindex="-1" role="dialog" aria-labelledby="update-header-photo" aria-hidden="true">

    <div class="modal-content">
        <div class="modal-header">
            <span class="icon-status online"></span>
            <h6 class="title" >Chat</h6>
            <div class="more">
                <svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                <svg class="olymp-little-delete js-chat-open"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
            </div>
        </div>
        <div class="modal-body">
            <div class="mCustomScrollbar">
                <ul class="notification-list chat-message chat-message-field">
                    <li>
                        <div class="author-thumb">
                            <img src="/frontend/img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
                        </div>
                        <div class="notification-event">
                            <span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
                            <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                        </div>
                    </li>

                    <li>
                        <div class="author-thumb">
                            <img src="/frontend/img/author-page.jpg" alt="author" class="mCS_img_loaded">
                        </div>
                        <div class="notification-event">
                            <span class="chat-message-item">Don’t worry Mathilda!</span>
                            <span class="chat-message-item">I already bought everything</span>
                            <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:29pm</time></span>
                        </div>
                    </li>

                    <li>
                        <div class="author-thumb">
                            <img src="/frontend/img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
                        </div>
                        <div class="notification-event">
                            <span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
                            <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                        </div>
                    </li>
                </ul>
            </div>

            <form class="need-validation">

                <div class="form-group label-floating is-empty">
                    <label class="control-label">Press enter to post...</label>
                    <textarea class="form-control" placeholder=""></textarea>
                    <div class="add-options-message">
                        <a href="#" class="options-message">
                            <svg class="olymp-computer-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                        </a>
                        <div class="options-message smile-block">

                            <svg class="olymp-happy-sticker-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-happy-sticker-icon"></use></svg>

                            <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat1.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat2.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat3.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat4.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat5.png" alt="icon">
                                    </a>
                                </li>
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
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat8.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat9.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat10.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat11.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat12.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat13.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat14.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat15.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat16.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat17.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat18.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat19.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat20.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat21.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat22.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat23.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat24.png" alt="icon">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/frontend/img/icon-chat25.png" alt="icon">
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
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->



<a class="back-to-top" href="#">
    <img src="/frontend/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

@yield('scripts')

    <script src="{{asset('/js/app.js')}}"></script>

<!-- JS Scripts -->
<script src="/frontend/js/jquery-3.2.1.js"></script>
<script src="/frontend/js/jquery.appear.js"></script>
<script src="/frontend/js/jquery.mousewheel.js"></script>
<script src="/frontend/js/perfect-scrollbar.js"></script>
<script src="/frontend/js/jquery.matchHeight.js"></script>
<script src="/frontend/js/svgxuse.js"></script>
<script src="/frontend/js/imagesloaded.pkgd.js"></script>
<script src="/frontend/js/Headroom.js"></script>
<script src="/frontend/js/velocity.js"></script>
<script src="/frontend/js/ScrollMagic.js"></script>
<script src="/frontend/js/jquery.waypoints.js"></script>
<script src="/frontend/js/jquery.countTo.js"></script>
<script src="/frontend/js/popper.min.js"></script>
<script src="/frontend/js/material.min.js"></script>
<script src="/frontend/js/bootstrap-select.js"></script>
<script src="/frontend/js/smooth-scroll.js"></script>
<script src="/frontend/js/selectize.js"></script>
<script src="/frontend/js/swiper.jquery.js"></script>
<script src="/frontend/js/moment.js"></script>
<script src="/frontend/js/daterangepicker.js"></script>
<script src="/frontend/js/simplecalendar.js"></script>
<script src="/frontend/js/fullcalendar.js"></script>
<script src="/frontend/js/isotope.pkgd.js"></script>
<script src="/frontend/js/ajax-pagination.js"></script>
<script src="/frontend/js/Chart.js"></script>
<script src="/frontend/js/chartjs-plugin-deferred.js"></script>
<script src="/frontend/js/circle-progress.js"></script>
<script src="/frontend/js/loader.js"></script>
<script src="/frontend/js/run-chart.js"></script>
<script src="/frontend/js/jquery.magnific-popup.js"></script>
<script src="/frontend/js/jquery.gifplayer.js"></script>
<script src="/frontend/js/mediaelement-and-player.js"></script>
<script src="/frontend/js/mediaelement-playlist-plugin.min.js"></script>

<script src="/frontend/js/base-init.js"></script>
<script defer src="/frontend/fonts/fontawesome-all.js"></script>

<script src="/frontend/Bootstrap/dist/js/bootstrap.bundle.js"></script>




    @if(isset($noHeader))
    <script>
        $(window).scroll(function() {
            if ($('#header--standard').hasClass('headroom--top')){
                $('#header--standard').addClass('header--standard');
            } else {
                $('#header--standard').removeClass('header--standard');
            }

            if ($('#header--standard').hasClass('headroom--not-top')){
                $('.search-box-container-main').addClass('scroll');
            } else {
                $('.search-box-container-main').removeClass('scroll');
            }
        })
    </script>
    @else

        <script>

            $(document).ready(function () {

                $(window).scroll(function() {
                    if ($('#header--standard').hasClass('headroom--not-top slideUp')){
                        $('.search-box-container-main').addClass('scroll');
                    } else {
                        $('.search-box-container-main').removeClass('scroll');
                    }

                })


            })

        </script>

    @endif




</div>
</body>
</html>