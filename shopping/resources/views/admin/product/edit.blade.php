@extends('layout.admin')


@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link href="{{asset('vendor\select2\select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admins\product\add\add.css')}}"/>
    <link rel="stylesheet" href="{{asset('admins\product\edit\edit.css')}}"/>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Product', 'key'=>'Edit'] )


    <!-- Main content -->
        <form action="{{route('product.update', ['id'=>$product->id])}}" enctype="multipart/form-data" method="post">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm"
                                       value="{{$product->name}}">
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" class="form-control" name="price" placeholder="Nhập giá sản phẩm"
                                       value="{{$product->price}}">
                            </div>

                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" class="form-control-file" name="feature_image">
                            </div>

                            <div class="col-md-4">
                                <img class="product_feature_image_edit" src="{{$product->feature_image}}"
                                     alt="Ảnh đại diện">
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">
                            </div>

                            <div class="col-md-12">
                                @foreach($product->images as $imageItem)
                                    <img class="product_detail_image_edit" src="{{$imageItem->image_path}}"
                                         alt="Ảnh chi tiết">
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tag sản phẩm</label>

                                <select class="form-control tags_selected" multiple="multiple" name="tags[]"
                                >
                                    @foreach($product->tags as $tag)
                                        <option selected value="{{$tag->name}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control tinymce_editor_init" name="contents" id="content"
                                          cols="5">{{$product->content}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
@section('js')
    <script src={{asset('vendor\select2\select2.min.js')}}></script>
    <script src="https://cdn.tiny.cloud/1/3rne6jd1jdxvqldt7mxdmt37raq5ger1m53irgiba3raw0kd/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{asset('admins\product\add\add.js')}}"></script>
@endsection


