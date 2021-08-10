@extends('layout.app')

@section('content')
<header id="hero">
    <section class="hero-slider hero-style">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="slide-inner slide-bg-image" data-background="assets/img/hero/hero-1.jpg">
              <div class="container">
                <div data-swiper-parallax="300" class="slide-title">
                  <h2 class="title">Jalur Rempah</h2>
                </div>
                <div data-swiper-parallax="400" class="slide-text">
                  <p class="caption">Penggalian kembali ekosistem bahari yang berdiri dari jalur dan jejak masa lampau. Suatu sudut pandang dan fondasi dari masa lalu sebagai masa kini. Rangkaian ingatan kolektif sebagai pengetahuan dalam membangun masa depan.</p>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <!-- end slide-inner -->
          </div>
          <!-- end swiper-slide -->
          <div class="swiper-slide">
            <div class="slide-inner slide-bg-image" data-background="assets/img/hero/hero-2.jpg">
              <div class="container">
                <div data-swiper-parallax="300" class="slide-title">
                  <h2 class="title">Jalur Rempah</h2>
                </div>
                <div data-swiper-parallax="400" class="slide-text">
                  <p class="caption">Penggalian kembali ekosistem bahari yang berdiri dari jalur dan jejak masa lampau. Suatu sudut pandang dan fondasi dari masa lalu sebagai masa kini. Rangkaian ingatan kolektif sebagai pengetahuan dalam membangun masa depan.</p>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <!-- end slide-inner -->
          <!-- end swiper-slide -->
          <div class="swiper-slide">
            <div class="slide-inner slide-bg-image" data-background="assets/img/hero/hero-3.jpg">
              <div class="container">
                <div data-swiper-parallax="300" class="slide-title">
                  <h2 class="title">Jalur Rempah</h2>
                </div>
                <div data-swiper-parallax="400" class="slide-text">
                  <p class="caption">Penggalian kembali ekosistem bahari yang berdiri dari jalur dan jejak masa lampau. Suatu sudut pandang dan fondasi dari masa lalu sebagai masa kini. Rangkaian ingatan kolektif sebagai pengetahuan dalam membangun masa depan.</p>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <!-- end slide-inner --><img src="">
        </div>
        <!-- end swiper-slide -->
      </div>
      <!-- end swiper-wrapper -->
      <!-- swipper controls -->
      <!-- <div class="swiper-pagination"></div> -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      </div>
    </section>
    <!-- end of hero slider -->
  </header>
  <main>
    <div id="content">
      <section id="jelajah">
        <div class="container">
          <img class="item-jelajah item-jelajah-1" src="assets/img/item-daun-1.svg">
          <img class="item-jelajah item-jelajah-2" src="assets/img/item-daun-2.svg">
          <div class="row justify-content-center content-jelajahi" data-aos="fade-right">
            <div class="col-12 col-md-6 col-lg-4 mb-2">
              <img class="jelajah-img" src="assets/img/jalur.png">
            </div>
            <div class="col-12 col-md-6 col-lg-6 center-v">
              <header>
                <h2 class="sub-judul">Jalur Rempah</h2>
              </header>
              <p class="jelajah-des">Melihat kembali lintasan jalur perdagangan rempah dari satu titik ke titik lainnya, menghidupkan kembali beragam kisahnya, menghubungkan kembali berbagai jejaknya.</p>
              <a href="{{ route('tentangjalur') }}" class="btn btn-danger btn-jelajah">
                lihat selengkapnya
              </a>
            </div>
          </div>
          <div class="row justify-content-center content-jelajahi wrap-div" data-aos="fade-left">
            <div class="col-12 col-md-6 col-lg-6 text-end center-v mb-2 second-div" style="margin-top: 30px;">
              <header>
                <h2 class="sub-judul">Jejak Rempah Nusantara</h2>
              </header>
              <p class="jelajah-des">Menghidupkan kembali jejak globalisasi dari perniagaan rempah masa lalu yang menciptakan hubungan lintas budaya. Menampilkan jejak antar bangsa dan antar suku bangsa sebagai warisan dan pengetahuan hari ini.</p>
              <a href="{{ route('tentangjejak') }}" class="btn btn-danger btn-jelajah">
                lihat selengkapnya
              </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4 first-div mb-2">
              <img class="jelajah-img" src="assets/img/jejak.png">
            </div>
          </div>
          <div class="row justify-content-center content-jelajahi" data-aos="fade-right">
            <div class="col-12 col-md-6 col-lg-4 mb-2">
              <img class="jelajah-img" src="assets/img/masa-depan.png">
            </div>
            <div class="col-12 col-md-6 col-lg-6 center-v">
              <header>
                <h2 class="sub-judul">Masa Depan</h2>
              </header>
              <p class="jelajah-des">Melihat kembali lintasan jalur perdagangan rempah dari satu titik ke titik lainnya, menghidupkan kembali beragam kisahnya, menghubungkan kembali berbagai jejaknya.</p>
              <a href="{{ route('tentangmasadepan') }}" class="btn btn-danger btn-jelajah">
                lihat selengkapnya
              </a>
            </div>
          </div>
        </div>
      </section>
      <section id="magnetDunia">
        <div class="container">
          <img class="item-jelajah item-jelajah-3" src="assets/img/asset-jelajah.png">
          <div class="row justify-content-center content-jelajahi" data-aos="fade-left">
            <div class="col-lg-10 mb-4">
              <div class="video video-magnet-dunia" data-video-id="fj2xxbx_OHQ">
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
            <div class=" col-lg-10 center-v">
              <header>
                <h2 class="sub-judul text-center mb-3">Jalur Rempah Magnet Dunia</h2>
              </header>
              <p class="jelajah-des text-justify">Asimilasi budaya dan keterhubungan antarbangsa di Indonesia tidak terjadi begitu saja. Di masa lampau, kehadiran para pedagang antarbangsa memiliki peranan penting terhadap perkembangan budaya yang masih bisa kita lihat dan rasakan jejaknya. Hal ini disebabkan oleh komoditi rempah yang berasal dari berbagai kepulauan di Nusantara yang terlibat dalam lalu lintas perdagangan di masa lampau, sehingga menjadi salah satu jalur budaya.</p>
            </div>
          </div>
        </div>
      </section>
      <section id="kegiatan">
        <div class="container">
          <header class="row justify-content-center mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Kegiatan</h2>
            </div>
            <div class="col-md-6 center-v text-end d-desktop">
              <a href="{{ route('informasi') }}" class="btn btn-outline-danger">Lihat Semua Kegiatan</a>
            </div>
          </header>
          <section class="row justify-content-center" data-aos="flip-up">
            @foreach( $kegiatan as $k )
            <div class="col-md-12 col-lg-4 mb-4">
              <div class="card no-border card-kegiatan">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan" src="{{ asset('storage/assets/kegiatan/thumbnail/' . $k->thumbnail) }}">
                    </div>
                    <div class="col-6 center-v">
                      <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ $k->created_at->isoFormat('dddd, D MMMM Y'); }}</p>
                      <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $k->judul_indo }}</h3>
                    </div>
                  </div>
                  <a href="{{ route('event_detail') }}" class="stretched-link"></a>
                </div>
              </div>
            </div>
            @endforeach
            <div class="col-md-12 text-center d-mobile">
              <a href="{{ route('informasi') }}" class="btn btn-outline-danger">Lihat Semua Kegiatan</a>
            </div>
          </section>
        </div>
      </section>
      <section id="artikelDanBerita">
        <section class="container" id="artikel">
          <header class="row justify-content-center mb-2">
            <div class="col-lg-6">
              <h2 class="sub-judul">Artikel dan Berita</h2>
            </div>
            <div class="col-md-6 center-v text-end  d-desktop">
              <a href="{{ route('articles') }}" class="btn btn-outline-danger">Lihat Semua Berita</a>
            </div>
          </header>
          <section class="row justify-content-center" data-aos="fade-up">
            @foreach( $artikel as $a )
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card no-border card-artikel">
                <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h3 class="card-title judul-artikel">{{ $a->judul_indo }}</h3>
                  <p class="card-text des-artikel minimize">{!! $a->konten_indo !!}</p>
                  <p class="penulis-artikel">
                    {{ $a->penulis }}
                  </p>
                  <p class="tgl-artikel">
                    {{ $a->created_at->isoFormat('dddd, D MMMM Y'); }}
                  </p>
                </div>
                <a href="{{ route('article_detail', $a->id) }}" class="stretched-link"></a>
              </div>
            </div>
            @endforeach
            <div class="col-md-12 text-center  d-mobile">
              <button type="button" class="btn btn-outline-danger">Lihat Semua Berita</button>
            </div>
          </section>
        </section>
        <section class="container" id="media">
          <div class="row">
            <section class="col-md-6 center-v">
              <header>
                <h2 class="sub-judul">Konten</h2>
                <p class="des-sub-judul">Berbagai upaya dilakukan untuk melestarikan jalur rempah, salah satunya dengan melakukan berbagai kegiatan.</p>
                <p class="des-sub-sub-judul">Di masa lampau, kehadiran para pedagang antarbangsa memiliki peranan penting terhadap perkembangan budaya yang masih bisa kita lihat dan rasakan jejaknya.</p>
                <a href="{{ route('konten') }}" class="btn btn-outline-danger">
                  Lihat Semua Konten
                </a>
              </header>
            </section>
            <section class="offset-md-1 col-md-5">
              <div class="row">
                <div class="col-md-6">
                  <div class="card no-border card-media card-media-1">
                    <div class="card-body text-center">
                      <img src="assets/img/icon-image.png" width="40%">
                      <p class="judul-media">Foto</p>
                    </div>
                    <a href="{{ route('photos') }}" class="stretched-link"></a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card no-border card-media card-media-2">
                    <div class="card-body text-center">
                      <img src="assets/img/icon-publication.png" width="40%">
                      <p class="judul-media">Publikasi</p>
                    </div>
                    <a href="{{ route('publications') }}" class="stretched-link"></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card no-border card-media card-media-3">
                    <div class="card-body text-center">
                      <img src="assets/img/icon-video.png" width="40%">
                      <p class="judul-media">Video</p>
                    </div>
                    <a href="{{ route('videos') }}" class="stretched-link"></a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card no-border card-media card-media-4">
                    <div class="card-body text-center">
                      <img src="assets/img/icon-sound.png" width="40%">
                      <p class="judul-media">Audio</p>
                    </div>
                    <a href="{{ route('audios') }}" class="stretched-link"></a>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </section>
      </section>
      <section id="sosialMedia">
        <section class="container" id="youtubeJalurRempah">
          <div class="row mb-4">
            <div class="col-lg-12">
              <header>
                <h2 class="sub-judul">Youtube Jalur Rempah</h2>
              </header>
            </div>
          </div>
          <div class="youtube-video">
            @foreach( $video as $v )
            <div class="p-2">
              <div class="card no-border card-artikel">
                <div class="video" data-video-id="fj2xxbx_OHQ">
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
                <div class="card-body">
                  <p class="card-text">{{ $v->judul_indo }}</p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </section>
        <section class="container" id="twitterJalurRempah">
          <div class="row mb-4">
            <div class="col-lg-12">
              <header>
                <h2 class="sub-judul">Twitter Jalur Rempah</h2>
              </header>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="tweet" id="1374692986882125826"></div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="tweet" id="1412370237035479040"></div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="tweet" id="1412370234686599172"></div>
            </div>
          </div>
        </section>
        <section class="container" id="instagramJalurRempah">
          <div class="row">
            <div class="col-lg-12">
              <header>
                <h2 class="sub-judul">Instagram Jalur Rempah</h2>
              </header>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4">
              <iframe max-width="100%" height="475" src="https://www.instagram.com/p/CQ-6yXOAlAH/embed" frameborder="0"></iframe>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
              <iframe max-width="100%" height="400" src="https://www.instagram.com/p/CQ8WuZ9h8Ea/embed" frameborder="0"></iframe>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
              <iframe max-width="100%" height="325" src="https://www.instagram.com/p/CQ5xnOBgg-Z/embed" frameborder="0"></iframe>
            </div>
          </div>
        </section>
      </section>
      <section id="kontributor" class="no-padding ">
        <div class="wrap-img-kontributor">
          <img src="assets/img/hero/hero-6.jpg">
        </div>
        <div class="wrap-text-kontributor">
          <div class="row">
            <div class="col-lg-5 clr-white">
              <header>
                <h2 class="sub-judul">Mari Berkontribusi</h2>
              </header>
              <p>Mari mendukung kegiatan Jalur Rempah dengan berkontribusi di website Jalur Rempah. Kami menerima konten dari kontributor berupa <b>artikel, esai, liputan, cerita foto,</b> hingga <b>video</b>
                dari sudut pandang sejarah, budaya, gastronomi, arkeologi, sastra, kuliner, film, fesyen, seni, dan hal-hal lain terkait Jalur Rempah yang ada di sekitarmu.</p>
            </div>
            <div class="offset-lg-1 col-lg-6 text-center center-v">
              <a href="{{ route('register') }}" class="btn btn-lg btn-secondary btn-primary-jarem">Jadi Kontributor</a>
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
<script src="http://platform.twitter.com/widgets.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="assets/js/slick.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.1.0/flickity.pkgd.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
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
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
document.body.appendChild(tag);

