@extends('layout.app')

@section('content')
<header id="hero">
    <section class="hero-slider hero-style">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          @if( count($slider) > 0 )
            @foreach( $slider as $s )
            <div class="swiper-slide">
              <div class="slide-inner slide-bg-image" data-background="{{ asset('storage/assets/'. substr($s->getTable(), 0, -1) .'/slider/' . $s->slider_file) }}">
                <div class="layer-masking"></div>
                <div class="container">
                  <div data-swiper-parallax="300" class="slide-title">
                    <h2 class="title">{{ $s->judul_english ?? $s->judul_indo }}</h2>
                  </div>
                  <div data-swiper-parallax="400" class="slide-text">
                    <p class="caption">{!! Str::limit($s->konten_english ?? $s->konten_indo, 160, $end='...') !!}</p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- end slide-inner -->
            </div>
            <!-- end swiper-slide -->
            @endforeach
          @else
            <div class="swiper-slide">
              <div class="slide-inner slide-bg-image" data-background="assets/img/hero/hero-1.jpg">
                <div class="layer-masking"></div>
                <div class="container">
                  <div data-swiper-parallax="300" class="slide-title">
                    <h2 class="title">Jalur Rempah</h2>
                  </div>
                  <div data-swiper-parallax="400" class="slide-text">
                    <p class="caption">Respecting the past through our heritage, enlivening the future for the well-being of all.</p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- end slide-inner -->
            </div>
            <!-- end swiper-slide -->
          @endif
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
                <h2 class="sub-judul">The Route</h2>
              </header>
              <p class="jelajah-des">The Spice Routes covers various cultural routes that gave rise to global civilization & revive the people of Nusantara’s role centuries ago.</p>
              {{-- <a href="{{ route('tentangjalur') }}" class="btn btn-danger btn-jelajah">
                explore more
              </a> --}}
              <a href="#" class="btn btn-danger btn-jelajah">
                explore more
              </a>
            </div>
          </div>
          <div class="row justify-content-center content-jelajahi wrap-div" data-aos="fade-left">
            <div class="col-12 col-md-6 col-lg-6 text-end center-v mb-2 second-div" style="margin-top: 30px;">
              <header>
                <h2 class="sub-judul">The Trace</h2>
              </header>
              <p class="jelajah-des">The traces display the cultural interactions in the past that still exist today, a cultural heritage that has become Indonesia’s collective memory.</p>
              {{-- <a href="{{ route('tentangjejak') }}" class="btn btn-danger btn-jelajah">
                explore more
              </a> --}}
              <a href="#" class="btn btn-danger btn-jelajah">
                explore more
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
                <h2 class="sub-judul">The Future</h2>
              </header>
              <p class="jelajah-des">A means of reconstruction and revitalization of the maritime cultural routes. Re-excavating the potentials for sustainable wealth and prosperity of all.</p>
              {{-- <a href="{{ route('tentangmasadepan') }}" class="btn btn-danger btn-jelajah">
                explore more
              </a> --}}
              <a href="#" class="btn btn-danger btn-jelajah">
                explore more
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
                <h2 class="sub-judul text-center mb-3">The Spice Routes</h2>
              </header>
              <p class="jelajah-des text-center">The cultural assimilation and its connectedness among nations in Indonesia did not just happen. International traders played a significant role in the cultural development that left the traces we can find today. It is due to the spice commodity, coming from various islands in Nusantara that formed the trade traffic in the past, and thus becoming a cultural route.</p>
            </div>
          </div>
        </div>
      </section>
      <section id="kegiatan">
        <div class="container">
          <header class="row justify-content-center mb-2">
            <div class="col-md-6">
              <h2 class="sub-judul">Events</h2>
            </div>
            <div class="col-md-6 center-v text-end d-desktop">
              <a href="{{ route('informasi') }}" class="btn btn-outline-danger">See All Events</a>
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
                      <p class="tgl-kegiatan" id="tglKegiatan" name="tglKegiatan">{{ $k->created_at->isoFormat('D MMMM Y'); }}</p>
                      <h3 class="judul-kegiatan" id="jdlKegiatan" name="jdlKegiatan">{{ $k->judul_english ?? $k->judul_indo }}</h3>
                    </div>
                  </div>
                  <a href="{{ route('event_detail', $k->slug_english ?? $k->slug) }}" class="stretched-link"></a>
                </div>
              </div>
            </div>
            @endforeach
            <div class="col-md-12 text-center d-mobile">
              <a href="{{ route('informasi') }}" class="btn btn-outline-danger">See All Event</a>
            </div>
          </section>
        </div>
      </section>
      <section id="artikelDanBerita">
        <section class="container" id="artikel">
          <header class="row justify-content-center mb-2">
            <div class="col-lg-6">
              <h2 class="sub-judul">News and Article</h2>
            </div>
            <div class="col-md-6 center-v text-end  d-desktop">
              <a href="{{ route('articles') }}" class="btn btn-outline-danger">See All News and Articles</a>
            </div>
          </header>
          <section class="row justify-content-center" data-aos="fade-up">
            @foreach( $artikel as $a )
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card no-border card-artikel">
                <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" class="card-img-top img-thumbnail" alt="...">
                <div class="card-body">
                  <h3 class="card-title judul-artikel">{{ $a->judul_english ?? $a->judul_indo }}</h3>
                  {{-- <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_english ?? $a->konten_indo, 50, $end='...') !!}</p> --}}
                  <p class="penulis-artikel">
                    {{ $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin' }}
                  </p>
                  <p class="tgl-artikel">
                    {{ $a->created_at->isoFormat('D MMMM Y'); }}
                  </p>
                </div>
                <a href="{{ route('article_detail', $a->slug_english ?? $a->slug) }}" class="stretched-link"></a>
              </div>
            </div>
            @endforeach
            <div class="col-md-12 text-center  d-mobile">
              <button type="button" class="btn btn-outline-danger">See All News and Article</button>
            </div>
          </section>
        </section>
        <section class="container" id="media">
          <div class="row">
            <section class="col-md-6 center-v">
              <header>
                <h2 class="sub-judul">Contents</h2>
                <p class="des-sub-judul">Follow various exciting contents about the Spice Routes through the articles, photos, videos, and audio.</p>
                <a href="{{ route('konten') }}" class="btn btn-outline-danger">
                  See All Contents
                </a>
              </header>
            </section>
            <section class="offset-md-1 col-md-5">
              <div class="row">
                <div class="col-md-6">
                  <div class="card no-border card-media card-media-1">
                    <div class="card-body text-center">
                      <img src="assets/img/icon-image.png" width="40%">
                      <p class="judul-media">Photo</p>
                    </div>
                    <a href="{{ route('photos') }}" class="stretched-link"></a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card no-border card-media card-media-2">
                    <div class="card-body text-center">
                      <img src="assets/img/icon-publication.png" width="40%">
                      <p class="judul-media">Publication</p>
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
                <h2 class="sub-judul">Youtube</h2>
              </header>
            </div>
          </div>
          <div class="youtube-video mt-3">
            @foreach( $video as $v )
            <div class="p-2">
              <div class="card no-border card-artikel">
                <div class="video" data-video-id="{{ $v->youtube_key }}">
                  <!--ganti id sesuai id youtube yang akan ditampilkan-->
                  <div class="video-layer">
                    <div class="video-placeholder">
                      <!-- ^ div is replaced by the YouTube video -->
                    </div>
                  </div>
                  <div class="video-preview" style="background: url('https://img.youtube.com/vi/{{ $v->youtube_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                    <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                    <svg viewBox="0 0 74 74">
                      <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                      <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                      <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                    </svg>
                  </div>
                </div>
                <div class="card-body">
                  <p class="card-text">{{ $v->judul_english ?? $v->judul_indo }}</p>
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
                <h2 class="sub-judul">Twitter</h2>
              </header>
            </div>
          </div>
          <div class="twitter-jalrem">
            <div id="twitKolom1" class="p-2">
              <a  class="twitter-timeline" data-height="400" data-chrome="nofooter" href="https://twitter.com/JalurrempahRI?ref_src=twsrc%5Etfw">Tweets by JalurrempahRI</a>
            </div>
            <div id="twitKolom2" class="p-2">
              <a  class="twitter-timeline" data-height="400" data-chrome="nofooter" href="https://twitter.com/JalurrempahRI?ref_src=twsrc%5Etfw">Tweets by JalurrempahRI</a>
            </div>
            <div id="twitKolom3" class="p-2">
              <a  class="twitter-timeline" data-height="400" data-chrome="nofooter" href="https://twitter.com/JalurrempahRI?ref_src=twsrc%5Etfw">Tweets by JalurrempahRI</a>
            </div>
            <div id="twitKolom4" class="p-2">
              <a  class="twitter-timeline" data-height="400" data-chrome="nofooter" href="https://twitter.com/JalurrempahRI?ref_src=twsrc%5Etfw">Tweets by JalurrempahRI</a>
            </div>
            <div id="twitKolom5" class="p-2">
              <a  class="twitter-timeline" data-height="400" data-chrome="nofooter" href="https://twitter.com/JalurrempahRI?ref_src=twsrc%5Etfw">Tweets by JalurrempahRI</a>
            </div>
          </div>
        </section>
        <section class="container" id="instagramJalurRempah">
          <div class="row">
            <div class="col-lg-12">
              <header>
                <h2 class="sub-judul">Instagram</h2>
              </header>
            </div>
          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-md-12">
              <!-- LightWidget WIDGET -->
              <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="https://cdn.lightwidget.com/widgets/d94273e72eb659c5b16e7be54b8c35b7.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
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
                <h2 class="sub-judul">let's contribute</h2>
              </header>
              <p>Let's support the Spice Route activities by contributing to the Spice Route website. We accept content from contributors in the form of <b>articles, essays, coverage, photo stories,</b> to <b>videos</b>
                from the point of view of history, culture, gastronomy, archeology, literature, culinary, film, fashion, art, and anything else related to the Spice Trail that is around you.</p>
            </div>
            <div class="offset-lg-1 col-lg-6 text-center center-v">
              <a href="{{ route('contributor') }}" class="btn btn-lg btn-secondary btn-primary-jarem">Become a Contributor</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection

@section('js')
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
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="assets/js/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script><script>
  window.addEventListener("load", function () {
    setTimeout(otherOperation, 500);
}, false);

  function otherOperation() {
    $("#twitter-widget-3").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(1))").hide();
    $("#twitter-widget-4").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(2))").hide();
    $("#twitter-widget-5").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(3))").hide();
    $("#twitter-widget-6").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(4))").hide();
    $("#twitter-widget-7").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(5))").hide();
    $("#twitter-widget-8").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(6))").hide();
    $("#twitter-widget-9").contents().find(".timeline-Viewport>ol>.timeline-TweetList-tweet:not(:nth-child(7))").hide();

    $("#twitter-widget-3").contents().find(".timeline-LoadMore").hide();
    $("#twitter-widget-4").contents().find(".timeline-LoadMore").hide();
    $("#twitter-widget-5").contents().find(".timeline-LoadMore").hide();
    $("#twitter-widget-6").contents().find(".timeline-LoadMore").hide();
    $("#twitter-widget-7").contents().find(".timeline-LoadMore").hide();
    $("#twitter-widget-8").contents().find(".timeline-LoadMore").hide();
    $("#twitter-widget-9").contents().find(".timeline-LoadMore").hide();

    // alert("YIHAAAA")
  }
</script>
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
AOS.init({ disable: 'mobile' });
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

      $('.twitter-jalrem').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
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
          dots: false,
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
