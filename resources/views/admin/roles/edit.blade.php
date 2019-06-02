@extends('admin.layout.master_admin')

@section('content')

    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <div>
                <h3 class="box-title"> ویرایش نقش </h3>
                <h4 class="box-title text-danger">{{$role->name}}</h4>
                <h5 class="box-title">({{$role->explanation}})</h5>
                </div>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
           {{-- <div class="box-header with-border">
                @include('partials.form_errors')
            </div>--}}
            <!-- /.box-header -->
            <div class="box-body" style="">

                <form class="col-md-6" method="post" action="/administrator/roles/{{$role->id}}">
                    <input type="hidden" name="_method" value="PATCH">
                    @csrf
                    <div class="form-group">
                        <label>عنوان</label>
                        <input name="title" placeholder="عنوان نقش" class="form-control" value="{{$role->name}}">
                    </div>

                    <div class="form-group">
                        <label>توضیح</label>
                        <input name="explanation" placeholder="توضیح نقش" class="form-control" value="{{$role->explanation}}">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    تعیین سطح دسترسی
                                </div>
                                @foreach($permissions as $permission)
                                    <div class="form-check col-xl-6 col-lg-6 col-md-12">
                                        <input @foreach($role->permissions as $rolePermission) {{$rolePermission->id === $permission->id ? 'checked' : ''}} @endforeach class="form-check-input" type="checkbox" name="permission[]" value="{{$permission->id}}">
                                        <label class="form-check-label">{{$permission->name}}</label>
                                        <span>({{$permission->explanation}})</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">اعمال تغییرات</button>

                </form>

            </div>

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">نقش های موجود</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>نقش</th>
                                <th>توضیح نقش</th>
                                <th>زمان ایجاد</th>
                                <th>زمان به روز رسانی</th>
                            </tr>
                            @foreach($roles as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->explanation}}</td>
                                <td>
                                    {{\Hekmatinasser\Verta\Verta::instance($row->created_at)->formatDifference()}}
                                </td>
                                <td>
                                    {{\Hekmatinasser\Verta\Verta::instance($row->updated_at)->formatDifference()}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>

@endsection