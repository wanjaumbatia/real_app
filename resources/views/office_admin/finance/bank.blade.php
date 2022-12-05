@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Bank Accounts</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Bank Accounts</a></li>
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
                            <div class="col-12 mt-2">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <th>Name</th>
                                        <th>Account Number</th>
                                        <th>Branch</th>
                                        <th>Balance</th>
                                    </thead>
                                    <tbody>
                                        @foreach($banks as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->account_number}}</td>
                                            <td>{{$item->branch}}</td>
                                            <td>{{number_format($item->balance)}}</td>
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