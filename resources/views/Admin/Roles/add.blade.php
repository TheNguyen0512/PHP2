@extends('Admin.layouts.admin')
@section('title')
    <title>Add | Roles</title>
@endsection
@section('Css')
    <link rel="stylesheet" href="{{asset('admins\Roles\Roles.css')}}">
@endsection
@section('Js')
    <script src="{{asset('admins\Roles\Roles.js')}}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('Admin.pages.content-header', ['name' => 'Roles' , 'key' => 'add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('roles.index')}}" class="btn btn-link"><i class="fa fa-long-arrow-alt-left"
                                                                                   aria-hidden="true"></i> Back</a>
                    </div>
                    <div class="col-md-12">
                        <div class="panel-body">
                            <form  method="post" action="{{route('roles.store')}}"
                                  enctype="multipart/form-data">
                            @csrf
                            <!-- name -->
                                <div class="form-group">
                                    <label for="name">Roles name</label>
                                    <input type="text" id="name" hidden="true">
                                    <input require="true" type="text"
                                           class="form-control  @error('name') is-invalid @enderror"
                                           id="name" name="name"
                                           placeholder="Enter roles name" value="{{old('name')}}">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            <!-- display_name -->
                                <div class="form-group">
                                    <label for="name">Display name</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"
                                              name="display_name"></textarea>
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- Roles -->
                                <div class="form-group">
                                    <div class="row col-md-2">
                                        <div class="card border-dark mb-3">
                                            <div class="card-header">
                                                <h6 class="card-header text">
                                                    <input class="form-check-input check_all" type="checkbox"
                                                           value="">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Check ALL
                                                    </label>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($PermissonsParent as $itemPraent)
                                        <div class="card border-dark mb-3">
                                            <div class="card-header">
                                                <h5 class="card-header text">
                                                    <input class="form-check-input checkbox_wrapper" type="checkbox"
                                                           value="">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        Module {{$itemPraent->name}}
                                                    </label>
                                                </h5>
                                            </div>
                                            <div class="row text-center col-md-12">
                                                @foreach($itemPraent->PermissionChildent as $itemChildent)
                                                    <div class="card-body col-md-3">
                                                        <h4 class="card-title">
                                                            <div class="form-check">
                                                                <input class="form-check-input checkbox_childent"
                                                                       type="checkbox" name="permission_id[]"
                                                                       value="{{$itemChildent->id}}">
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    {{$itemChildent->name}}
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-success">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection



