@extends('layout.app')

@section('content')

<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-4.jpg">
    <div class="text-hero-2">
        <div class="">
            <div class="col-lg-12 text-center">
                <h1>Cari Konten</h1>
            </div>
        </div>
    </div>
</header>
<main>
    <div id="content">
        <section id="sejarahRempah">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach( $artikel as $a )
                        @if( $a->getTable() == 'videos' )
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card no-border card-artikel">
                              <div class="video media-video" data-video-id="{{ $a->youtube_key }}">
                                <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                <div class="video-layer">
                                  <div class="video-placeholder">
                                    <!-- ^ div is replaced by the YouTube video -->
                                  </div>
                                </div>
                                <div class="video-preview" style="background: url('https://img.youtube.com/vi/{{ $a->youtube_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                  <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                  <svg viewBox="0 0 74 74">
                                    <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                                    <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                                    <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                                  </svg>
                                </div>
                              </div>
                              <a class="stretched-link lightbox" href="{{ route('video_detail', $a->slug) }}"></a>
                              <div class="card-body">
                                <p class="card-text">{{ $a->judul_indo }}</p>
                              </div>
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
                        @elseif( $a->getTable() == 'audio' )
                         <div class="col-md-6 col-lg-4 mb-4">
                            <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{ $a->cloud_key }}&color=%231a150d&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
                            <div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="#" title="" target="_blank" style="color: #cccccc; text-decoration: none;"></a> · <a href="{{ route('audio_detail', $a->slug) }}" title="{{ $a->judul_indo }}" style="color: #cccccc; text-decoration: none;">{{ $a->judul_indo }}</a></div>
                            <main></main>
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
                        @else
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card no-border card-artikel">
                                    <img src="{{ asset(get_asset_path($a->getTable(), $a->thumbnail, 'thumbnail')) }}" class="card-img-top img-thumbnail" alt="...">
                                    <div class="card-body">
                                        <h3 class="card-title judul-artikel">{{ $a->judul_indo }}</h3>
                                        {{-- <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> --}}
                                        <p class="penulis-artikel">
                                            {{ $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin' }}
                                        </p>
                                        <p class="tgl-artikel">
                                            {{ \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y'); }}
                                        </p>
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
                                    <a href="{{ route(generate_route_content($a->getTable()) .'_detail', $a->slug) }}" class="stretched-link"></a>
                                </div>
                            </div>
                        @endif
                    
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                {!! $artikel->links() !!}
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
      $('.menu-toggle').click(function(){
         $(".nav2").toggleClass("mobile-nav");
         $(".nav2").removeClass("temp-pos");
         $(this).toggleClass("is-active");
      });
    </script>
@endsection
