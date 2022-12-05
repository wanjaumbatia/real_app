@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Plans</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Plans</a></li>
                    <li class="breadcrumb-item active">Index</li>
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
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="/plans/create" class="btn btn-primary btn-sm">New Plan</a>
                            </div>
                            <div class="col-12">
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Charge</th>
                                            <th>Commission</th>
                                            <th>Duration</th>
                                            <th>Penalty</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($plans as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->charge}}</td>
                                            <td>{{$item->commission}}</td>
                                            <td>{{$item->duration}}</td>
                                            <td>{{$item->penalty}}</td>
                                            <td><a href="/plans/edit/{{$item->id}}" class="btn btn-primary btn-sm">Edit</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection