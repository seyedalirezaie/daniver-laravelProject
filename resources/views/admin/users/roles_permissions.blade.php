@extends('admin.layout.master_admin')

@section('content')

    <div class="content">
            <div class="box-header with-border">
                <h4 class="box-title">نقش ها و سطوح دسترسی</h4>
                <h3 class="box-title text-danger">{{$user->family}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <form method="POST" action="{{route('user.store' , $user->id)}}">
                @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col">
                        <div class="jumbotron">
                            نقش ها
                        </div>
                        <div class="form-group">
                            <select name="roles[]" class="form-control" multiple style="min-height: 400px">
                                @foreach($roles as $role)
                                    <option

                                    @foreach($user->roles as $userRole)
                                            {{$userRole->id == $role->id ? 'selected="selected"' : ''}}
                                    @endforeach

                                    value="{{$role->id}}">{{$role->name}} ({{$role->explanation}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col">
                        <div class="jumbotron">
                            سطوح دسترسی
                        </div>
                        <div class="form-group">
                            <select class="form-control" multiple style="min-height: 400px" name="permissions[]">
                                @foreach($permissions as $permission)
                                    <option

                                    @foreach($user->permissions as $userPermission)
                                    {{$userPermission->id == $permission->id ? 'selected="selected"' : ''}}
                                    @endforeach

                                    value="{{$permission->id}}">{{$permission->name}} ({{$permission->explanation}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

                <input class="btn btn-success" type="submit" value="ذخیره">

        </form>

        </div>
    </div>

@endsection