@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Withdrawals</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Reconciliation</a></li>
                    <li class="breadcrumb-item active">Withdrawals</li>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <th>Customer</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Commission</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->customer}}</td>
                                        <td>{{$item->plan}}</td>
                                        <td>{{number_format($item->amount)}}</td>
                                        <td>{{number_format($item->commission)}}</td>
                                        <td><a class="btn btn-sm btn-primary" href="/reconcile_withdrawal/{{$item->id}}">Reconcile</a></td>
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
</div>
<!-- /.modal -->

@endsection