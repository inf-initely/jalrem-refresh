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
                            <option>Choose Category</option>
                            <option {{ Request::get('wilayah') ? 'selected' : '' }} value="wilayah">Location</option>
                            <option {{ Request::get('rempah') ? 'selected' : '' }} value="rempah">Spice</option>
                        </select>
                    </div>
                    <div class="col-lg-5 mb-3">
                        <select id="lokasiRempah" class="form-select" aria-label="Default select example">
                            @foreach( $value_type as $v )
                                <option {{ Request::get('rempah') == $v->id || Request::get('wilayah') == $v->id ? 'selected' : '' }} value="{{ $v->id }}">{{ $v->getTable() == 'rempahs' ? $v->jenis_rempah : $v->nama_lokasi_english }}</option>
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
                            @endif
                            @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <div class="loader"></div>
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
<!-- <script src="http://platform.twitter.com/widgets.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script>
const provinceLatLong = [{
            "id": "1",
            "name": "ACEH",
            "latitude": 4.36855,
            "longitude": 97.0253
        },
        {
            "id": "33",
            "name": "NORTH SUMATERA",
            "latitude": 2.19235,
            "longitude": 99.38122
        },
        {
            "id": "31",
            "name": "WEST SUMATERA",
            "latitude": -1.14225,
            "longitude": 100.5761
        },
        {
            "id": "25",
            "name": "RIAU",
            "latitude": 0.50041,
            "longitude": 101.54758
        },
        {
            "id": "8",
            "name": "JAMBI",
            "latitude": -1.61157,
            "longitude": 102.7797
        },
        {
            "id": "32",
            "name": "SOUTH SUMATERA",
            "latitude": -3.12668,
            "longitude": 104.09306
        },
        {
            "id": "4",
            "name": "BENGKULU",
            "latitude": -3.51868,
            "longitude": 102.53598
        },
        {
            "id": "19",
            "name": "LAMPUNG",
            "latitude": -4.8555,
            "longitude": 105.0273
        },
        {
            "id": "17",
            "name": "BANGKA BELITUNG ISLANDS",
            "latitude": -2.75775,
            "longitude": 107.58394
        },
        {
            "id": "18",
            "name": "RIAU ISLANDS",
            "latitude": -0.15478,
            "longitude": 104.58037
        },
        {
            "id": "6",
            "name": "DKI JAKARTA",
            "latitude": -6.1745,
            "longitude": 106.8227
        },
        {
            "id": "9",
            "name": "WEST JAVA",
            "latitude": -6.88917,
            "longitude": 107.64047
        },
        {
            "id": "10",
            "name": "CENTRAL JAVA",
            "latitude": -7.30324,
            "longitude": 110.00441
        },
        {
            "id": "5",
            "name": "DI YOGYAKARTA",
            "latitude": -7.7956,
            "longitude": 110.3695
        },
        {
            "id": "11",
            "name": "EAST JAVA",
            "latitude": -7.275973,
            "longitude": 112.808304
        },
        {
            "id": "3",
            "name": "BANTEN",
            "latitude": -6.44538,
            "longitude": 106.13756
        },
        {
            "id": "2",
            "name": "BALI",
            "latitude": -8.23566,
            "longitude": 115.12239
        },
        {
            "id": "22",
            "name": "WEST NUSA TENGGARA",
            "latitude": -8.12179,
            "longitude": 117.63696
        },
        {
            "id": "34",
            "name": "EAST NUSA TENGGARA",
            "latitude": -8.56568,
            "longitude": 120.69786
        },
        {
            "id": "12",
            "name": "WEST KALIMANTAN",
            "latitude": -0.13224,
            "longitude": 111.09689
        },
        {
            "id": "14",
            "name": "CENTRAL KALIMANTAN",
            "latitude": -1.49958,
            "longitude": 113.29033
        },
        {
            "id": "13",
            "name": "SOUTH KALIMANTAN",
            "latitude": -2.94348,
            "longitude": 115.37565
        },
        {
            "id": "15",
            "name": "EAST KALIMANTAN",
            "latitude": 0.78844,
            "longitude": 116.242
        },
        {
            "id": "16",
            "name": "NORTH KALIMANTAN",
            "latitude": 2.72594,
            "longitude": 116.911
        },
        {
            "id": "30",
            "name": "NORTH SULAWESI",
            "latitude": 0.65557,
            "longitude": 124.09015
        },
        {
            "id": "28",
            "name": "CENTRAL SULAWESI",
            "latitude": -1.69378,
            "longitude": 120.80886
        },
        {
            "id": "27",
            "name": "SOUTH SULAWESI",
            "latitude": -3.64467,
            "longitude": 119.94719
        },
        {
            "id": "29",
            "name": "SOUTHEAST SULAWESI",
            "latitude": -3.54912,
            "longitude": 121.72796
        },
        {
            "id": "7",
            "name": "GORONTALO",
            "latitude": 0.71862,
            "longitude": 122.45559
        },
        {
            "id": "26",
            "name": "WEST SULAWESI",
            "latitude": -2.49745,
            "longitude": 119.3919
        },
        {
            "id": "20",
            "name": "MALUKU",
            "latitude": -3.11884,
            "longitude": 129.42078
        },
        {
            "id": "21",
            "name": "NORTH MALUKU",
            "latitude": 0.63012,
            "longitude": 127.97202
        },
        {
            "id": "24",
            "name": "WEST PAPUA",
            "latitude": -1.38424,
            "longitude": 132.90253
        },
        {
            "id": "23",
            "name": "PAPUA",
            "latitude": -3.98857,
            "longitude": 138.34853
        }
    ]
    const url = new URL(window.location.href);
    const wilayah = url.searchParams.get("wilayah");
    const rempah = url.searchParams.get("rempah");
    const page = url.searchParams.get("page");
        
    function initMap() {
        if (wilayah && !rempah) {
            //get value artikel from php
            const artikle = {!! json_encode($artikel) !!};
            let totalArtikle = artikle.data.length;

            // convert object artikelData.data to array if paginate
            // because paginate convert artikle.data from array to object
            if (page) {
                totalArtikle = Object.keys(artikle.data).length
            }

            // get wilayah data from provinceLatLong json
            const wilayahData = provinceLatLong.filter(
                (data) => data.id == wilayah
            );

            // show map
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: {
                    lat: wilayahData[0].latitude,
                    lng: wilayahData[0].longitude
                },
                mapId: "ceda280a7ce6c183",
            });
            const contentString = `
                <div id="content" class="d-flex justify-content-start align-items-center py-3 px-1" style="gap: 10px;">
                    <div class="d-flex justify-content-start align-items-center">
                        <span class="map-info-window-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <h4 class="map-info-window-title">${wilayahData[0].name} :</h4> 
                    </div>
                    <p class="map-info-window-desc"><b>${totalArtikle}</b> Content</p>
                </div>`;
            const infowindow = new google.maps.InfoWindow({
                content: contentString,
            });
            const marker = new google.maps.Marker({
                position: {
                    lat: wilayahData[0].latitude,
                    lng: wilayahData[0].longitude
                },
                map,
                title: "Hello World!",
                optimized: false,
            });;

            // show marker
            infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
            });

        } else if (rempah && !wilayah) {
            //get value artikel
            const artikleData= {!! json_encode($artikel) !!};
            let artikleRem = artikleData.data;

            // convert object artikelData.data to array if paginate
            // because paginate convert artikle.data from array to object
            if (page) {
                artikleRem = Object.values(artikleData.data);
            }

            // container markerdata
            const markerData = [];

            // iterate artikelRem and push to markerData if not exit in markerData
            // but if exit in markerData, then just add +1 total artikel 
            for (let i = 0; i < artikleRem.length; i++) {
                let artikel = artikleRem[i];
                let isExist = false;
                for (let j = 0; j < markerData.length; j++) {
                    let marker = markerData[j];
                    if (marker.id == artikel.id_lokasi) {
                        isExist = true;
                        marker.totalArtikel += 1;
                        break;
                    }
                }
                if (!isExist) {
                    // get lokasi if lokasi artikel same with data from provinceLatLong
                    let lokasiData = provinceLatLong.filter(
                        (data) => data.id == artikel.id_lokasi
                    );

                    // push to markerData if lokasiData not empty
                    if (lokasiData.length > 0) {
                        markerData.push({
                            id: artikel.id_lokasi,
                            lokasi: lokasiData[0],
                            totalArtikel: 1
                        });
                    }
                }
            }

            //  show map
            const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 5.3,
                    center: {
                        lat: -1.5,
                        lng: 119,
                    },
                    mapId: 'ceda280a7ce6c183',
            });

            // show marker on map for each markerData
            for (let i = 0; i < markerData.length; i++) {
                const lokasi = markerData[i].lokasi;
                const totalArtikel = markerData[i].totalArtikel;

                const contentString = `
                <div id="content" class="d-flex justify-content-start align-items-center py-3 px-1" style="gap: 10px;">
                    <div class="d-flex justify-content-start align-items-center">
                        <span class="map-info-window-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                                </g>
                            </svg>
                        </span>
                        <h4 class="map-info-window-title">${lokasi.name} :</h4> 
                    </div>
                    <p class="map-info-window-desc"><b>${totalArtikel}</b> Content</p>
                </div>`;
                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });
                const  marker = new google.maps.Marker({
                    position: {
                        lat: lokasi.latitude,
                        lng: lokasi.longitude
                    },
                    map,
                    title: "Hello World!",
                    optimized: false,
                });;
                infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                });
            }
        }  else { 
            // not wilayah or rempah in url
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5.3,
                center: {
                    lat: -1.5,
                    lng: 119,
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAPS_KEY') }}&callback=initMap&libraries=&v=weekly" async></script>
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
                options += `<option value=${data[i].id}>${data[i].nama_lokasi_english}</option>`;
            }
            $('#lokasiRempah').append(options);
            
            // window.location.href = '?rempah=' + $('#lokasiRempah').val();
        });
       } else if( selected === 'rempah' ) {
        $.get('/get_rempah_json', function(data, status){
            let options = "";
            $('#lokasiRempah').html('');
            for( let i = 0; i < data.length; i++ ) {
                options += `<option value=${data[i].id}>${data[i].jenis_rempah_english}</option>`;
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
         url: `?rempah={{ Request::get('rempah') }}&wilayah={{ Request::get('wilayah') }}&page=${halaman}`,
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
