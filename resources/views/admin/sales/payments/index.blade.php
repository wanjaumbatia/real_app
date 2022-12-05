@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h1 class="m-0">Payments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Payments</a></li>
                    <li class="breadcrumb-item active">List</li>
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
                        <table id="customertableid" width="100%" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Transaction Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>
                            <tbody>

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

<script type="text/javascript">
    $(document).ready(function() {
        $("#customertableid").DataTable({
            serverSide: true,
            ajax: {
                url: "{{url('load_payments')}}",
                data: function(data) {
                    data.params = {
                        sac: "helo"
                    }
                }
            },
            buttons: false,
            searching: true,
            scrollY: 500,
            scrollX: true,
            scrollCollapse: true,
            columns: [
                {
                    data: "customer",
                    className: 'customer'
                },
                {
                    data: "transaction_type",
                    className: 'transaction_type'
                },
                {
                    data: "amount",
                    className: 'amount',
                    render: $.fn.dataTable.render.number(',', '.', 2, '₦')
                },
                {
                    data: "status",
                    className: 'status'
                },
                {
                    data: "branch",
                    className: 'branch'
                },
            ]
        });

    });
</script>

@endsection