<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Emporee</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('otika/assets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('otika/assets/bundles/bootstrap-social/bootstrap-social.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('otika/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('otika/assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ ('otika/assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href=" {{ asset('otika/assets/img/favicon.ico') }}" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">

                    @isset($url)

                    <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}" class="form-horizontal needs-validation" novalidate="">
                    @else
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="form-horizontal needs-validation" novalidate="">
                    @endisset
                        @csrf


                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Silahkan masukkan email yang valid
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">

                      </div>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                     Silahkan masukkan password yang valid
                    </div>
                  </div>
                  <div class="form-group">

                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

                <div>
                <a href="{{ url('/login/anggota')}}" class="btn btn-info">Login Anggota</a>
                <a href="{{ url('/login/admin')}}" class="btn btn-success">Login Admin</a>
                <br/><br/><hr/>
                <a href="{{ url('/register/anggota')}}" class="btn btn-info">Register Anggota</a>
                </div>


                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->

</body>

<script src="{{ asset('otika/assets/js/app.min.js') }}"></script>
<script src="{{ asset('otika/assets/js/scripts.js') }}"></script>
<script src="{{ asset('otika/assets/js/custom.js') }}"></script>
</html>
