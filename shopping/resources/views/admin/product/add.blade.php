@extends('layout.admin')


@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link href="{{asset('vendor\select2\select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admins\product\add\add.css')}}"/>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Product', 'key'=>'Add'] )

    {{--        <div class="col-md-12">--}}
    {{--            @if ($errors->any())--}}
    {{--                <div class="alert alert-danger">--}}
    {{--                    <ul>--}}
    {{--                        @foreach ($errors->all() as $error)--}}
    {{--                            <li>{{ $error }}</li>--}}
    {{--                        @endforeach--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            @endif--}}
    {{--        </div>--}}
    <!-- Main content -->
        <form action="{{route('product.store')}}" enctype="multipart/form-data" method="post">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{old('name')}}"
                                       placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                       name="price" value="{{old('price')}}" placeholder="Nhập giá sản phẩm">
                                @error('price')
                                <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" class="form-control-file" name="feature_image">
                            </div>

                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple class="form-control-file" name="image_path[]">
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập tag sản phẩm</label>
                                <select class="form-control tags_selected" multiple="multiple" name="tags[]">

                                </select>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea
                                    class="form-control tinymce_editor_init @error('contents') is-invalid @enderror"
                                    name="contents" id="content"
                                    cols="5">{{old('contents')}}</textarea>
                            </div>
                            @error('contents')
                            <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                            @enderror
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


