@extends('layout.app')

@section('content')
<header id="hero">
    <img class="hero-img-2" src="{{ asset('assets/img/hero/hero-5.jpg') }}">
    <div class="text-hero-2">
      <div class="">
        <div class="col-lg-12 text-center">
          <h1>Funfact</h1>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div id="content">
      <section id="artikelDanBerita" class="full-bg">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9">
              <header class="mb-3">
                <h2 class="sub-judul">{{ $rempah->jenis_rempah_english }}</h2>
              </header>
              <div id="desTentang">
                {{ $rempah->keterangan_english }}
                <section>
                  <ul class="@if(count($artikel_rempah) > 0) timeline @endif">
                    @foreach( $artikel_rempah as $index => $a )
                    <li class="@if(($loop->index+1)%2 == 0) timeline-inverted @endif">
                      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
                      <div class="timeline-panel">
                        <div class="timeline-heading">
                          <img class="img-responsive" src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" />
                        </div>
                        <div class="timeline-body">
                          <div class="card no-border no-background">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <p class="tgl-timeline">{{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y'); }}</p>
                                  <h3 class="judul-timeline">{{ Str::limit($a->judul_english, 50, $end='...') }}</h3>
                                </div>
                              </div>
                              <a href="{{ route('article_detail', $a->slug_english ?? $a->slug) }}" class="stretched-link"></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endforeach
                    <li class="clearfix" style="float: none;"></li>
                  </ul>
                </section>
      <!----------------------------------------------------------->
      {{-- <section id="kisahLainnya" class="full-bg">
        <div class="container">
          <header class="row justify-content-center mb-2">
            <div class="col-md-12">
              <h2 class="sub-judul aside-judul">Jelajahi Kisah Lainnya</h2>
            </div>
          </header>
          <section class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card no-border no-background card-body">
                <img src="assets/img/berita-detail/gambar6.png" class="card-img-top mb-4" alt="...">
                <h3 class="card-title judul-artikel">Cagar Budaya di Pati: Sejarah Akulturasi dan Jejak Perdagangan Rempah</h3>
                <p class="card-text des-artikel minimize">Pati, merupakan sebuah kabupaten di wilayah Jawa Tengah, ia berbatasan dengan Kabupaten JCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Sed porttitor lectus nibh.</p>
                <p class="penulis-artikel">Ahmad Rifaldi</p>
                <p class="tgl-artikel">20 November 2021</p>
                <a href="detail-berita.html" class="stretched-link"></a>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card no-border no-background card-body">
                <img src="assets/img/berita-detail/gambar7.png" class="card-img-top mb-4" alt="...">
                <h3 class="card-title judul-artikel">Cagar Budaya di Pati: Sejarah Akulturasi dan Jejak Perdagangan Rempah</h3>
                <p class="card-text des-artikel minimize">Pati, merupakan sebuah kabupaten di wilayah Jawa Tengah, ia berbatasan dengan Kabupaten JCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Sed porttitor lectus nibh.</p>
                <p class="penulis-artikel">Ahmad Rifaldi</p>
                <p class="tgl-artikel">20 November 2021</p>
                <a href="detail-berita.html" class="stretched-link"></a>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card no-border no-background card-body">
                <img src="assets/img/berita-detail/gambar8.png" class="card-img-top mb-4" alt="...">
                <h3 class="card-title judul-artikel">Cagar Budaya di Pati: Sejarah Akulturasi dan Jejak Perdagangan Rempah</h3>
                <p class="card-text des-artikel minimize">Pati, merupakan sebuah kabupaten di wilayah Jawa Tengah, ia berbatasan dengan Kabupaten JCurabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Sed porttitor lectus nibh.</p>
                <p class="penulis-artikel">Ahmad Rifaldi</p>
                <p class="tgl-artikel">20 November 2021</p>
                <a href="detail-berita.html" class="stretched-link"></a>
              </div>
            </div>
          </section>
        </div>
      </section> --}}
      <section id="rempahLainnya">
        <h2 class="sub-judul">Other Spices</h2>
        <ul class="tags mt-3">
          @foreach( $rempahs as $r )
            @if( $r->jenis_rempah_english )
                <li><a href="{{ route('rempah_detail', $r->jenis_rempah) }}" class="tag">{{ $r->jenis_rempah_english }}</a></li>
            @endif
        @endforeach
        </ul>
      </section>

    </div>
  </main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="http://platform.twitter.com/widgets.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        if ($(window).width() <= 1000) {
            $(".navbar").addClass("bg-nav");
            $(".navbar").removeClass("bg-trans");
        }
        $(".navbar").addClass("bg-trans");
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
                // $(".navbar").removeClass("bg-nav");
            }
        } else {
            $(".navbar").addClass("bg-nav");
            $(".navbar").removeClass("bg-trans");
        }

    }); //missing );
</script>
<script>
    $("#selectLokasi").select2({
        placeholder: "Pilih Lokasi",
        allowClear: true
    });

    $("#selectRempah").select2({
        placeholder: "Pilih Jenis Rempah",
        allowClear: true
    });
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
    function readMore() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("btnReadmore");


        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Lihat Selengkapnya";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Kembali";
            moreText.style.display = "inline";
        }

        if ($("#wrapHeroText").hasClass("min-h-100")) {
            $("#wrapHeroText").removeClass("min-h-100", 1000);
        } else {
            $("#wrapHeroText").addClass("min-h-100", 1000);
        }

    }

    function readMore2(){
        var dots2 = document.getElementById("dots2");
        var moreText2 = document.getElementById("more2");
        var btnText2 = document.getElementById("btnReadmore2");


        if (dots2.style.display === "none") {
            dots2.style.display = "inline";
            btnText2.innerHTML = "Lihat Selengkapnya";
            moreText2.style.display = "none";
        } else {
            dots2.style.display = "none";
            btnText2.innerHTML = "Kembali";
            moreText2.style.display = "inline";
        }
    }

</script>

<script>
  $('.menu-toggle').click(function(){
     $(".nav2").toggleClass("mobile-nav");
     $(".nav2").removeClass("temp-pos");
     $(this).toggleClass("is-active");
  });
</script>
@endsection
