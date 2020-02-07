<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{!! env('APP_NAME') !!}- @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{!!asset('dashboard/dark/assets/images/favicon.ico')  !!}">

    <!-- third party css -->
    <link href="{!!asset('dashboard/dark/assets/libs/select2/select2.min.css')  !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!!asset('dashboard/dark/assets/libs/datatables/dataTables.bootstrap4.css')  !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!!asset('dashboard/dark/assets/libs/datatables/responsive.bootstrap4.css')  !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!!asset('dashboard/dark/assets/libs/datatables/buttons.bootstrap4.css')  !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!!asset('dashboard/dark/assets/libs/datatables/select.bootstrap4.css')  !!}" rel="stylesheet"
          type="text/css"/>
    <!-- third party css end -->

    <link href="{!! asset('dashboard/dark/assets/libs/dropify/dropify.min.css')!!}" rel="stylesheet" type="text/css"/>

    <!-- App css -->
    <link href="{!! asset('dashboard/dark/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('dashboard/dark/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('dashboard/dark/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css"/>
    @stack('header')

</head>

<body class="left-side-menu-dark">
@include('sweetalert::alert')

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
@include('admin.layouts._header')
<!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
@include('admin.layouts._sidebar')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                @yield('content')
                {{--
                 <!-- end row -->

 --}}
            </div> <!-- container -->

        </div> <!-- content -->

        @include('admin.layouts._footer')

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<!-- Vendor js -->
<script src="{!! asset('dashboard/dark/assets/js/vendor.min.js') !!}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- third party js -->
<script src="{!! asset('dashboard/dark/assets/libs/datatables/jquery.dataTables.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/dataTables.bootstrap4.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/dataTables.responsive.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/responsive.bootstrap4.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/dataTables.buttons.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/buttons.bootstrap4.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/buttons.html5.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/buttons.flash.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/buttons.print.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/dataTables.keyTable.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/datatables/dataTables.select.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/pdfmake/pdfmake.min.js')!!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/pdfmake/vfs_fonts.js')!!}"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="{!! asset('dashboard/dark/assets/js/pages/datatables.init.js')!!}"></script>

<!-- knob plugin -->
<script src="{!! asset('dashboard/dark/assets/libs/jquery-knob/jquery.knob.min.js') !!}"></script>
<script src="{!! asset('dashboard/dark/assets/libs/select2/select2.min.js') !!}"></script>


<!-- Dashboard init js-->
{{--
<script src="{!! asset('dashboard/dark/assets/js/pages/dashboard.init.js') !!}"></script>
--}}


<!-- Validation js (Parsleyjs) -->
<script src="{!! asset('dashboard/dark/assets/libs/parsleyjs/parsley.min.js')!!}"></script>

<!-- validation init -->
<script src="{!! asset('dashboard/dark/assets/js/pages/form-validation.init.js')!!}"></script>


<!-- dropify js -->
<script src="{!! asset('dashboard/dark/assets/libs/dropify/dropify.min.js')!!}"></script>

<!-- form-upload init -->
<script src="{!! asset('dashboard/dark/assets/js/pages/form-fileupload.init.js')!!}"></script>


<!-- App js -->
<script src="{!! asset('dashboard/dark/assets/js/app.min.js') !!}"></script>
<script src="{!! asset('dashboard/scripts.js') !!}"></script>

@stack('scripts')

</body>
</html>


