@php
    $lang = App::getLocale();
    $altnav = true;
@endphp

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
            @include("partials.contents_navi_footer")
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
