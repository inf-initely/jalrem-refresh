@extends('layout.app')

@section('title')
    {{ $kegiatan->judul_indo }} - Jalur Rempah Kemdikbudristek Republik Indonesia
@endsection

@section('content')
<main>
    <div id="content">
      <section id="artikelDanBerita">
        <div class="container">
          <div class="row justify-content-center">
            <article class="col-lg-8">
              <header>
                <h2 class="sub-judul mb-4">{{ $kegiatan->judul_indo }}</h2>
                <div class="info-penulis">
                  <span class="txt-penulis" class="mr-3" id="penulis" name="penulis">{{ $kegiatan->penulis != 'admin' ? $kegiatan->kontributor_relasi->nama : 'admin' }}</span> |
                  <span class="txt-penulis" id="tglArtikel" name="tglArtikel">{{ \Carbon\Carbon::parse($kegiatan->published_at)->isoFormat('D MMMM Y'); }}</span>
                </div>
              </header>
              <img src="{{ asset('storage/assets/kegiatan/thumbnail/' . $kegiatan->thumbnail) }}" width="100%">
              <article id="isiKonten">
                {!! $kegiatan->konten_indo !!}
              </article>
              @if( $kegiatan->penulis != 'admin' )
                <div id="disclaimer" class="mt-4">
                  <p>Konten ini dibuat oleh kontributor website Jalur Rempah. <br>
                    Laman Kontributor merupakan platform dari website Jalur Rempah yang digagas khusus untuk masyarakat luas untuk mengirimkan konten (berupa tulisan, foto, dan video) dan membagikan pengalamannya tentang Jalur Rempah. Setiap konten dari kontributor adalah tanggung jawab kontributor sepenuhnya.</p>
                </div>
              @endif
              @php
                  $konten_name = 'event';
                  $konten = $kegiatan;
              @endphp
              @include('partials.social-share')
            </article>
          </div>
        </div>
      </section>
      <section id="artikelDanBerita">
        <section class="container" id="artikel">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Kegiatan Saat Ini</h2>

            </div>
          </header>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row">
                @foreach( $kegiatanSaatIni as $k )
                <div class="col-lg-4 mb-1">
                  <div class="card no-border no-background">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ asset('storage/assets/kegiatan/thumbnail/' . $k->thumbnail) }}">
                        </div>
                        <div class="col-6 center-v">
                          <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ $k->created_at->isoFormat('D MMMM Y'); }}</p>
                          <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $k->judul_indo }}</h3>
                        </div>
                      </div>
                      <a href="{{ route('event_detail', $k->slug) }}" class="stretched-link"></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="http://platform.twitter.com/widgets.js"></script>
    <script>
    $(document).ready(function() {
    if ($(window).width() <= 1000) {
        $(".navbar").addClass("bg-nav-baru");
        $(".navbar").removeClass("bg-trans");
    }
    });
    $(window).scroll(function() {

    if ($(window).width() >= 1000) {
        var scroll = $(window).scrollTop();
        //>=, not <=
        if (scroll >= 50) {
        //clearHeader, not clearheader - caps H
        $(".navbar").addClass("bg-nav-baru");
        $(".navbar").removeClass("bg-trans");
        } else {
        $(".navbar").addClass("bg-trans");
        $(".navbar").removeClass("bg-nav-baru");
        }
    } else {
        $(".navbar").addClass("bg-nav-baru");
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
$(document).ready(function() {
      $("iframe").attr("allowfullscreen", "allowfullscreen");
    });
    </script>
    <script>
      $('.menu-toggle').click(function(){
         $(".nav2").toggleClass("mobile-nav");
         $(".nav2").removeClass("temp-pos");
         $(this).toggleClass("is-active");
      });
    </script>
@endsection
