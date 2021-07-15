@extends('layout.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('partials.content-header', ['name'=>'Permission', 'key'=>'Add'] )


    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permission.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên permission cha</label>
                                <select class="form-control" name="name">
                                    <option value="">Chọn module</option>
                                    @foreach($moduleParents as $moduleParent)
                                        <option value="{{$moduleParent}}">{{$moduleParent}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach($moduleChildren as $moduleChild)
                                        <div class="col-md-3">
                                            <label for="{{$moduleChild}}">
                                                <input type="checkbox" id="{{$moduleChild}}" value="{{$moduleChild}}"
                                                       name="module_children[]"/>
                                                {{$moduleChild}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


