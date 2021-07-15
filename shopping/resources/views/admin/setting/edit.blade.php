@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Setting', 'key'=>'Edit'] )


    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('setting.update', ['id'=>$setting->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nhập config_key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror"
                                       name="config_key" placeholder="Nhập config_key"
                                       value="{{$setting->config_key}}">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập config_value</label>
                                @if(request()->type==='Text')
                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror"
                                           name="config_value"
                                           placeholder="Nhập config_value" value="{{$setting->config_value}}">
                                @elseif(request()->type === 'Textarea')
                                    <textarea name="config_value" class="form-control" rows="5"
                                              placeholder="Nhập config_value"
                                              @error('config_value') is-invalid @enderror
                                    ">{{$setting->config_value}}</textarea>
                                @endif
                                @error('config_value')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


