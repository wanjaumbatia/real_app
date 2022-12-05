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
                    <li class="breadcrumb-item active">Collection</li>
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
                            <input value="{{$customer->id}}" hidden name="id" id="id" />
                            <form id='collection-form'>
                                @foreach ($accounts as $acc)
                                <div class="form-group">
                                    <label for="">{{$acc->name}}</label>
                                    <input type="number" class="form-control" value="10000" name="{{$acc->id}}" id="{{$acc->id}}" required>
                                </div>
                                @endforeach
                                <button id="submit" class="btn btn-primary w-100 mt-2">Submit</button>
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
<!-- /.modal -->

@endsection