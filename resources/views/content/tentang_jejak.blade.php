@extends('layout.app')

@section('content')
<header id="hero">
    <div id="map"></div>
    <div class="wrap-hero-text wrap-hero-text-bg d-none d-lg-block" id="wrapHeroText">
        <div class="row">
            <div class="col-md-12 text-end">
                <header>
                    <h2 class="sub-judul sub-judul-hero ">Jejak dan Jalur Rempah</h2>
                </header>
                <p>Jalur Rempah merupakan sebutan untuk suatu peradaban yang sangat tua, kompleks, dan luas. Jalurnya merupakan jalur budaya; terbentang dari timur Asia hingga barat Eropa, terhubung dengan Benua Amerika, Afrika dan Australia; dan mempengaruhi peradaban global.<span id="dots">...</span><span id="more"><br><br>
                        Kita dapat melihat peran aktif masyarakat Nusantara dalam pembentukkan peradaban ini. Baik sebagai produsen rempah yang menggerakkan perdagangan lintas batas, maupun sebagai masyarakat yang terbuka bagi banyak bangsa (pendatang) yang memiliki latar belakang budaya yang berbeda.<br><br>
                        Keterbukaan masyarakat dan hubungan budaya yang melahirkan beragam warisan budaya multikultural dan multietnis ke berbagai medium, termasuk hubungan lintas lautan di dalamnya, menjadi suatu keniscayaan. Tidak hanya antar bangsa, tetapi juga antar sukubangsa. Hubungan budaya antar manusia lintas lautan meninggalkan jejak, dan rangkaian jejak lintas wilayah inilah yang sekaligus membangun jalur.<br><br>
                        Setiap warisan memiliki nilai budaya yang disimpan dalam berbagai bentuk. Kisah asal usul, nyanyian, musik, tarian, teknologi tradisional, arsitektur bangunan, kepercayaan dan banyak lainnya. Simpanan nilai budaya yang menjadi memori kolektif ini sekaligus menjadi bukti dan jejak Jalur Rempah.</span></p>
                <button class="btn btn-sm btn-outline-secondary" onclick="readMore()" id="btnReadmore">Lihat Selengkapnya</button>
            </div>
        </div>
    </div>
    <div class="text-hero-2 input-hero">
        <div class="row justify-content-center">
            <div class="col-11 col-md-10 col-lg-12">
                <div class="mb-3 row wrap-select">
                    <div class="col-lg-5 mb-3">
                        <select id="selectLokasi" class="form-select" aria-label="Default select example">
                            <option selected>Pilih Kategori</option>
                            <option value="wilayah">Wilayah</option>
                            <option value="rempah">Jenis Rempah</option>
                        </select>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <select id="selectRempah" class="form-select" aria-label="Default select example">
                            <option selected>Pilih Jenis Rempah</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 wrap-btn-select">
                        <button id="btnSelect" class="btn btn-danger btn-select" type="button" id="button-addon2">Telusuri</button>
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
                <div class="col-md-12">
                    <header>
                        <h2 class="sub-judul sub-judul-hero ">Jejak dan Jalur Rempah</h2>
                    </header>
                    <p>Jalur Rempah merupakan sebutan untuk suatu peradaban yang sangat tua, kompleks, dan luas. Jalurnya merupakan jalur budaya; terbentang dari timur Asia hingga barat Eropa, terhubung dengan Benua Amerika, Afrika dan Australia; dan mempengaruhi peradaban global.<span id="dots2" style="display:inline">...</span><span id="more2" style="display:none"><br><br>
                            Kita dapat melihat peran aktif masyarakat Nusantara dalam pembentukkan peradaban ini. Baik sebagai produsen rempah yang menggerakkan perdagangan lintas batas, maupun sebagai masyarakat yang terbuka bagi banyak bangsa (pendatang) yang memiliki latar belakang budaya yang berbeda.<br><br>
                            Keterbukaan masyarakat dan hubungan budaya yang melahirkan beragam warisan budaya multikultural dan multietnis ke berbagai medium, termasuk hubungan lintas lautan di dalamnya, menjadi suatu keniscayaan. Tidak hanya antar bangsa, tetapi juga antar sukubangsa. Hubungan budaya antar manusia lintas lautan meninggalkan jejak, dan rangkaian jejak lintas wilayah inilah yang sekaligus membangun jalur.<br><br>
                            Setiap warisan memiliki nilai budaya yang disimpan dalam berbagai bentuk. Kisah asal usul, nyanyian, musik, tarian, teknologi tradisional, arsitektur bangunan, kepercayaan dan banyak lainnya. Simpanan nilai budaya yang menjadi memori kolektif ini sekaligus menjadi bukti dan jejak Jalur Rempah.</span></p>
                    <button class="btn btn-sm btn-outline-secondary" onclick="readMore2()" id="btnReadmore2">Lihat Selengkapnya</button>
                </div>
            </div>
        </section>
        <section id="kontenJejak">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="row">
                            @foreach( $artikel as $a )
                            <div class="col-lg-6 mb-1">
                                <div class="card no-border no-background">
                                    <div class="card-body row">
                                        <div class="col-5 center-v">
                                            <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" width="100%">
                                        </div>
                                        <div class="col-7 center-v">
                                            @if( $a->lokasi != null )
                                            <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi }}</small></a>
                                            @endif
                                            <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route('article_detail', $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_indo }}</a> </h3>
                                            <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_indo, 60, $end='...') !!}</p> -->
                                            <div class="wrap-tag-rempah">
                                                @foreach( $a->rempahs as $r )
                                                <a href="funfact.html" class="text-danger text-decoration-none">{{ $r->jenis_rempah }}</a>|
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

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
                                        <div class="col-3 ">
                                            <img src="assets/img/icon/jalur_1.svg" width="80%">
                                        </div>
                                        <div class="col-9 center-v">
                                            <h3 class="judul-card-info">Jalur</h3>
                                            <p class="des-card-info">Merangkai Budaya Nusantara Melalui Jalur Rempahs</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tentangjalur') }}" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 ">
                                            <img src="assets/img/icon/jejak_1.svg" width="80%">
                                        </div>
                                        <div class="col-9 center-v">
                                            <h3 class="judul-card-info">Jejak</h3>
                                            <p class="des-card-info">Merangkai Budaya Nusantara Melalui Jalur Rempahs</p>
                                        </div>
                                    </div>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 ">
                                            <img src="assets/img/icon/masa-depan_1.svg" width="80%">
                                        </div>
                                        <div class="col-9 center-v">
                                            <h3 class="judul-card-info">Masa Depan</h3>
                                            <p class="des-card-info">Merangkai Budaya Nusantara Melalui Jalur Rempahs</p>
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
            center: {
                lat: -0.8917,
                lng: 119.8707
            },
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
    const locations = [{
            lat: -31.56391,
            lng: 147.154312
        },
        {
            lat: -33.718234,
            lng: 150.363181
        },
        {
            lat: -33.727111,
            lng: 150.371124
        },
        {
            lat: -33.848588,
            lng: 151.209834
        },
        {
            lat: -33.851702,
            lng: 151.216968
        },
        {
            lat: -34.671264,
            lng: 150.863657
        },
        {
            lat: -35.304724,
            lng: 148.662905
        },
        {
            lat: -36.817685,
            lng: 175.699196
        },
        {
            lat: -36.828611,
            lng: 175.790222
        },
        {
            lat: -37.75,
            lng: 145.116667
        },
        {
            lat: -37.759859,
            lng: 145.128708
        },
        {
            lat: -37.765015,
            lng: 145.133858
        },
        {
            lat: -37.770104,
            lng: 145.143299
        },
        {
            lat: -37.7737,
            lng: 145.145187
        },
        {
            lat: -37.774785,
            lng: 145.137978
        },
        {
            lat: -37.819616,
            lng: 144.968119
        },
        {
            lat: -38.330766,
            lng: 144.695692
        },
        {
            lat: -39.927193,
            lng: 175.053218
        },
        {
            lat: -41.330162,
            lng: 174.865694
        },
        {
            lat: -42.734358,
            lng: 147.439506
        },
        {
            lat: -42.734358,
            lng: 147.501315
        },
        {
            lat: -42.735258,
            lng: 147.438
        },
        {
            lat: -43.999792,
            lng: 170.463352
        },
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
            btnText.innerHTML = "Lihat Selengkapnya";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Kembali";
            moreText.style.display = "inline";
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
@endsection
