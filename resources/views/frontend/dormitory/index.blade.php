@extends('frontend.layout.master')

@section('content')


        <div class="row" dir="rtl">

            @foreach($dorms as $dorm)
            <div dir="ltr" class="col col-xl-4 col-lg-4 col-md-6 col-sm-12 col-3">
                <div class="ui-block">
                    <div class="friend-item">

                        <a href="/{{$dorm->url}}/posts/{{$dorm->slug}}" class="photo-item dorm p-0 w-100 cursor-pointer">
                            <img src="/images/image/{{$dorm->photo->path}}" alt="{{$dorm->titles}}" title="{{$dorm->titles}}" class="h-100">

                            <h3 class="dorm-title h1">{{$dorm->titles}}</h3>

                            <div class="overlay overlay-dark custom-overly text-center">
                                {{--<span class="btn btn-blue cursor-pointer">ورود</span>--}}
                                <div class="text-gold dorm-stats text-center">

                                    <div class="d-block text-center mb-3">
                                        <span class="d-inline fs1-1 fw-700">اعضا: 140</span>
                                        <span class="d-inline fs1-1 fw-700 mr-3">پست ها: 140</span>
                                    </div>
                                    <div class="d-block">
                                    <span class="d-block fs0-9">پست های امروز: 4</span>
                                    <span class="d-block fs0-9">پست های هفته گذشته: 10</span>
                                    <span class="d-block fs0-9">پست های ماه گذشته: 204</span>
                                    </div>
                                </div>
                            </div>
                            <span data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></span>

                        </a>
                    </div>
                </div>
            </div>
            @endforeach


        </div>


@endsection