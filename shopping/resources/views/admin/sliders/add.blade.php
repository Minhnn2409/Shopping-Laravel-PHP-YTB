@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('/admins/slider/add/add.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Slider', 'key'=>'Add'] )

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       placeholder="Nhập tên menu" value="{{old('name')}}">
                            </div>

                            @error('name')
                            <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror" rows="5"
                                    name="description"
                                    placeholder="Nhập mô tả"
                                >
                                    {{old('description')}}
                                </textarea>
                            </div>

                            @error('description')
                            <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Ảnh slider</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror"
                                       name="image_path">
                            </div>

                            @error('image_path')
                            <div class="alert alert-danger alert-error-input">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


