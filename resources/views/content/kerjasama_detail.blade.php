@extends('layout.app')

@section('content')
<main>
    <div id="content">
      <section id="artikelDanBerita">
        <div class="container">
          <div class="row justify-content-center">
            <article class="col-lg-8">
              <header>
                <h2 class="sub-judul mb-4" id="judulMedia">{{ $kerjasama->judul_indo }}</h2>
                <p class="penulis-artikel" id="authorMedia">
                    {{ $kerjasama->penulis != 'admin' ? $kerjasama->kontributor_relasi->nama : 'admin' }}
                </p>
                <p class="tgl-artikel mb-4" id="tglMedia">
                  {{ $kerjasama->created_at->isoFormat('dddd, D MMMM Y') }}
                </p>
              </header>
              <div class="slide-video">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="video video-artikel" data-video-id="fj2xxbx_OHQ">
                      <!--ganti id sesuai id youtube yang akan ditampilkan-->
                      <div class="video-layer">
                        <div class="video-placeholder">
                          <!-- ^ div is replaced by the YouTube video -->
                        </div>
                      </div>
                      <div class="video-preview video-01">
                        <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                        <svg viewBox="0 0 74 74">
                          <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                          <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                          <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <article id="txtMedia" class="mt-3">
                {!! $kerjasama->konten_indo !!}
              </article>
            </article>
          </div>
        </div>
      </section>
      <section id="mediaJalurRempah">
        <section class="container" id="artikel">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Media Jalur Rempah</h2>
              <p>Berbagai media dan publikasi yang terkait Jalur Rempah Nusantara</p>
            </div>
          </header>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row text-center">
                <div class="col mb-1">
                  <div class="card no-border card-media">
                    <div class="card-body">
                      <img src="{{ asset('assets/img/icon-publication.png') }}" width="32.5%">
                      <p class="judul-media">Artikel</p>
                      <p class="des-media">

                      </p>
                    </div>
                    <a href="list-artikel.html" class="stretched-link"></a>
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
                <div class="col mb-1">
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
@endsection