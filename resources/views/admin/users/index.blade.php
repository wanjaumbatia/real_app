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
                    <li class="breadcrumb-item active">List</li>
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
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Branch</th>
                                    <th>Role</th>
                                    <th>Active</th>
                                    <th>Short</th>
                                    <th>Blocked</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->branch}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        @if($user->active == true)
                                        <p class="btn btn-success btn-sm m-1">Active</p>
                                        @else
                                        <p class="btn btn-danger btn-sm m-1">Inactive</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->short == true)
                                        <p class="btn btn-danger btn-sm  m-1">Shortage</p>
                                        @else
                                        <p class="btn btn-success btn-sm m-1">No Shortage</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->blocked == true)
                                        <p class="btn btn-danger btn-sm m-1">Blocked</p>
                                        @else
                                        <p class="btn btn-success btn-sm m-1">Not Blocked</p>
                                        @endif
                                    </td>
                                    <td><a href="/users/edit/{{$user->id}}" class="btn btn-primary btn-sm">Edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection