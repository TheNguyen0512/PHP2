@extends('Admin.layouts.admin')

@section('title')
    <title>Roles</title>
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
    @include('Admin.pages.content-header', ['name' => 'Roles', 'key' => ''])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        @can('role-add')
                            <p><a href="{{route('roles.create')}}" class="btn btn-success" role="button">Add</a></p>
                        @endcan
                    </div>
                    <div class="col-md-5">
                        <!-- SidebarSearch Form -->
                        <form method="GET" action="{{route('roles.index')}}">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control form-control-lg" placeholder="Type your keywords here">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class=" col-md-12">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="col-md-1">STT</th>
                                <th scope="col" class="col-md-2">Name</th>
                                <th scope="col" class="col-md-9">Description of the role</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach($role as $item)
                                <tr>
                                    <th scope="row">{{$count++}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->display_name}}</td>
                                    <td>
                                        @can('role-edit')
                                            <a href="{{route('roles.edit', ['id'=>$item->id])}}"
                                               class="btn btn-success" role="button"><i class="far fa-edit fa-2x"></i></a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('role-delete')
                                            <a href="{{route('roles.delete',['id'=>$item->id])}}"
                                               class="btn btn-danger" id="RolesDelete" role="button" onclick="return confirm('Are you sure delete this roles ?')"><i class="far fa-trash-alt fa-2x"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$role->links()}}
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        <!-- /.content -->
    </div>
@endsection


