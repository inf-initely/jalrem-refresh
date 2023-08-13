@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('content')
    <header id="hero">
        <img class="hero-img-2"
            srcset="{{ asset('assets/img/hero/hero-4-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-4-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-4-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-4-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-4.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-4.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{__("All Contents")}}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="sejarahRempah">
                <div class="container">
                    <div class="row justify-content-center">
                        @foreach ($contents as $content)
                            @if ($content["content_type"] == 'video')
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card no-border card-artikel">
                                        <div class="video media-video" data-video-id="{{ $content["youtube_key"] }}">
                                            <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                            <div class="video-layer">
                                                <div class="video-placeholder">
                                                    <!-- ^ div is replaced by the YouTube video -->
                                                </div>
                                            </div>
                                            <div class="video-preview"
                                                style="background: url('https://img.youtube.com/vi/{{ $content["youtube_key"] }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                                <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                                <svg viewBox="0 0 74 74">
                                                    <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37"
                                                        r="36.5"></circle>
                                                    <circle fill="none" stroke="#fff" cx="37" cy="37"
                                                        r="36.5"></circle>
                                                    <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                                                </svg>
                                            </div>
                                        </div>
                                        <a class="stretched-link lightbox" href="{{ route('video_detail.'.$lang, $content["slug"]) }}"></a>
                                        <div class="card-body">
                                            <p class="card-text">{{ $content["title"] }}</p>
                                        </div>
                                        @foreach ($content["categories"] as $category)
                                            @include("partials.category-badge")
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($content["content_type"] == 'audio')
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay"
                                        src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{ $content["cloud_key"] }}&color=%231a150d&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
                                    <div
                                        style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;">
                                        <a href="#" title="" target="_blank"
                                            style="color: #cccccc; text-decoration: none;"></a> · <a
                                            href="{{ route('audio_detail.'.$lang, $content["slug"]) }}" title="{{ $content["title"] }}"
                                            style="color: #cccccc; text-decoration: none;">{{ $content["title"] }}</a></div>
                                    <main></main>
                                    @foreach ($content["categories"] as $category)
                                        @include("partials.category-badge")
                                    @endforeach
                                </div>
                            @else
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card no-border card-artikel">
                                        <img src="{{ asset(get_asset_path($content["table_name"], $content["thumbnail"], 'thumbnail')) }}"
                                            class="card-img-top img-thumbnail" alt="...">
                                        <div class="card-body">
                                            <h3 class="card-title judul-artikel">{{ $content["title"] }}</h3>
                                            {{-- <p class="card-text des-artikel minimize">{!! Str::limit($content["konten_indo"], 50, $end='...') !!}</p> --}}
                                            <p class="penulis-artikel">{{ $content["author"] }}</p>
                                            <p class="tgl-artikel">{{ $content["published_at"] }}</p>
                                            @foreach ($content["categories"] as $category)
                                                @include("partials.category-badge")
                                            @endforeach
                                        </div>
                                        <a href="{{ route(generate_route_content($content["table_name"]) . '_detail.'.$lang, $content["slug"]) }}"
                                            class="stretched-link"></a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $contents->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('js')
    @include("partials.js.jquery")
    @include("partials.js.bootstrap")
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
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
