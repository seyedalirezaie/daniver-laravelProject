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
    <meta charset="UTF-8">
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

        <div class="guidance-container container">
            <div class="row">
                <div class="col-2">
                    <img src="/images/avatars/guid-user.jpg">

                    <div class="loader-6 center"><span></span></div>
                </div>
                <div class="col-10 pr-5 position-relative">
                    <p class="guid-text">
                        سلام. احتمالا برای بررسی سایت وارد شده اید...من اینجا هستم تا توضیحات مختصری پیرامون قسمت های مختلف سایت بدهم. اگر نیازی به حضور من ندارید دکمه ضربدر را بزنید
                    </p>
                    <i class="fas fa-times btn-close-guid"></i>
                </div>
            </div>
        </div>


<a class="back-to-top" href="#">
    <img src="/frontend/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>
</div>

        @include('frontend.layout.scripts')




    @yield('scripts')

<script>

    $(document).on('click', '.guid-item', function () {
        var type = $(this).attr('data-type');
        if (type === 'activest'){
            guidance('در این قسمت با توجه به فعالیت های هر گروه در هر دسته امتیازاتی در نظر گرفته می شود و سه گروه اول هر دسته نمایش داده می شود');
        }
    });

    $('.blog-hover').hover(function () {
        guidance('در این قسمت یک vue component قرار گرفته است. در هر سری که کاربر روی موارد بیشتر کلیک کند 6 پست جدید از وبلاگ به پست های صفحه اضافه می شود.');
    } , function () {

    })

    function guidance(guidText) {
        $('.guid-text').text(guidText)
    }

</script>

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





</body>
</html>