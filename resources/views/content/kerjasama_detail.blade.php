@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

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
                            <img class="mb-3 mt-3"
                                src="{{ asset('storage/assets/kerjasama/thumbnail/' . $content['thumbnail']) }}"
                                width="100%">
                            <article id="txtMedia" class="mt-3">
                                {!! $content['content'] !!}
                            </article>
                            @if ($content['author_type'] != 'admin')
                                <div id="disclaimer" class="mt-4">
                                    <p>{!! __('wall.author_disclaimer_contributor') !!}</p>
                                </div>
                            @endif
                            @include('partials.social_share')
                        </article>
                    </div>
                </div>
            </section>
            @include('partials.contents_navi_footer')
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
