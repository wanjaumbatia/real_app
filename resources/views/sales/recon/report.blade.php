@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Reconciliation Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Report</a></li>
                    <li class="breadcrumb-item active">Reconciliation</li>
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
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Collection</th>
                                <th>Withdrawals</th>
                                <th>Commission</th>
                                <th>Registration Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->reconciled_on}}</td>
                                    <td>{{number_format($item->collection)}}</td>
                                    <td>{{number_format($item->withdrawals)}}</td>
                                    <td>{{number_format($item->loans)}}</td>
                                    <td>{{number_format($item->registration)}}</td>
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