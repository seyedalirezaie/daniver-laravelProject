@extends('admin.layout.master_admin')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">بلاگ</a></li>
                    <li class="breadcrumb-item active">افزودن پست جدید</li>
                </ol>
            </div>

            <div class="col-sm-12">
                <h4>کاربران</h4>
            </div>

            <admin-users-component :roles="{{$roles}}"></admin-users-component>
        </div>
    </div><!-- /.container-fluid -->
</section>


@endsection

@section('scripts')
<script src="{{asset('/js/app.js')}}"></script>
@endsection