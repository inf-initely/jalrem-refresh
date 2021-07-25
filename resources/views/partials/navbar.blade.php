@if( Request::segment(1) == null )  
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top bg-trans">
  <div class="container">
    <a class="navbar-brand" href="index.html">
      <img src="assets/img/logo/logo.png" width="117px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link page-scroll" aria-current="page" href="#home">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#jelajah">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#kegiatan">Kegiatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#artikelDanBerita">Konten</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/img/bendera/flag-indonesia.png" class="mr-2 flag" width="20px"> INA
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="index.html">
                    <img src="assets/img/bendera/flag-indonesia.png" class="mr-2 flag" width="20px"> INA
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <img src="assets/img/bendera/flag-english.png" class="mr-2 flag" width="20px"> ENG
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-white"></i>
        </button>
        <a href="login.html" class="btn btn-danger mr-4" style="margin-right:1rem">
          Masuk
        </a>
      </div>
    </div>
  </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top bg-trans">
  <div class="container">
    <a class="navbar-brand" href="index.html">
      <img src="assets/img/logo/logo.png" width="117px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.html">Beranda</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tentang
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">Jalur</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">Jejak</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">Masa Depan</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="konten.html">Konten</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="informasi.html">Informasi</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/img/bendera/flag-indonesia.png" class="mr-2 flag" width="20px"> INA
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="index.html">
                    <img src="assets/img/bendera/flag-indonesia.png" class="mr-2 flag" width="20px"> INA
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <img src="assets/img/bendera/flag-english.png" class="mr-2 flag" width="20px"> ENG
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-white"></i>
        </button>
        <a href="login.html" class="btn btn-danger mr-4" style="margin-right:1rem">
          Masuk
        </a>
      </div>
    </div>
  </div>
</nav>
@endif