@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins\role\add\add.css')}}">
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Role', 'key'=>'Add'] )

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('role.create')}}" method="post" style="width: 100%">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên vai trò">
                            </div>
                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <textarea class="form-control" name="display_name"
                                          placeholder="Mô tả vai trò" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="check_all">
                                        Check All
                                    </label>
                                </div>
                            </div>
                        </div>
                        @foreach($permissionParents as $permissionParent)

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" class="checkbox_wrapper"
                                                       value="{{$permissionParent->id}}">
                                            </label>
                                            {{$permissionParent->name}}
                                        </div>

                                        <div class="row">
                                            @foreach($permissionParent->permissionChildren as $permissionParentItem)
                                                <div class="card-body text-primary">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" class="checkbox_children"
                                                                   value="{{$permissionParentItem->id}}"
                                                                   name="permission_id[]">
                                                        </label>
                                                        {{$permissionParentItem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admins\role\add\add.js')}}"></script>
@endsection


