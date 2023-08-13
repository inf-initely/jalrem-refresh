@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('meta_info')
    tentang_jalur
@endsection

@section('title')
    {{ __('common.the_route') }}
@endsection

@section('content')
    <header id="hero">
        <img class="hero-img-2 hero-peta "
            src="https://jalurrempah.kemdikbud.go.id/wp-content/uploads/2020/09/Peta-indonesia-u-JR.jpg">
        <div class="wrap-hero-text wrap-hero-text-bg d-none d-lg-block" id="wrapHeroText">
            <div class="row">
                <article class="col-md-12">
                    <header>
                        <h2 class="sub-judul sub-judul-hero text-end">{{ __("The Spice Routes' Spots") }}</h2>
                    </header>
                    <p>{!! __("wall.the_route_hero_desc") !!}</p>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-sm btn-outline-secondary" onclick="readMore()" id="btnReadmore">{{__("Read More")}}</button>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="narasi" class="d-block d-lg-none px-3">
                <div class="row">
                    <article class="col-md-12">
                        <header>
                            <h2 class="sub-judul sub-judul-hero">{{ __("The Spice Routes' Spots") }}</h2>
                        </header>
                        <p>{!! __("wall.the_route_hero_desc") !!}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-outline-secondary" onclick="readMore2()"
                                    id="btnReadmore2">{{ __('Read More') }}</button>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <section id="kontenJejak">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 mt-3">
                            <div class="row" id="contents">
                                @foreach ($data as $content)
                                    @if ($content['content_type'] == 'video')
                                        <div class="col-lg-6 mb-1">
                                            <div class="card no-border no-background">
                                                <div class="card-body row">
                                                    <div class="col-5 center-v">
                                                        <div class="video media-video" style="height: 170px;"
                                                            data-video-id="{{ $content['youtube_key'] }}">
                                                            <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                            <div class="video-layer">
                                                                <div class="video-placeholder">
                                                                    <!-- ^ div is replaced by the YouTube video -->
                                                                </div>
                                                            </div>
                                                            <div class="video-preview"
                                                                style="background: url('https://img.youtube.com/vi/{{ $content['youtube_key'] }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                                <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                                <svg viewBox="0 0 74 74">
                                                                    <circle style="opacity:0.64;stroke:#fff" cx="37"
                                                                        cy="37" r="36.5"></circle>
                                                                    <circle fill="none" stroke="#fff" cx="37"
                                                                        cy="37" r="36.5"></circle>
                                                                    <polygon fill="#fff" points="33,22 33,52 48,37">
                                                                    </polygon>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 center-v">
                                                        <a href="#"
                                                            class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $content['location'] ?? '' }}</small></a>
                                                        <h3 class="judul-artikel judul-artikel-tentang"><a
                                                                href="{{ route('video_detail', $content['slug']) }}"
                                                                class="text-decoration-none clr-black">{{ $content['title'] }}</a>
                                                        </h3>
                                                        <div class="wrap-tag-rempah">
                                                            @foreach ($content['sices'] as $spice)
                                                                <a href="{{ route('rempah_detail', $spice['type']) }}"
                                                                    class="text-danger text-decoration-none">{{ $spice['type'] }}</a>
                                                                @if (!$loop->last)
                                                                    |
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        @foreach ($content['categories'] as $category)
                                                            @include('partials.category-badge')
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($content['content_type'] == 'audio')
                                        <div class="col-lg-6 mb-1">
                                            <div class="card no-border no-background">
                                                <div class="card-body row">
                                                    <div class="col-5 center-v">
                                                        <div class="video media-video" style="height: 170px;"
                                                            data-video-id="{{ $content['cloud_key'] }}">
                                                            <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                            <div class="video-layer">
                                                                <div class="video-placeholder">
                                                                    <!-- ^ div is replaced by the YouTube video -->
                                                                </div>
                                                            </div>
                                                            <div class="video-preview"
                                                                style="background: url('https://img.youtube.com/vi/{{ $content['cloud_key'] }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                                <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                                <svg viewBox="0 0 74 74">
                                                                    <circle style="opacity:0.64;stroke:#fff" cx="37"
                                                                        cy="37" r="36.5"></circle>
                                                                    <circle fill="none" stroke="#fff" cx="37"
                                                                        cy="37" r="36.5"></circle>
                                                                    <polygon fill="#fff" points="33,22 33,52 48,37">
                                                                    </polygon>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 center-v">
                                                        <a href="#"
                                                            class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $content['location'] }}</small></a>
                                                        <h3 class="judul-artikel judul-artikel-tentang"><a
                                                                href="{{ route('video_detail', $content['slug']) }}"
                                                                class="text-decoration-none clr-black">{{ $content['title'] }}</a>
                                                        </h3>
                                                        <div class="wrap-tag-rempah">
                                                            @foreach ($content['spices'] as $spice)
                                                                <a href="{{ route('rempah_detail', $spice['type']) }}"
                                                                    class="text-danger text-decoration-none">{{ $spice['type'] }}</a>
                                                                @if (!$loop->last)
                                                                    |
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        @foreach ($content['categories'] as $category)
                                                            @include('partials.category-badge')
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-6 mb-2">
                                            <div class="card no-border no-background">
                                                <div class="card-body row">
                                                    <div class="col-5 center-v">
                                                        <img class="tentang-thumbnail"
                                                            src="{{ asset(get_asset_path($content['table_name'], $content['thumbnail'])) }}"
                                                            width="100%">
                                                    </div>
                                                    <div class="col-7 center-v">
                                                        <a href="#"
                                                            class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $content['location'] }}</small></a>
                                                        <h3 class="judul-artikel judul-artikel-tentang"><a
                                                                href="{{ route(generate_route_content($content['table_name']) . '_detail.' . $lang, $content['slug']) }}"
                                                                class="text-decoration-none clr-black">{{ $content['title'] }}</a>
                                                        </h3>
                                                        <div class="wrap-tag-rempah">
                                                            @foreach ($content['spices'] as $spice)
                                                                <a href="{{ route('rempah_detail', $spice['type']) }}"
                                                                    class="text-danger text-decoration-none">{{ $spice['type'] }}</a>
                                                                @if (!$loop->last)
                                                                    |
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        @foreach ($content['categories'] as $category)
                                                            @include('partials.category-badge')
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <div class="loader"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include("partials.triad_card_navi_footer")
        </div>
    </main>
