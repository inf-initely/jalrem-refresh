@extends('layout.app')

@section('title')
    All Events - Jalur Rempah Kemdikbudristek Republik Indonesia
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
                    <h1>Events</h1>
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
                                <div class="row justify-content-center" id="events">
                                    @foreach ($kegiatan as $k)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card no-border card-artikel">
                                                <img src="{{ asset('storage/assets/kegiatan/thumbnail/' . $k->thumbnail) }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h3 class="card-title judul-artikel">{{ $k->judul_english }}</h3>
                                                    {{-- <p class="card-text des-artikel minimize">{!! Str::limit($k->konten_english, 50, $end='...') !!}</p> --}}
                                                    <p class="penulis-artikel">
                                                        {{ $k->penulis != 'admin' ? $k->kontributor_relasi->nama : 'admin' }}
                                                    </p>
                                                    <p class="tgl-artikel">
                                                        {{ \Carbon\Carbon::parse($k->published_at)->isoFormat('D MMMM Y') }}
                                                    </p>
                                                    @foreach ($k->kategori_show as $ks)
                                                        @if ($ks->isi == 'Indepth')
                                                            <span
                                                                class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($k->kategori_show as $ks)
                                                        @if ($ks->isi == 'Jurnal Artikel')
                                                            <span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal
                                                                Artikel</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <a href="{{ route('event_detail', $k->slug_english ?? $k->slug) }}"
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            if ($(window).width() <= 1000) {
                $(".navbar").addClass("bg-nav");
                $(".navbar").removeClass("bg-trans");
            }
        });
        $(window).scroll(function() {

            if ($(window).width() >= 1000) {
                var scroll = $(window).scrollTop();
                //>=, not <=
                if (scroll >= 50) {
                    //clearHeader, not clearheader - caps H
                    $(".navbar").addClass("bg-nav");
                    $(".navbar").removeClass("bg-trans");
                } else {
                    $(".navbar").addClass("bg-trans");
                    $(".navbar").removeClass("bg-nav");
                }
            } else {
                $(".navbar").addClass("bg-nav");
                $(".navbar").removeClass("bg-trans");
            }

        }); //missing );
    </script>
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
        var page = 1
        var mentok = false;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                if (!mentok) {
                    page++;
                    loadMoreData(page);
                }
            }
        });
        $('.loader').hide();

        function loadMoreData(page) {
            $.ajax({
                    url: '?page=' + page,
                    type: 'GET',
                    beforeSend: function() {
                        $('.loader').show();
                    }
                })
                .done(function(data) {
                    // console.log(data.data[0].profile.photo_url);
                    // if(data.html == " "){
                    //       // $('.ajax-load').html("No more records found");
                    //       return;
                    // }
                    for (let i = 0; i < data.data.length; i++) {
                        let kategori_show = data?.data[i]?.kategori_show?.map(item => {
                            if (item == 'Indepth') {
                                return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                            } else if (item == 'Jurnal Artikel') {
                                return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                            }
                            return '';
                        }).toString().replaceAll(',', ' ')

                        if (kategori_show == undefined) {
                            kategori_show = '';
                        }

                        $('#events').append(`
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card no-border card-artikel">
              <img src="{{ asset('storage/assets/kegiatan/thumbnail/') }}/${data.data[i].thumbnail}" class="card-img-top" alt="...">
              <div class="card-body">
                <h3 class="card-title judul-artikel">${data.data[i].judul}</h3>
                {{-- <p class="card-text des-artikel minimize">{!! Str::limit($k->konten_indo, 50, $end='...') !!}</p> --}}
                <p class="penulis-artikel">
                  ${data.data[i].penulis}
                </p>
                <p class="tgl-artikel">
                  ${data.data[i].published_at}
                </p>
                ${kategori_show}
              </div>
              <a href="/event_detail/${data.data[i].slug}" class="stretched-link"></a>
            </div>
          </div>
             `)
                    }
                    console.log(data);
                    if (data.data.length <= 0) {
                        mentok = true;
                    }
                    $('.loader').hide();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }
    </script>

    <script>
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
