@extends('layout.app')

@section('title')
    {{ $audio->judul_english ?? $audio->judul_indo }} - Jalur Rempah Kemdikbudristek Republik Indonesia
@endsection

@section('content')
<main>
  <div id="content">
    <section id="artikelDanBerita">
      <div class="container">
        <div class="row justify-content-center">
          <article class="col-lg-8">
            <header>
              <h2 class="sub-judul mb-4" id="judulMedia">{{ $audio->judul_english }}</h2>
              <p class="penulis-artikel" id="authorMedia">
                {{ $audio->penulis != 'admin' ? $audio->kontributor_relasi->nama : 'admin' }}
              </p>
              <p class="tgl-artikel mb-4" id="tglMedia">
                {{ \Carbon\Carbon::parse($audio->published_at)->isoFormat('D MMMM Y'); }}
              </p>
            </header>
            <div class="ytdefer video media-video media-video-detail" data-alt="youtube jalur rempah" data-src="{{ $audio->cloud_key }}"></div>
            <article id="txtMedia" class="mt-4">
              {!! $audio->konten_english !!}
            </article>
            @if( $audio->penulis != 'admin' )
                <div id="disclaimer" class="mt-4">
                  <p>Konten ini dibuat oleh kontributor website Jalur Rempah. <br>
                    Laman Kontributor merupakan platform dari website Jalur Rempah yang digagas khusus untuk masyarakat luas untuk mengirimkan konten (berupa tulisan, foto, dan video) dan membagikan pengalamannya tentang Jalur Rempah. Setiap konten dari kontributor adalah tanggung jawab kontributor sepenuhnya.</p>
                </div>
              @endif
            @php
                $konten_name = 'audio';
                $konten = $audio;
            @endphp
            @include('partials.social-share')
          </article>
        </div>
      </div>
    </section>
    <section id="mediaJalurRempah">
      <section class="container" id="artikel">
        <header class="row justify-content-start mb-2">
          <div class="col-md-6">
            <h2 class="sub-judul">Spice Routes Media</h2>
          </div>
        </header>
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row text-center justify-content-center">
              <div class="col mb-1">
                <div class="card no-border card-media">
                  <div class="card-body">
                    <img src="{{ asset('assets/img/icon-publication.png') }}" width="32.5%">
                    <p class="judul-media">Artikel</p>
                    <p class="des-media">

                    </p>
                  </div>
                  <a href="{{ route('articles') }}" class="stretched-link"></a>
                </div>
              </div>
              <div class="col mb-1">
                <div class="card no-border card-media">
                  <div class="card-body">
                    <img src="{{ asset('assets/img/icon-image.png') }}" width="32.5%">
                    <p class="judul-media">Foto</p>
                    <p class="des-media">

                    </p>
                  </div>
                  <a href="{{ route('photos') }}" class="stretched-link"></a>
                </div>
              </div>
              <div class="col mb-1">
                <div class="card no-border card-media">
                  <div class="card-body">
                    <img src="{{ asset('assets/img/icon-video.png') }}" width="32.5%">
                    <p class="judul-media">Video</p>
                    <p class="des-media">

                    </p>
                  </div>
                  <a href="{{ route('videos') }}" class="stretched-link"></a>
                </div>
              </div>
              <div class="col mb-1">
                <div class="card no-border card-media">
                  <div class="card-body">
                    <img src="{{ asset('assets/img/icon-publication.png') }}" width="32.5%">
                    <p class="judul-media">Publikasi</p>
                    <p class="des-media">

                    </p>
                  </div>
                  <a href="{{ route('publications') }}" class="stretched-link"></a>
                </div>
              </div>
              <div class="col d-none d-lg-block d-xl-none mb-1">
                <div class="card no-border card-media">
                  <div class="card-body">
                    <img src="{{ asset('assets/img/icon-sound.png') }}" width="32.5%">
                    <p class="judul-media">Audio</p>
                    <p class="des-media">

                    </p>
                  </div>
                  <a href="{{ route('audios') }}" class="stretched-link"></a>
                </div>
              </div>
              <div class="col-6 col-md-3 mb-1 d-lg-none d-xl-block">
                <div class="card no-border card-media">
                  <div class="card-body">
                    <img src="{{ asset('assets/img/icon-sound.png') }}" width="32.5%">
                    <p class="judul-media">Audio</p>
                    <p class="des-media">

                    </p>
                  </div>
                  <a href="{{ route('audios') }}" class="stretched-link"></a>
                </div>
              </div>
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
<script type="text/javascript" src="{{ asset('assets/js/ytdefer.min.js') }}"></script>
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
  window.addEventListener('load', ytdefer_setup);
</script>
<script>
  $('.menu-toggle').click(function(){
     $(".nav2").toggleClass("mobile-nav");
     $(".nav2").removeClass("temp-pos");
     $(this).toggleClass("is-active");
  });
</script>
@endsection
