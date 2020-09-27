<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf_token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

    <!-- Style -->
  @stack('prepend-style')
  @include('includes.styles')
  @stack('addon-style')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column bg-info">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('includes.siswa.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('includes.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button--> @include('includes.modal')<!-- Logout Modal-->
  

    <!-- Script -->
    @stack('prepend-script')
    @include('includes.scripts')
    @stack('addon-script')

</body>

</html>