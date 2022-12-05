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
                    <li class="breadcrumb-item"><a href="#">Cashflow</a></li>
                    <li class="breadcrumb-item active">Create</li>
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
                            <form action="/ops/cashflow/store" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Branch</label>
                                    <select name="branch" id="branch" class="form-control" required>
                                        @foreach($branches as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Direction</label>
                                    <select name="direction" id="branch" class="form-control" required>
                                        <option value="1">To HQ</option>
                                        <option value="2">To Branch</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input type="number" class="form-control" name="amount" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                </div>
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

@endsection