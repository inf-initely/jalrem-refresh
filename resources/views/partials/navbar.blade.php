@if( Session::get('lg') == 'en' )
{{-- Bahasa Inggriss --}}
@if( Request::segment(1) == null )  
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="assets/img/logo/logo.png" height="50px">
    </a>
    <ul class="link-bahasa d-block d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="btn icon-search d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
      <i class="fa fa-search clr-white"></i>
    </button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link page-scroll active" aria-current="page" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#jelajah">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#media">Contents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#kegiatan">Events</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_id') }}">
                    <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_en') }}">
                    <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-white"></i>
        </button>
        <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/en" class="btn btn-danger mr-4" style="margin-right:1rem">
          The Spice Routes Exhibition
        </a>
      </div>
    </div>
  </div>
</nav>

<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
  <div class="px-3">
    <div class="row">
      <div class="col-6">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="assets/img/logo/logo.png" height="45px">
        </a>
      </div>
      <div class="col"></div>
      <div class="col mt-1">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </div>
      <div class="col text-end">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </div>
      <ul class="nav2 no-search temp-pos">
        <li class="nav-item">
          <a class="page-scroll" aria-current="page" href="#home">
            <i class="fa fa-home mr-2"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" href="#jelajah">
            <i class="fa fa-info-circle mr-2"></i> About
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" href="#media">
            <i class="fa fa-image mr-2"></i> Content
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" href="#kegiatan">
            <i class="fa fa-newspaper mr-2"></i> Events
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i> Search
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger clr-white">
            The Spice Routes Exhibition
          </a>
        </li>
        <div class="bg-nav2">
          <img class="item-jelajah-3" src="assets/img/asset-jelajah.png">
        </div>
      </ul>
    </div>
  </div>
</nav>
@elseif( Request::segment(1) == 'konten' || Request::segment(1) == 'kegiatan' || Request::segment(1) == 'foto' || Request::segment(1) == 'video' || Request::segment(1) == 'audio' || Request::segment(1) == 'kerjasama' )
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/logo/logo-2.png') }}" height="50px">
    </a>
    <ul class="link-bahasa d-block d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') :  asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="btn icon-search d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
      <i class="fa fa-search clr-black"></i>
    </button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-baru" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            About
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">The Route</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">The Trace</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">The Future</a></li>
            {{-- <li><a class="dropdown-item" href="#">The Route</a></li>
            <li><a class="dropdown-item" href="#">The Trace</a></li>
            <li><a class="dropdown-item" href="#">The Future</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'konten' || Request::segment(1) == 'foto' ? 'active' : '' }}" href="{{ route('konten') }}">Contents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'informasi' || Request::segment(1) == 'kegiatan' ? 'active' : '' }}" href="{{ route('informasi') }}">Information</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_id') }}">
                    <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_en') }}">
                    <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-black"></i>
        </button>
        <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/en" class="btn btn-danger mr-4" style="margin-right:1rem">
          The Spice Routes Exhibition
        </a>
      </div>
    </div>
  </div>
</nav>

<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
  <div class="px-3">
    <div class="row">
      <div class="col-6">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="assets/img/logo/logo.png" height="45px">
        </a>
      </div>
      <div class="col"></div>
      <div class="col mt-1">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </div>
      <div class="col text-end">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </div>
      <ul class="nav2 no-search temp-pos">
        <li class="nav-item">
          <a class="page-scroll" aria-current="page" href="{{ route('home') }}">
            <i class="fa fa-home mr-2"></i> Home
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="page-scroll dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-info-circle mr-2"></i> About
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li style="padding-top : 0px"><a class="dropdown-item" href="{{ route('tentangjalur') }}">Jalur</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">The Route</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">The Trace</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">The Future</a></li>
            {{-- <li><a class="dropdown-item" href="#">The Route</a></li>
            <li><a class="dropdown-item" href="#">The Trace</a></li>
            <li><a class="dropdown-item" href="#">The Future</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'konten' || Request::segment(1) == 'foto' ? 'active' : '' }}" href="{{ route('konten') }}">
            <i class="fa fa-image mr-2"></i> Contents
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'informasi' || Request::segment(1) == 'kegiatan' ? 'active' : '' }}" href="{{ route('informasi') }}">
            <i class="fa fa-newspaper mr-2"></i> Informations
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i> Search
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger clr-white">
            The Spice Routes Exhibition
          </a>
        </li>
        <div class="bg-nav2">
          <img class="item-jelajah-3" src="assets/img/asset-jelajah.png">
        </div>
      </ul>
    </div>
  </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/logo/logo.png') }}" height="50px">
    </a>
    <ul class="link-bahasa d-block d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="btn icon-search d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
      <i class="fa fa-search clr-white"></i>
    </button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            About
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">The Route</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">The Trace</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">The Future</a></li>
            {{-- <li><a class="dropdown-item" href="#">The Route</a></li>
            <li><a class="dropdown-item" href="#">The Trace</a></li>
            <li><a class="dropdown-item" href="#">The Future</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'konten' ? 'active' : '' }}" href="{{ route('konten') }}">Contents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'informasi' ? 'active' : '' }}" href="{{ route('informasi') }}">Information</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') :  asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_id') }}">
                    <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_en') }}">
                    <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-white"></i>
        </button>
        <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/en" class="btn btn-danger mr-4" style="margin-right:1rem">
          The Spice Routes Exhibition
        </a>
      </div>
    </div>
  </div>