// When the YouTube API code loads, it calls this function, so it must be global
// and it must be named exactly onYouTubeIframeAPIReady.
window.onYouTubeIframeAPIReady = function() {
  var videoModules = document.querySelectorAll('.video');
  // for Internet Explorer 11 and below, convert array-like NodeList to an actual Array.
  videoModules = Array.prototype.slice.call(videoModules);
  videoModules.forEach(initializeVideoModule);
}

function initializeVideoModule(videoModule) {
  var player = new YT.Player(videoModule.querySelector('.video-placeholder'), {
    videoId: videoModule.dataset.videoId,
    events: {
      onStateChange: function(event) {
        var isEnded = event.data === YT.PlayerState.ENDED;
        // 'playing' css class controls fading the video and preivew images in/out.
        // Internet Explorer 11 and below do not support a second argument to `toggle`
        // videoModule.classList.toggle('playing', !isEnded);
        videoModule.classList[isEnded ? 'remove' : 'add']('playing');
        // if the video is done playing, remove it and re-initialize
        if (isEnded) {
          player.destroy();
          videoModule.querySelector('.video-layer').innerHTML = (
            '<div class="video-placeholder"></div>'
          );
          initializeVideoModule(videoModule);
        }
      }
    }
  });
}
</script>
<script>
var tweets = $(".tweet");

