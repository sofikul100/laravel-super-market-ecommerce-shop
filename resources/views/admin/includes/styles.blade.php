<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('admin_title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon1.png') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  {{-- toaster alert css  --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  {{-- sweet alert  --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.min.css"> 
  {{-- end sweet alert  --}}
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <style>
    .active{
      background:#009BCB !important;
    }
    .active2{
      background:#62d5f9 !important;
      border-radius: 0%;
      color:white
      
    }
    #side_menu_text{
      color:black;
    }
  </style>
  </head>