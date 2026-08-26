<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- Datatables -->

    <link href="{{ asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-car"></i></i> <span>Rent Car
                                Admin</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('admin/images/img.jpg') }}" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>John Doe</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('admin.layouts.sidebar')
                    <!-- sidebar menu -->

                    <!-- top navigation -->
                    @include('admin.layouts.nav')
                    <!-- /top navigation -->

                    <!-- page content -->
                    @yield('admin-content')
                    <!-- /page content -->

                    <!-- footer content -->
                    @include('admin.layouts.footer')
                    <!-- /footer content -->
                </div>
            </div>

            <!-- jQuery -->
            <script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>
            <!-- Bootstrap -->
            <script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <!-- FastClick -->
            <script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }}"></script>
            <!-- NProgress -->
            <script src="{{ asset('admin/vendors/nprogress/nprogress.js') }}"></script>
            <!-- iCheck -->
            <script src="{{ asset('admin/vendors/iCheck/icheck.min.js') }}"></script>
            <!-- Datatables -->
            <script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
            <script src="{{ asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/jszip/dist/jszip.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
            <script src="{{ asset('admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

            <!-- Custom Theme Scripts -->
            <script src="{{ asset('admin/build/js/custom.min.js') }}"></script>

            <!-- Custom DataTables Order -->
            <script>
                $(document).ready(function() {
                    if ($.fn.DataTable.isDataTable('#datatable')) {
                        $('#datatable').DataTable().destroy();
                    }
                    $('#datatable').DataTable({
                        "order": [
                            [0, "desc"]
                        ]
                    });
                });
            </script>

</body>

</html>
