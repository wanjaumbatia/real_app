@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Cashflow</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Finance</a></li>
                    <li class="breadcrumb-item active">Cashflow</li>
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
                            <table class="table table-striped" id='datatable'>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Branch</th>
                                        <th>To</th>
                                        <th>From</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->branch}}</td>
                                        <td>{{$item->to}}</td>
                                        <td>{{$item->from}}</td>
                                        <td>{{number_format($item->amount)}}</td>
                                        <td>
                                            @if($item->status=="pending")
                                            <a href="/confirm_cashflow/{{$item->id}}" class="btn btn-sm btn-primary">Confirm</a>
                                            @else
                                            <p class="text-success">Confirmed</p>
                                            @endif
                                        </td>
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

@endsection