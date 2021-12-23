@extends('layout.app')

@section('title')
    {{ $publikasi->judul_indo }} - Jalur Rempah Kemdikbudristek Republik Indonesia
@endsection

@section('content')
<header id="hero">
    <img class="hero-img-2" src="{{ asset('assets/img/hero/hero-2.webp') }}">
    <div class="text-hero-2">
      <div class="">
        <div class="col-lg-12 text-center">
          <h1>Publikasi</h1>
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
                <h2 class="sub-judul">{{ $publikasi->judul_indo }}</h2>
                <div class="info-penulis">
                  <span class="txt-penulis" class="mr-3" id="penulis" name="penulis">{{ $publikasi->penulis != 'admin' ? $publikasi->kontributor_relasi->nama : 'admin' }}</span> |
                  <span class="txt-penulis" id="tglArtikel" name="tglArtikel">{{ \Carbon\Carbon::parse($publikasi->published_at)->isoFormat('D MMMM Y') }}</span>
                </div>
              </header>
              <article id="isiKonten">
                <img class="mb-3 mt-3" src="{{ asset('storage/assets/publikasi/thumbnail/' . $publikasi->thumbnail) }}" width="100%">
                {!! $publikasi->konten_indo !!}
                {!! $publikasi->iframe !!}
              </article>
              @if( $publikasi->penulis != 'admin' )
              <div id="disclaimer" class="mt-4">
                <p>Konten ini dibuat oleh kontributor website Jalur Rempah. <br>
                  Laman Kontributor merupakan platform dari website Jalur Rempah yang digagas khusus untuk masyarakat luas untuk mengirimkan konten (berupa tulisan, foto, dan video) dan membagikan pengalamannya tentang Jalur Rempah. Setiap konten dari kontributor adalah tanggung jawab kontributor sepenuhnya.</p>
              </div>
               @endif
              @php
                  $konten_name = 'publication';
                  $konten = $publikasi;
              @endphp
              @include('partials.social-share')
            </article>

            <div class="col-lg-4">
              <div class="row mb-4">
                <div class="col-md-12 wrap-aside">
                  <header>
                    <h2 class="sub-judul">Publikasi Populer</h2>
                  </header>
                  <div class="row">
                    @foreach( $publikasiPopuler as $a )
                    <div class="col-12 mb-2">
                      <div class="card no-border no-background">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-5">
                              <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ asset('storage/assets/publikasi/thumbnail/' . $a->thumbnail) }}">
                            </div>
                            <div class="col-7 center-v">
                              <h3 class="judul-berita-aside" id="jdlKegiatan" name="jdlKegiatan">{{ $a->judul_indo }}</h3>
                              <p class="tgl-berita-aside" id="tglKegiatan" name="tglKegiatan">{{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y'); }} </p>
                            </div>
                          </div>
                          <a href="{{ route('publication_detail', $a->slug) }}" class="stretched-link"></a>
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
                    <h2 class="sub-judul">Publikasi Terbaru</h2>
                  </header>
                  <div class="row">
                    @foreach( $publikasiTerbaru as $a )
                    <div class="col-12 mb-2">
                      <div class="card no-border no-background">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-5">
                              <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ asset('storage/assets/publikasi/thumbnail/' . $a->thumbnail) }}">
                            </div>
                            <div class="col-7 center-v">
                              <h3 class="judul-berita-aside" id="jdlKegiatan" name="jdlKegiatan">{{ $a->judul_indo }}</h3>
                              <p class="tgl-berita-aside" id="tglKegiatan" name="tglKegiatan">{{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y'); }}</p>
                            </div>
                          </div>
                          <a href="{{ route('publication_detail', $a->slug) }}" class="stretched-link"></a>
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
            <h2 class="sub-judul aside-judul">Publikasi Terkait</h2>
            <p>Berbagai upaya dilakukan untuk melestarikan jalur rempah, salah satunya dengan melakukan berbagai kegiatan.</p>
          </div>
          <div class="col-md-6 center-v text-end">
          </div>
        </header>
        <section class="row justify-content-center">
          @foreach( $publikasiPopuler as $a )
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card no-border no-background card-body">
              <img src="{{ asset('storage/assets/publikasi/thumbnail/' . $a->thumbnail) }}" class="card-img-top mb-4 img-thumbnail" alt="...">
              <h3 class="card-title judul-artikel">{{ $a->judul_indo }}</h3>
              {{-- <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> --}}
              <p class="penulis-artikel">{{ $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin' }}</p>
              <p class="tgl-artikel">{{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y'); }}</p>
              <a href="{{ route('publication_detail', $a->slug) }}" class="stretched-link"></a>
            </div>
          </div>
          @endforeach
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
