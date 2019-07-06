@extends('frontend.layout.master' , ['noHeader' => 'noHeader'])

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/vue2-animate/dist/vue2-animate.min.css"/>
    <link rel="stylesheet" href="/js/emojionearea-master/dist/emojionearea.min.css">
@endsection

@section('content')

    <div class="container-fluid">
    <posts-component :category="{{$category}}" :year="{{$year}}" :images="{{json_encode(Constants::$img['user_avatar_male'])}}" :postimages="{{json_encode(Constants::postImgRandom())}}"></posts-component>
        <vue-progress-bar></vue-progress-bar>
        <notifications group="auth"
                       position="bottom left"
                       width="400"
                       :speed="500"></notifications>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/js/emojionearea-master/dist/emojionearea.min.js')}}"></script>
    <script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script src="/js/ckeditor/translations/fa.js"></script>

    <script>
        $(document).on('click', '.btn-comment-circle', function () {
            $('.text-comment').parent().addClass('is-focused');
        });



        $(document).on('click', '.btn-insert-post', function () {

            var srcArray = [];
            $('#editor img').each(function () {
                var imageSRC = $(this).attr('src');
                srcArray.push(imageSRC);
            });
            $('.photos-path').val(srcArray);
        });

        $(document).ready(function () {
            guidance('ساخته شده است vue.js این صفحه با به صورت کامل با' + '<br/>' + 'ستفاده شده است ckeditor5 و برای ارسال پست از پلاگین emojiarea برای درج نظر از پلاگین جی کوئری' + '<br/>' + 'سیستم جستجو با لاراول و بدون پلاگین خاصی پیاده سازی شده است');
        })


    </script>
@endsection