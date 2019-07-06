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
        <div style="position: fixed; left: 0; bottom: 30px; padding: 6px; z-index: 2500">
        <img class="img-guid" style="width: 45px;" src="/images/avatars/guid-user.jpg">
        </div>
        <div class="guidance-container container">
            <div class="row">
                <div class="col-12 pr-5 position-relative guid-content">
                    <p class="guid-text">
                        درود. من همین گوشه پایین سمت چپ صفحه هستم. در زمان بازدید هرجایی که علامت
                        <i class="fas fa-question-circle fs1-2 guid-item" data-type="blog-main"></i>
                         دیدید، روی آن کلیک کنید تا توضیح مختصری درباره آن بدهم

                    </p>
                    <i class="fas fa-times btn-close-guid"></i>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal" dir="rtl">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <img style="width: 45px;" src="/images/avatars/guid-user.jpg">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p class="text-right">
                            سلام. احتمالا برای بررسی سایت وارد شده اید. اگر با حضور من در ادامه بازدید از سایت مشکلی ندارید گزینه ی زیر را کلیک کنید.
                        </p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-green ml-2" data-dismiss="modal" onclick="startGuidance()">مشکلی ندارم</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                    </div>

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

    $(document).ready(function(){
        if (!localStorage.getItem('guid')){
            setTimeout(function () {
                $("#myModal").modal();
            },6000);
        } else {
            $('.guid-item').show();
            $('.guidance-container').css('display' , 'block');
            $('.img-guid').css('display' , 'block');
            if (localStorage.getItem('guid-size') === 'max'){
                maxGuidance();
            }
            if (localStorage.getItem('guid-size') === 'min'){
                minGuidance();
            }
        }

    });

    function minGuidance() {
        $('.guidance-container').addClass('min');
        $('.img-guid').addClass('min');
        $('.guidance-container').animate({'width' : 60} , 700);
        $('.guid-content p').hide();
        $('.btn-close-guid').hide();
        localStorage.setItem('guid-size' , 'min');
    }

    function maxGuidance() {
        $('.img-guid').removeClass('min');
        $('.guidance-container').removeClass('min')
        $('.guidance-container').animate({'width' : '65%'} , 700);
        setTimeout(function () {
            $('.guid-content p').fadeIn();
            $('.btn-close-guid').fadeIn();
        },1500)
        localStorage.setItem('guid-size' , 'max');
    }

    function startGuidance(){
        localStorage.setItem('guid' , true);
        $('.guid-item').show();
        minGuidance();
        setTimeout(function () {
            $('.guidance-container').css('display' , 'block');
            $('.img-guid').css('display' , 'block');
            setTimeout(function () {
                maxGuidance();
            },1500)

        },400)
    }

    $(document).on('click', '.guid-item', function () {
        var type = $(this).attr('data-type');
        if (type === 'activest'){
            guidance('در این قسمت با توجه به فعالیت های هر گروه در هر دسته امتیازاتی در نظر گرفته می شود و سه گروه اول هر دسته نمایش داده می شود');
        }
        if (type === 'blog-main'){
            guidance('نمایش پست های جدید وبلاگ از طریق یک کامپوننت ویو جی اس انجام می شود.' + '<br/>' + 'پست های وبلاگ از طریق پنل مدیریت ایجاد و انتخاب می شود که در حال حاضر قسمت ایجاد پست آن در پنل مدیریت پیاده سازی شده است و تنها کاربرانی که دارای نقش مدیر یا نویسنده وبلاگ باشند می توانند به پنل وارد شوند. در صورتی که با نقش مدیر وارد سایت شوید در نوار بالای سایت دکمه ورود به پنل مدیریت را خواهید دید');
        }
        if (type === 'login'){
            guidance('هرچند از صفحه ورود می توانید به سایت وارد شوید اما می توانید به طور مستقیم نیز به عناوین زیر وارد شوید' + '<br/>' + '<span class="btn btn-sm btn-green mt-4 fs0-9 btn-login-auto" data-type="admin">ورود به عنوان مدیر سایت</span>' + '<br/>' + '<span class="btn btn-sm btn-danger fs0-9 btn-login-auto" data-type="user">ورود به عنوان کاربر معمولی</span>' + '<br/>' + '<span class="btn btn-sm btn-purple fs0-9 btn-login-auto" data-type="writer">ورود به عنوان نویسنده وبلاگ</span>');
        }
        if (type === 'search'){
            guidance(' که کلیدواژه وارد شده را در میان نام، نام خانوادگی و نام مستعار کاربران جستجو می کند vue component یک');
        }
        if (type === 'panel'){
            guidance('ساخته شده است و اعلان های خوانده نشده را به کاربر نمایش می دهد vue.js این قسمت نیز با' + '<br/>' + ' اعلان ها به صورت خوانده شده در می آیند EventListener در صورتی که کاربر اعلان ها را بخواند توسط یک ');
        }
    });

    $(document).on('click', '.btn-close-guid', function () {
        minGuidance();

        $('.img-guid').hover(function () {
            if ($(this).hasClass('min')) {
                $('.guidance-container').animate({'width' : 80} , 400)
            }
        } , function () {
            if ($(this).hasClass('min')) {
                $('.guidance-container').animate({'width': 60}, 400)
            }
        });
    })

    $(document).on('click', '.img-guid.min', function () {
        maxGuidance();
    })



    function guidance(guidText) {
        minGuidance();
        setTimeout(function () {
            maxGuidance();
        },1000)
        $('.guid-text').html(guidText);

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

                $(document).on('click', '.btn-login-auto', function () {
                    var type = $(this).attr('data-type');
                    $.ajax({
                        type: 'POST',
                        url: '/api/autoLogin' +'?_token=' + '{{ csrf_token() }}',
                        data: {'type' : type},
                        success: function (data){
                            window.location.reload();
                        },
                        error: function(e) {

                        }});
                });

            })

        </script>


    @endif





</body>
</html>