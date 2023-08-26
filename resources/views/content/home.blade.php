@extends('layout.app')

@php
    $lang = App::getLocale();
@endphp

@section('meta_info')
    home
@endsection

@section("title")
    {{__("Home")}}
@endsection

@section('content')
    <header id="hero">
        <section class="hero-slider hero-style">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if (count($slider) > 0)
                        @foreach ($slider as $s)
                            <div class="swiper-slide">
                                <div class="slide-inner slide-bg-image"
                                    data-background="{{ asset('storage/assets/' . substr($s->getTable(), 0, -1) . '/slider/' . $s->slider_file) }}">
                                    <div class="layer-masking"></div>
                                    <div class="container">
                                        <div data-swiper-parallax="300" class="slide-title">
                                            <h2 class="title"><a style="text-decoration: none; color: #fff;"
                                                    href="{{ route(generate_route_content($s->getTable()) . '_detail.'.$lang, $s->{'slug_' . $lang} ?? $s->slug) }}">{{ $s->{'judul_' . $lang} }}</a>
                                            </h2>
                                        </div>
                                        <div data-swiper-parallax="400" class="slide-text">
                                            <p class="caption">{!! Str::limit($s->{'meta_' . $lang}, 160, $end = '...') !!}</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="swiper-slide">
                            <div class="slide-inner slide-bg-image"
                                data-background="{{ asset('assets/img/hero/hero-1.jpg') }}">
                                <div class="layer-masking"></div>
                                <div class="container">
                                    <div data-swiper-parallax="300" class="slide-title">
                                        <h2 class="title">Jalur Rempah</h2>
                                    </div>
                                    <div data-swiper-parallax="400" class="slide-text">
                                        <p class="caption">Penggalian kembali ekosistem bahari yang berdiri dari jalur dan
                                            jejak masa lampau. Suatu sudut pandang dan fondasi dari masa lalu sebagai masa
                                            kini. Rangkaian ingatan kolektif sebagai pengetahuan dalam membangun masa depan.
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
    </header>
    <main>
        <div id="content">
            <section id="jelajah">
                <div class="container">
                    <img class="item-jelajah item-jelajah-1" src="{{ asset('assets/img/item-daun-1.svg') }}" loading="lazy">
                    <img class="item-jelajah item-jelajah-2" src="{{ asset('assets/img/item-daun-2.svg') }}" loading="lazy">
                    <div class="row justify-content-center content-jelajahi" data-aos="fade-right">
                        <div class="col-12 col-md-6 col-lg-4 mb-2">
                            <img class="jelajah-img"
                                srcset="{{ asset('assets/img/jalur-576px.webp') }} 576w, {{ asset('assets/img/jalur-768px.webp') }} 768w, {{ asset('assets/img/jalur-992px.webp') }} 992w, {{ asset('assets/img/jalur-1200px.webp') }} 1200w, {{ asset('assets/img/jalur.webp') }}"
                                sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
                                src="{{ asset('assets/img/jalur.webp') }}" alt="" loading="lazy" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 center-v">
                            <header>
                                <h2 class="sub-judul sub-judul-jelajahi">{{ __('common.the_route') }}</h2>
                            </header>
                            <p class="jelajah-des">{{ __('page_home.desc.route') }}</p>
                            <a href="{{ route('the-route.'.$lang) }}"
                                class="btn btn-danger btn-jelajah">{{ __('Explore More') }}</a>
                        </div>
                    </div>
                    <div class="row justify-content-center content-jelajahi wrap-div text-end" data-aos="fade-left">
                        <div class="col-12 col-md-6 col-lg-6 center-v mb-2 second-div sec-jejak">
                            <header>
                                <h2 class="sub-judul sub-judul-jelajahi">{{ __('common.the_trail') }}</h2>
                            </header>
                            <p class="jelajah-des">{{ __('page_home.desc.trail') }}</p>
                            <a href="{{ route('the-trail.'.$lang) }}"
                                class="btn btn-danger btn-jelajah">{{ __('Explore More') }}</a>

                        </div>
                        <div class="col-12 col-md-6 col-lg-4 first-div mb-2">
                            <img class="jelajah-img"
                                srcset="{{ asset('assets/img/jejak-576px.webp') }} 576w, {{ asset('assets/img/jejak-768px.webp') }} 768w, {{ asset('assets/img/jejak-992px.webp') }} 992w, {{ asset('assets/img/jejak-1200px.webp') }} 1200w, {{ asset('assets/img/jejak.webp') }}"
                                sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
                                src="{{ asset('assets/img/jejak.webp') }}" alt="" loading="lazy" />
                        </div>
                    </div>
                    <div class="row justify-content-center content-jelajahi" data-aos="fade-right">
                        <div class="col-12 col-md-6 col-lg-4 mb-2">
                            <img class="jelajah-img"
                                srcset="{{ asset('assets/img/masa-depan-576px.webp') }} 576w, {{ asset('assets/img/masa-depan-768px.webp') }} 768w, {{ asset('assets/img/masa-depan-992px.webp') }} 992w, {{ asset('assets/img/masa-depan-1200px.webp') }} 1200w, {{ asset('assets/img/masa-depan.webp') }}"
                                sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
                                src="{{ asset('assets/img/masa-depan.webp') }}" alt="" loading="lazy" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 center-v">
                            <header>
                                <h2 class="sub-judul sub-judul-jelajahi">{{ __('common.the_future') }}</h2>
                            </header>
                            <p class="jelajah-des">{{ __('page_home.desc.future') }}</p>
                            <a href="{{ route('the-future.'.$lang) }}"
                                class="btn btn-danger btn-jelajah">{{ __('Explore More') }}</a>
                        </div>
                    </div>
                </div>
            </section>
            <section id="magnetDunia">
                <div class="container">
                    <img class="item-jelajah item-jelajah-3"
                        srcset="{{ asset('assets/img/asset-jelajah-576px.webp') }} 576w, {{ asset('assets/img/asset-jelajah-768px.webp') }} 768w, {{ asset('assets/img/asset-jelajah-992px.webp') }} 992w, {{ asset('assets/img/asset-jelajah-1200px.webp') }} 1200w, {{ asset('assets/img/asset-jelajah.webp') }}lajah.webp') }}"
                        sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
                        src="{{ asset('assets/img/asset-jelajah.webp') }}" alt="" loading="lazy" />
                    <div class="row justify-content-center content-jelajahi" data-aos="fade-left">
                        <div class="col-lg-10 mb-4">
                            <div class="ytdefer video video-magnet-dunia" data-alt="Enter optional img alt text here"
                                data-title="Enter optional img title here" data-src="a7CMQ36ixNw"
                                style="position: relative !important;"></div>
                        </div>
                        <div class=" col-lg-10 center-v">
                            <header>
                                <h2 class="sub-judul text-center mb-3">{{ __('page_home.heading.world_magnet') }}</h2>
                            </header>
                            <p class="jelajah-des text-center">{{ __('page_home.desc.world_magnet') }}</p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="kegiatan">
                <div class="container">
                    <header class="row justify-content-center mb-2">
                        <div class="col-md-6">
                            <h2 class="sub-judul">{{ __('Events') }}</h2>
                        </div>
                        <div class="col-md-6 center-v text-end d-desktop">
                            <a href="{{ route('information.'.$lang) }}"
                                class="btn btn-outline-danger">{{ __('page_home.button.activity') }}</a>
                        </div>
                    </header>
                    <section class="row justify-content-center" data-aos="flip-up">
                        @foreach ($kegiatan as $k)
                            <div class="col-md-12 col-lg-4 mb-4">
                                <div class="card no-border card-kegiatan">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan"
                                                    src="{{ asset('storage/assets/kegiatan/thumbnail/' . $k->thumbnail) }}"
                                                    loading="lazy">
                                            </div>
                                            <div class="col-6 center-v">
                                                <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">
                                                    {{ \Carbon\Carbon::parse($k->published_at)->isoFormat('D MMMM Y') }}
                                                </p>
                                                <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">
                                                    {{ $k->{'judul_' . $lang} }}</h3>
                                            </div>
                                        </div>
                                        <a href="{{ route('event_detail.'.$lang, $k->{'slug_' . $lang} ?? $k->slug) }}"
                                            class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 text-center d-mobile">
                            <a href="{{ route('information.'.$lang) }}"
                                class="btn btn-outline-danger">{{ __('page_home.button.activity') }}</a>
                        </div>
                    </section>
                </div>
            </section>
            <section id="artikelDanBerita">
                <section class="container" id="artikel">
                    <header class="row justify-content-center mb-2">
                        <div class="col-lg-6">
                            <h2 class="sub-judul">{{ __('News and Articles') }}</h2>
                        </div>
                        <div class="col-md-6 center-v text-end  d-desktop">
                            <a href="{{ route('articles.'.$lang) }}"
                                class="btn btn-outline-danger">{{ __('page_home.button.article') }}</a>
                        </div>
                    </header>
                    <section class="row justify-content-center" data-aos="fade-up">
                        @foreach ($artikel as $a)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card no-border card-artikel">
                                    <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}"
                                        class="card-img-top img-thumbnail" alt="..." loading="lazy">
                                    <div class="card-body">
                                        <h3 class="card-title judul-artikel">{{ $a->{'judul_' . $lang} }}</h3>
                                        {{-- <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> --}}
                                        <p class="penulis-artikel">
                                            {{ $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin' }}
                                        </p>
                                        <p class="tgl-artikel">
                                            {{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y') }}
                                        </p>
                                    </div>
                                    <a href="{{ route('article_detail.'.$lang, $a->{'slug_' . $lang} ?? $a->slug) }}"
                                        class="stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 text-center  d-mobile">
                            <button type="button"
                                class="btn btn-outline-danger">{{ __('page_home.button.article') }}</button>
                        </div>
                    </section>
                </section>
                <section class="container" id="media">
                    <div class="row">
                        <section class="col-md-6 center-v">
                            <header>
                                <h2 class="sub-judul">{{ __('Contents') }}</h2>
                                <p class="des-sub-judul">{{ __('page_home.desc.contents') }}</p>
                                <a href="{{ route('contents.'.$lang) }}"
                                    class="btn btn-outline-danger">{{ __('page_home.button.content') }}</a>
                            </header>
                        </section>
                        <section class="offset-md-1 col-md-5">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="card no-border card-media card-media-1">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/img/icon-image.webp') }}" width="40%">
                                            <p class="judul-media">{{ __('Photo') }}</p>
                                        </div>
                                        <a href="{{ route('photos.'.$lang) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="card no-border card-media card-media-2">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/img/icon-publication.webp') }}" width="40%">
                                            <p class="judul-media">{{ __('Publication') }}</p>
                                        </div>
                                        <a href="{{ route('publications.'.$lang) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="card no-border card-media card-media-3">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/img/icon-video.webp') }}" width="40%">
                                            <p class="judul-media">{{ __('Video') }}</p>
                                        </div>
                                        <a href="{{ route('videos.'.$lang) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="card no-border card-media card-media-4">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('assets/img/icon-sound.webp') }}" width="40%">
                                            <p class="judul-media">{{ __('Audio') }}</p>
                                        </div>
                                        <a href="{{ route('audios.'.$lang) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <section id="kontributor" class="no-padding ">
                <div class="wrap-img-kontributor">
                    <img srcset="{{ asset('assets/img/hero/hero-6-576px.webp') }} 576w, {{ asset('assets/img/hero/hero-6-768px.webp') }} 768w, {{ asset('assets/img/hero/hero-6-992px.webp') }} 992w, {{ asset('assets/img/hero/hero-6-1200px.webp') }} 1200w, {{ asset('assets/img/hero/hero-6.webp') }}"
                        sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
                        src="{{ asset('assets/img/hero/hero-6.webp') }}" alt="" loading="lazy" />
                </div>
                <div class="wrap-text-kontributor">
                    <div class="row">
                        <div class="col-lg-5 clr-white">
                            <header>
                                <h2 class="sub-judul">{{ __('page_home.heading.contribute') }}</h2>
                            </header>
                            <p>{!! __('page_home.desc.contribute') !!}</p>
                        </div>
                        <div class="offset-lg-1 col-lg-6 text-center center-v">
                            <a href="{{ route('contributor') }}"
                                class="btn btn-lg btn-secondary btn-primary-jarem">{{ __('page_home.button.contribute') }}</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('js')
    @include("partials.js.bootstrap")
    @include('partials.js.jquery')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/ytdefer.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    @include("partials.js.dynamic-navbar")
    <script>
        $(function() {

            var minimized_elements = $('p.minimize');

            minimized_elements.each(function() {
                var t = $(this).text();
                if (t.length < 90) return;

                $(this).html(
                    t.slice(0, 90) + '<span>...' +
                    '<span style="display:none;">' + t.slice(90, t.length)
                );

            });

        });
    </script>
    <script>
        AOS.init({
            disable: 'mobile'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#selectLanguage').change(function() {
                var language = $("#selectLanguage option:selected").text();
                // console.log(language);
                if (language == "INA") {
                    $("#languageFlag").attr("src", "assets/img/bendera/flag-indonesia-20px.webp");
                } else {
                    $("#languageFlag").attr("src", "assets/img/bendera/flag-english-20px.webp");
                }
            });
        });
    </script>
    <script>
        $(".page-scroll").on('click', function(e) {
            var tujuan = $(this).attr('href');
            var elemenTujuan = $(tujuan);
            // console.log(tujuan);

            $('html,body').animate({
                scrollTop: elemenTujuan.offset().top - 67

            }, 500);
            e.preventDefault();
        })
    </script>
    <script>
        // HERO SLIDER
        var menu = [];
        jQuery('.swiper-slide').each(function(index) {
            menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
        });
        var interleaveOffset = 0.5;
        var swiperOptions = {
            loop: true,
            speed: 1000,
            parallax: true,
            autoplay: {
                delay: 6500,
                disableOnInteraction: false,
            },
            watchSlidesProgress: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            on: {
                progress: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        var slideProgress = swiper.slides[i].progress;
                        var innerOffset = swiper.width * interleaveOffset;
                        var innerTranslate = slideProgress * innerOffset;
                        swiper.slides[i].querySelector(".slide-inner").style.transform =
                            "translate3d(" + innerTranslate + "px, 0, 0)";
                    }
                },

                touchStart: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = "";
                    }
                },

                setTransition: function(speed) {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = speed + "ms";
                        swiper.slides[i].querySelector(".slide-inner").style.transition =
                            speed + "ms";
                    }
                }
            }
        };

        var swiper = new Swiper(".swiper-container", swiperOptions);

        // DATA BACKGROUND IMAGE
        var sliderBgSetting = $(".slide-bg-image");
        sliderBgSetting.each(function(indx) {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).data("background") + ")");
            }
        });
    </script>
    <script>
        window.addEventListener('load', ytdefer_setup);
    </script>
    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
