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
                    The Spice Routes covered numerous tracks from the east part of Asia to the west part of Europe, connected with American, African, and Australian Continents. It acted as a civilization trajectory in various forms–straight lines, circles, crossways, that then formed networks.
                    <span id="dots">...</span><span id="more"><br><br>

                    In Indonesia, the Spice Routes appeared in various forms. Covering broader than merely the spice producer lands, it also reached other points in Indonesia and formed a sustainable civilization trajectory.<br><br>

                    The Spice Routes program is here to respect the tracks of the spice trade from one point to another, enlivening the sundry stories, and connecting the traces.<br><br>

                    Enlivening the historical narration that commonly puts aside the role of Indonesians in the forming of the Spice Routes.<br><br>

                    The Spice Routes determines to record the role of those who stood in the Spice Routes points, connecting the lines that have yet not to be documented and are blurry in the historical narration.</span>
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
                        The Spice Routes covered numerous tracks from the east part of Asia to the west part of Europe, connected with American, African, and Australian Continents. It acted as a civilization trajectory in various forms–straight lines, circles, crossways, that then formed networks.
                        <span id="dots2" style="display:inline">...</span><span id="more2" style="display:none"><br><br>

                        In Indonesia, the Spice Routes appeared in various forms. Covering broader than merely the spice producer lands, it also reached other points in Indonesia and formed a sustainable civilization trajectory.<br><br>

                        The Spice Routes program is here to respect the tracks of the spice trade from one point to another, enlivening the sundry stories, and connecting the traces.<br><br>

                        Enlivening the historical narration that commonly puts aside the role of Indonesians in the forming of the Spice Routes.<br><br>

                        The Spice Routes determines to record the role of those who stood in the Spice Routes points, connecting the lines that have yet not to be documented and are blurry in the historical narration.</span>
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
                                            <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>{{ $a->lokasi->nama_lokasi ?? '' }}</small></a>
                                            <h3 class="judul-artikel judul-artikel-tentang"><a href="{{ route('article_detail', $a->slug_english ?? $a->slug) }}" class="text-decoration-none clr-black">{{ $a->judul_english ?? $a->judul_indo }}</a> </h3>
                                            <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_english ?? $a->konten_indo, 50, $end='...') !!}</p> -->
                                            <div class="wrap-tag-rempah">
                                                @if( $a->rempahs != null )
                                                @foreach( $a->rempahs as $r )
                                                <a href="{{ route('rempah_detail', $r->id) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah }}</a>
                                                |
                                                @endforeach
                                                @endif
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
                                            <h3 class="judul-card-info">The Route</h3>
                                            <p class="des-card-info">Looking back to the spice trade routes from one point to another.</p>
                                        </div>
                                    </div>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 ">
                                            <img src="assets/img/icon/jejak_1.svg" width="80%">
                                        </div>
                                        <div class="col-9 center-v">
                                            <h3 class="judul-card-info">The Trace</h3>
                                            <p class="des-card-info">Reviving the globalization trace of the spice trade in the past.</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tentangjejak') }}" class="stretched-link"></a>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <div class="card no-border card-media">
                                    <div class="card-body row">
                                        <div class="col-3 ">
                                            <img src="assets/img/icon/masa-depan_1.svg" width="80%">
                                        </div>
                                        <div class="col-9 center-v">
                                            <h3 class="judul-card-info">The Future</h3>
                                            <p class="des-card-info">The excavation of the maritime ecosystem, emerging from traces in the past.</p>
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
@endsection
