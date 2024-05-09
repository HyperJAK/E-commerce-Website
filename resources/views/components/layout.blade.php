@props(['bodyClass'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/material/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('frontRessource/images/favicon.ico')}}">
    <title>
        Icom
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
        <link href="{{asset('/material/assets/css/nucleo-icons.css')}}" rel="stylesheet" type='text/css' />
        <link href="{{asset('/material/assets/css/nucleo-svg.css')}}" rel="stylesheet" type='text/css' />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('/assets/css/material-dashboard.css?v=3.0.0')}}" rel="stylesheet" />
</head>
<body class="{{ $bodyClass }}">

{{ $slot }}

<script src="{{asset('/material/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/material/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/material/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('/material/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
@stack('js')
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('/material/assets/js/material-dashboard.min.js?v=3.0.0')}}"></script>
</body>
</html>
