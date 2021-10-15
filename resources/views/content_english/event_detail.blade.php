@extends('layout.app')

@section('content')
<main>
    <div id="content">
      <section id="artikelDanBerita">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <header>
                <h2 class="sub-judul mb-4">{{ $kegiatan->judul_english }}</h2>
              </header>
              <img src="{{ asset('storage/assets/kegiatan/thumbnail/' . $kegiatan->thumbnail) }}" width="100%">
              <section id="desTentang">
                {{ $kegiatan->konten_english }}
              </section>
            </div>
          </div>
        </div>
      </section>
      <section id="artikelDanBerita">
        <section class="container" id="artikel">
          <header class="row justify-content-start mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Current activity</h2>
            </div>
          </header>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <div class="row">
                @foreach( $kegiatanSaatIni as $K )
                <div class="col-lg-4 mb-1">
                  <div class="card no-border no-background">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ $k->thumbnail }}">
                        </div>
                        <div class="col-6 center-v">
                          <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ \Carbon\Carbon::parse($k->published_at)->isoFormat('D MMMM Y'); }}</p>
                          <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $k->judul_english }}</h3>
                        </div>
                      </div>
                      <a href="{{ route('event_detail', $k->slug_english ?? $k->slug) }}" class="stretched-link"></a>
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
@endsection
