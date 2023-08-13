@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section("meta_info")
    informasi
@endsection

@section("title")
    {{__("Information")}}
@endsection

@section('content')
    <header id="hero">
        <img class="hero-img-2"
            srcset="{{ asset('assets/img/hero/hero-5-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-5-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-5-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-5-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-5.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-5.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{__("The Spice Routes Information")}}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="artikelDanBerita">
                <div class="container" id="artikel">
                    <header class="row justify-content-start mb-2">
                        <div class="col-md-6">
                            <h2 class="sub-judul">{{__("Latest Events")}}</h2>
                        </div>
                        <div class="col-md-6 center-v text-end d-desktop">
                            <a href="{{ route('events.'.$lang) }}" class="btn btn-outline-danger">{{__("See All")}}</a>
                        </div>
                    </header>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($ongoing_events as $event)
                                    <div class="col-lg-4 mb-1">
                                        <div class="card no-border no-background">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan"
                                                            src="{{ asset('storage/assets/kegiatan/thumbnail/' . $event["thumbnail"]) }}">
                                                    </div>
                                                    <div class="col-6 center-v">
                                                        <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ $event["published_at"] }}</p>
                                                        <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $event["title"] }}</h3>
                                                    </div>
                                                    @foreach ($event["categories"] as $category)
                                                        @include("partials.category-badge")
                                                    @endforeach
                                                </div>
                                                <a href="{{ route('event_detail.'.$lang, $event["slug"]) }}" class="stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center d-mobile mt-2">
                        <a href="{{ route('events.'.$lang) }}" class="btn btn-outline-danger">{{__("See All")}}</a>
                    </div>
                </div>
            </section>
            <section id="kegiatanSebelumnya">
                <div class="container">
                    <header class="row justify-content-start mb-2">
                        <div class="col-md-6">
                            <h2 class="sub-judul">{{__("Past Events")}}</h2>
                        </div>
                        <div class="col-md-6 center-v text-end d-desktop">
                            <a href="{{ route('events.'.$lang) }}" class="btn btn-outline-danger">{{__("See All")}}</a>
                        </div>
                    </header>
                    <div class="kegiatan-sebelumnya">
                        @foreach ($past_events as $event)
                            <div>
                                <div class="card no-border card-kegiatan">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan"
                                                    src="{{ asset('storage/assets/kegiatan/thumbnail/' . $event["thumbnail"]) }}">
                                            </div>
                                            <div class="col-6 center-v">
                                                <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ $event["published_at"] }}</p>
                                                <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $event["title"] }}</h3>
                                            </div>
                                            @foreach ($event["categories"] as $category)
                                                @include("partials.category-badge")
                                            @endforeach
                                        </div>
                                        <a href="{{ route('event_detail.'.$lang, $event["slug"]) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-md-12 text-center d-mobile mt-2">
                        <a href="{{ route('events.'.$lang) }}" class="btn btn-outline-danger">{{__("See All")}}</a>
                    </div>
                </div>
        </div>
        </section>
        <section id="kerjasama">
            <div class="container">
                <header class="row justify-content-start mb-2">
                    <div class="col-md-6">
                        <h2 class="sub-judul">{{__("Partnership")}}</h2>
                    </div>
                    <div class="col-md-6 center-v text-end d-desktop">
                        <a href="{{ route('partnerships.'.$lang) }}" class="btn btn-outline-danger">{{__("See All")}}</a>
                    </div>
                </header>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($partnerships as $partnership)
                                <div class="col-lg-4 mb-1">
                                    <div class="card no-border card-artikel">
                                        <img src="{{ asset('storage/assets/kerjasama/thumbnail/' . $partnership["thumbnail"]) }}"
                                            class="card-img-top img-thumbnail" alt="...">
                                        <div class="card-body">
                                            <h3 class="card-title judul-artikel">{{ $partnership["title"] }}</h3>
                                            <p class="penulis-artikel">
                                                {{-- {{ $event["penulis"] }} --}}
                                            </p>
                                            <p class="tgl-artikel">{{ $event["published_at"] }}</p>
                                            @foreach ($event["categories"] as $category)
                                                @include("partials.category-badge")
                                            @endforeach
                                        </div>
                                        <a href="{{ route('partnership_detail.'.$lang, $event["slug"]) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center d-mobile mt-2">
                    <a href="{{ route('partnerships.'.$lang) }}" class="btn btn-outline-danger">{{__("See All")}}</a>
                </div>
            </div>
        </section>
        <!----------------------------------------------------------->
        @include("partials.triad_card_navi_footer")
        </div>
    </main>
@endsection

@section('js')
    @include("partials.js.jquery")
    @include("partials.js.bootstrap")
    @include("partials.js.dynamic-navbar")
    <script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script>
        $('.kegiatan-sebelumnya').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true,
                        arrows: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
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
