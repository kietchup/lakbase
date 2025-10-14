<!DOCTYPE html>
<html lang="en">

<head>

    @yield('title')
    @include('layouts.header')
    @yield('css')

    <style>
        *{
            font-family: 'Poppins';
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper layout-top-nav">
        <!-- Navbar and Sidebard -->
        @include('layouts.nav')
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('contentHeader')
            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- Footer --}}
          @include('layouts.footer')
        
        

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!--FOOTER-->
    @include('layouts.script')
    @yield('script')
</body>

</html>
