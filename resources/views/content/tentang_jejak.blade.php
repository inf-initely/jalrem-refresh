@php
    $lang = App::getLocale();
    $altnav = true;

    $metadata = [
        "meta:title" => __("common.the_trail")." | ".__("common.title"),
        "title" => __("common.the_trail"),
        "description" => __("meta.tentang_jejak.description"),
        "keywords" => __("meta.tentang_jejak.keywords"),
    ];
@endphp

@extends('layout.app')

@section('content')
    @include("content.common.location")
    <header id="hero">
        <div id="map"></div>
        <div class="wrap-hero-text wrap-hero-text-bg d-none d-lg-block" id="wrapHeroText">
            <div class="row">
                <article class="col-md-12 text-end">
                    <header>
                        <h2 class="sub-judul sub-judul-hero ">{{ __('The Trails of the Spices') }}</h2>
                    </header>
                    @php
                        $suffix = "";
                    @endphp
                    @include('content.the_trail.hero_desc_' . $lang)
                    <button class="btn btn-sm btn-outline-secondary" onclick="readMore()"
                        id="btnReadmore">{{ __('Read More') }}</button>
                </article>
            </div>
        </div>
        <div class="text-hero-2 input-hero">
            <div class="row justify-content-center">
                <div class="col-11 col-md-10 col-lg-12">
                    <div class="mb-3 row wrap-select">
                        <div class="col-lg-5 mb-3">
                            <select id="selectLokasiRempah" class="form-select" aria-label="Default select example">
                                <option>{{ __('All') }}</option>
                                <option value="area">{{ __('Area') }}</option>
                                <option value="spice">{{ __('Spice') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-5 mb-3">
                            <select disabled id="lokasiRempah" class="form-select" aria-label="Default select example">
                            </select>
                        </div>
                        <div class="col-lg-2 wrap-btn-select">
                            <button id="btnSelect" class="btn btn-danger btn-select telusuri">{{ __('Browse') }}</button>
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
                            <h2 class="sub-judul sub-judul-hero ">{{ __('The Trails of the Spices') }}</h2>
                        </header>
                        @php
                            $suffix = "2";
                        @endphp
                        @include('content.the_trail.hero_desc_' . $lang)
                        <button class="btn btn-sm btn-outline-secondary" onclick="readMore2()"
                            id="btnReadmore2">{{ __('Read More') }}</button>
                    </article>
                </div>
            </section>
            <section id="kontenJejak">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 mt-3">
                            <div class="row" id="contents">
                                @foreach ($data as $content)
                                    @include('content.common.the_xxx_item')
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <div class="loader"></div>
                            </div>
                        </div>
                    </div>
            </section>
            @include('partials.triad_card_navi_footer')
        </div>
    </main>
@endsection

@section('js')
    @include('partials.js.jquery')
    @include('partials.js.bootstrap')
    {{-- @include('partials.js.dynamic-navbar') --}}
    @include("content.loader.the_xxx")
    <script>
        $(".navbar").addClass({!! $altnav ? "'bg-nav-baru'" : "'bg-nav'" !!});
        $(".navbar").removeClass("bg-trans");
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <script>
        const spices = {!! json_encode($spices) !!}
        const stats = {!! json_encode($stats) !!}

        const mapSpices = {}
        for (const spice of spices)
            mapSpices[spice.id] = spice
    </script>
    <script>
        const url = new URL(window.location.href);
        const area = url.searchParams.get("area");
        const spice = url.searchParams.get("spice");
        const page = url.searchParams.get("page");

        const defaultOpenInfo = (spice != null && spice != "") || (area != null && area != "");

        function initMap() {
            const theMap = new google.maps.Map(document.querySelector("#map"), {
                zoom: 5,
                center: {
                    lat: 0,
                    lng: 123,
                },
                mapId: "ceda280a7ce6c183"
            })
            const bounds = new google.maps.LatLngBounds()
            // if (area != "") {
            //     if (stats.length < 1) {
            //         stats.push({
            //             id: parseInt(area),
            //             total: 0
            //         })
            //     }
            // }

            for (const stat of stats) {
                const loc = locations[stat.id]
                if (loc == null) continue

                const marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(loc.latitude),
                        lng: parseFloat(loc.longitude)
                    },
                    map: theMap,
                    title: "Hello World!",
                    optimized: false,
                });

                bounds.extend(marker.getPosition())

                const contentString = `
                    <div id="content" class="d-flex justify-content-start align-items-center py-1 px-1" style="gap: 10px;">
                        <div class="d-flex justify-content-start align-items-center">
                            <span class="map-info-window-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                                    </g>
                                </svg>
                            </span>
                            <h4 class="map-info-window-title" style="font-size: 1rem;">${loc.name} :</h4>
                        </div>
                        <p class="map-info-window-desc" style="font-size: 1rem;"><b>${stat.total}</b> Konten</p>
                    </div>`;

                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });

                marker.addListener("click", () => {
                    if (infowindow.getMap() == null) {
                        infowindow.open({
                            anchor: marker,
                            map: theMap,
                            shouldFocus: true,
                        });
                    } else {
                        infowindow.close()
                    }
                })

                if (defaultOpenInfo)
                    infowindow.open({
                        anchor: marker,
                        map: theMap,
                        shouldFocus: false,
                    });
            }


            if (stats.length > 0) {
                // theMap.addListenerOnce("bounds_changed", () => {
                //     theMap.setZoom(5)
                // })

                // theMap.setCenter(bounds.getCenter())
                // theMap.fitBounds(bounds)
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAPS_KEY') }}&callback=initMap&libraries=&v=weekly"
        async></script>
    <script>
        itemSelect = $("#lokasiRempah")
        categorySelect = $("#selectLokasiRempah")

        function updateItems(e) {
            let selected = categorySelect.val()
            if (selected === 'area') {
                itemSelect
                    .html('').prop('disabled', false)
                    .append(Object.values(locations).map(a =>
                        `<option value=${a.id} ${parseInt(area) === a.id ? "selected" : ""}>${a.name}</option>`));
            } else if (selected === 'spice') {
                itemSelect
                    .html('').prop('disabled', false)
                    .append(spices.map(s =>
                        `<option value=${s.id} ${parseInt(spice) === s.id ? "selected" : ""}>${s.name}</option>`));
            } else {
                itemSelect
                    .html('').prop('disabled', true)
            }
        }

        if (area != null && area != "") {
            categorySelect.val("area")
            updateItems()

        } else if (spice != null && spice != "") {
            categorySelect.val("spice")
            updateItems()
        }

        if (stats.length > 0) {
            const selected = $(`#lokasiRempah [selected]`)
            const content = selected.text()
            selected.text(`${content} (${stats[0].count} {{ __('Contents') }})`)
        }

        categorySelect.change(updateItems)

        $('#btnSelect').click(function() {
            let type = categorySelect.val();
            let value = itemSelect.val();

            if (value == null || value == "" || (!["area", "spice"].includes(type))) {
                window.location.href = `?`
                return
            }

            window.location.href = `?${type}=${value}`;
        })
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
                btnText.innerHTML = '{{ __('Read More') }}';
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = '{{ __('Hide') }}';
                moreText.style.display = "inline";
            }

        }

        function readMore2() {
            var dots2 = document.getElementById("dots2");
            var moreText2 = document.getElementById("more2");
            var btnText2 = document.getElementById("btnReadmore2");


            if (dots2.style.display === "none") {
                dots2.style.display = "inline";
                btnText2.innerHTML = '{{ __('Read More') }}';
                moreText2.style.display = "none";
            } else {
                dots2.style.display = "none";
                btnText2.innerHTML = '{{ __('Hide') }}';
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
        $('.menu-toggle').click(function() {
            $(".nav2").toggleClass("mobile-nav");
            $(".nav2").removeClass("temp-pos");
            $(this).toggleClass("is-active");
        });
    </script>
@endsection
