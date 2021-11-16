@extends('layout.app')

@section('title')
    Semua Audio - Jalur Rempah Kemdikbudristek Republik Indonesia
@endsection

@section('content')
<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-4.jpg">
    <div class="text-hero-2">
      <div class="">
        <div class="col-lg-12 text-center">
          <h1>Audio</h1>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div id="content">
      <section id="sejarahRempah">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <section id="tabLine">
                <div class="row justify-content-center" id="audios">
                  @foreach( $audio as $a )
                  <div class="col-md-12 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                      <div class="ytdefer video media-video" data-alt="youtube jalur rempah" data-src="{{ $a->cloud_key }}"></div>
                      <a class="stretched-link lightbox" href="{{ route('audio_detail', $a->slug) }}"></a>
                      <div class="card-body">
                        <p class="card-text">{{ $a->judul_indo }}</p>
                        @foreach( $a->kategori_show as $ks )
                            @if( $ks->isi == 'Indepth' )
                            <span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>
                            @endif
                        @endforeach
                        @foreach( $a->kategori_show as $ks )
                            @if( $ks->isi == 'Jurnal Artikel' )
                            <span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>
                            @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    <div class="loader"></div>
                </div>
              </section>
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
<script type="text/javascript" src="{{ asset('assets/js/ytdefer.min.js') }}"></script>
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
  window.addEventListener('load', ytdefer_setup);
</script>
<script>
  window.addEventListener('load', ytdefer_setup);
</script>
<script>
  var page = 1
  var mentok = false;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
          if( !mentok ) {
          page++;
          loadMoreData(page);
          }
      }
  });
  $('.loader').hide();
  
  function loadMoreData(page) {
      $.ajax({
          url: '?page=' + page,
          type: 'GET',
          beforeSend: function() {
          $('.loader').show();
          }
      })
      .done(function(data)
      {
          // console.log(data.data[0].profile.photo_url);
          // if(data.html == " "){
          //       // $('.ajax-load').html("No more records found");
          //       return;
          // }
          
        for( let i = 0; i < data.data.length; i++ ) {
          let kategori_show = data?.data[i]?.kategori_show?.map(item => {
                if( item == 'Indepth' ) {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if( item == 'Jurnal Artikel' ) {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).toString().replaceAll(',', ' ')

            if( kategori_show == undefined ) {
                kategori_show = '<div></div>';
            }
            $('#audios').append(`
            <div class="col-md-12 col-lg-4 mb-4">
              <div class="card no-border card-artikel">
                <iframe width="100%" height="190" src="//www.youtube.com/embed/${data.data[i].cloudkey}?rel=0&amp;fs=0&amp;showinfo=0" frameborder="0" allowfullscreen>
                </iframe>
                <a class="stretched-link lightbox" href="/audio/${data.data[i].slug}"></a>
                <div class="card-body">
                  <p class="card-text">${data.data[i].judul}</p>
                  ${kategori_show}
                </div>
              </div>
            </div>
                `)
            }
            if( data.data.length <= 0 ) {
                mentok = true;
            }
            $('.loader').hide();
      })
      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
          alert('server not responding...');
      });
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
