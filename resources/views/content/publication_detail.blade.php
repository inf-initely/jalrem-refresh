@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('title')
    {{ $content['title'] }}
@endsection

@section('content')
    <header id="hero">
        <img class="hero-img-2"
            srcset="{{ asset('assets/img/hero/hero-2-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-2-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-2-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-2-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-2.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-2.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{ __('Publication') }}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="artikel">
                <img class="item-jelajah item-kompas" src="{{ asset('assets/img/item-kompas.svg') }}">
                <img class="item-jelajah item-cengkeh" src="{{ asset('assets/img/item-cengkeh.svg') }}">
                <div class="container">
                    <div class="row justify-content-center">
                        <article class="col-lg-8">
                            <header>
                                <h2 class="sub-judul">{{ $content['title'] }}</h2>
                                <div class="info-penulis">
                                    <span class="txt-penulis" class="mr-3" id="penulis"
                                        name="penulis">{{ $content['author'] }}</span>
                                    |
                                    <span class="txt-penulis" id="tglArtikel"
                                        name="tglArtikel">{{ $content['published_at'] }}</span>
                                </div>
                            </header>
                            <article id="isiKonten">
                                <img class="mb-3 mt-3"
                                    src="{{ asset('storage/assets/publikasi/thumbnail/' . $content['thumbnail']) }}"
                                    width="100%">
                                {!! $content['content'] !!}
                                {!! $content['iframe'] !!}
                            </article>
                            @if ($content['author_type'] != 'admin')
                                <div id="disclaimer" class="mt-4">
                                    <p>{!! __('wall.author_disclaimer_contributor') !!}</p>
                                </div>
                            @endif
                            @include('partials.social_share')
                        </article>

                        <div class="col-lg-4">
                            <div class="row mb-4">
                                <div class="col-md-12 wrap-aside">
                                    <header>
                                        <h2 class="sub-judul">{{__("Popular Publications")}}</h2>
                                    </header>
                                    <div class="row">
                                        @foreach ($popular as $publication)
                                            <div class="col-12 mb-2">
                                                <div class="card no-border no-background">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <img class="kegiatan-img" id="imgKegiatan"
                                                                    name="imgKegiatan"
                                                                    src="{{ asset('storage/assets/publikasi/thumbnail/' . $publication['thumbnail']) }}">
                                                            </div>
                                                            <div class="col-7 center-v">
                                                                <h3 class="judul-berita-aside" id="jdlKegiatan"
                                                                    name="jdlKegiatan">{{ $publication['title'] }}
                                                                </h3>
                                                                <p class="tgl-berita-aside" id="tglKegiatan"
                                                                    name="tglKegiatan">
                                                                    {{ $publication['published_at'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('publication_detail.'.$lang, $publication['slug']) }}"
                                                            class="stretched-link"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 wrap-aside">
                                    <header>
                                        <h2 class="sub-judul">{{__("Latest Publications")}}</h2>
                                    </header>
                                    <div class="row">
                                        @foreach ($latest as $a)
                                            <div class="col-12 mb-2">
                                                <div class="card no-border no-background">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <img class="kegiatan-img" id="imgKegiatan"
                                                                    name="imgKegiatan"
                                                                    src="{{ asset('storage/assets/publikasi/thumbnail/' . $publication['thumbnail']) }}">
                                                            </div>
                                                            <div class="col-7 center-v">
                                                                <h3 class="judul-berita-aside" id="jdlKegiatan"
                                                                    name="jdlKegiatan">{{ $publication['title'] }}
                                                                </h3>
                                                                <p class="tgl-berita-aside" id="tglKegiatan"
                                                                    name="tglKegiatan">
                                                                    {{ $publication['published_at'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('publication_detail.'.$lang, $publication['slug']) }}"
                                                            class="stretched-link"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!---------------------------------------------------->
            <section class="container mt-5">
                <header class="row justify-content-center mb-2">
                    <div class="col-md-6">
                        <h2 class="sub-judul aside-judul">{{__("Related Publications")}}</h2>
                        <p>{!! __("wall.publication_desc_related") !!}</p>
                    </div>
                    <div class="col-md-6 center-v text-end">
                    </div>
                </header>
                <section class="row justify-content-center">
                    @foreach ($related as $a)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card no-border no-background card-body">
                                <img src="{{ asset('storage/assets/publikasi/thumbnail/' . $publication['thumbnail']) }}"
                                    class="card-img-top mb-4 img-thumbnail" alt="...">
                                <h3 class="card-title judul-artikel">{{ $publication['title'] }}</h3>
                                {{-- <p class="card-text des-artikel minimize">{!! Str::limit($publication["konten_indo"] , 50, $end='...') !!}</p> --}}
                                <p class="penulis-artikel"> {{ $publication['author'] }}</p>
                                <p class="tgl-artikel">{{ $publication['published_at'] }}</p>
                                <a href="{{ route('publication_detail.'.$lang, $publication['slug']) }}"
                                    class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </section>
            </section>
        </div>
    </main>
@endsection

@section('js')
    @include('partials.js.bootstrap')
    @include('partials.js.jquery')
    @include('partials.js.dynamic-navbar')
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
