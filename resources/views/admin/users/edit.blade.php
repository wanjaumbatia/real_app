@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">{{$user->name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/users/{{$user->id}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{$user->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select name="branch" id="branch" class="form-control">
                                    @foreach($branches as $item)
                                    <option {{$user->branch == $item->name ? 'selected' : ''}} value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($roles as $item)
                                    <option {{$user->role == $item->name ? 'selected' : ''}} value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">User Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option {{$user->type == 'Field' ? 'selected' : ''}} value="Field">Field</option>
                                    <option {{$user->type == 'HQ' ? 'selected' : ''}} value="HQ">HQ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Active</label>
                                <select name="active" id="active" class="form-control">
                                    <option {{$user->active == true ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$user->active == false ? 'selected' : ''}} value="0">Not Active</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Blocked</label>
                                <select name="block" id="block" class="form-control">
                                    <option {{$user->blocked == true ? 'selected' : ''}} value="1">Blocked</option>
                                    <option {{$user->blocked == false ? 'selected' : ''}} value="0">Not Blocked</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Short</label>
                                <select name="short" id="short" class="form-control">
                                    <option {{$user->short == true ? 'selected' : ''}} value="1">Shortage</option>
                                    <option {{$user->short == false ? 'selected' : ''}} value="0">Not Shortage</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" name="description" id="description" class="form-control" value="{{$user->description}}">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection