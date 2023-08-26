@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('title')
    {{__("All Articles")}}
@endsection

@section('content')
    <header id="hero">
        <img class="hero-img-2"
            srcset="{{ asset('assets/img/hero/hero-4-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-4-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-4-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-4-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-4.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-4.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{__("Article")}}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="content">
            <section id="sejarahRempah">
                <div class="container">
                    <div class="row justify-content-center" id="articles">
                        @foreach ($data as $article)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card no-border card-artikel">
                                    <img src="{{ asset('storage/assets/artikel/thumbnail/' . $article["thumbnail"]) }}"
                                        class="card-img-top img-thumbnail" alt="...">
                                    <div class="card-body">
                                        <h3 class="card-title judul-artikel">{{ $article["title"] }}</h3>
                                        {{-- <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> --}}
                                        <p class="penulis-artikel">{{ $article["author"] }}</p>
                                        <p class="tgl-artikel">{{ $article["published_at"] }}</p>
                                        @foreach ($article["categories"] as $category)
                                            @include("partials.category-badge")
                                        @endforeach
                                    </div>
                                    <a href="{{ route('article_detail.'.$lang, $article["slug"]) }}" class="stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="loader"></div>
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
    @include('content.loader.articles')
    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
