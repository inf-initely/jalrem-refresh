@extends('layout.app')

@section('title')
    {{ $content["title"] }}
@endsection

@section('content')
    <main>
        <div id="content">
            <section id="artikelDanBerita">
                <div class="container">
                    <div class="row justify-content-center">
                        <article class="col-lg-8">
                            <header>
                                <h2 class="sub-judul mb-4">{{ $content["title"] }}</h2>
                                <div class="info-penulis">
                                    <span class="txt-penulis" class="mr-3" id="penulis"
                                        name="penulis">{{ $content["author"] }}</span>
                                    |
                                    <span class="txt-penulis" id="tglArtikel"
                                        name="tglArtikel">{{ $content["published_at"] }}</span>
                                </div>
                            </header>
                            <img src="{{ asset('storage/assets/kegiatan/thumbnail/' . $content["thumbnail"]) }}"
                                width="100%">
                            <article id="isiKonten">
                                {!! $content["content"] !!}
                            </article>
                            @if ($content["author_type"] != 'admin')
                                <div id="disclaimer" class="mt-4">
                                    <p>{!! __("wall.author_disclaimer_contributor") !!}</p>
                                </div>
                            @endif
                            @include('partials.social_share')
                        </article>
                    </div>
                </div>
            </section>
            <section id="artikelDanBerita">
                <section class="container" id="artikel">
                    <header class="row justify-content-start mb-2">
                        <div class="col-md-6">
                            <h2 class="sub-judul">{{__("Latest Events")}}</h2>

                        </div>
                    </header>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach ($latest as $item)
                                    <div class="col-lg-4 mb-1">
                                        <div class="card no-border no-background">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan"
                                                            src="{{ asset('storage/assets/kegiatan/thumbnail/' . $item["thumbnail"]) }}">
                                                    </div>
                                                    <div class="col-6 center-v">
                                                        <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">
                                                            {{ $item["published_at"] }}</p>
                                                        <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">
                                                            {{ $item["title"] }}</h3>
                                                    </div>
                                                </div>
                                                <a href="{{ route('event_detail', $item["slug"]) }}" class="stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
