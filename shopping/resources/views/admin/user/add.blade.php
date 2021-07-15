@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection
@section('css')
    <link href="{{asset('vendor\select2\select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admins\user\add\add.css')}}"/>
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'User', 'key'=>'Add'] )


    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('user.create')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên người dùng">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="Nhập email người dùng">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"
                                       placeholder="Nhập password người dùng">
                            </div>

                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select class="form-control select2_init" name="role_id[]" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src={{asset('vendor\select2\select2.min.js')}}></script>
    <script src="{{asset('admins\user\add\add.js')}}"></script>
@endsection