@endsection

@section('js')
    @include("partials.js.jquery")
    @include("partials.js.bootstrap")
    @include("partials.js.dynamic-navbar")
    @include("content.loader.the_route")
    <script>
        $("#selectLokasi").select2({
            placeholder: "Pilih Lokasi",
            allowClear: true
        });

        $("#selectRempah").select2({
            placeholder: "Pilih Jenis Rempah",
            allowClear: true
        });
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
        function readMore() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("btnReadmore");


            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = {{__("Read More")}};
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = {{__("Hide")}};
                moreText.style.display = "inline";
            }

            if ($("#wrapHeroText").hasClass("min-h-100")) {
                $("#wrapHeroText").removeClass("min-h-100", 1000);
            } else {
                $("#wrapHeroText").addClass("min-h-100", 1000);
            }

        }

        function readMore2() {
            var dots2 = document.getElementById("dots2");
            var moreText2 = document.getElementById("more2");
            var btnText2 = document.getElementById("btnReadmore2");


            if (dots2.style.display === "none") {
                dots2.style.display = "inline";
                btnText2.innerHTML = "Lihat Selengkapnya";
                moreText2.style.display = "none";
            } else {
                dots2.style.display = "none";
                btnText2.innerHTML = "Kembali";
                moreText2.style.display = "inline";
            }
        }
    </script>

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
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
