@extends('frontend.layout.master' , ['noHeader' => 'noHeader'])

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/vue2-animate/dist/vue2-animate.min.css"/>
@endsection

@section('content')

    <div class="container-fluid" {{--id="app"--}}>
    <posts-component :categoryid="{{$categoryId}}" :year="{{$year}}" :images="{{json_encode(Constants::$img['user_avatar_male'])}}" :postimages="{{json_encode(Constants::postImgRandom())}}"></posts-component>
        <vue-progress-bar></vue-progress-bar>
        <notifications group="auth"
                       position="bottom left"
                       width="400"
                       :speed="500" />
    </div>




@endsection

@section('scripts')
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script src="/js/ckeditor/translations/fa.js"></script>

    <script>
        $(document).on('click', '.btn-comment-circle', function () {

            $('.text-comment').parent().addClass('is-focused');

        })

        $(document).on('click', '.btn-insert-post', function () {

            var srcArray = [];
            $('#editor img').each(function () {
                var imageSRC = $(this).attr('src');
                srcArray.push(imageSRC);
            })
            $('.photos-path').val(srcArray);
        })












    </script>
@endsection