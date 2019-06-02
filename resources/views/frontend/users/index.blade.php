@extends('frontend.layout.master')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/vue2-animate/dist/vue2-animate.min.css"/>
@endsection

@section('content')

    <div class="container-fluid" {{--id="app"--}}>
    <users-component></users-component>
        <vue-progress-bar></vue-progress-bar>
        <notifications group="auth"
                       position="bottom left"
                       width="400"
                       :speed="500" />
    </div>




@endsection

@section('scripts')
    <script src="{{asset('/js/app.js')}}"></script>
@endsection