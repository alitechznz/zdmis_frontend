<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crocs admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Crocs admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('logo/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('logo/logo.png') }}" type="image/x-icon">
    <title>ZDMIS System</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/calendar.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/vector-map.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/fullcalender.css') }}">--}}
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
{{--    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">--}}
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <!-- sweet alert -->
    <link rel="stylesheet" href="{{ asset('sweetalert2/dist/sweetalert2.min.css')}}">
    <!-- In head section, add Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
      <!-- App css-->
      <style>
          .table th {
              padding-left: 10px;
              padding-right: 10px;
          }
          .table td {
              padding-left: 10px;
              padding-right: 10px;
          }
      </style>
    @stack('styles')
    @livewireStyles
  </head>
{{--  <body onload="startTime()" class="light">--}}
  <body>
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader">
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('includes.topbar')
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->

      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
       @include('includes.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
         @yield('content')
         {{ $slot ?? ""}}
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 p-0 footer-copyright">
                <p class="mb-0">Copyright 2025 © ZANZIBAR DISASTER MANAGEMENT COMMISSION</p>
              </div>
              <div class="col-md-6 p-0">
                <p class="heart mb-0">v 1.0.0
                  <svg class="footer-icon">
                    {{-- <use href="../assets/svg/icon-sprite.svg#heart"></use> --}}
                  </svg>
                </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
{{--    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>--}}
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-pin.js') }}"></script>
{{--    <script src="{{ asset('assets/js/clock.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/calendar/fullcalendar.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/calendar/fullcalendar-custom.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/calendar/fullcalender.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/calendar/custom-calendar.js') }}"></script>--}}
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart-widget.js') }}"></script>
    <script src="{{ asset('assets/js/general-widget.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>


{{--    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-au-mill.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-asia-mill.js') }}"></script>--}}
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
{{--    <script src="{{ asset('assets/js/notify/index.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom1.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>--}}
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
{{--    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/vector-map/map-vector.js') }}"></script>--}}
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
{{--    <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- Plugin used-->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'  // Adjusts width to fit its container
            });
        });
    </script>
    <!-- Alert -->
    <script src="{{ asset('sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script>
        //Sweet alert for livewire
        var toastMixin = Swal.mixin({
            toast: true,
            animation: false,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('swal:success', event => {
            toastMixin.fire({
                animation: true,
                icon: 'success',
                title: '<b style="font-size:12pt!important; margin-left: 10px;">' + event.detail.title + '</b>'
            });
        })

        window.addEventListener('swal:info', event => {
            toastMixin.fire({
                animation: true,
                icon: 'success',
                title: '<b style="font-size:12pt!important; margin-left: 10px;">' + event.detail.title + '</b>'
            });
        })

        window.addEventListener('swal:error', event => {
            toastMixin.fire({
                animation: true,
                icon: 'error',
                title: '<b style="font-size:12pt!important; margin-left: 10px;">' + event.detail.title + '</b>'
            });
        })

        @if(Session::has('success'))
        toastMixin.fire({
            animation: true,
            icon: 'success',
            title: '<b style="font-size:12pt!important; margin-left: 10px;">{{Session::get('success')}}</b>'
        });
        @php
            Session::forget('success');
        @endphp
        @endif

        @if(Session::has('warning'))
        toastMixin.fire({
            animation: true,
            icon: 'error',
            title: '<b style="font-size:12pt!important; margin-left: 10px;">{{Session::get('warning')}}</b>'
        });
        @php
            Session::forget('warning');
        @endphp
        @endif

    </script>
    @stack('scripts')
    @livewireScripts
  </body>
</html>
