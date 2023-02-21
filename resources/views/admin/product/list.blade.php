@extends("admin.layout")

@section("title", "Product List")

@section("before_css")
    <!-- Select2 -->
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection


@section("product-menu-status", "menu-open")
@section("list-product-menu-status", "active")
@section("create-product-menu-status", "")
@section("edit-product-menu")
@endsection

@section("category-menu-status", "")
@section("list-category-menu-status", "")
@section("create-category-menu-status", "")
@section("edit-category-menu")
@endsection

@section("content-header")
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Product List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section("main-content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-inline-block">
                        <a type="button" class="btn btn-block btn-success" href="{{url("/admin/product/create")}}"><i class="fas fa-plus mr-2"></i>Add Product</a>
                    </div>

                    <form action="{{ url("admin/product") }}" method="get">
                        <div class="input-group input-group-md float-right" style="width: 250px;" >
                            <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ app("request")->input("search") }}">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        <!-- select -->
                        <div class="form-group float-right mr-2" style="width: 200px">
                            <select class="form-control select2bs4" name="category_id" style="width: 100%">
                                <option @if(app("request")->input("category_id") == 0) selected @endif value="0">Choose category...</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}" @if(app("request")->input("category_id") == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-inline-block float-right">
                            <input type="number" name="highest_price" class="form-control" placeholder="Highest price">
                        </div>
                        <div class="d-inline-block float-right">
                            <input type="number" name="lowest_price" class="form-control" placeholder="Lowest price">
                        </div>

                    </form>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Thumbnail</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td> <img src="{{url("$item->thumbnail")}}" alt="{{ $item->thumbnail }}" class="img-thumbnail" width="50"></td>
                                    <td>
                                        {{ $item->Category->name }}
                                        <span class="badge bg-info">{{ $item->Category->Products->count() }}</span>
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        @if($item->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route("product_edit",["product" => $item->id])}}" type="button" class="btn btn-block btn-warning">Edit</a>
                                        <form method="post" action="{{route("product_delete",["product" => $item->id])}}" style="display: inline-block">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit" onclick="return confirm('Ban co chac muon xoa');" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {!! $data->appends( app("request")->input() )->links("pagination::bootstrap-4") !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section("after_js")
    <!-- Select2 -->
    <script src="/admin/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
