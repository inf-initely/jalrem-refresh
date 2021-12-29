@extends('layout.app')

@section('content')
<header id="hero">
    <img class="hero-img-2 hero-peta " src="https://jalurrempah.kemdikbud.go.id/wp-content/uploads/2020/09/Peta-indonesia-u-JR.jpg">
    <div class="wrap-hero-text wrap-hero-text-bg d-none d-lg-block" id="wrapHeroText">
        <div class="row">
            <article class="col-md-12">
                <header>
                    <h2 class="sub-judul sub-judul-hero text-end">The Spice Routes’ Points</h2>
                </header>
                <p>
                    The Spice Routes covers various <b>cultural routes</b> from East Asia to Western Europe connected to American, African, and Australian Continents. A civilization trajectory in different forms; straight line, circle, crosswise, and even a network.
                    <span id="dots">...</span><span id="more"><br><br>

                   In Indonesia, the spice trade routes cover many things. It stands not only on one spice producer area but also various points in Indonesia, forming a <b>sustainable civilization trajectory.</b><br><br>

                    TThe Spice Routes program recollects the spice trade routes from one point to another, revives its sundry stories and connects the traces. <br><br>

                    Enlivening the historical narration that commonly puts aside the role of Indonesians in the forming of the Spice Routes.<br><br>

                    The program is determined to revive the historical narrative by revealing the people of Nusantara’s roles in the Spice Routes formation; documenting their roles in the spice trade areas; reconstructing the red thread in one historical construction.</span>
                </p>
                <div class="row">
                    <div class="col text-end">
                        <button class="btn btn-sm btn-outline-secondary" onclick="readMore()" id="btnReadmore">Read more</button>
                    </div>
                </div>
            </article>
        </div>
    </div>
</header>
<main>
    <div id="content">
        <section id="narasi" class="d-block d-lg-none px-3">
            <div class="row">
                <article class="col-md-12">
                    <header>
                        <h2 class="sub-judul sub-judul-hero">The Spice Routes’ Points</h2>
                    </header>
                    <p>
                        The Spice Routes covers various <b>cultural routes</b> from East Asia to Western Europe connected to American, African, and Australian Continents. A civilization trajectory in different forms; straight line, circle, crosswise, and even a network.
                        <span id="dots2" style="display:inline">...</span><span id="more2" style="display:none"><br><br>

                        In Indonesia, the spice trade routes cover many things. It stands not only on one spice producer area but also various points in Indonesia, forming a <b>sustainable civilization trajectory.</b><br><br>

                        The Spice Routes program recollects the spice trade routes from one point to another, revives its sundry stories and connects the traces. <br><br>

                        Enlivening the historical narration that commonly puts aside the role of Indonesians in the forming of the Spice Routes.<br><br>

                        The program is determined to revive the historical narrative by revealing the people of Nusantara’s roles in the Spice Routes formation; documenting their roles in the spice trade areas; reconstructing the red thread in one historical construction.</span>
                    </p>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-outline-secondary" onclick="readMore2()" id="btnReadmore2">Lihat Selengkapnya</button>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <section id="kontenJejak">
            <div class="container">
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
                                            <div class="video media-video" style="height: 170px;" data-video-id="{{ $a->cloud_key }}">
                                                <!--ganti id sesuai id youtube yang akan ditampilkan-->
                                                <div class="video-layer">
                                                    <div class="video-placeholder">
                                                    <!-- ^ div is replaced by the YouTube video -->
                                                    </div>
                                                </div>
                                                <div class="video-preview" style="background: url('https://img.youtube.com/vi/{{ $a->cloud_key }}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
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
                                            <div class="wrap-tag-rempah">
                                                @if( $a->rempahs != null )
                                                @foreach( $a->rempahs as $r )
                                                    @if( $r->jenis_rempah_english )
                                                        <a href="{{ route('rempah_detail', $r->jenis_rempah_english ?? $r->jenis_rempah) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
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
                                        <div class="col-3 mt-3 text-center ">
                                            <img src="assets/img/icon/jalur_1.svg" height="40px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Routes</h3>
                                            <p class="des-card-info">The Spice Routes covers various cultural routes</p>
                                        </div>
                                    </div>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 mt-3 text-center ">
                                            <img src="assets/img/icon/jejak_1.svg" height="32px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Trace</h3>
                                            <p class="des-card-info">The traces display the cultural interactions in the past</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tentangjejak') }}" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 mt-3 text-center ">
                                            <img src="assets/img/icon/masa-depan_1.svg" height="40px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Future</h3>
                                            <p class="des-card-info">A means of reconstruction and revitalization of the nautical cultural routes</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tentangmasadepan') }}" class="stretched-link"></a>
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
    function readMore() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("btnReadmore");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
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
            btnText2.innerHTML = "Read more";
            moreText2.style.display = "none";
        } else {
            dots2.style.display = "none";
            btnText2.innerHTML = "Read less";
            moreText2.style.display = "inline";
        }
    }
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
                                <h3 class="judul-artikel judul-artikel-tentang"><a href="${asset}/${data.data[i].slug}" class="text-decoration-none clr-black">${data.data[i].judul}</a> </h3>
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
