<!doctype html>
<html lang="en" id="home">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-183878925-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-183878925-1');
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      @include('partials.head')
    <!-- Bootstrap CSS -->

    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hero-slider.css') }}?v={{ config('app.version') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jalur-rempah.css') }}?v={{ config('app.version') }}">
    @if( Session::get('lg') == 'en' )
      @if( Request::segment(1) == null )
        <title>Home - The Spice Routes Indonesia</title>
         @elseif(Request::segment(1) == "tentang-jalur")
        <title>Routes - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == "tentang-jejak")
        <title>The Traces of Spice Routes - Indonesia</title>
        @elseif(Request::segment(1) == "tentang-masa-depan")
        <title>Future - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == "konten")
        <title>Contents - The Spice Routes Indonesia</title>
        @elseif(Request::segment(1) == "informasi")
        <title>Information - The Spice Routes Indonesia</title>
      @endif
    @else
      @if( Request::segment(1) == null )
        <title>Beranda - Jalur Rempah Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == "tentang-jalur")
        <title>Jalur Rempah Nusantara Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == "tentang-jejak")
        <title>Jejak Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == "tentang-masa-depan")
        <title>Masa Depan - Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == "konten")
        <title>Konten - Jalur Rempah Kemdikbudristek Republik Indonesia</title>
        @elseif(Request::segment(1) == "informasi")
        <title>Informasi - Jalur Rempah Kemdikbudristek Republik Indonesia</title>
      @endif
    @endif
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">
</head>

<body>
  @include('partials.navbar')
  @include('sweetalert::alert')
  @yield('content')
  <!-- Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,.6);">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-search">
      <div class="modal-content modal-body-search">
        <div class="modal-body">
          <div class="mb-3">
            <form class="input-group" action="{{ url('/cari') }}">
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
