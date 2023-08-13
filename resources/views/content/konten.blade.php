@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('meta_info')
    konten
@endsection

@section("title")
    {{__("Contents")}}
@endsection

@section('head')
    <style type="text/css">
        .slick-center {
            -webkit-transform: scale(1.25);
            -moz-transform: scale(1.25);
            transform: scale(1.25);
            transition: all 1s ease;
        }

        .slick-track {
            display: flex !important;
        }

        .slick-slide {
            height: inherit !important;
            margin-left: 35px;
            margin-right: 35px;
            margin-top: 50px;

        }

        @media (max-width: 991.98px) {
            .slick-slide {
                margin-left: 10px;
                margin-right: 10px;
                margin-top: 50px;
            }
        }
    </style>
@endsection

@section('content')
    <main>
        <div id="content" class="full-bg">
            <section id="sliderArtikel">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <header class="mb-2">
                                <h2 class="sub-judul text-center">{{ __('page_konten.top_heading') }}</h2>
                            </header>
                            <div class="feature">
                                @foreach ($kontenSlider as $a)
                                    @if ($a->getTable() == 'videos')
                                        <div class="card no-border card-artikel">
                                            <div class="video media-video img-thumbnail-slider"
                                                data-video-id="{{ $a->youtube_key }}">
                                                <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                <div class="video-layer">
                                                    <div class="video-placeholder">
                                                        <!-- ^ div is replaced by the YouTube video -->
                                                    </div>
                                                </div>
                                                <div class="video-preview"
                                                    style="background: url('https://img.youtube.com/vi/{{ $a->youtube_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                    <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                    <svg viewBox="0 0 74 74">
                                                        <circle style="opacity:0.64;stroke:#fff" cx="37"
                                                            cy="37" r="36.5"></circle>
                                                        <circle fill="none" stroke="#fff" cx="37" cy="37"
                                                            r="36.5"></circle>
                                                        <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                                                    </svg>
                                                </div>
                                            </div>
                                            <a class="stretched-link lightbox"
                                                href="{{ route('video_detail.'.$lang, $a->{"slug_".$lang} ?? $a->slug) }}"></a>
                                            <div class="card-body">
                                                <p class="card-text">{{ $a->{"judul_".$lang} }}</p>
                                            </div>
                                        </div>
                                    @elseif($a->getTable() == 'audio')
                                        <div class="card no-border card-artikel">
                                            <div class="video media-video img-thumbnail-slider"
                                                data-video-id="{{ $a->cloud_key }}">
                                                <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                <div class="video-layer">
                                                    <div class="video-placeholder">
                                                        <!-- ^ div is replaced by the YouTube video -->
                                                    </div>
                                                </div>
                                                <div class="video-preview"
                                                    style="background: url('https://img.youtube.com/vi/{{ $a->cloud_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                    <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                    <svg viewBox="0 0 74 74">
                                                        <circle style="opacity:0.64;stroke:#fff" cx="37"
                                                            cy="37" r="36.5"></circle>
                                                        <circle fill="none" stroke="#fff" cx="37" cy="37"
                                                            r="36.5"></circle>
                                                        <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                                                    </svg>
                                                </div>
                                            </div>
                                            <a class="stretched-link lightbox"
                                                href="{{ route('audio_detail.'.$lang, $a->{"slug_".$lang} ?? $a->slug) }}"></a>
                                            <div class="card-body">
                                                <p class="card-text">{{ $a->{"judul_".$lang} }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="card no-border card-artikel no-background">
                                                <img src="{{ asset('storage/assets/' . substr($a->getTable(), 0, -1) . '/thumbnail/' . $a->thumbnail) }}"
                                                    class="card-img-top img-thumbnail-slider" alt="...">
                                                <div class="card-body">
                                                    <h3 class="card-title judul-artikel">{{ $a->{"judul_".$lang} }}</h3>
                                                </div>
                                                <a href="{{ route(generate_route_content($a->getTable()) . '_detail.'.$lang, $a->{"slug_".$lang} ?? $a->slug) }}"
                                                    class="stretched-link"></a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="secMedia">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <header class="text-center">
                                <h2 class="sub-judul">{{ __('page_konten.heading') }}</h2>
                                <p>{{ __('page_konten.desc') }}</p>
                            </header>
                            <section id="tabLine">
                                <ul class="nav nav-pills mb-3 nav-tabline justify-content-center" id="pills-tab"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="tab-artikel-tab" data-bs-toggle="pill"
                                            data-bs-target="#tab-artikel" type="button" role="tab"
                                            aria-controls="tab-artikel" aria-selected="true">{{ __('Article') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-foto-tab" data-bs-toggle="pill"
                                            data-bs-target="#tab-foto" type="button" role="tab"
                                            aria-controls="tab-foto" aria-selected="false">{{ __('Photo') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-video-tab" data-bs-toggle="pill"
                                            data-bs-target="#tab-video" type="button" role="tab"
                                            aria-controls="tab-video" aria-selected="false">{{ __('Video') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-publikasi-tab" data-bs-toggle="pill"
                                            data-bs-target="#tab-publikasi" type="button" role="tab"
                                            aria-controls="tab-publikasi"
                                            aria-selected="false">{{ __('Publication') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tab-audio-tab" data-bs-toggle="pill"
                                            data-bs-target="#tab-audio" type="button" role="tab"
                                            aria-controls="tab-audio" aria-selected="false">{{ __('Audio') }}</button>
                                    </li>
                                </ul>
                                <div class="tab-content mt-5" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="tab-artikel" role="tabpanel"
                                        aria-labelledby="tab-artikel-tab">
                                        <div class="row justify-content-center">
                                            @foreach ($artikel as $a)
                                                <div class="col-md-6 col-lg-4 mb-4">
                                                    <div class="card no-border card-artikel">
                                                        <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}"
                                                            class="card-img-top img-thumbnail" alt="...">
                                                        <div class="card-body">
                                                            <h3 class="card-title judul-artikel">{{ $a->{"judul_".$lang} }}</h3>
                                                            <p class="penulis-artikel">
                                                                {{ $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin' }}
                                                            </p>
                                                            <p class="tgl-artikel">
                                                                {{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y') }}
                                                            </p>
                                                            @foreach ($a->kategori_show as $ks)
                                                                @include("partials.badge")
                                                            @endforeach
                                                        </div>
                                                        <a href="{{ route('article_detail.'.$lang, $a->{"slug_".$lang} ?? $a->slug) }}"
                                                            class="stretched-link"></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('articles.'.$lang) }}" class="btn btn-danger mr-4"
                                                    style="margin-right:1rem">{{ __('See All') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-foto" role="tabpanel"
                                        aria-labelledby="tab-foto-tab">
                                        <div class="row justify-content-center">
                                            @foreach ($foto as $f)
                                                <div class="col-lg-4 mb-4">
                                                    <div class="img-bg-wrap">
                                                        <img
                                                            src="{{ asset('storage/assets/foto/thumbnail/' . $f->thumbnail) }}">
                                                        <div class="text-img">
                                                            <p class="judul-img">{{ $f->{"judul_".$lang} }}</p>
                                                            <p class="author-img">
                                                                {{ $f->penulis != 'admin' ? $f->kontributor_relasi->nama : 'admin' }}
                                                            </p>
                                                            <p class="tgl-img">
                                                                {{ \Carbon\Carbon::parse($f->published_at)->isoFormat('D MMMM Y') }}
                                                            </p>
                                                        </div>
                                                        @foreach ($f->kategori_show as $ks)
                                                            @include("partials.badge")
                                                        @endforeach
                                                        <a class="stretched-link lightbox"
                                                            href="{{ route('photo_detail.'.$lang, $f->slug) }}"></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('photos.'.$lang) }}" class="btn btn-danger mr-4"
                                                    style="margin-right:1rem">{{ __('See All') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-video" role="tabpanel"
                                        aria-labelledby="tab-video-tab">
                                        <div class="row justify-content-center">
                                            @foreach ($video as $v)
                                                <div class="col-md-12 col-lg-4 mb-4">
                                                    <div class="card no-border card-artikel">
                                                        <!-- <div class="ytdefer video media-video" data-alt="youtube jalur rempah" data-src="{{ $v->youtube_key }}"></div> -->
                                                        <div class="video media-video"
                                                            data-video-id="{{ $v->youtube_key }}">
                                                            <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                            <div class="video-layer">
                                                                <div class="video-placeholder">
                                                                    <!-- ^ div is replaced by the YouTube video -->
                                                                </div>
                                                            </div>
                                                            <div class="video-preview"
                                                                style="background: url('https://img.youtube.com/vi/{{ $v->youtube_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                                <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                                <svg viewBox="0 0 74 74">
                                                                    <circle style="opacity:0.64;stroke:#fff"
                                                                        cx="37" cy="37" r="36.5">
                                                                    </circle>
                                                                    <circle fill="none" stroke="#fff" cx="37"
                                                                        cy="37" r="36.5"></circle>
                                                                    <polygon fill="#fff" points="33,22 33,52 48,37">
                                                                    </polygon>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <a class="stretched-link lightbox"
                                                            href="{{ route('video_detail.'.$lang, $v->slug) }}"></a>
                                                        <div class="card-body">
                                                            <p class="card-text">{{ $v->{"judul_".$lang} }}</p>
                                                        </div>
                                                        @foreach ($v->kategori_show as $ks)
                                                            @include("partials.badge")
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('videos.'.$lang) }}" class="btn btn-danger mr-4"
                                                    style="margin-right:1rem">{{ __('See All') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-publikasi" role="tabpanel"
                                        aria-labelledby="tab-publikasi-tab">
                                        <div class="row justify-content-center">
                                            @foreach ($publikasi as $p)
                                                <div class="col-md-6 col-lg-4 mb-4">
                                                    <div class="card no-border card-artikel">
                                                        <img src="{{ asset('storage/assets/publikasi/thumbnail/' . $p->thumbnail) }}"
                                                            class="card-img-top img-thumbnail" alt="...">
                                                        <div class="card-body">
                                                            <h3 class="card-title judul-artikel">{{ $p->{"judul_".$lang} }}</h3>
                                                            {{-- <p class="card-text des-artikel minimize">{!! Str::limit($p->konten_indo, 50, $end='...') !!}</p> --}}
                                                            <p class="penulis-artikel">
                                                                {{ $p->penulis != 'admin' ? $p->kontributor_relasi->nama : 'admin' }}
                                                            </p>
                                                            <p class="tgl-artikel">
                                                                {{ \Carbon\Carbon::parse($p->published_at)->isoFormat('D MMMM Y') }}
                                                            </p>
                                                            @foreach ($p->kategori_show as $ks)
                                                                @include("partials.badge")
                                                            @endforeach
                                                        </div>
                                                        <a href="{{ route('publication_detail.'.$lang, $p->slug) }}"
                                                            class="stretched-link"></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('publications.'.$lang) }}" class="btn btn-danger mr-4"
                                                    style="margin-right:1rem">{{ __('See All') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-audio" role="tabpanel"
                                        aria-labelledby="tab-audio-tab">
                                        <div class="row justify-content-center">
                                            @foreach ($audio as $a)
                                                <div class="col-md-12 col-lg-4 mb-4">
                                                    <div class="card no-border card-artikel">
                                                        <!-- <div class="ytdefer video media-video" data-alt="youtube jalur rempah" data-src="{{ $a->cloud_key }}"></div> -->
                                                        <div class="video media-video"
                                                            data-video-id="{{ $a->cloud_key }}">
                                                            <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                            <div class="video-layer">
                                                                <div class="video-placeholder">
                                                                    <!-- ^ div is replaced by the YouTube video -->
                                                                </div>
                                                            </div>
                                                            <div class="video-preview"
                                                                style="background: url('https://img.youtube.com/vi/{{ $a->cloud_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                                <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                                <svg viewBox="0 0 74 74">
                                                                    <circle style="opacity:0.64;stroke:#fff"
                                                                        cx="37" cy="37" r="36.5">
                                                                    </circle>
                                                                    <circle fill="none" stroke="#fff" cx="37"
                                                                        cy="37" r="36.5"></circle>
                                                                    <polygon fill="#fff" points="33,22 33,52 48,37">
                                                                    </polygon>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <a class="stretched-link lightbox"
                                                            href="{{ route('audio_detail.'.$lang, $a->{"slug_".$lang} ?? $a->slug) }}"></a>
                                                        <div class="card-body">
                                                            <p class="card-text">{{ $a->{"judul_".$lang} }}</p>
                                                        </div>
                                                        @foreach ($a->kategori_show as $ks)
                                                            @include("partials.badge")
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('audios.'.$lang) }}" class="btn btn-danger mr-4"
                                                    style="margin-right:1rem">{{ __('See All') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('js')
    @include("partials.js.jquery")
    @include("partials.js.bootstrap")
    <script type="text/javascript" src="{{ asset('assets/js/ytdefer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
    @include("partials.js.dynamic-navbar")
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        document.body.appendChild(tag);

        // When the YouTube API code loads, it calls this function, so it must be global
        // and it must be named exactly onYouTubeIframeAPIReady.
        window.onYouTubeIframeAPIReady = function() {
            var videoModules = document.querySelectorAll('.video');
            // for Internet Explorer 11 and below, convert array-like NodeList to an actual Array.
            videoModules = Array.prototype.slice.call(videoModules);
            videoModules.forEach(initializeVideoModule);
        }

        function initializeVideoModule(videoModule) {
            var player = new YT.Player(videoModule.querySelector('.video-placeholder'), {
                videoId: videoModule.dataset.videoId,
                events: {
                    onStateChange: function(event) {
                        var isEnded = event.data === YT.PlayerState.ENDED;
                        // 'playing' css class controls fading the video and preivew images in/out.
                        // Internet Explorer 11 and below do not support a second argument to `toggle`
                        // videoModule.classList.toggle('playing', !isEnded);
                        videoModule.classList[isEnded ? 'remove' : 'add']('playing');
                        // if the video is done playing, remove it and re-initialize
                        if (isEnded) {
                            player.destroy();
                            videoModule.querySelector('.video-layer').innerHTML = (
                                '<div class="video-placeholder"></div>'
                            );
                            initializeVideoModule(videoModule);
                        }
                    }
                }
            });
        }
    </script>
    <script>
        $(function() {

            var minimized_elements = $('p.minimize');

            minimized_elements.each(function() {
                var t = $(this).text();
                if (t.length < 90) return;

                $(this).html(
                    t.slice(0, 90) + '<span>...' +
                    '<span style="display:none;">' + t.slice(90, t.length)
                );

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.feature').slick({
                centerMode: true,
                centerPadding: '300px',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 9000,
                responsive: [{
                        breakpoint: 1000,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        window.addEventListener('load', ytdefer_setup);
    </script>

    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
