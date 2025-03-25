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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
     <!-- Include Bootstrap CSS -->
     <!-- Include Bootstrap CSS (using Bootstrap 5 CDN) -->



    <style>
        body, .container-fluid, .login-card  {

            background: url('{{ asset('assets/images/bg1.png') }}') no-repeat center center fixed;
            background-size: cover;
            /* Ensures the background is behind the content */
        }
        .carousel-item {
            height: 110vh; /* Adjust the height of the slider to the viewport */
            min-height: 300px;
            background: no-repeat center center scroll;
            background-size: cover;

        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000; /* Black background for better visibility */
        }
    </style>
        @stack('styles')
        @livewireStyles
</head>
<body>
    @yield('content')

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>window.gtranslateSettings = {"default_language":"sw","native_language_names":true,"detect_browser_language":true,"languages":["sw","en"],"wrapper_selector":".gtranslate_wrapper","flag_style":"3d","alt_flags":{"en":"usa"}}</script>
    <script src="https://cdn.gtranslate.net/widgets/latest/fc.js" defer></script>

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
