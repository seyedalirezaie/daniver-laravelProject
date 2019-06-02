@extends('admin.layout.master_admin')

@section('content')

    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">سطوح دسترسی</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-header with-border">
                <a class="btn btn-app pull-left" href="{{route('permissions.create')}}">
                    <i class="fa fa-plus"></i> جدید
                </a>
            </div>

            {{--@if(Session::has('brand_add'))
                <div class="box-header with-border bg-success">
                    {{session('brand_add')}}
                </div>
        @endif--}}

        <!-- /.box-header -->
            <div class="box-body" style="">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>توضیح</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->explanation}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{route('permissions.edit' , $permission->id)}}">ویرایش</a>
                                    <form class="d-inline-block" method="post" action="/administrator/permissions/{{$permission->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                   {{-- <div>
                        {{$brands->links()}}
                    </div>--}}

                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>

@endsection