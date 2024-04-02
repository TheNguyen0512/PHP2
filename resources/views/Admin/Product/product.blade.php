@extends('Components.admin.admin')
@section('title')
<title>Products</title>
@endsection
@section('Css')
    <link rel="stylesheet" href="{{asset('admins\adminStyless.css')}}">
@endsection
@section('Js')
<script>
    $(function() {
        $('#example1').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': false,
            'autoWidth': false
        })
    })

</script>
<script src="{{asset('admins\adminJs.js')}}"></script>

@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Products
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">products</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4 ">
                                <div class="button">
                                    <a href="{{ route('admin-products-add') }}"><button class="btn btn-success btn-add">Add Product</button></a>
                                </div>
                            </div>
                            <div class="col-xs-8 ">
                                <form method="GET" action="{{route('admin-products')}}" id="form-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="search" placeholder="Search by Name">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-fw fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image(s)</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $item)
                                <tr>
                                    <td>{{$item->pro_id}}</td>
                                    <td>{{ $item->pro_name }}</td>
                                    <td>{{ $item->pro_price }}</td>
                                    <td>
                                        @if($item->pro_img)
                                        <img class="img" src="data:image/jpeg;base64,{{ base64_encode($item->pro_img) }}">
                                        @endif
                                    </td>
                                    <td>{{ $item->category->cate_name}}</td>
                                    <th>
                                        <a href="{{ route('admin-products-change-status', ['id'=>$item->pro_id]) }}" class="btn @if($item->pro_status == true) btn-success @else btn btn-danger @endif " role="button">
                                            @if($item->pro_status == true) On @else Off @endif 
                                        </a>
                                       
                                    </th>
                                    <td>
                                        <a href="{{ route('admin-products-edit', ['id'=>$item->pro_id]) }}" class="btn btn-success" role="button">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin-products-delete', ['id' => $item->pro_id]) }}" class="btn btn-danger" role="button" onclick ="confirmDelete(event,this)">
                                            <i class="fa fa-fw fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image(s)</th>
                                    <th>Category</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                        {{ $products->links()}}
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection

