<!DOCTYPE html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml">
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


    @include('frontend.layout.header')



<!-- ... end Header Standard -->


<div class="header-spacer--standard"></div>

<div class="{{!empty($container) ? $container : 'container'}}">
    <div class="row">
        <div align="right" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @yield('content')
            <router-view></router-view>
        </div>
    </div>
</div>

<!-- Footer -->
        @include('frontend.layout.footer')
<!-- ... end Footer -->


    @if(Auth::check())
    @if(Auth::user()->hasVerifiedEmail())
    @else

        <div class="container-fluid verification-email-card text-right py-3" dir="rtl">
            <div class="row justify-content-center">
                <div class="col-md-12 px-0">
                    <div class="card">
                        <div class="card-header"> <span class="text-primary">{{$user->family}}</span> {{ __('عزیز. شما هنوز ایمیل خود را تایید نکرده اید.')}}
                            <i class="btn-expand fas fa-minus-circle float-left fs1-2 cursor-pointer text-tomato"></i>
                        </div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('یک ایمیل فعال سازی جدید برایتان ارسال شد') }}
                                </div>
                            @endif

                            {{ __('قبل از این که از امکانات کامل سایت استفاده کنید و کاربران دیگر شما را مشاهده کنند لازم است ایمیل خود را تایید کنید. برای این کار وارد ایمیل خود شده و روی لینک فعال سازی ایمیلی که برایتان ارسال کرده ایم کلیک کنید.') }} <br/>
                            {{ __('اگر ایمیل فعال سازی را دریافت نکرده اید') }}، <a href="{{ route('verification.resend') }}">{{ __('اینجا را کلیک کنید تا یک ایمیل فعال سازی جدید برایتان ارسال شود') }}</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
    @endif

<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->



<a class="back-to-top" href="#">
    <img src="/frontend/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>



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


    @yield('scripts')

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

                });

                if (sessionStorage.getItem('email-verify-size') === 'max'){
                    $('.verification-email-card .card-body').slideDown(0);
                    $('.verification-email-card .btn-expand').removeClass('fa-plus-circle').addClass('fa-minus-circle');
                } else if (sessionStorage.getItem('email-verify-size') === 'min') {
                    $('.verification-email-card .card-body').slideUp(0);
                    $('.verification-email-card .btn-expand').removeClass('fa-minus-circle').addClass('fa-plus-circle');
                }

                $(document).on('click', '.verification-email-card .btn-expand', function () {
                    $('.verification-email-card .card-body').slideToggle(0);
                    if ($(this).hasClass('fa-minus-circle')) {
                        $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
                        sessionStorage.setItem('email-verify-size' , 'min');
                    } else {
                        $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
                        sessionStorage.setItem('email-verify-size' , 'max');
                    }


                });

            })

        </script>

    @endif




</div>
</body>
</html>