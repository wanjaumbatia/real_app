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
                <div class="card">
                    <div class="card-body">
                        <form action="/finance/banks/store" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Bank Name</label>
                                <input type="text" class="form-control" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="">Bank Account</label>
                                <input type="text" class="form-control" name="account" />
                            </div>
                            <div class="form-group">
                                <label for="">Bank Branch</label>
                                <input type="text" class="form-control" name="bank_branch" />
                            </div>
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select name="branch" id="branch" class="form-control">
                                    @foreach($branches as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary w-100">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection