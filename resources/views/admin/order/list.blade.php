@extends("admin.layout")

@section("title", "Order List")

@section("content-header")
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Order</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section("main-content")
    <div class="row">
        <div class="col-12">
            <div class="card">
{{--                <div class="card-header">--}}
{{--                    <div class="d-inline-block">--}}
{{--                        <a type="button" class="btn btn-block btn-success" href="{{url("/admin/order/create")}}"><i class="fas fa-plus mr-2"></i>Add Order</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Shopping Address</th>
                            <th>Customer Phone Number</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->shipping_address }}</td>
                                    <td>{{ $item->customer_tel }}</td>
                                    <td>{{ $item->grand_total }}</td>
                                    <td>
                                        @switch($item->status)
                                            @case(0)
                                                <span class="badge bg-gray">Order Placed</span>
                                                @break
                                            @case(1)
                                                <span class="badge bg-cyan">Payment Received</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-yellow">Order Processing</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-blue">Shipped</span>
                                                @break
                                            @case(4)
                                                <span class="badge bg-success">Delivered</span>
                                                @break
                                            @case(5)
                                                <span class="badge bg-dark">Cancelled</span>
                                                @break
                                            @case(6)
                                                <span class="badge bg-orange">On Hold</span>
                                                @break
                                            @default
                                                <span class="badge bg-success">Unidentified</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ url("admin/order/detail",["order"=>$item->id]) }}" class="mr-2" title="Detail"><i class="fas fa-info-circle"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {!! $data->links("pagination::bootstrap-4") !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

