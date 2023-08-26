@php
    $lang = App::getLocale();

    $metadata = [
        "meta:title" => __("common.the_future")." | ".__("common.title"),
        "title" => __("common.the_future"),
        "description" => __("meta.tentang_masa_depan.description"),
        "keywords" => __("meta.tentang_masa_depan.keywords"),
    ];
@endphp

@extends('layout.app')

@section('content')
    <header id="hero">
        <img class="hero-img-2"
            srcset="{{ asset('assets/img/hero/hero-3-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-3-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-3-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-3-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-3.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-3.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{__("common.the_future")}}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="sejarahRempah">
                <div class="container">
                    <div class="row justify-content-center">
                        <article class="col-lg-8">
                            <header>
                                <h2 class="sub-judul">{{__("The Future and The Spice Routes")}}</h2>
                            </header>
                            <section id="desTentang">
                                @include("content.the_future.hero_desc_".$lang)
                            </section>
                        </article>
                        <section id="artikelTentang">
                            <div class="row justify-content-center">
                                <div class="col-lg-11 mt-3">
                                    <div class="row" id="contents">
                                        @foreach ($data as $content)
                                            @include('content.common.the_xxx_item')
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        <div class="loader"></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
            @include('partials.triad_card_navi_footer')
        </div>
    </main>
@endsection

@section('js')
    @include('partials.js.jquery')
    @include('partials.js.bootstrap')
    @include('partials.js.dynamic-navbar')
    @include('content.loader.the_xxx')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
