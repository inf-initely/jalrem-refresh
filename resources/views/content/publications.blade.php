@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('title')
    {{__("All Publications")}}
@endsection

@section('content')
    <header id="hero">
        <img class="hero-img-2" srcset="{{ asset('assets/img/hero/hero-4-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-4-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-4-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-4-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-4.webp') }}"
            sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
            src="{{ asset('assets/img/hero/hero-4.webp') }}" alt="" />
        <div class="text-hero-2">
            <div class="">
                <div class="col-lg-12 text-center">
                    <h1>{{__("Publication")}}</h1>
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
                                <div class="row justify-content-center" id="publications">
                                    @foreach ($data as $publication)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card no-border card-artikel">
                                                <img src="{{ asset('storage/assets/publikasi/thumbnail/' . $publication["thumbnail"]) }}"
                                                    class="card-img-top img-thumbnail" alt="...">
                                                <div class="card-body">
                                                    <h3 class="card-title judul-artikel">{{ $publication["title"] }}</h3>
                                                    <p class="penulis-artikel">{{ $publication["author"] }}</p>
                                                    <p class="tgl-artikel">{{ $publication["published_at"] }}</p>
                                                    @foreach ($publication["categories"] as $category)
                                                        @include("partials.category-badge")
                                                    @endforeach
                                                </div>
                                                <a href="{{ route('publication_detail.'.$lang, $publication["slug"]) }}"
                                                    class="stretched-link"></a>
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
    @include("content.loader.publications")
    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
