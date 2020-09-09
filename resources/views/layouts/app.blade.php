<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf_token" content="{{ csrf_token() }}">
  
  <title>@yield('title')</title>

    <!-- Style -->
  @stack('prepend-style')
  @include('includes.styles')
  @stack('addon-style')
</head>

<body>

  <!-- Navbar -->
  @include('includes.index.navbar')

    <!-- Main Content -->
    @yield('content')

    @include('includes.index.footer')

    <!-- Script -->
    @stack('prepend-script')
    @include('includes.scripts')
    @stack('addon-script')

</body>
</html>