<!doctype html>
<html lang="en" id="home">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/jalur-rempah.css">
  <title>Jalur Rempah</title>
  <link rel="shortcut icon" href="assets/img/logo/favicon.png">
</head>

<body>
  <main>
    <div id="content">
      <div class="row">
        <div class="col-lg-7 wrap-img-daftar">
          <img id="img-login" src="assets/img/hero/hero-6.jpg">
        </div>
        <div class="col-lg-5 wrap-form-daftar center-v">
          <a href="index.html">
            <img class="logo-daftar mb-4" src="assets/img/logo-footer.png">
          </a>
          <h1>Login Jalur Rempah</h1>
          <p class="des-form-daftar">Fill in the data for profile. It will take a couple of minutes. You only need a passport</p>
          <div class="card mt-5 mb-2">
            <div class="card-body">
              <h3 class="sub-judul-form">Form Login</h3>
              <p class="des-form-daftar">Fill the username & password below. Fill captcha for authenticate you are not a robot.</p>
              @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                  {{ $errors->first() }} 
                </div>
              @endif
              
              <form method="post" action="{{ route('login_post') }}">
                @csrf
                <div class="input-group mb-4">
                  <span class="input-group-text icon-group" id="icon-email"> <i class="fa fa-envelope"></i> </span>
                  <input value="{{ old('email') }}" id="inputEmail" type="email" name="email" class="form-control" placeholder="masukkan email" aria-label="email" aria-describedby="icon-email">
                </div>
                <div class="input-group mb-4">
                  <span class="input-group-text icon-group" id="icon-pass">
                    <i class="fa  fa-asterisk"></i>
                  </span>
                  <input value="{{ old('password') }}" id="inputPassword" type="password" name="password" class="form-control" placeholder="masukkan password" aria-label="password" aria-describedby="icon-pass">
                  <span class="input-group-text" id="icon-pass">
                    <i toggle="#inputPassword" class="fa  fa-eye toggle-password"></i>
                  </span>
                </div>
                <div class="form-group mt-4 mb-4">
                  <div class="captcha" style="display: flex;">
                      <input id="captcha" type="text" class="form-control" placeholder="masukkan Captcha" name="captcha">
                      <span style="margin-left: 5px; margin-right: 5px;">{!! captcha_img() !!}</span>
                      <button type="button" class="btn btn-danger" class="reload" id="reload">
                          &#x21bb;
                      </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 text-center d-grid gap-2">
                    <button class="btn btn-secondary btn-daftar">
                      Sign In
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          {{-- <p class="des-form-daftar text-center">Don't have an account? <a class="link-daftar" href="{{ route('register') }}">Sign Up</a></p> --}}
        </div>
      </div>
    </div>
  </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>

<script type="text/javascript">
  $('#reload').click(function () {
      $.ajax({
          type: 'GET',
          url: 'reload-captcha',
          success: function (data) {
              $(".captcha span").html(data.captcha);
          }
      });
  });

</script>

</html>
