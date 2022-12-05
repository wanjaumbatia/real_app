@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">{{$account->customer}} - {{$plan->name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Customer</a></li>
                    <li class="breadcrumb-item active">Withdrawal</li>
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
                            <form id='withdrawal-form'>
                                <input type="text" id="id" value="{{$account->id}}" hidden>
                                <p class="font-weight-bold">Balance - {{number_format($balance)}}</p>
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input value="13700" type="number" id="amount" class="form-control" required>
                                </div>
                                @if($plan->regular == true)
                                <div class="form-group">
                                    <label for="">Commission</label>
                                    <input value="300" type="number" id="commission" class="form-control" required>
                                </div>
                                @endif
                                <button class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-sm" id='comm_modal'>
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Small Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection