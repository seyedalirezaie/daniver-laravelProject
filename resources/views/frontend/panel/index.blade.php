@extends('frontend.layout.master')

@section('titleTag')
    <title>پروفایل کاربری</title>
@endsection

@section('content')

    <panel-component :user="{{json_encode($user)}}" :friends_number="{{json_encode($friendsCount)}}" :avatars="{{json_encode(Constants::$img)}}"></panel-component>
    <vue-progress-bar></vue-progress-bar>
    <notifications group="alert-panel"
                   position="bottom left"
                   width="400"
                   :speed="500"></notifications>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            guidance('ساخته شده است و در هیچ یک از تب های آن صفحه بارگذاری مجدد نمی شود vue.js این صفحه نیز با به صورت کامل با');
        })
    </script>
@endsection