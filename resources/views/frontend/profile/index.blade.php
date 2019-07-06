@extends('frontend.layout.master')

@section('titleTag')
    <title>{{$user->family}} ::
    پروفایل کاربری
    </title>
@endsection
@section('metaDescription')
    <meta name="description" content="پروفایل کاربری پست ها فعالیت ها گالری تصاویر مشخصات{{$user->family}}
@foreach($user->categories as $category)
@if($category->sort === 'major')
@if($category->pivot->status == 1)
دانشجوی {{$category->titles}}
@elseif($category->pivot->status == 2)
فارغ التحصیل {{$category->titles}}
@endif
@endif
 @endforeach
دانشگاه ولی عصر رفسنجان و مشاهده دوستان
">
@endsection
@section('metaKeywords')
    <meta name="keywords" content="دانشگاه ولی عصر رفسنجان,شبکه اجتماعی رفسنجان,دانشگاه رفسنجان,دانشجویان رفسنجان,اخبار دانشگاه ولی عصر رفسنجان,بچه های دانشگاه ولی عصر رفسنجان,رفسنجان,رفسنجون,دانشگاه ولیعصر,دانشگاه رفسنجون">
@endsection

@section('content')

    <div class="container" {{--id="app"--}}>
    <profile-component :profile_user="{{$user}}" :posts="{{$posts}}" :received_comments="{{$receivedComments}}" :received_likes="{{$receivedLikes}}" :birthday="{{json_encode($birthday)}}" :post_avatar="{{json_encode(Constants::$img['post_profile'])}}" :user_avatar="{{json_encode(Constants::$img['user_avatar_male'])}}" :sorted_actions="{{json_encode($sortedActions)}}" :avatars="{{json_encode(Constants::$img)}}" :auth_user="{{json_encode(Auth::user())}}"></profile-component>
        <vue-progress-bar></vue-progress-bar>
        <notifications group="alert"
                       position="bottom left"
                       width="400"
                       :speed="500"></notifications>

    </div>

@endsection

@section('scripts')
    <script src="{{asset('/js/app.js')}}"></script>

    <script>
        $(document).ready(function () {
            guidance('ساخته شده است و در هیچ یک از تب های آن صفحه بارگذاری مجدد نمی شود vue.js این صفحه نیز با به صورت کامل با');
        })
    </script>
@endsection