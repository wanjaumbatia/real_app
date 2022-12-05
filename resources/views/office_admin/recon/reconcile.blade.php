@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">{{$name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Customer</a></li>
                    <li class="breadcrumb-item active">Reconcile</li>
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
                            <form action="/reconcile_post/{{$name}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Expected Amount</label>
                                    <input type="number" class="form-control" value="{{$total}}" hidden name="expected" />
                                    <input type="text" class="form-control" value="₦{{number_format($total)}}" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="">Summited Amount</label>
                                    <input type="number" class="form-control" name="submited" />
                                </div>

                                <button class="btn btn-primary w-100">Reconcile</button>
                            </form>


                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($collection as $item)
                                    <tr>
                                        <td>{{$item->customer}}</td>
                                        <td>{{$item->transaction_type}}</td>
                                        <td>{{number_format($item->amount)}}</td>
                                        <td>{{$item->status}}</td>
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