</nav>

<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
  <div class="px-3">
    <div class="row">
      <div class="col-6">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="assets/img/logo/logo.png" height="45px">
        </a>
      </div>
      <div class="col"></div>
      <div class="col mt-1">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </div>
      <div class="col text-end">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </div>
      <ul class="nav2 no-search temp-pos">
        <li class="nav-item">
          <a class="page-scroll" aria-current="page" href="{{ route('home') }}">
            <i class="fa fa-home mr-2"></i> Home
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="page-scroll dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-info-circle mr-2"></i> About
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">The Route</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">The Trace</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">The Future</a></li>
            {{-- <li><a class="dropdown-item" href="#">The Route</a></li>
            <li><a class="dropdown-item" href="#">The Trace</a></li>
            <li><a class="dropdown-item" href="#">The Future</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'konten' || Request::segment(1) == 'foto' ? 'active' : '' }}" href="{{ route('konten') }}">
            <i class="fa fa-image mr-2"></i> Contents
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'informasi' || Request::segment(1) == 'kegiatan' ? 'active' : '' }}" href="{{ route('informasi') }}">
            <i class="fa fa-newspaper mr-2"></i> Informations
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i> Search
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger clr-white">
            The Spice Routes Exhibition
          </a>
        </li>
        <div class="bg-nav2">
          <img class="item-jelajah-3" src="assets/img/asset-jelajah.png">
        </div>
      </ul>
    </div>
  </div>
</nav>
@endif

@else

{{-- Bahasa Indonesia --}}
@if( Request::segment(1) == null )  
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="assets/img/logo/logo.png" height="50px">
    </a>
    <ul class="link-bahasa d-block d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="btn icon-search d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
      <i class="fa fa-search clr-white"></i>
    </button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link page-scroll active" aria-current="page" href="#home">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#jelajah">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#media">Konten</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll" href="#kegiatan">Kegiatan</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_id') }}">
                    <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_en') }}">
                    <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-white"></i>
        </button>
        <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger mr-4" style="margin-right:1rem">
          Pameran Jalur Rempah
        </a>
      </div>
    </div>
  </div>
</nav>
<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
  <div class="px-3">
    <div class="row">
      <div class="col-6">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="assets/img/logo/logo.png" height="45px">
        </a>
      </div>
      <div class="col"></div>
      <div class="col mt-1">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </div>
      <div class="col text-end">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </div>
      <ul class="nav2 no-search temp-pos">
        <li class="nav-item">
          <a class="page-scroll" aria-current="page" href="#home">
            <i class="fa fa-home mr-2"></i> Beranda
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" href="#jelajah">
            <i class="fa fa-info-circle mr-2"></i> Tentang
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" href="#media">
            <i class="fa fa-image mr-2"></i> Konten
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" href="#kegiatan">
            <i class="fa fa-newspaper mr-2"></i> Kegiatan
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i> Pencarian
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger clr-white">
            Pameran Jalur Rempah
          </a>
        </li>
        <div class="bg-nav2">
          <img class="item-jelajah-3" src="assets/img/asset-jelajah.png">
        </div>
      </ul>
    </div>
  </div>
</nav>
@elseif( Request::segment(1) == 'konten' || Request::segment(1) == 'kegiatan' || Request::segment(1) == 'foto' || Request::segment(1) == 'video' || Request::segment(1) == 'audio' || Request::segment(1) == 'kerjasama' )
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/logo/logo-2.png') }}" height="50px">
    </a>
    <ul class="link-bahasa d-block d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') :  asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="btn icon-search d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
      <i class="fa fa-search clr-black"></i>
    </button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-baru" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tentang
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">Jalur</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">Jejak</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">Masa Depan</a></li>
            {{-- <li><a class="dropdown-item" href="#">Jalur</a></li>
            <li><a class="dropdown-item" href="#">Jejak</a></li>
            <li><a class="dropdown-item" href="#">Masa Depan</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'konten' || Request::segment(1) == 'foto' ? 'active' : '' }}" href="{{ route('konten') }}">Konten</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'informasi' || Request::segment(1) == 'kegiatan' ? 'active' : '' }}" href="{{ route('informasi') }}">Informasi</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_id') }}">
                    <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_en') }}">
                    <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-black"></i>
        </button>
        <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger mr-4" style="margin-right:1rem">
          Pameran Jalur Rempah
        </a>
      </div>
    </div>
  </div>
