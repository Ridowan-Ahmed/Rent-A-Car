<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CarDealer</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dash.css') }}" rel="stylesheet">

</head>
<body>
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img src="{{Auth::user()->photoSrc()}}" alt="person" class="img-fluid rounded-circle">
                <h4><a href="{{route('user.edit', Auth::user()->slug)}}" class="">{{Auth::user()->name}}</a></h4><span>{{ucwords(Auth::user()->role->name)}}</span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="/" class="brand-small text-center"> <strong>C</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li>
                    <a href="/home"><i class="fa fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="#vendorDownDropdown" aria-expanded="false" data-toggle="collapse">
                        <i class="fa fa-building"></i> Company
                    </a>
                    <ul id="vendorDownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('company.index')}}"><i class="fa fa-credit-card-alt"></i> All Company</a></li>
                        <li><a href="{{route('company.create')}}"><i class="fa fa-credit-card"></i> Add Company</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#ownerDownDropdown" aria-expanded="false" data-toggle="collapse">
                        <i class="fa fa-blind"></i> Owner
                    </a>
                    <ul id="ownerDownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('owner.index')}}"><i class="fa fa-users"></i> All Owners</a></li>
                        <li><a href="{{route('owner.create')}}"><i class="fa fa-user-plus"></i> Add Owner</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#reportDownDropdown" aria-expanded="false" data-toggle="collapse">
                        <i class="fa fa-money"></i> Report
                    </a>
                    <ul id="reportDownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{route('logbook.bill')}}"><i class="fa fa-google-wallet"></i> Bill</a></li>
                        <li><a href="{{route('logbook.payment')}}"><i class="fa fa-dollar"></i> Payment</a></li>
                    </ul>
                </li>

                <li> <a href="#"> <i class="icon-mail"></i>Demo
                        <div class="badge badge-warning">6 New</div></a></li>
            </ul>
        </div>
        <div class="admin-menu">
            <h5 class="sidenav-heading">Second menu</h5>
            <ul id="side-admin-menu" class="side-menu list-unstyled">
                <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
                <li> <a href="#"> <i class="icon-flask"> </i>Demo
                        <div class="badge badge-info">Special</div></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="page">
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                        <a href="/" class="navbar-brand">
                            <div class="brand-text d-none d-md-inline-block">
                                <span>Car </span><strong class="text-primary">Dealer</strong>
                            </div>
                        </a>
                    </div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Languages dropdown    -->
                        <li class="nav-item dropdown">
                            <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                                <img src="{{asset('images/GB.png')}}" alt="English"><span class="d-none d-sm-inline-block">English</span>
                            </a>
                            <ul aria-labelledby="languages" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="{{asset('images/GB.png')}}" alt="English" class="mr-2"><span>English</span></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item"> <img src="{{asset('images/BD.png')}}" alt="English" class="mr-2"><span>Bangla</span></a></li>
                            </ul>
                        </li>
                        <!-- Log out-->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="d-none d-sm-inline-block">Logout</span>
                                <i class="fa fa-sign-out"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid">
        @if(Session::has('msg'))
            <p class="bg bg-success">{{session('msg')}}</p>
        @endif
        @yield('content')
    </main>
</div>
@yield('script')
</body>
</html>
