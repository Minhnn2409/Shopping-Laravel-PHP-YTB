@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins\product\index\style.css')}}">
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Product', 'key'=>'List'] )


    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('product.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td><img class="product_image_150_100" src="{{$product->feature_image}}"
                                             alt="Ảnh đại diện">
                                    </td>
                                    <td>{{optional($product->category)->name}}</td>
                                    <td>
                                        <a href="{{route('product.edit', ['id'=>$product['id']])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('product.delete', ['id' => $product['id']])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">{{$products->links('pagination::bootstrap-4')}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('vendor\sweetAlert\sweetalert2@11.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins\product\index\index.js')}}"></script>
@endsection


