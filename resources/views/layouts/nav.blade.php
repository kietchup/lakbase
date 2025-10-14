<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/custom.css') }}">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-bell"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">
    <!-- Brand Logo -->
    <a href="#" class="brand-link ijoin">
        <img src="{{ asset('OSAS_Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><img class="logo w-50" src="{{ asset('iJoin Logo.png') }}"></span>
</a>

    <!-- Sidebar -->
    <div class="sidebar menu ">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center;">
            <div class="image">
                <img src="{{ asset('images/' . Auth::User()->image) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a>
                @if (Auth::user()->role_id == 1)
                    <a href="{{-- {{route('getUserProfile')}} --}}" class="d-block">Admin | {{ Auth::user()->id_num }} <i class="fas fa-edit"></i>
                    </a>
                @elseif (Auth::user()->role_id == 2)
                    <a href="{{-- {{route('getUserProfile')}} --}}" class="d-block">Adviser | {{ Auth::user()->id_num }} <i class="fas fa-edit"></i>
                    </a>
                @elseif (Auth::user()->role_id == 3)
                    <a href="{{--{{route('getUserProfile')}}  --}}" class="d-block">C-Pres. | {{ Auth::user()->id_num }} <i class="fas fa-edit"></i>
                    </a>
                @else
                    <a href="{{-- {{route('getUserProfile')}} --}}" class="d-block">Member | {{ Auth::user()->id_num }} <i class="fas fa-edit"></i>
                    </a>
                @endif

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{-- {{ route('getStudHome') }} --}}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{-- {{ route('getDashboard') }} --}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-clipboard"></i>
                        <p>
                            Application
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>
                    @if (Auth::user()->role_id == 1)
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{--{{route('getClubAppApproval')}}  --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Club Establishment Application Approval</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                    @if (Auth::user()->role_id == 2)
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{-- {{route('getClubAppStatus')}} --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Club Application Status</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{-- {{ route('getClubAppForm') }} --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Club Application Form</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                    @if (Auth::user()->role_id == 3)
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{-- {{route('getUser')}} --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Membership Application Status</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{-- {{route('userTable')}} --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Membership Application Form</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                    @if (Auth::user()->role_id == 4)
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{--{{route('getMemAppStatus')}}  --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Membership Application Status</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{--{{ route('getMemAppForm') }}  --}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Membership Application Form</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                </li>
                <li class="nav-item">
                    <a href="{{-- {{ route('getCalendar') }} --}}" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Calendar</p>
                    </a>
                </li>
                @if (Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a href="{{-- {{ route('getClubList') }} --}}" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows"></i>
                            <p>Clubs</p>

                        </a>
                        {{-- <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('getAddClub')}}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Club</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('getClubList') }}" class="sub nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of Clubs</p>
                                </a>
                            </li>
                        </ul> --}}
                    </li>
                @endif
                @if (Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a href="{{-- {{route('getApprovedMembers')}} --}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Club Members</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 3 | Auth::user()->role_id == 4)
                    <li class="nav-item">
                        <a href="{{-- {{route('getCoMembers')}} --}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Members</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role_id == 2)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Members <i class="right fas fa-angle-down"></i></p>

                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{-- {{ route('getClubMembers') }} --}}" class="sub nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Members</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{-- {{route('getMemAppApproval')}} --}}" class="sub nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Membership Application Approval</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a href="{{-- {{ route('getAcctApproval') }} --}}" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            <p>Account Approval</p>

                        </a>
                    </li>
                @endif
                <li class="nav-item" style="align-self: end;">
                    <a href="{{--{{ route('logout') }}  --}}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt "></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