</nav>
<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
  <div class="px-3">
    <div class="row">
      <div class="col-6">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="assets/img/logo/logo.png" height="45px">
        </a>
      </div>
      <div class="col"></div>
      <div class="col mt-1">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </div>
      <div class="col text-end">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </div>
      <ul class="nav2 no-search temp-pos">
        <li class="nav-item">
          <a class="page-scroll" aria-current="page" href="{{ route('home') }}">
            <i class="fa fa-home mr-2"></i> Beranda
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="page-scroll dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-info-circle mr-2"></i> Tentang
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li style="padding-top : 0px"><a class="dropdown-item" href="{{ route('tentangjalur') }}">Jalur</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">Jejak</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">Masa Depan</a></li>
            {{-- <li><a class="dropdown-item" href="#">Jalur</a></li>
            <li><a class="dropdown-item" href="#">Jejak</a></li>
            <li><a class="dropdown-item" href="#">Masa Depan</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'konten' || Request::segment(1) == 'foto' ? 'active' : '' }}" href="{{ route('konten') }}">
            <i class="fa fa-image mr-2"></i> Konten
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'informasi' || Request::segment(1) == 'kegiatan' ? 'active' : '' }}" href="{{ route('informasi') }}">
            <i class="fa fa-newspaper mr-2"></i> Informasi
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i> Pencarian
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger clr-white">
            Pameran Jalur Rempah
          </a>
        </li>
        <div class="bg-nav2">
          <img class="item-jelajah-3" src="assets/img/asset-jelajah.png">
        </div>
      </ul>
    </div>
  </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-dark bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/logo/logo.png') }}" height="50px">
    </a>
    <ul class="link-bahasa d-block d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="btn icon-search d-block d-lg-none" data-bs-toggle="modal" data-bs-target="#searchModal">
      <i class="fa fa-search clr-white"></i>
    </button>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tentang
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">Jalur</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">Jejak</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">Masa Depan</a></li>
            {{-- <li><a class="dropdown-item" href="#">Jalur</a></li>
            <li><a class="dropdown-item" href="#">Jejak</a></li>
            <li><a class="dropdown-item" href="#">Masa Depan</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'konten' ? 'active' : '' }}" href="{{ route('konten') }}">Konten</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(1) == 'informasi' ? 'active' : '' }}" href="{{ route('informasi') }}">Informasi</a>
        </li>
      </ul>
      <div class="d-flex wrap-side-navbar">
        <div class="wrap-language">
          <ul class="link-bahasa d-none d-lg-block">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') :  asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_id') }}">
                    <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('set_language_en') }}">
                    <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="fa fa-search clr-white"></i>
        </button>
        <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger mr-4" style="margin-right:1rem">
          Pameran Jalur Rempah
        </a>
      </div>
    </div>
  </div>
</nav>
<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
  <div class="px-3">
    <div class="row">
      <div class="col-6">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="assets/img/logo/logo.png" height="45px">
        </a>
      </div>
      <div class="col"></div>
      <div class="col mt-1">
        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ Session::get('lg') == 'en' ? asset('assets/img/bendera/flag-english.png') : asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> {{ Session::get('lg') == 'en' ? 'EN' : 'ID' }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
          <li>
            <a class="dropdown-item" href="{{ route('set_language_id') }}">
              <img src="{{ asset('assets/img/bendera/flag-indonesia.png') }}" class="mr-2 flag" width="20px"> ID
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('set_language_en') }}">
              <img src="{{ asset('assets/img/bendera/flag-english.png') }}" class="mr-2 flag" width="20px"> EN
            </a>
          </li>
        </ul>
      </div>
      <div class="col text-end">
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </div>
      <ul class="nav2 no-search temp-pos">
        <li class="nav-item">
          <a class="page-scroll" aria-current="page" href="{{ route('home') }}">
            <i class="fa fa-home mr-2"></i> Beranda
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="page-scroll dropdown-toggle clr-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-info-circle mr-2"></i> Tentang
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li style="padding-top : 0px"><a class="dropdown-item" href="{{ route('tentangjalur') }}">Jalur</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangjejak') }}">Jejak</a></li>
            <li><a class="dropdown-item" href="{{ route('tentangmasadepan') }}">Masa Depan</a></li>
            {{-- <li><a class="dropdown-item" href="#">Jalur</a></li>
            <li><a class="dropdown-item" href="#">Jejak</a></li>
            <li><a class="dropdown-item" href="#">Masa Depan</a></li> --}}
          </ul>
        </li>
        <li class="nav-item">
          <a class="page-scroll {{ Request::segment(1) == 'konten' || Request::segment(1) == 'foto' ? 'active' : '' }}" href="{{ route('konten') }}" href="{{ route('konten') }}">
            <i class="fa fa-image mr-2"></i> Konten
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll  {{ Request::segment(1) == 'informasi' || Request::segment(1) == 'kegiatan' ? 'active' : '' }}" href="{{ route('informasi') }}">
            <i class="fa fa-newspaper mr-2"></i> Informasi
          </a>
        </li>
        <li class="nav-item">
          <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i> Pencarian
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger clr-white">
            Pameran Jalur Rempah
          </a>
        </li>
        <div class="bg-nav2">
          <img class="item-jelajah-3" src="assets/img/asset-jelajah.png">
        </div>
      </ul>
    </div>
  </div>
</nav>
@endif

@endif
