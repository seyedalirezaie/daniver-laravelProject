@extends('admin.layout.master_admin')

@section('content')

    <blog-category-component></blog-category-component>

@endsection

@section('scripts')
    <script src="{{asset('/js/app.js')}}"></script>
@endsection