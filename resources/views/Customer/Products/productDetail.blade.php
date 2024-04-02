@extends('Components.shop.index')
@section('title')
<title>Details</title>
@endsection
@section('Css')
@endsection
@section('content')
@include('Components.shop.hero', ['categories' => $categories, 'product' => $product])

<section class="product-details spad">
    <div class="container">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.show', ['id' => $product->category->cate_id]) }}">{{ $product->category->cate_name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->pro_name}}</li>
                </ol>
            </nav>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="data:image/jpeg;base64,{{ base64_encode($product->pro_img) }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach($product->productImages as $image)
                            <img src="data:image/jpeg;base64,{{ base64_encode($image->proImg_img) }}" alt="" class="product__details__pic__item--small" onclick="showLargeImage(this)">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->pro_name }}</h3>
                    <div class="product__details__rating">
                        <!-- Rating stars -->
                    </div>                    
                    <div>Brand: {{ strtoupper($product->pro_brand) }}</div>
                    <div class="product__details__price">${{ $product->pro_price }}</div>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1" id="quantity">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">ADD TO CART</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><br>Description: </br> <span>{!! nl2br(e($product->pro_description)) !!}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
            </div>
        </div>
    </div>
</section>
@endsection
