@extends('Components.admin.admin')
@section('title')
<title>Add | Permission</title>

@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <form method="post" action="{{route('post-permission-create')}}">
                            @csrf
                            <div class="form-group">
                                <label for="id_category">Menu Parent</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">Select Module</option>
                                    @foreach(config('permissions.table_module') as $moduleItem)
                                    <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- check --->
                            <div class="form-group">
                                <div class="card border-dark mb-3">
                                    <div class="row text-center col-md-12">
                                        <!-- list --->
                                        @foreach(config('permissions.module_childrent') as $moduleItem)
                                        <div class="card-body col-md-3">
                                            <h4 class="card-title">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox_childent" type="checkbox" name="module_childrent[]" value="{{$moduleItem}}">
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                        {{$moduleItem}}
                                                    </label>
                                                </div>
                                            </h4>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" id="permission_add">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <!-- /.content -->
</div>
@endsection