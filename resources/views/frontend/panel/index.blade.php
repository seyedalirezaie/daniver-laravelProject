@extends('frontend.layout.master')
@section('content')

    <panel-component :user="{{json_encode($user)}}" :friends_number="{{json_encode($friendsCount)}}" :avatars="{{json_encode(Constants::$img)}}"></panel-component>
    <vue-progress-bar></vue-progress-bar>
    <notifications group="alert-panel"
                   position="bottom left"
                   width="400"
                   :speed="500"></notifications>
@endsection