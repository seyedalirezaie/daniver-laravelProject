@extends('frontend.layout.master')

@section('content')
<div class="container" id="app">

    <register-component></register-component>
    <notifications group="reg"
                   position="bottom left"
                   width="450"
                   :speed="240" />
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