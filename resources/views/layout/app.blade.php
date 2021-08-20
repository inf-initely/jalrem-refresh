<!doctype html>
<html lang="en" id="home">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      @include('partials.head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hero-slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jalur-rempah.css') }}">
    <title>Jalur Rempah</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">
</head>

<body>
  @include('partials.navbar')
  @include('sweetalert::alert')
  @yield('content')
  <!-- Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-search">
      <div class="modal-content modal-body-search">
        <div class="modal-body">
          <div class="mb-3">
            <form class="input-group" action="{{ url('/cari-artikel') }}">
              <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari disini...." aria-describedby="btnCari">
              <button type="submit" class="btn btn-lg btn-danger" type="button" id="btnCari"> <i class="fa fa-search mr-2"></i> Cari</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
  @include('partials.footer')
</body>
@yield('js')

</html>
