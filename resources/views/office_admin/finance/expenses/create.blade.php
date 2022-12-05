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
                    <li class="breadcrumb-item"><a href="#">Expenses</a></li>
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
                            <form action="/expenses/store" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Code</label>
                                    <select name="type" id="type" class="form-control" id="select_item">
                                        @foreach($codes as $item)
                                        <option value="{{$item->id}}">{{$item->expense_type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-1">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>

                                <div class="form-group mt-1">
                                    <label for="">Amount</label>
                                    <input type="number" class="form-control" name="amount">
                                </div>
                                <div class="form-group mt-1">
                                    <label for="">Remarks</label>
                                    <textarea type="text" class="form-control" name="remarks" rows="3"></textarea>
                                </div>

                                <div class="form-group mt-1">
                                    <label for="">Created By</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled>
                                </div>

                                <button class="btn btn-primary w-100 mt-2">Submit</button>
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