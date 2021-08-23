@extends('layout.app')

@section('content')
<main>
    <div id="content" class="full-bg">
      <section id="sliderArtikel">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <header class="mb-2">
                <h2 class="sub-judul text-center">Terbaru</h2>
              </header>
              <div class="feature">
                @foreach( $artikelSlider as $a )
                <div>
                  <div class="card no-border card-artikel no-background">
                    <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" class="card-img-top img-thumbnail-slider" alt="...">
                    <div class="card-body">
                      <h3 class="card-title judul-artikel">{{ $a->judul_indo }}</h3>
                    </div>
                    <a href="{{ route('article_detail', $a->slug) }}" class="stretched-link"></a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
       {{-- <section id="secBerita" class="d-none">
        <div class="container">
          <header class="row justify-content-center">
            <div class="col-md-12 text-center">
              <h2 class="sub-judul aside-judul">Berita</h2>

            </div>
            <div class="col-md-6 center-v text-end">
            </div>
          </header>
          <section class="row justify-content-center">
            @foreach( $artikel as $a )
            <div class="col-md-6 col-lg-4 mb-4">
              <div class="card no-border no-background card-body">
                <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" class="card-img-top mb-4 img-thumbnail" alt="...">
                <h3 class="card-title judul-artikel">{{ $a->judul_indo }}</h3>
                <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p>
                <p class="penulis-artikel">{{ $a->penulis }}</p>
                <p class="tgl-artikel">{{ $a->created_at->isoFormat('D MMMM Y'); }}</p>
                <a href="{{ route('article_detail', $a->slug) }}" class="stretched-link"></a>
              </div>
            </div>
            @endforeach
            {{ $artikel->links('vendor.pagination.custom') }}
          </section>
        </div>
      </section> --}}
      <section id="secMedia">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <header class="text-center">
                <h2 class="sub-judul">Konten Jalur Rempah</h2>
              </header>
              <section id="tabLine">
                <ul class="nav nav-pills mb-3 nav-tabline justify-content-center" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-artikel-tab" data-bs-toggle="pill" data-bs-target="#tab-artikel" type="button" role="tab" aria-controls="tab-artikel" aria-selected="true">Artikel</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-foto-tab" data-bs-toggle="pill" data-bs-target="#tab-foto" type="button" role="tab" aria-controls="tab-foto" aria-selected="false">Foto</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-video-tab" data-bs-toggle="pill" data-bs-target="#tab-video" type="button" role="tab" aria-controls="tab-video" aria-selected="false">Video</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-publikasi-tab" data-bs-toggle="pill" data-bs-target="#tab-publikasi" type="button" role="tab" aria-controls="tab-publikasi" aria-selected="false">Publikasi</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-audio-tab" data-bs-toggle="pill" data-bs-target="#tab-audio" type="button" role="tab" aria-controls="tab-audio" aria-selected="false">Audio</button>
                  </li>
                </ul>
                <div class="tab-content mt-5" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="tab-artikel" role="tabpanel" aria-labelledby="tab-artikel-tab">
                    <div class="row justify-content-center">
                      @foreach( $artikel as $a )
                      <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card no-border card-artikel">
                          <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" class="card-img-top img-thumbnail" alt="...">
                          <div class="card-body">
                            <h3 class="card-title judul-artikel">{{ $a->judul_indo }}</h3>
                            {{-- <p class="card-text des-artikel minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> --}}
                            <p class="penulis-artikel">
                              {{ $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin' }}
                            </p>
                            <p class="tgl-artikel">
                              {{ $a->created_at->isoFormat('D MMMM Y'); }}
                            </p>
                          </div>
                          <a href="{{ route('article_detail', $a->slug) }}" class="stretched-link"></a>
                        </div>
                      </div>
                      @endforeach
                      <div class="d-flex justify-content-center">
                        <a href="{{ route('articles') }}" class="btn btn-danger mr-4" style="margin-right:1rem">
                          Lihat Semua
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-foto" role="tabpanel" aria-labelledby="tab-foto-tab">
                    <div class="row justify-content-center">
                      @foreach( $foto as $f )
                      <div class="col-lg-4 mb-4">
                        <div class="img-bg-wrap">
                          <img src="{{ asset('storage/assets/foto/thumbnail/' . $f->thumbnail) }}">
                          <div class="text-img">
                            <p class="judul-img">{{ $f->judul_indo }}</p>
                            <p class="author-img">{{ $f->penulis != 'admin' ? $f->kontributor_relasi->nama : 'admin' }}</p>
                            <p class="tgl-img">{{ $f->created_at->isoFormat('D MMMM Y'); }}</p>
                          </div>
                          <a class="stretched-link lightbox" href="{{ route('photo_detail', $f->slug) }}"></a>
                        </div>
                      </div>
                      @endforeach
                      <div class="d-flex justify-content-center">
                        <a href="{{ route('photos') }}" class="btn btn-danger mr-4" style="margin-right:1rem">
                          Lihat Semua
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-video" role="tabpanel" aria-labelledby="tab-video-tab">
                    <div class="row justify-content-center">
                      @foreach( $video as $v ) 
                      <div class="col-md-12 col-lg-4 mb-4">
                        <div class="card no-border card-artikel">
                          <div class="video media-video" data-video-id="{{ $v->youtube_key }}">
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
                          <a class="stretched-link lightbox" href="{{ route('video_detail', $v->slug) }}"></a>
                          <div class="card-body">
                            <p class="card-text">{{ $v->judul_indo }}</p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      <div class="d-flex justify-content-center">
                        <a href="{{ route('videos') }}" class="btn btn-danger mr-4" style="margin-right:1rem">
                          Lihat Semua
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-publikasi" role="tabpanel" aria-labelledby="tab-publikasi-tab">
                    <div class="row justify-content-center">
                      @foreach( $publikasi as $p )
                      <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card no-border card-artikel">
                          <img src="{{ asset('storage/assets/publikasi/thumbnail/' . $p->thumbnail) }}" class="card-img-top img-thumbnail" alt="...">
                          <div class="card-body">
                            <h3 class="card-title judul-artikel">{{ $p->judul_indo }}</h3>
                            {{-- <p class="card-text des-artikel minimize">{!! Str::limit($p->konten_indo, 50, $end='...') !!}</p> --}}
                            <p class="penulis-artikel">
                              {{ $p->penulis != 'admin' ? $p->kontributor_relasi->nama : 'admin' }}
                            </p>
                            <p class="tgl-artikel">
                              {{ $p->created_at->isoFormat('D MMMM Y'); }}
                            </p>
                          </div>
                          <a href="{{ route('publication_detail', $p->slug) }}" class="stretched-link"></a>
                        </div>
                      </div>
                      @endforeach
                      <div class="d-flex justify-content-center">
                        <a href="{{ route('publications') }}" class="btn btn-danger mr-4" style="margin-right:1rem">
                          Lihat Semua
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-audio" role="tabpanel" aria-labelledby="tab-audio-tab">
                    <div class="row justify-content-center">
                      @foreach( $audio as $a )
                      <div class="col-md-6 col-lg-4 mb-4">
                        <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{ $a->cloud_key }}&color=%231a150d&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
                        <div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="#" title="ellamft" target="_blank" style="color: #cccccc; text-decoration: none;"></a> · <a href="#" title="{{ $a->judul_indo }}" target="_blank" style="color: #cccccc; text-decoration: none;">{{ $a->judul_indo }}</a></div>
                        <main></main>
                      </div>
                      @endforeach
                      <div class="d-flex justify-content-center">
                        <a href="{{ route('audios') }}" class="btn btn-danger mr-4" style="margin-right:1rem">
                          Lihat Semua
                        </a>
                      </div>
                    </div>
                  </div>
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
<script type="text/javascript" src="{{ asset('assets/js/slick.min.js') }}"></script>
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
      $('.feature').slick({
        centerMode: true,
        centerPadding: '300px',
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 9000,
        responsive: [{
            breakpoint: 1000,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '40px',
              slidesToShow: 1
            }
          }
        ]
      });
    });
    </script>
@endsection
