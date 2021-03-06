@extends('frontend.layout.master')

@section('titleTag')
    <title>درس و بحث:: دانشکده ها</title>
@endsection
@section('metaDescription')
    <meta name="description" content="با انتخاب دانشکده رشته های مرتبط را مشاهده کنید">
@endsection
@section('metaKeywords')
    <meta name="keywords" content="سوالات درسی,سوال و جواب,آموزش درسی,امتحانات دانشگاه,دانشگاه ولی عصر,دانشگاه ولیعصر,دانشگاه رفسنجان,دانشکده,فنی و مهندسی,ادبیات و علوم انسانی,ایران شناسی,علوم اداری و اقتصاد,علوم پایه,علوم ریاضی,کشاورزی">
@endsection

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

                        <a href="{{route('study.college' , ['slug'=>$major->slug])}}" class="photo-item college">
                            <img src="/images/md/{{$major->photo->path}}" alt="photo">
                            <div class="overlay overlay-dark"></div>

                            <span data-toggle="modal" data-target="#open-photo-popup-v1" class="  full-block"></span>
                        </a>

                        <div class="friend-item-content">


                            <div class="friend-avatar bg-text-image">
                                <div class="author-content">
                                    <a href="{{route('study.college' , ['slug'=>$major->slug])}}" class="h5 author-name fs0-9">دانشکده {{$major->title}}</a>
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