<meta charset="utf-8">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Responsive -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Información del sistema -->
<meta name="description" content="Sistema de Compra y Venta">
<meta name="author" content="AnderCode">
<title>@yield('title', 'Sistema de Compra y Venta')</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

<!-- Layout JS -->
<script src="{{ asset('assets/js/layout.js') }}"></script>

<!-- Bootstrap CSS -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

<!-- Icons CSS -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

<!-- App CSS -->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
