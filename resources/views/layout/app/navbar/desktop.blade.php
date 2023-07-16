<nav
    class="navbar navbar-expand-lg {{ $altnav ? 'navbar-light' : 'navbar-dark' }} bg-light sticky-top bg-trans d-none d-lg-block d-xl-none">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="assets/img/logo/{{ $altnav ? 'logo-2.png' : 'logo.png' }}" height="50px">
        </a>
        <div class="collapse navbar-collapse {{ $altnav ? 'navbar-baru' : '' }}" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link page-scroll {{ $info == 'home' ? 'active' : '' }}" aria-current="page"
                        href="{{ $info != "home" ? route('home') : '#home' }}">{{ __('navbar.beranda') }}</a>
                </li>
                @if ($info != "home")
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ in_array($info, ['tentang_jalur', 'tentang_jejak', 'tentang_masa_depan']) ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('navbar.tentang') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('tentangjalur') }}">{{ __('navbar.jalur') }}</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('tentangjejak') }}">{{ __('navbar.jejak') }}</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('tentangmasadepan') }}">{{ __('navbar.masa_depan') }}</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#jelajah">{{ __('navbar.tentang') }}</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link page-scroll {{ $info == 'konten' ? 'active' : '' }}"
                        href="{{ $info != "home" ? route('konten') : '#media' }}">{{ __('navbar.konten') }}</a>
                </li>
                <li class="nav-item">
                    @if ($info != "home")
                        <a class="nav-link page-scroll {{ $info == 'informasi' ? 'active' : '' }}"
                            href="{{ route('informasi') }}">{{ __('navbar.informasi') }}</a>
                    @else
                        <a class="nav-link page-scroll" href="#kegiatan">{{ __('navbar.kegiatan') }}</a>
                    @endif
                </li>
            </ul>
            <div class="d-flex wrap-side-navbar">
                <div class="wrap-language">
                    <ul class="link-bahasa d-none d-lg-block">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ $altnav ? 'clr-black' : '' }}" href="#"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/img/bendera/flag-' . __('base.full_lang') . '-20px.webp') }}"
                                    class="mr-2 flag" width="20px">
                                {{ strtoupper($lang) }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('set_language_id') }}">
                                        <img src="{{ asset('assets/img/bendera/flag-indonesia-20px.webp') }}"
                                            class="mr-2 flag" width="20px"> ID
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('set_language_en') }}">
                                        <img src="{{ asset('assets/img/bendera/flag-english-20px.webp') }}"
                                            class="mr-2 flag" width="20px"> EN
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="btn icon-search mr-4 d-none d-lg-block" data-bs-toggle="modal"
                    data-bs-target="#searchModal">
                    <i class="fa fa-search clr-white"></i>
                </button>
                <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id" class="btn btn-danger mr-4"
                    style="margin-right:1rem">
                    {{ __('navbar.pameran') }}
                </a>
            </div>
        </div>
    </div>
</nav>
