@extends('layout.app')

@section('name')
    
@endsection

@section('content')
<main>
  <div id="content">
    <section id="artikelDanBerita">
      <div class="container">
        <div class="row justify-content-center">
          <article class="col-lg-8">
            <header>
              <h2 class="sub-judul mb-4" id="judulMedia">{{ $audio->judul_english ?? $audio->judul_indo }}</h2>
              <p class="penulis-artikel" id="authorMedia">
                {{ $audio->penulis != 'admin' ? $audio->kontributor_relasi->nama : 'admin' }}
              </p>
              <p class="tgl-artikel mb-4" id="tglMedia">
                {{ $audio->created_at->isoFormat('dddd, D MMMM Y') }}
              </p>
            </header>
            <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{ $audio->cloud_key }}&color=%231a150d&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
            <div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="https://soundcloud.com/ellamft" title="ellamft" target="_blank" style="color: #cccccc; text-decoration: none;">ellamft</a> · <a href="https://soundcloud.com/ellamft/luruh-isyana-sarasvati-ft-rara-sekar-cover-with-maydina" title="{{ $audio->judul_indo }}" target="_blank" style="color: #cccccc; text-decoration: none;">{{ $audio->judul_indo }}</a></div>
            <main></main>
            <section></section>
            <article id="txtMedia" class="mt-4">
              {!! $audio->judul_english ?? $audio->judul_indo !!}
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
                  <a href="{{ route('articles') }}"" class="stretched-link"></a>
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
                  <a href="{{ route('photos') }}"" class="stretched-link"></a>
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
                  <a href="{{ route('videos') }}"" class="stretched-link"></a>
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
                  <a href="{{ route('publications') }}"" class="stretched-link"></a>
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
@endsection
