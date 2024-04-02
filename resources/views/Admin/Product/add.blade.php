@extends('Components.admin.admin')
@section('title')
<title>Add | Product</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('AdminLTE-2.4.18/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/adminStyless.css')}}">
@endsection
@section('Js')
<script src="{{asset('AdminLTE-2.4.18/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('AdminLTE-2.4.18/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admins/adminJs.js')}}"></script>
<script src="{{asset('admins/Product/product.js')}}"></script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin-products')}}" class="btn btn-link"><i class="fa fa-long-arrow-alt-left" ria-hidden="true"></i> Back</a>
                </div>
                <div class="col-md-12">
                    <div class="panel-body add">
                        <form action="{{route('post-products-create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">* Product name</label>
                                <input require="true" type="text" class="form-control @error('pro_name') is-invalid @enderror" id="pro_name" name="pro_name" placeholder="Enter name product" value="{{old('pro_name')}}">
                            </div>
                            @error('pro_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Price</label>
                                <input require="true" type="floatval" class="form-control @error('pro_price') is-invalid @enderror" id="pro_price" name="pro_price" placeholder="Enter price product" value="{{old('pro_price')}}">
                            </div>
                            @error('pro_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Quantity</label>
                                <input require="true" type="floatval" class="form-control @error('pro_quantity') is-invalid @enderror" id="pro_quantity" name="pro_quantity" placeholder="Enter quantity product" value="{{old('pro_quantity')}}">
                            </div>
                            @error('pro_quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Featured</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio_img" value="false" checked> No
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio_img" value="true"> Yes
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_parent">* Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                    <option value="">--- Select a category ---</option>
                                    {!! $htmlOptions !!}
                                </select>
                            </div>
                            @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Brand</label>
                                <input require="true" type="text" class="form-control @error('pro_brand') is-invalid @enderror" id="pro_brand" name="pro_brand" placeholder="Enter brand product" value="{{old('pro_brand')}}">
                            </div>
                            @error('pro_brand')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="custom-form-group">
                                <label for="name">* Product Image</label>
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" for="inputGroupFile01" id="imageLabel">Choose file</label>
                                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="custom-form-group">
                                <label for="name">Detailed photo <span style="color: #999999;">(The number of photos will be in the order you choose)</span></label>
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" id="imageChildentLabel">Choose file</label>
                                        <input type="file" class="custom-file-input" id="img_childent" name="img_childent[]" accept="image/*" multiple>
                                    </div>
                                </div>
                            </div>
                            @error('img_childent')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('img_childent.*')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">* Content</h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="pro_description" name="pro_description" rows="10" cols="80">{{old('pro_description')}}</textarea>
                                </div>
                            </div>
                            @error('pro_description')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@endsection