$(tweets).each(function(t, tweet) {

  var id = $(this).attr('id');

  twttr.widgets.createTweet(
    id, tweet, {
      conversation: 'none', // or all
      cards: 'hidden', // or visible
      linkColor: '#cc0000', // default is blue
      theme: 'light' // or dark
    });

});
</script>
<script>
AOS.init();
</script>
<script>
$(document).ready(function() {
  $('#selectLanguage').change(function() {
    var language = $("#selectLanguage option:selected").text();
    // console.log(language);
    if (language == "INA") {
      $("#languageFlag").attr("src", "assets/img/bendera/flag-indonesia.png");
    } else {
      $("#languageFlag").attr("src", "assets/img/bendera/flag-english.png");
    }
  });
});
</script>
<script>
$(document).ready(function() {
  $('.youtube-video').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 2,
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          arrows: false
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
});
</script>
<script>
var options = {
  autoPlay: 7000,
  pauseAutoPlayOnHover: false,
  accessibility: true,
  prevNextButtons: true,
  pageDots: true,
  setGallerySize: false,
  arrowShape: {
    x0: 10,
    x1: 60,
    y1: 50,
    x2: 60,
    y2: 45,
    x3: 15
  }
};

var $carousel = $('[data-carousel]').flickity(options);
var $slideContent = $('.slide-content');
var flkty = $carousel.data('flickity');
var selectedSlide = flkty.selectedElement;

flkty.on('settle', function(index) {
  selectedSlide = flkty.selectedElement;
});

flkty.on('change', function(index) {
  $slideContent.eq(index).removeClass('mask');

  setTimeout(function() {
    $slideContent.addClass('mask');
  }, 500);
});

flkty.on('dragStart', function(event) {
  var index = 0;
  selectedSlide = flkty.selectedElement;

  if (event.layerX > 0) { // direction right
    index = $(selectedSlide).index() + 1;
  } else { // direction left
    index = $(selectedSlide).index() - 1;
  }

  $slideContent.eq(index).removeClass('mask');
});

setTimeout(function() {
  $slideContent.addClass('mask');
}, 500);
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
@endsection
