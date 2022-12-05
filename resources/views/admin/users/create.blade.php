@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active">Create</li>
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
                        <form action="/users" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select name="branch" id="branch" class="form-control">
                                    @foreach($branches as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($roles as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">User Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="Field">Field</option>
                                    <option value="HQ">HQ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" name="description" id="description" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
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