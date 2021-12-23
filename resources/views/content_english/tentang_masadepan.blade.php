@extends('layout.app')

@section('content')
<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-3.jpg">
    <div class="text-hero-2">
        <div class="">
            <div class="col-lg-12 text-center">
                <h1>The Future</h1>
            </div>
        </div>
    </div>
</header>
<main>
    <div id="content">
        <section id="sejarahRempah">
            <div class="container">
                <div class="row justify-content-center">
                    <article class="col-lg-8">
                        <header>
                            <h2 class="sub-judul">The Future and the Spice Routes</h2>
                        </header>
                        <section id="desTentang">
                            <p>
                                The Spice Routes is forward-looking. The program focuses on increasing the public's awareness to conserve, develop, and use the Spice Routes cultural heritage (tangible and intangible) as an asset to promote the <b>sustainable prosperity</b> of all. <br><br>

                                It is a point of view that sets off from the traces which link to one another and form a cultural ecosystem—a means of <b>reconstruction and revitalization</b> through the sea as a symbol of wealth and prosperity. <br><br>

                                The Spice Routes strives to grow pride upon identities of various regions in Indonesia, strengthening the cultural interaction network among areas and reinforcing the national bond through the <b>nautical cultural routes</b> that had existed thousands of years ago.<br><br>

                                Through this point of view, the Spice Routes reopen regional and global communities' perspectives concerning the role of Indonesia as the <b>global maritime axis</b> in the past, present, and future.
                            </p>
                        </section>
                    </article>
                    <section id="artikelTentang">
                        <div class="row justify-content-center">
                            <div class="col-lg-11 mt-3">
                                <div class="row" id="contents">
                                    @foreach( $artikel as $a )
                                    @if( $a->getTable() == 'videos' )
                                    <div class="col-lg-6 mb-1">
                                        <div class="card no-border no-background">
                                            <div class="card-body row">
                                                <div class="col-5 center-v">
                                                    <div class="video media-video" style="height: 170px;" data-video-id="{{ $a->youtube_key }}">
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
                                                </div>
                                                <div class="col-7 center-v">
                                                    <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi_english ?? '' }}</small></a>
                                                    <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route('video_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english }}</a> </h3>
                                                    <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> -->
                                                    <div class="wrap-tag-rempah">
                                                        @if( $a->rempahs != null )
                                                        @foreach( $a->rempahs as $r )
                                                            @if( $r->jenis_rempah_english )
                                                                <a href="{{ route('rempah_detail', $r->jenis_rempah_english) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
                                                                |
                                                            @endif
                                                        @endforeach
                                                        @endif
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
                                        </div>
                                    </div> 
                                    @elseif( $a->getTable() == 'audio' )
                                    <div class="col-lg-6 mb-1">
                                        <div class="card no-border no-background">
                                            <div class="card-body row">
                                                <div class="col-5 center-v">
                                                    <iframe width="100%" height="150" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/{{ $a->cloud_key }}&color=%231a150d&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
                                                    <div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;"><a href="#" title="" target="_blank" style="color: #cccccc; text-decoration: none;"></a> · <a href="{{ route('audio_detail', $a->slug) }}" title="{{ $a->judul_english }}" style="color: #cccccc; text-decoration: none;">{{ $a->judul_english }}</a></div>
                                                    <main></main>
                                                </div>
                                                <div class="col-7 center-v">
                                                    <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi_english ?? '' }}</small></a>
                                                    <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route('audio_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english }}</a> </h3>
                                                    <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> -->
                                                    <div class="wrap-tag-rempah">
                                                        @if( $a->rempahs != null )
                                                        @foreach( $a->rempahs as $r )
                                                            @if( $r->jenis_rempah_english )
                                                                <a href="{{ route('rempah_detail', $r->jenis_rempah_english) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
                                                                |
                                                            @endif
                                                        @endforeach
                                                        @endif
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
                                        </div>
                                    </div>
                                    @else
                                        <div class="col-lg-6 mb-2">
                                            <div class="card no-border no-background">
                                                <div class="card-body row">
                                                    <div class="col-5 center-v">
                                                        <img class="tentang-thumbnail" src="{{ asset(get_asset_path($a->getTable(), $a->thumbnail)) }}" width="100%">
                                                    </div>
                                                    <div class="col-7 center-v">
                                                        <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi_english ?? '' }}</small></a>
                                                        <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route(generate_route_content($a->getTable()) . '_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english }}</a> </h3>
                                                        <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> -->
                                                        <div class="wrap-tag-rempah">
                                                            @if( $a->rempahs != null )
                                                            @foreach( $a->rempahs as $r )
                                                                @if( $r->jenis_rempah_english )
                                                                    <a href="{{ route('rempah_detail', $r->jenis_rempah_english) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
                                                                    |
                                                                @endif
                                                            @endforeach
                                                            @endif
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
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <div class="loader"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <section id="cardInfo">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="row">
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 mt-3 text-center">
                                            <img src="assets/img/icon/jalur_1.svg" height="40px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Routes</h3>
                                            <p class="des-card-info">The Spice Routes covers various cultural routes</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tentangjalur') }}" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 mt-3 text-center">
                                            <img src="assets/img/icon/jejak_1.svg" height="32px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Traces</h3>
                                            <p class="des-card-info">The traces display the cultural interactions in the past</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tentangjejak') }}" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 mt-3 text-center">
                                            <img src="assets/img/icon/masa-depan_1.svg" height="40px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Future</h3>
                                            <p class="des-card-info">A means of reconstruction and revitalization of the nautical cultural routes</p>
                                        </div>
                                    </div>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
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
    var halaman = 1;
    var mentok = false;
    $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
         if( !mentok ) {
            halaman++;
            loadMoreData(halaman);
         }
      }
   });
   $('.loader').hide();

   function loadMoreData(halaman) {
      $.ajax({
         url: `?page=${halaman}`,
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
         if( data.data.length > 0 ) {
             
         }
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
            
            let content = '';
            let rempahs = '';
            if( data?.data[i]?.rempahs == undefined ) {
                rempahs = `<div></div>`;
            } else {
                rempahs = data?.data[i]?.rempahs?.map(item => {
                    return `<a href="/funfact/${item.jenis_rempah}" class="text-danger text-decoration-none">${item.jenis_rempah}</a>
                                    |`;
                })
            }
            
            if( data.data[i].table == 'audio' ) {
                content = `
                <div class="col-lg-6 mb-1">
                    <div class="card no-border no-background">
                        <div class="card-body row">
                            <div class="col-5 center-v">
                                <div class="video media-video" style="height: 170px;" data-video-id="${data.data[i].cloudkey}">
                                    <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                    <div class="video-layer">
                                        <div class="video-placeholder">
                                            <!-- ^ div is replaced by the YouTube video -->
                                        </div>
                                    </div>
                                    <div class="video-preview" style="background: url('https://img.youtube.com/vi/${data.data[i].cloudkey}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                        <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                        <svg viewBox="0 0 74 74">
                                            <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                                            <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                                            <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 center-v">
                                <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>${data.data[i].nama_lokasi}</small></a>
                                <h3 class="judul-artikel judul-artikel-tentang"><a href="video/${data.data[i].slug}" class="text-decoration-none clr-black">${data.data[i].judul}</a> </h3>
                                <div class="wrap-tag-rempah">
                                    ${rempahs}
                                </div>
                                ${kategori_show}
                            </div>
                        </div>
                    </div>
                </div>
                `
            } else if( data.data[i].table == 'videos' ) {
                content = `
                <div class="col-lg-6 mb-1">
                    <div class="card no-border no-background">
                        <div class="card-body row">
                            <div class="col-5 center-v">
                                <div class="video media-video" style="height: 170px;" data-video-id="${data.data[i].youtubekey}">
                                    <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                    <div class="video-layer">
                                        <div class="video-placeholder">
                                            <!-- ^ div is replaced by the YouTube video -->
                                        </div>
                                    </div>
                                    <div class="video-preview" style="background: url('https://img.youtube.com/vi/${data.data[i].youtubekey}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                                        <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                                        <svg viewBox="0 0 74 74">
                                            <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                                            <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                                            <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 center-v">
                                <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>${data.data[i].nama_lokasi}</small></a>
                                <h3 class="judul-artikel judul-artikel-tentang"><a href="video/${data.data[i].slug}" class="text-decoration-none clr-black">${data.data[i].judul}</a> </h3>
                                <div class="wrap-tag-rempah">
                                    ${rempahs}
                                </div>
                                ${kategori_show}
                            </div>
                        </div>
                    </div>
                </div>
                `
            } else {
                let asset = '';
                switch(data.data[i].table) {
                    case 'artikels':
                        asset = 'artikel';
                        break;
                    case 'fotos':
                        asset = 'foto';
                        break;
                    case 'publikasis':
                        asset = 'publikasi';
                        break;
                    case 'kegiatans':
                        asset = 'kegiatan';
                        break;
                    case 'kerjasamas':
                        asset = 'kerjasama';
                        break;
                    default:
                        asset = '';
                        break;
                }
                content = `
                <div class="col-lg-6 mb-2">
                    <div class="card no-border no-background">
                        <div class="card-body row">
                            <div class="col-5 center-v">
                                <img class="tentang-thumbnail" src="{{ asset('storage/assets/${asset}/thumbnail/${data.data[i].thumbnail}') }}" width="100%">
                            </div>
                            <div class="col-7 center-v">
                                <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>${data.data[i].nama_lokasi}</small></a>
                                <h3 class="judul-artikel judul-artikel-tentang"><a href="video/${data.data[i].slug}" class="text-decoration-none clr-black">${data.data[i].judul}</a> </h3>
                                <div class="wrap-tag-rempah">
                                    ${rempahs}
                                </div>
                                ${kategori_show}
                            </div>
                        </div>
                    </div>
                </div>
                `
            }

            $('#contents').append(content);
         }
         console.log(data);
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
