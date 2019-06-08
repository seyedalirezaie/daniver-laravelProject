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
                <h4>ایجاد پست جدید</h4>
            </div>

            <create-post-component :categories="{{$categories}}" :tags="{{$tags}}"></create-post-component>
        </div>
    </div><!-- /.container-fluid -->
</section>


@endsection

@section('scripts')
<script src="{{asset('/js/app.js')}}"></script>
<script src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
<script src="/js/ckeditor/translations/fa.js"></script>

<script>
$(document).on('click', '.btn-insert-post', function () {

        var srcArray = [];
        $('#editor img').each(function () {
        var imageSRC = $(this).attr('src');
        srcArray.push(imageSRC);
        })
        $('.photos-path').val(srcArray);
})
</script>
@endsection