@extends('frontend.layout.master')

@section('content')


        <div class="row" dir="rtl">
            <div class="col-12 pb-4">
                <h5 class="presentation-margin">دانشکده خود را انتخاب کنید</h5>
            </div>

            @foreach($majors as $major)
            <div dir="ltr" class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="ui-block">


                    <!-- Friend Item -->

                    <div class="friend-item">
                        {{--<a href="{{route('study.college' , ['slug'=>$major->slug])}}" class="friend-header-thumb">
                            <img src="/images/adabiat.jpg" alt="friend">
                        </a>--}}

                        <div class="photo-item">
                            <img src="/images/md/{{$major->photo->path}}" alt="photo">
                            <div class="overlay overlay-dark"></div>

                            <a href="{{route('study.college' , ['slug'=>$major->slug])}}" data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></a>
                        </div>

                        <div class="friend-item-content">


                            <div class="friend-avatar bg-text-image">
                                <div class="author-content">
                                    <a href="{{route('study.college' , ['slug'=>$major->slug])}}" class="h5 author-name text-blue-light text-shadow">دانشکده {{$major->title}}</a>
                                </div>
                            </div>

                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="friend-count">
                                            <a href="#" class="friend-count-item">
                                                <div class="h6">{{$major->subusers}}</div>
                                                <div class="title">اعضا</div>
                                            </a>
                                            <a href="#" class="friend-count-item">
                                                <div class="h6">{{$major->subposts}}</div>
                                                <div class="title">پست ها</div>
                                            </a>
                                            <a href="#" class="friend-count-item">
                                                <div class="h6">{{$major->children_recursive_count}}</div>
                                                <div class="title">رشته ها</div>
                                            </a>
                                        </div>
                                        <div class="control-block-button">
                                            <div>
                                                <span>پست های امروز:</span>
                                                <span>{{$major->dateposts[0]}}</span>
                                            </div>
                                            <div>
                                                <span>پست های هفته گذشته:</span>
                                                <span>{{$major->dateposts[1]}}</span>
                                            </div>
                                            <div>
                                                <span>پست های ماه گذشته:</span>
                                                <span>{{$major->dateposts[2]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- ... end Friend Item -->
                </div>
            </div>
            @endforeach
        </div>


@endsection