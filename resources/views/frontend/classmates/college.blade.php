@extends('frontend.layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="ui-block">
                    <div class="ui-block-title" dir="rtl">
                        <div class="h6 title">دانشکده {{$majorTitle}}</div>
                        <a href="" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($majors as $major)
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
                                        <img class="major-list-avatar img-circle-40" src="/images/avatars/{{$major->photo ? $major->photo->path : ''}}" alt="author">
                                    </div>
                                    <div class="author-date">
                                        <a href="/{{$major->url}}/posts/{{$major->slug}}" class="author-name h6">{{$major->title}}</a>
                                    <time class="published" datetime="2017-03-24T18:18">@if($major->type == 1) کارشناسی @elseif($major->type == 2) کارشناسی ارشد @elseif($major->type == 3) دکتری @endif</time>
                                    </div>
                                </div>
                            </td>
                            <td class="location">
                                <div class="place inline-items">
                                    <svg class="olymp-add-a-place-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-add-a-place-icon"></use></svg>
                                    <span>{{$major->posts_count}} پست</span>
                                </div>
                            </td>
                            <td class="description">
                                <p class="description">آخرین فعالیت: {{$major->latest_action ? \Hekmatinasser\Verta\Verta::instance($major->latest_action)->formatDifference() : 'بدون فعالیت'}}</p>
                            </td>

                            <td class="users">
                                <span>تعداد اعضا:</span>
                                <span>{{$major->users_count}}</span>
                            </td>
                            <td class="add-event">
                                <a href="/{{$major->url}}/posts/{{$major->slug}}" class="btn btn-breez btn-sm">ورود</a>
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