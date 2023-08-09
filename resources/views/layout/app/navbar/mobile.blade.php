<nav class="navbar2 py-2 sticky-top d-lg-none d-xl-block bg-nav">
    <div class="px-3">
        <div class="row">
            <div class="col-6">
                <a class="navbar-brand" href="{{ route('home.'.$lang) }}">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" height="45px">
                </a>
            </div>
            <div class="col"></div>
            <div class="col mt-1">
                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/img/bendera/flag-' . __('base.full_lang') . '-20px.webp') }}"
                        class="mr-2 flag" width="20px"> {{ strtoupper($lang) }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: 0px">
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
                    <a class="page-scroll {{ $info == 'home' ? 'active' : '' }}"
                        href="{{ $altnav ? route('home.'.$lang) : '#home' }}">
                        <i class="fa fa-home mr-2"></i> {{ __("Home") }}
                    </a>
                </li>
                @if ($altnav)
                    <li class="nav-item dropdown">
                        <a class="page-scroll dropdown-toggle clr-black {{ in_array($info, ['tentang_jalur', 'tentang_jejak', 'tentang_masa_depan']) ? 'active' : '' }}"
                            href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-info-circle mr-2"></i> {{ __('About') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li style="padding-top : 0px"><a class="dropdown-item"
                                    href="{{ route('tentangjalur') }}">{{ __('common.the_route') }}</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('tentangjejak') }}">{{ __('common.the_trail') }}</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ route('tentangmasadepan') }}">{{ __('common.the_future') }}</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="page-scroll" href="#jelajah">
                            <i class="fa fa-info-circle mr-2"></i> {{ __('About') }}
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="page-scroll {{ $info == 'konten' ? 'active' : '' }}"
                        href="{{ $altnav ? route('contents.'.$lang) : '#media' }}">
                        <i class="fa fa-image mr-2"></i> {{ __('Contents') }}</a>
                </li>
                <li class="nav-item">
                    @if ($altnav)
                        <a class="page-scroll {{ $info == 'informasi' ? 'active' : '' }}"
                            href="{{ route('information.'.$lang) }}">
                            <i class="fa fa-newspaper mr-2"></i> {{ __('Information') }}
                        </a>
                    @else
                        <a class="page-scroll" href="#kegiatan">
                            <i class="fa fa-newspaper mr-2"></i> {{ __('Events') }}
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="page-scroll" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i> {{__("common.the_search")}}
                    </a>
                </li>

                <li class="nav-item">
                    <a target="_blank" href="https://pameran-jalurrempah.kemdikbud.go.id/id"
                        class="btn btn-danger clr-white">
                        {{__("The Spice Routes Exhibition")}}
                    </a>
                </li>
                <div class="bg-nav2">
                    <img class="item-jelajah-3"
                        srcset="{{ asset('assets/img/asset-jelajah-576px.webp') }} 576w, {{ asset('assets/img/asset-jelajah-768px.webp') }} 768w, {{ asset('assets/img/asset-jelajah-992px.webp') }} 992w, {{ asset('assets/img/asset-jelajah-1200px.webp') }} 1200w, {{ asset('assets/img/asset-jelajah.webp') }}"
                        sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
                        src="{{ asset('assets/img/asset-jelajah.webp') }}" alt="" />
                </div>
            </ul>
        </div>
    </div>
</nav>
