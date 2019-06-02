@extends('admin.layout.master_admin')

@section('content')

    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <div>
                <h3 class="box-title"> ویرایش دسترسی </h3>
                <h4 class="box-title text-danger">{{$permission->title}}</h4>
                <h5 class="box-title">({{$permission->explanation}})</h5>
                </div>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-header with-border">
                @include('partials.form_errors')
            </div>

            <div class="box-body" style="">

                <form class="col-md-6" method="post" action="/administrator/permissions/{{$permission->id}}">
                    <input type="hidden" name="_method" value="PATCH">
                    @csrf
                    <div class="form-group">
                        <label>دسترسی</label>
                        <input name="name" placeholder="دسترسی" class="form-control" value="{{$permission->name}}">
                    </div>

                    <div class="form-group">
                        <label>توضیح</label>
                        <input name="explanation" placeholder="توضیح دسترسی" class="form-control" value="{{$permission->explanation}}">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    تعیین نقش
                                </div>
                                @foreach($roles as $role)
                                    <div class="form-check col-xl-6 col-lg-6 col-md-12">
                                        <input @foreach($permission->roles as $rolePermission) {{$rolePermission->id === $role->id ? 'checked' : ''}} @endforeach class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}">
                                        <label class="form-check-label">{{$role->name}}</label>
                                        <span class="text-danger">({{$role->explanation}})</span>
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
                        <h5 class="card-title">دسترسی های موجود</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>دسترسی</th>
                                <th>توضیح</th>
                                <th>زمان ایجاد</th>
                                <th>زمان به روز رسانی</th>
                            </tr>
                            @foreach($permissions as $row)
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