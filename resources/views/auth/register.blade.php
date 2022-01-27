

<!DOCTYPE html>
<html lang="en">


<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
              @isset($url)
                    <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}" class="form-horizontal needs-validation" novalidate="">
                    @else
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="form-horizontal needs-validation" novalidate="">
                    @endisset
                        @csrf



                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">Username</label>
                      <input id="frist_name" type="text" class="form-control" name="username" autofocus required="">
                      <div class="invalid-feedback">Silahkan masukkan Username yang valid
                    </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">No Telepon</label>
                      <input id="last_name" type="text" class="form-control" name="no_telepon" required="">
                      <div class="invalid-feedback">Silahkan masukkan No Telepon yang valid
                    </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-6">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required="">
                    <div class="invalid-feedback">Silahkan masukkan email yang valid
                    </div>
                  </div>

                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="password" required="">
                        <div class="invalid-feedback">Silahkan masukkan password yang valid
                    </div>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('otika/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('otika/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('otika/assets/js/custom.js') }}"></script>
</body>


<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->
</html>
