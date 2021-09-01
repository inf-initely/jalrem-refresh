@extends('layout.app')

@section('content')
<header id="hero">
    <div id="map"></div>
    <div class="wrap-hero-text wrap-hero-text-bg d-none d-lg-block" id="wrapHeroText">
        <div class="row">
            <article class="col-md-12 text-end">
                <header>
                    <h2 class="sub-judul sub-judul-hero">The Trace of The Spice Routes</h2>
                </header>
                <p>
                    The Spice Routes is an <b>ancient, complex, and vast civilization that affected the global civilization</b>. Its traces display cultural interactions in the past. <span id="dots">...</span><span id="more"><br><br>
                   The people of Nusantara’s openness and cultural relations gave rise to multicultural and multiethnic heritage in different mediums. The cultural ties between people left some <b>legacies and a series of traces:</b> the story of the origin, songs, music, dances, traditional technology, building architecture, fashion, culinary, potions, letters, languages, and beliefs. It is a cultural heritage that has become Indonesia’s collective memory as proof and traces of the Spice Routes. </span>
                </p>
                <button class="btn btn-sm btn-outline-secondary" onclick="readMore()" id="btnReadmore">Read more</button>
            </article>
        </div>
    </div>
    <div class="text-hero-2 input-hero">
        <div class="row justify-content-center">
            <div class="col-11 col-md-10 col-lg-12">
                <div class="mb-3 row wrap-select">
                    <div class="col-lg-5 mb-3">
                        <select id="selectLokasiRempah" class="form-select" aria-label="Default select example">
                            <option>Pilih Kategori</option>
                            <option {{ Request::get('wilayah') ? 'selected' : '' }} value="wilayah">Wilayah</option>
                            <option {{ Request::get('rempah') ? 'selected' : '' }} value="rempah">Jenis Rempah</option>
                        </select>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <select id="lokasiRempah" class="form-select" aria-label="Default select example">
                            @foreach( $value_type as $v )
                                <option {{ Request::get('rempah') == $v->id || Request::get('wilayah') == $v->id ? 'selected' : '' }} value="{{ $v->id }}">{{ $v->getTable() == 'rempahs' ? $v->jenis_rempah : $v->nama_lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 wrap-btn-select">
                        <button id="btnSelect" class="btn btn-danger btn-select telusuri"">Telusuri</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div id="content">
        <section id="narasi" class="d-block d-lg-none px-3">
            <div class="row">
                <article class="col-md-12">
                    <header>
                        <h2 class="sub-judul sub-judul-hero ">Jejak dan Jalur Rempah</h2>
                    </header>
                    <p>JJalur Rempah merupakan suatu <b> peradaban yang sangat tua, kompleks, luas, dan memengaruhi peradaban global.</b> Jejaknya memperlihatkan interaksi budaya pada masa lampau.<span id="dots2" style="display:inline">...</span><span id="more2" style="display:none"><br><br>
                    Dari keterbukaan masyarakat Nusantara dan hubungan budaya yang terjalin, lahir beragam warisan budaya multikultural dan multietnis ke berbagai medium. Hubungan budaya antarmanusia ini meninggalkan <b>warisan dan serangkaian jejak yang masih hidup hingga hari ini</b>: kisah asal usul, nyanyian, musik, tarian, teknologi tradisional, arsitektur bangunan, fesyen, kuliner, ramuan, aksara, bahasa, hingga kepercayaan. Sebuah peninggalan nilai budaya yang menjadi memori kolektif bangsa sebagai bukti dan jejak dari Jalur Rempah.</span></p>
                    <button class="btn btn-sm btn-outline-secondary" onclick="readMore2()" id="btnReadmore2">Lihat Selengkapnya</button>
                </article>
            </div>
        </section>
        <section id="kontenJejak">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="row">
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
                                            <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi ?? '' }}</small></a>
                                            <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route('video_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english }}</a> </h3>
                                            <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> -->
                                            <div class="wrap-tag-rempah">
                                                @if( $a->rempahs != null )
                                                @foreach( $a->rempahs as $r )
                                                    @if( $r->jenis_rempah_english )
                                                        <a href="{{ route('rempah_detail', $r->id) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
                                                        |
                                                    @endif
                                                @endforeach
                                                @endif
                                            </div>
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
                                            <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi ?? '' }}</small></a>
                                            <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route('audio_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english }}</a> </h3>
                                            <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> -->
                                            <div class="wrap-tag-rempah">
                                                @if( $a->rempahs != null )
                                                @foreach( $a->rempahs as $r )
                                                    @if( $r->jenis_rempah_english )
                                                        <a href="{{ route('rempah_detail', $r->id) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
                                                        |
                                                    @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="col-lg-6 mb-1">
                                    <div class="card no-border no-background">
                                        <div class="card-body row">
                                            <div class="col-5 center-v">
                                                <img src="{{ asset(get_asset_path($a->getTable(), $a->thumbnail)) }}" width="100%">
                                            </div>
                                            <div class="col-7 center-v">
                                                <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi ?? '' }}</small></a>
                                                <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route(generate_route_content($a->getTable()) . '_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english }}</a> </h3>
                                                <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 50, $end='...') !!}</p> -->
                                                <div class="wrap-tag-rempah">
                                                    @if( $a->rempahs != null )
                                                    @foreach( $a->rempahs as $r )
                                                        @if( $r->jenis_rempah_english )
                                                            <a href="{{ route('rempah_detail', $r->id) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah_english }}</a>
                                                            |
                                                        @endif
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                            <div class="d-flex justify-content-center mt-2">
                                {!! $artikel->links() !!}
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
                                        <div class="col-3 mt-3 text-center">
                                            <img src="assets/img/icon/jalur_1.svg" height="40px">
                                        </div>
                                        <div class="col-9">
                                            <h3 class="judul-card-info">The Route</h3>
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
                                            <h3 class="judul-card-info">The Trace</h3>
                                            <p class="des-card-info">The traces display the cultural interactions in the past</p>
                                        </div>
                                    </div>
                                    <a href="#" class="stretched-link"></a>
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
                                            <p class="des-card-info">A means of reconstruction and revitalization of the maritime</p>
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
<!-- <script src="http://platform.twitter.com/widgets.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDH9juhlGHJLtBCZMmO0Q54DwryFcWNs40&callback=initMap&libraries=&v=weekly" async></script>
<script>
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: { lat: -1.500000, lng: 127.750000 },
        mapId: 'ceda280a7ce6c183',
      });
      // Create an array of alphabetical characters used to label the markers.
      const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      // Add some markers to the map.
      // Note: The code uses the JavaScript Array.prototype.map() method to
      // create an array of markers based on a given "locations" array.
      // The map() method here has nothing to do with the Google Maps API.
      const markers = locations.map((location, i) => {
        return new google.maps.Marker({
          position: location,
          label: labels[i % labels.length],
        });
      });
      // Add a marker clusterer to manage the markers.
      new MarkerClusterer(map, markers, {
        imagePath: "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
      });
    }
    const locations = [
      { lat: -31.56391, lng: 147.154312 },
      { lat: -33.718234, lng: 150.363181 },
      { lat: -33.727111, lng: 150.371124 },
      { lat: -33.848588, lng: 151.209834 },
      { lat: -33.851702, lng: 151.216968 },
      { lat: -34.671264, lng: 150.863657 },
      { lat: -35.304724, lng: 148.662905 },
      { lat: -36.817685, lng: 175.699196 },
      { lat: -36.828611, lng: 175.790222 },
      { lat: -37.75, lng: 145.116667 },
      { lat: -37.759859, lng: 145.128708 },
      { lat: -37.765015, lng: 145.133858 },
      { lat: -37.770104, lng: 145.143299 },
      { lat: -37.7737, lng: 145.145187 },
      { lat: -37.774785, lng: 145.137978 },
      { lat: -37.819616, lng: 144.968119 },
      { lat: -38.330766, lng: 144.695692 },
      { lat: -39.927193, lng: 175.053218 },
      { lat: -41.330162, lng: 174.865694 },
      { lat: -42.734358, lng: 147.439506 },
      { lat: -42.734358, lng: 147.501315 },
      { lat: -42.735258, lng: 147.438 },
      { lat: -43.999792, lng: 170.463352 },
    ];
    </script>
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
    // $("#selectLokasi").select2({
    //   placeholder: "Pilih Lokasi",
    //   allowClear: true
    // });

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

        // if ($("#wrapHeroText").hasClass("min-h-100")) {
        //   $("#wrapHeroText").removeClass("min-h-100", 1000);
        // } else {
        //   $("#wrapHeroText").addClass("min-h-100", 1000);
        // }

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
    $('#selectLokasiRempah').change(function(e) {
       let selected = e.target.value;
       if( selected === 'wilayah' ) {
        $.get('/get_location_json', function(data, status){
            let options = "";
            $('#lokasiRempah').html('');
            for( let i = 0; i < data.length; i++ ) {
                options += `<option value=${data[i].id}>${data[i].nama_lokasi}</option>`;
            }
            $('#lokasiRempah').append(options);
            
            // window.location.href = '?rempah=' + $('#lokasiRempah').val();
        });
       } else if( selected === 'rempah' ) {
        $.get('/get_rempah_json', function(data, status){
            let options = "";
            $('#lokasiRempah').html('');
            for( let i = 0; i < data.length; i++ ) {
                options += `<option value=${data[i].id}>${data[i].jenis_rempah}</option>`;
            }
            $('#lokasiRempah').append(options);
            // window.location.href = '?lokasi=' + $('#lokasiRempah').val();
        });
       }
    })

    $('#btnSelect').click(function() {
        let type = $('#selectLokasiRempah').val();
        let value = $('#lokasiRempah').val();

        window.location.href = `?${type}=${value}`;
    })
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
