@extends('frontend.layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="ui-block">
                    <div class="ui-block-title" dir="rtl">
                        <div class="h6 title">دانشکده {{$majors->title}}</div>
                        <a href="" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($majors->childrenRecursive as $major)
    <div class="container">
        <div class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="ui-block" dir="rtl">


                    <table class="event-item-table">
                        <tbody>
                        <tr class="event-item">


                            <td class="author">
                                <div class="event-author inline-items">
                                    <div class="author-thumb">
                                        <img class="major-list-avatar" src="/images/avatars/civil.jpg" alt="author">
                                    </div>
                                    <div class="author-date">
                                        <a href="{{route('study.posts' , ['slug'=>$major->slug])}}" class="author-name h6">{{$major->title}}</a>
                                    <time class="published" datetime="2017-03-24T18:18">@if($major->type == 1) کارشناسی @elseif($major->type == 2) کارشناسی ارشد @elseif($major->type == 3) دکتری @endif</time>
                                    </div>
                                </div>
                            </td>
                            <td class="location">
                                <div class="place inline-items">
                                    <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                    <span>100 پست</span>
                                </div>
                            </td>
                            <td class="description">
                                <p class="description">آخرین فعالیت: 20 دقیقه پیش</p>
                            </td>
                            <td class="users">
                                <ul class="friends-harmonic">
                                    <li>
                                        <a href="#">
                                            <img src="/frontend/img/friend-harmonic5.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/frontend/img/friend-harmonic10.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/frontend/img/friend-harmonic7.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/frontend/img/friend-harmonic8.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="/frontend/img/friend-harmonic2.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="all-users bg-breez">+24</a>
                                    </li>

                                    <li class="with-text">
                                        تعداد اعضا
                                    </li>
                                </ul>
                            </td>
                            <td class="add-event">
                                <a href="" class="btn btn-breez btn-sm">ورود</a>
                            </td>

                        </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection