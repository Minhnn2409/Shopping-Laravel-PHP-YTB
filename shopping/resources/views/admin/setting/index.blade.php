@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admins\setting\add.css')}}">
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Setting', 'key'=>'List'] )


    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right action-group">
                            <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
                                Add
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('setting.add') . '?type=Text'}}">Text</a></li>
                                <li><a href="{{route('setting.add') . '?type=Textarea'}}">TextArea</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config_key</th>
                                <th scope="col">Config_value</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <th scope="row">{{$setting->id}}</th>
                                    <td>{{$setting->config_key}}</td>
                                    <td>{{$setting->config_value}}</td>
                                    <td>
                                        <a href="{{route('setting.edit', ['id'=>$setting['id']]) .'?type=' . $setting->type}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('setting.delete', ['id'=>$setting['id']])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">{{$settings->links('pagination::bootstrap-4')}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('vendor\sweetAlert\sweetalert2@11.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins\product\index\index.js')}}"></script>
@endsection



