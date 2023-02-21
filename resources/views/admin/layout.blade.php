<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{--    Thêm nếu lỗi ảnh--}}
    {{--    <base href="/" />--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield("title","System admin page")</title> {{--System admin page la default, khong co cung duoc--}}
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--dat truoc before va sau after trong truong hop khong cần css nay--}}
    @yield("before_css")
    @include("admin.html.css")
    @yield("after_css")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include("admin.html.nav")

    @include("admin.html.aside")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            @yield("content-header")
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield("main-content")
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include("admin.html.footer")

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{{--dat truoc before va sau after trong truong hop khong cần js nay--}}
@yield("before_js")
@include('admin.html.script')
@yield("after_js")

</body>
</html>
