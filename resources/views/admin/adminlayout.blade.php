<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @php $user = Auth::user(); @endphp

  @if(Auth::check() && $user->usertype != 2)
    <title>Admin Panel</title>
  @elseif(Auth::check() && $user->usertype == 2)
    <title>User Panel</title>
  @else
    <title>Welcome</title>
  @endif

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>
  <div class="container-scroller">
    <!-- Sidebar -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        @if(Auth::check() && $user->usertype != 2)
      <a class="sidebar-brand brand-logo" href="/redirects" style="color:white;text-decoration:none;">Admin Panel</a>
    @elseif(Auth::check() && $user->usertype == 2)
    <a class="sidebar-brand brand-logo" href="/redirects" style="color:white;text-decoration:none;">User Panel</a>
  @else
  <a class="sidebar-brand brand-logo" href="#" style="color:white;text-decoration:none;">Guest</a>
@endif
        <a class="sidebar-brand brand-logo-mini" href="#"><img src="{{ asset('admin/assets/images/logo-mini.svg') }}"
            alt="logo" /></a>
      </div>
      <ul class="nav">
        @if(Auth::check())
      <li class="nav-item profile">
        <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
          <img class="img-xs rounded-circle" src="{{ asset('assets/images/admin/' . $user->profile_photo_path) }}"
            alt="">
          <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
          <h5 class="mb-0 font-weight-normal">{{ $user->name }}</h5>
          @if($user->usertype == 1)
        <span>Super Admin</span>
      @elseif($user->usertype == 3)
      <span>Sub Admin</span>
    @elseif($user->usertype == 2)
      <span>Delivery Boy</span>
    @endif
          </div>
        </div>
        </div>
      </li>

      <li class="nav-item nav-category"><span class="nav-link">Navigation</span></li>

      <li class="nav-item menu-items"><a class="nav-link" href="/redirects"><span class="menu-icon"><i
          class="mdi mdi-speedometer"></i></span><span class="menu-title">Dashboard</span></a></li>

      @if($user->usertype != 2)
      <li class="nav-item menu-items"><a class="nav-link" href="/admin/food-menu"><span class="menu-icon"><i
        class="mdi mdi-food"></i></span><span class="menu-title">Food Menu</span></a></li>

      <li class="nav-item menu-items"><a class="nav-link" href="/admin/chefs"><span class="menu-icon"><i
        class="mdi mdi-food"></i></span><span class="menu-title">Chefs</span></a></li>
    @endif

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon"><i class="mdi mdi-file-document-box"></i></span>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/admin/orders-incomplete">Pending Orders</a></li>
          <li class="nav-item"> <a class="nav-link" href="/orders/process">Processing Order</a></li>
          <li class="nav-item"> <a class="nav-link" href="/orders-complete">Complete Orders</a></li>
          <li class="nav-item"> <a class="nav-link" href="/orders/cancel">Cancelled Order</a></li>
          <li class="nav-item"> <a class="nav-link" href="/order/location">Update Location</a></li>
        </ul>
        </div>
      </li>

      <li class="nav-item menu-items"><a class="nav-link" href="/admin/reservation"><span class="menu-icon"><i
          class="mdi mdi-chart-bar"></i></span><span class="menu-title">Reservation</span></a></li>

      @if($user->usertype == 1)
      <li class="nav-item menu-items"><a class="nav-link" href="/admin/customize"><span class="menu-icon"><i
        class="mdi mdi-settings"></i></span><span class="menu-title">Customize Template</span></a></li>
      <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
      <span class="menu-icon"><i class="mdi mdi-file-document-box"></i></span>
      <span class="menu-title">Banners</span>
      <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic2">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="/admin/add/banner">Add Banners</a></li>
        <li class="nav-item"> <a class="nav-link" href="/admin/banner/all">All Banners</a></li>
      </ul>
      </div>
      </li>
      <li class="nav-item menu-items"><a class="nav-link" href="/admin/show"><span class="menu-icon"><i
        class="mdi mdi-account-multiple-plus"></i></span><span class="menu-title">Admin</span></a></li>
    @endif

      <li class="nav-item menu-items"><a class="nav-link" href="/customer"><span class="menu-icon"><i
          class="mdi mdi-account-plus"></i></span><span class="menu-title">Customer</span></a></li>

      @if($user->usertype == 1)
      <li class="nav-item menu-items"><a class="nav-link" href="/delivery-boy"><span class="menu-icon"><i
        class="mdi mdi-account-plus"></i></span><span class="menu-title">Delivery Boy</span></a></li>
    @endif

      @if($user->usertype != 2)
      <li class="nav-item menu-items"><a class="nav-link" href="/admin/coupon"><span class="menu-icon"><i
        class="mdi mdi-account-card-details"></i></span><span class="menu-title">Coupon</span></a></li>
      <li class="nav-item menu-items"><a class="nav-link" href="/admin/charge"><span class="menu-icon"><i
        class="mdi mdi-bank"></i></span><span class="menu-title">Charge</span></a></li>
    @endif

    @endif {{-- end Auth::check() --}}
      </ul>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid page-body-wrapper">
      <!-- Navbar -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('admin/assets/images/logo-mini.svg') }}"
              alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                <input type="text" class="form-control" placeholder="Search products">
              </form>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" data-toggle="dropdown">
          <div class="navbar-profile">
            <img class="img-xs rounded-circle"
            src="{{ asset('assets/images/admin/' . $user->profile_photo_path) }}" alt="">
            <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ $user->name }}</p>
            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
          </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="profileDropdown">
          <h6 class="p-3 mb-0">Profile</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item" href="user/profile">
            <div class="preview-icon bg-dark rounded-circle"><i class="mdi mdi-settings text-success"></i></div>
            <div class="preview-item-content">
            <p class="preview-subject mb-1">Settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <form action="/logout" method="post">@csrf
            <button class="dropdown-item preview-item" type="submit">
            <div class="preview-icon bg-dark rounded-circle"><i class="mdi mdi-logout text-danger"></i></div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Log out</p>
            </div>
            </button>
          </form>
          </div>
        </li>
      @endif
          </ul>
        </div>
      </nav>

      <!-- Page Content -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('container')
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Humber 2025</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/jquery.cookie.js') }}"></script>
  <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('admin/assets/js/misc.js') }}"></script>
  <script src="{{ asset('admin/assets/js/settings.js') }}"></script>
  <script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
  <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>