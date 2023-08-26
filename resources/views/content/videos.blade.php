@php
    $lang = App::getLocale();

    $metadata = [
        "meta:title" => __("All Videos")." | ".__("common.title"),
        "title" => __("All Videos"),
        // TODO: add videos metadata
    ];
@endphp

@extends('layout.app')

@section('content')
    <header id="hero">
        <img class="hero-img-2" srcset="{{ asset('assets/img/hero/hero-4-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-4-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-4-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-4-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-4.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-4.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{__("Video")}}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="sejarahRempah">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <section id="tabLine">
                                <div class="row justify-content-center" id="videos">
                                    @foreach ($data as $video)
                                        <div class="col-md-12 col-lg-4 mb-4">
                                            <div class="card no-border card-artikel">
                                                <iframe width="100%" height="190"
                                                    src="//www.youtube.com/embed/{{ $video["youtube_key"] }}?rel=0&amp;fs=0&amp;showinfo=0"
                                                    frameborder="0" allowfullscreen>
                                                </iframe>
                                                <a class="stretched-link lightbox"
                                                    href="{{ route('video_detail.'.$lang, $video["slug"]) }}"></a>
                                                <div class="card-body">
                                                    <p class="card-text">{{ $video["title"] }}</p>
                                                    @foreach ($video["categories"] as $category)
                                                        @include("partials.category-badge")
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="loader"></div>
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
    @include("partials.js.dynamic-navbar")
    @include("content.loader.videos")
    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script><img src="">
@endsection
