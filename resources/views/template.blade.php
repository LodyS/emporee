<!DOCTYPE html>
<html lang="en">

<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Emporee</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('otika/assets/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('otika/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('otika/assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('otika/assets/css/custom.css') }}">
<h3>Emporee</h3>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">

        </div>
        <ul class="navbar-nav navbar-right">



                @yield('content')
            </div>
          </li>
        </ul>
      </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <span class="logo-name"><b>Emporee</b></span>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                            <li class="dropdown">
                            <a href="{{ url('buku/index') }}" class="nav-link"><i data-feather="monitor"></i><span>Buku</span></a>
                            <a href="{{ url('buku/index') }}" class="nav-link"><i data-feather="monitor"></i><span>Pengajuan</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

      @yield('content')






  <script src="{{ asset('otika/assets/js/scripts.js') }}"></script>




</body>

</html>
