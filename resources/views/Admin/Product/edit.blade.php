@extends('Components.admin.admin')
@section('title')
<title>Edit | Product</title>
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
                        <form action="{{route('post-products-update', ['id'=> $product->pro_id])}}" method="post" enctype="multipart/form-data" id="edit">
                            @csrf
                            <div class="form-group">
                                <label for="name">* Product name</label>
                                <input require="true" type="text" class="form-control @error('pro_name') is-invalid @enderror" id="pro_name" name="pro_name" placeholder="Enter name product" value="@if($errors->has('pro_name')) {{old('pro_name')}} @else {{ $product->pro_name }}@endif">
                            </div>
                            @error('pro_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Price</label>
                                <input require="true" type="floatval" class="form-control @error('pro_price') is-invalid @enderror" id="pro_price" name="pro_price" placeholder="Enter price product" value="@if($errors->has('pro_price')) {{old('pro_price')}} @else {{ $product->pro_price }}@endif">
                            </div>
                            @error('pro_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Quantity</label>
                                <input require="true" type="floatval" class="form-control @error('pro_quantity') is-invalid @enderror" id="pro_quantity" name="pro_quantity" placeholder="Enter quantity product" value="@if($errors->has('pro_quantity')) {{old('pro_quantity')}} @else {{ $product->pro_quantity }}@endif">
                            </div>
                            @error('pro_quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="price">* Featured</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio_img" value="false" {{ $product->is_featured == true ? 'checked' : '' }}> No
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio_img" value="true" {{ $product->is_featured == false ? 'checked' : '' }}> Yes
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
                                <input require="true" type="text" class="form-control @error('pro_brand') is-invalid @enderror" id="pro_brand" name="pro_brand" placeholder="Enter brand product" value="@if($errors->has('pro_brand')) {{old('pro_brand')}} @else {{ $product->pro_brand }}@endif">
                            </div>
                            @error('pro_brand')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="custom-form-group">
                                <label for="name">* Product Image</label>
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" for="inputGroupFile01" id="imageLabel">Choose image</label>
                                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                <div class="col-xs-12 col-md-2">
                                    <a href="javascript:void(0);" class="thumbnail" data-id="main-img" onclick="zoomImg(this)">
                                        <img class="img" id="main-img" src="data:image/jpeg;base64,{{ base64_encode($product->pro_img) }}">
                                    </a>
                                </div>
                            </div>
                            <div class="custom-form-group">
                                <label for="name">Detailed photo</label>
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" id="img_label_1">Choose image 1</label>
                                        <input type="file" class="custom-file-input" id="img_1" name="img_1" accept="image/*">
                                    </div>
                                </div>
                                @error('img_1')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" id="img_label_2">Choose image 2</label>
                                        <input type="file" class="custom-file-input" id="img_2" name="img_2" accept="image/*">
                                    </div>
                                </div>
                                @error('img_2')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" id="img_label_3">Choose image 3</label>
                                        <input type="file" class="custom-file-input" id="img_3" name="img_3" accept="image/*">
                                    </div>
                                </div>
                                @error('img_3')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" id="img_label_4">Choose image 4</label>
                                        <input type="file" class="custom-file-input" id="img_4" name="img_4" accept="image/*">
                                    </div>
                                </div>
                                @error('img_4')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="custom-input-group mb-3">
                                    <div class="custom-file-wrapper">
                                        <label class="custom-file-label" id="img_label_5">Choose image 5</label>
                                        <input type="file" class="custom-file-input" id="img_5" name="img_5" accept="image/*">
                                    </div>
                                </div>
                                @error('img_5')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                @php $count = 1 @endphp
                                @foreach($product->productImages->sortBy('proImg_order') as $item)
                                <div class="col-xs-12 col-md-2">
                                    <a href="javascript:void(0);" class="thumbnail" data-id="{{$item->proImg_id}}" onclick="zoomImg(this)">
                                        <img class="img" id="{{$item->proImg_id}}" src="data:image/jpeg;base64,{{ base64_encode($item->proImg_img) }}">
                                    </a>
                                </div>
                                <input type="hidden" name="img_id_{{ $count }}" value="{{$item->proImg_id }}">
                                @php $count++ @endphp
                                @endforeach
                            </div>
                            <div id="overlay"></div>
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">* Content</h3>
                                </div>
                                <div class="box-body pad">
                                    <textarea id="pro_description" name="pro_description" rows="10" cols="80">@if($errors->has('pro_description')) {{old('pro_description')}} @else {{ $product->pro_description }}@endif</textarea>
                                </div>
                            </div>
                            @error('pro_description')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div>
@endsection