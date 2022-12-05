@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Plans</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Plans</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                        <form action="/plans/{{$plan->id}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Plan Name</label>
                                        <input type="text" class="form-control" name="name" required value="{{$plan->name}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Duration</label>
                                        <input type="number" class="form-control" name="duration" required value="{{$plan->duration}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Default Plan</label>
                                        <select name="default" id="default" class="form-control" required>
                                            <option {{$plan->default == true ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$plan->default == false ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Allow Multiple Accounts</label>
                                        <select name="multiple" id="multiple" class="form-control" required>
                                            <option {{$plan->multiple == true ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$plan->multiple == false ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option {{$plan->regular == true ? 'selected' : ''}} value="regular">Regular</option>
                                            <option {{$plan->savings == true ? 'selected' : ''}} value="savings">Savings</option>
                                            <option {{$plan->invest  == true ? 'selected' : ''}} value="invest">Invest</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Charge</label>
                                        <input type="text" class="form-control" name="charge" required value="{{$plan->charge}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Returns</label>
                                        <input type="text" class="form-control" name="returns" required value="{{$plan->returns}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Penalty</label>
                                        <input type="text" class="form-control" name="penalty" required value="{{$plan->penalty}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Sales Exec. Commission</label>
                                        <input type="text" class="form-control" name="commission" required value="{{$plan->commission}}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Active</label>
                                        <select name="active" id="active" class="form-control" required>
                                            <option {{$plan->active == true ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$plan->active == false ? 'selected' : ''}} value="0">Not Active</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Update</button>
                            </div>
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