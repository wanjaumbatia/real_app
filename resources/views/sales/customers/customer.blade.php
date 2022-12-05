@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">{{$customer->name}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Customer</a></li>
                    <li class="breadcrumb-item active">Details</li>
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
                            <form>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" value="{{$customer->address}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" value="{{$customer->phone}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control" value="{{$customer->status}}" disabled>
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach($accounts as $item)
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">{{$item['plan']}}</label>
                                        <p>{{$item['name']}}</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="btn btn-sm btn-primary">Statement</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="">Balance</label>
                                <input type="text" class="form-control" value="{{number_format($item['balance'])}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Pending Collection</label>
                                <input type="text" class="form-control" value="{{number_format($item['pending'])}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Pending Withdrawal</label>
                                <input type="text" class="form-control" value="{{number_format($item['pending_withdrawal'])}}" disabled>
                            </div>
                            <a href="/sep/withdrawal/{{$item['id']}}" class="btn btn-primary w-100">Withdraw</a>
                        </div>
                    </div>
                    @endforeach

                    <div class="card mt-2">
                        <div class="card-body">
                            <a href="/loan/{{$customer->id}}" class="btn btn-primary btn-sm w-100 my-1">Apply Loan</a>
                            <a href="/sep/collection/{{$customer->id}}" class="btn btn-primary btn-sm w-100 my-1">Go to payments</a>
                            <button type="button" class="btn btn-primary btn-sm w-100 my-1" data-toggle="modal" data-target="#modal-default">New Plan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Plan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/create_account/{{$customer->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <select name="plan" id="plan" class="form-control">
                        @foreach($plans as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>>
                        @endforeach
                    </select>
                    <button class="btn btn-primary w-100 mt-2" type="submit">Create</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        $("#plan_modal").click(function() {
            $('#modal').modal('show');
        });
    });
</script>
@endsection