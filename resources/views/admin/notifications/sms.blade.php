@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">SMS Messages</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Notifications</a></li>
                    <li class="breadcrumb-item active">SMS</li>
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
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Sent</th>
                                        <th>Delivered</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sms as $item)
                                    <tr>
                                        <td>{{$item->sent_to}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{$item->message}}</td>
                                        <td>
                                            @if($item->sent == true)
                                            <p class="btn btn-success btn-sm m-1">Sent</p>
                                            @else
                                            <p class="btn btn-danger btn-sm m-1">Not Sent</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->delivered == true)
                                            <p class="btn btn-success btn-sm m-1">Delivered</p>
                                            @else
                                            <p class="btn btn-danger btn-sm m-1">Not Delivered</p>
                                            @endif
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection