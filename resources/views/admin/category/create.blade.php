@extends("admin.layout")

@section("title", "Create Category")

@section("content-header")
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Category</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section("main-content")
    <div class="row">
        <!-- right column -->
        <div class="col-12">
            <!-- general form elements disabled -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <form role="form" method="post" action="{{ url("/admin/category/create") }}" enctype="multipart/form-data">
                    @csrf <!--Laravel quan lý form theo token (nếu không có sẽ bị lỗi 419 Page expired -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Category Name</label>
                                    <input type="text" name="name"
                                           class="form-control @error("name") is-invalid @enderror"
                                           placeholder="Enter category name ..."
                                           value="{{ old("name") }}"
                                           required>
                                    @error("name")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="customFile">Icon</label>
                                    <div class="custom-file">
                                        <input type="file" name="icon" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
@endsection
