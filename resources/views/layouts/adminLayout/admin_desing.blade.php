<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin SIG - Indonesia</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    @yield('app_css')

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('/plugins/morris/morris.css') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">




        @include('layouts.adminLayout.admin_header')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @include('layouts.adminLayout.admin_sidebar')
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                @yield('content')
                </div>
            </div>
            <!-- content -->
            @include('layouts.adminLayout.admin_footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src=" {{ asset('assets/js/jquery.min.js') }} "></script>
    <script src=" {{ asset('assets/js/bootstrap.bundle.min.js') }} "></script>
    <script src=" {{ asset('assets/js/metismenu.min.js') }} "></script>
    <script src=" {{ asset('assets/js/jquery.slimscroll.js') }} "></script>
    <script src=" {{ asset('assets/js/waves.min.js') }} "></script>

    <!--Morris Chart-->
    <script src=" {{ asset('plugins/morris/morris.min.js') }} "></script>
    <script src=" {{ asset('plugins/raphael/raphael.min.js') }} "></script>

    <script src=" {{ asset('assets/pages/dashboard.init.js') }} "></script>

    <!-- App js -->
    <script src=" {{ asset('assets/js/app.js') }} "></script>

    @yield('app_js')

</body>

</html>
