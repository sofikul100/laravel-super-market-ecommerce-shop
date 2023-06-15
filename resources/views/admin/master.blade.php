@include('admin.includes.styles')
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
   @include('admin.includes.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   @include('admin.includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         @yield('admin_content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control right Sidebar -->
  @include('admin.includes.right_sidebar')
  <!-- /.control- right-sidebar -->

  <!-- Main Footer -->
  @include('admin.includes.footer')
</div>

<!-- REQUIRED SCRIPTS -->
@include('admin.includes.scripts')
</body>
</html>

















































































{{-- <h1>admin dashboard</h1>

<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
 {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
 @csrf
</form> --}}