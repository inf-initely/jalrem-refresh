@extends('layout.app')

@section('title')
    {{ $content['title'] }}
@endsection

@section('content')
    <main>
        <div id="content">
            <section id="artikelDanBerita">
                <div class="container">
                    <div class="row justify-content-center">
                        <article class="col-lg-8">
                            <header>
                                <h2 class="sub-judul mb-4" id="judulMedia">{{ $content['title'] }}</h2>
                                <p class="penulis-artikel" id="authorMedia">{{ $content['author'] }}</p>
                                <p class="tgl-artikel mb-4" id="tglMedia">{{ $content['published_at'] }}</p>
                            </header>
                            <div class="slide-foto">
                                @foreach ($content['photos'] as $photo)
                                    <div>
                                        <div class="wrap-slide-img">
                                            <img src="{{ asset('storage/assets/foto/slider_foto/' . $photo["url"]) }}"
                                                width="100%">
                                            <div class="wrap-des-foto">
                                                <p>{{ $photo["caption"] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <article id="txtMedia">
                                {!! $content['content'] !!}
                            </article>
                            @if ($content['author_type'] != 'admin')
                                <div id="disclaimer" class="mt-4">
                                    <p>{! __("wall.author_disclaimer_contributor") !}</p>
                                </div>
                            @endif
                            @include('partials.social_share')
                        </article>
                    </div>
                </div>
            </section>
            <section id="mediaJalurRempah">
                <section class="container" id="artikel">
                    <header class="row justify-content-start mb-2">
                        <div class="col-md-6">
                            <h2 class="sub-judul">{{ __('The Spice Routes Contents') }}</h2>

                        </div>
                    </header>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row text-center">
                                <div class="col mb-2">
                                    <div class="card no-border card-media">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/icon-publication.webp') }}" width="25%">
                                            <p class="judul-media">{{ __('Article') }}</p>
                                            <p class="des-media">

                                            </p>
                                        </div>
                                        <a href="{{ route('articles') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="card no-border card-media">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/icon-image.webp') }}" width="25%">
                                            <p class="judul-media">{{ __('Photo') }}</p>
                                            <p class="des-media">

                                            </p>
                                        </div>
                                        <a href="{{ route('photos') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="card no-border card-media">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/icon-video.webp') }}" width="25%">
                                            <p class="judul-media">{{ __('Video') }}</p>
                                            <p class="des-media">

                                            </p>
                                        </div>
                                        <a href="{{ route('videos') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="card no-border card-media">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/icon-publication.webp') }}" width="25%">
                                            <p class="judul-media">{{ __('Publication') }}</p>
                                            <p class="des-media">

                                            </p>
                                        </div>
                                        <a href="{{ route('publications') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col d-none d-lg-block d-xl-none mb-1">
                                    <div class="card no-border card-media">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/icon-sound.webp') }}" width="32.5%">
                                            <p class="judul-media">{{ __('Audio') }}</p>
                                            <p class="des-media">

                                            </p>
                                        </div>
                                        <a href="{{ route('audios') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 mb-1 d-lg-none d-xl-block">
                                    <div class="card no-border card-media">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/icon-sound.webp') }}" width="32.5%">
                                            <p class="judul-media">{{ __('Audio') }}</p>
                                            <p class="des-media">

                                            </p>
                                        </div>
                                        <a href="{{ route('audios') }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>
@endsection

@section('js')
    @include('partials.js.bootstrap')
    @include('partials.js.jquery')
    @include('partials.js.dynamic-navbar')
    <script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.slide-foto').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("iframe").attr("allowfullscreen", "allowfullscreen");
        });
    </script>
    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
