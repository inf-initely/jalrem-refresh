@extends('layout.app')

@section('content')
<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-5.jpg">
    <div class="text-hero-2">
      <div class="">
        <div class="col-lg-12 text-center">
          <h1>Informasi Jalur Rempah</h1>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div id="content">
      <section id="artikelDanBerita">
        <div class="container" id="artikel">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Kegiatan Saat Ini</h2>
            </div>
            <div class="col-md-6 center-v text-end">
              <a href="{{ route('events') }}" class="btn btn-outline-danger">Lihat Semua</a>
            </div>
          </header>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row">
                @foreach( $kegiatan_saat_ini as $k )
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
        </div>
      </section>
      <section id="kegiatanSebelumnya">
        <div class="container">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Kegiatan Sebelumnya</h2>
            </div>
            <div class="col-md-6 center-v text-end">
              <a href="{{ route('events') }}" class="btn btn-outline-danger">Lihat Semua</a>
            </div>
          </header>
          <!--<div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row">
                @foreach( $kegiatan_sebelumnya as $k )
                <div class="col-lg-4 mb-1">
                  <div class="card no-border no-background">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ asset('storage/assets/kegiatan/thumbnail' . $k->thumbnail) }}">
                        </div>
                        <div class="col-6 center-v">
                          <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ $k->created_at->isoFormat('D MMMM Y'); }}</p>
                          <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $k->judul_indo }}</h3>
                        </div>
                      </div>
                      <a href="detail-kegiatan.html" class="stretched-link"></a>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div> -->
          <div class="kegiatan-sebelumnya">
            @foreach( $kegiatan_sebelumnya as $k )
            <div>
              <div class="card no-border card-kegiatan">
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
      <section id="kerjasama">
        <div class="container">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Kerja Sama</h2>
            </div>
            <div class="col-md-6 center-v text-end">
              <a href="{{ route('kerjasama') }}" class="btn btn-outline-danger">Lihat Semua</a>
            </div>
          </header>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row">
                @foreach( $kerjasama as $k )
                <div class="col-lg-4 mb-1">
                  <div class="card no-border card-artikel">
                    <img src="{{ asset('storage/assets/kerjasama/thumbnail/' . $k->thumbnail) }}" class="card-img-top img-thumbnail" alt="...">
                    <div class="card-body">
                      <h3 class="card-title judul-artikel">{{ $k->judul_indo }}</h3>
                      {{-- <p class="card-text des-artikel minimize">{{ $k->konten_indo }}</p> --}}
                      <p class="penulis-artikel">
                        {{-- {{ $k->penulis }} --}}
                      </p>
                      <p class="tgl-artikel">
                        {{ $k->created_at->isoFormat('D MMMM Y'); }}
                      </p>
                    </div>
                    <a href="{{ route('kerjasama_detail', $k->slug) }}" class="stretched-link"></a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
      <!----------------------------------------------------------->
      <section id="cardInfo">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="row">
                <div class="col-lg-4 mb-2">
                  <div class="card no-border card-media">
                    <div class="card-body row">
                      <div class="col-3 mt-3 text-center">
                        <img src="assets/img/icon/jalur_1.svg" height="40px">
                      </div>
                      <div class="col-9 ">
                        <h3 class="judul-card-info">Jalur</h3>
                          <p class="des-card-info-id">Jalur Rempah mencakup berbagai lintasan jalur budaya</p>
                      </div>
                    </div>
                    <a href="{{ route('tentangjalur') }}" class="stretched-link"></a>
                  </div>
                </div>
                <div class="col-lg-4 mb-2">
                  <div class="card no-border card-media">
                    <div class="card-body row">
                      <div class="col-3 mt-3 text-center">
                        <img src="assets/img/icon/jejak_1.svg" height="32px">
                      </div>
                      <div class="col-9 ">
                        <h3 class="judul-card-info">Jejak</h3>
                        <p class="des-card-info-id">Jejak memperlihatkan interaksi budaya pada masa lampau</p>
                      </div>
                    </div>
                    <a href="{{ route('tentangjejak') }}" class="stretched-link"></a>
                  </div>
                </div>
                <div class="col-lg-4 mb-2">
                  <div class="card no-border card-media">
                    <div class="card-body row">
                      <div class="col-3 mt-3 text-center">
                        <img src="assets/img/icon/masa-depan_1.svg" height="40px">
                      </div>
                      <div class="col-9 ">
                        <h3 class="judul-card-info">Masa Depan</h3>
                        <p class="des-card-info-id">Sebuah upaya rekontruksi dan revitalisasi jalur budaya bahari</p>
                      </div>
                    </div>
                    <a href="{{ route('tentangmasadepan') }}" class="stretched-link"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/slick.min.js"></script>
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
$('.kegiatan-sebelumnya').slick({
  dots: true,
  infinite: true,
  speed: 1000,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true,
        arrows: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
</script>
@endsection
