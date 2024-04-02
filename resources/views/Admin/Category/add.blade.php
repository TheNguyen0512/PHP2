@extends('Components.admin.admin')
@section('title')
<title>Add | Category</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('admins\adminStyless.css')}}">
@endsection
@section('Js')
<script src="{{asset('admins\adminJs.js')}}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin-categories')}}" class="btn btn-link"><i class="fa fa-long-arrow-alt-left" aria-hidden="true"></i> Back</a>
                </div>
                <div class="col-md-12">
                    <div class="panel-body">
                        <form method="post" action="{{ route('post-categories-create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name"> * Category name</label>
                                <input require="true" type="text" class="form-control @error('cate_name') is-invalid @enderror" id="cate_name" name="cate_name" value="{{ old('cate_name') }}" placeholder="Enter category name">
                            </div>
                            @error('cate_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="custom-form-group">
                                <label for="name">Category Image</label>
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" for="inputGroupFile01" id="imageLabel">Choose file</label>
                                        <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_category">Category Parent</label>
                                <select class="form-control" name="id_parent" id="id_parent">
                                    <option value="0">--- Select a category parent---</option>
                                    {!! $htmlOptions !!}
                                </select>
                            </div>
                            <button class="btn btn-success" id="categorySave">Save</button>
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