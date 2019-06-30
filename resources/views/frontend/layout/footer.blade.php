<div class="footer footer--dark has-not-copyright" id="footer" dir="rtl">
    <div class="container">
        <div class="row">

            <div class="col col-lg-4 col-md-4 col-sm-6 col-6" dir="rtl">
                <div class="widget w-list text-right">
                    <h6 class="title fs0-85">تماس با ما</h6>
                    <form class="form-group contact-us form-contact-us" dir="rtl" method="post">
                        <input class="form-control" name="name" placeholder="نام و نام خانوادگی">
                        <input class="form-control" name="email" placeholder="ایمیل">
                        <input class="form-control" name="phone" placeholder="شماره تماس">
                        <input class="form-control" name="title" placeholder="موضوع">
                        <textarea class="form-control" name="description" placeholder="متن پیام"></textarea>
                        <span onclick="submitContactUsForm()" class="btn btn-sm btn-transparent border mt-3 btn-send-msg">ارسال</span>
                    </form>

                </div>
            </div>

            <div class="col col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="widget w-list">
                    <h6 class="title">لینک های اصلی</h6>
                    <ul>
                        <li>
                            <a href="/register">ثبت نام</a>
                        </li>
                        <li>
                            <a href="/login">ورود</a>
                        </li>
                        <li>
                            <a href="/study">درس و بحث</a>
                        </li>
                        <li>
                            <a href="/dormitory">خوابگاه ها</a>
                        </li>
                        <li>
                            <a href="/classmates">هم کلاسی ها</a>
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
                                <a href="/{{$major->url}}/college/{{$major->slug}}">دانشکده {{$major->title}}</a>
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
                                <a href="/{{$dorm->url}}/posts/{{$dorm->slug}}">خوابگاه {{$dorm->title}}</a>
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
                            <a target="_blank" href="https://www.vru.ac.ir">دانشگاه ولی عصر (عج) رفسنجان</a>
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

@section('scripts')

    <script src="{{asset('/js/notifyjs.js')}}"></script>

    <script>
        function submitContactUsForm(){
            $('.form-contact-us').serializeArray();

            $.ajax({
                type: 'POST',
                url: '/api/contactus' +'?_token=' + '{{ csrf_token() }}',
                data: $('.form-contact-us').serializeArray(),
                success: function (data){
                    $(".form-contact-us")[0].reset();
                    $.notify("پیام شما با موفقیت ثبت شد و در سریع ترین زمان ممکن به آن رسیدگی خواهد شد", {
                        autoHideDelay: 20000,
                        globalPosition: 'bottom left',
                        className: 'success',
                    });
                },
                error: function(e) {
                    if (e.responseJSON.message === 'Unauthenticated.'){
                        $.notify("در حال حار مشکلی در ثبت پیام پیش آمده. لطفا مجددا امتحان کنید", {
                            autoHideDelay: 15000,
                            globalPosition: 'bottom left',
                            className: 'error',
                        });
                    }
                }});
        }
    </script>

@endsection