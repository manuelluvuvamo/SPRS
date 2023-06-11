<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">
    <meta name="author" content="">


    <title>@yield('titulo')</title>
    <meta content="" name="description" />
    <meta content="cdci" name="author" />
    <!-- Custom fonts for this template-->
    <link href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('startbootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="{{ asset('startbootstrap/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
     <script src="{{ asset('startbootstrap/vendor/jquery/jquery.min.js') }}"></script>
         <!-- Sweet Alert-->
    <link href="{{ asset('sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alerts js -->
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>   


       <!--Selec2-->
       <link href="{{ asset('startbootstrap/css/select2.css') }}" rel="stylesheet" type="text/css" />
    
       <script src="{{asset('startbootstrap/js/select2.min.js')}}"></script>
    @yield('style')


</head>
