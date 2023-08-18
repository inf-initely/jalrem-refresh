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
    @include('content.common.location')
    <header id="hero">
        <img class="hero-img-2 hero-peta "
            src="https://jalurrempah.kemdikbud.go.id/wp-content/uploads/2020/09/Peta-indonesia-u-JR.jpg">
        <div class="wrap-hero-text wrap-hero-text-bg d-none d-lg-block" id="wrapHeroText">
            <div class="row">
                <article class="col-md-12">
                    <header>
                        <h2 class="sub-judul sub-judul-hero text-end">{{ __("The Spice Routes' Spots") }}</h2>
                    </header>
                    @include('content.the_route.hero_desc_' . $lang)
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button class="btn btn-sm btn-outline-secondary" onclick="readMore()"
                                id="btnReadmore">{{ __('Read More') }}</button>
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
                        @include('content.the_route.hero_desc_' . $lang)
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
                                    @include('content.common.the_xxx_item')
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <div class="loader"></div>
                            </div>
                        </div>
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
                btnText.innerHTML = '{{ __('Read More') }}';
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = '{{ __('Hide') }}';
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
                btnText2.innerHTML = '{{ __('Read More') }}';
                moreText2.style.display = "none";
            } else {
                dots2.style.display = "none";
                btnText2.innerHTML = '{{ __('Hide') }}';
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
