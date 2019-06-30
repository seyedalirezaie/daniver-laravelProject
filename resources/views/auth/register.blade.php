@extends('frontend.layout.master')

@section('titleTag')
    <title>ثبت نام</title>
@endsection

@section('content')
<div class="container" id="app">

    <register-component></register-component>
    <vue-progress-bar></vue-progress-bar>
    <notifications group="reg"
                   position="bottom left"
                   width="450"
                   :speed="240"></notifications>
</div>
@endsection


@section('scripts')
    <script src="{{asset('/js/app.js')}}"></script>


    <script>

        $(document).on('click', '.vpd-actions button:first', function () {

            $('.date-select-container').addClass('is-focused');
            $('.date-select-container').removeClass('is-empty');
        })


    </script>
@endsection