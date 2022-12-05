@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Expenses</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Finance</a></li>
                    <li class="breadcrumb-item active">Expenses</li>
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
                <div class="table-responsive">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <a class="btn btn-sm btn-primary" href="/expenses/create">New Expense</a>
                                </div>
                                <div class="col-12 mt-2">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Expense Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $item)
                                            <tr>
                                                <td>{{$item->created_at}}</td>
                                                <td>{{$item->type}}</td>
                                                <td>{{$item->description}}</td>
                                                <td>{{number_format($item->amount)}}</td>
                                                <td>{{$item->created_by}}</td>
                                                <td>{{$item->status}}</td>
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
</div>

@endsection