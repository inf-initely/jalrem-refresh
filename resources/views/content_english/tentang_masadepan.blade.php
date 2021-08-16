@extends('layout.app')

@section('content')
<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-3.jpg">
    <div class="text-hero-2">
        <div class="">
            <div class="col-lg-12 text-center">
                <h1>Masa Depan</h1>
            </div>
        </div>
    </div>
</header>
<main>
    <div id="content">
        <section id="sejarahRempah">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <header>
                            <h2 class="sub-judul">Masa Depan dan Jalur Rempah</h2>
                        </header>
                        <section id="desTentang">
                            <p>Program Jalur Rempah berpandangan ke depan. Jejak dan Jalur direkonstruksi sebagai fondasi dari masa lalu sebagai masa kini untuk membangun masa depan.</p>
                            <p>Suatu cara pandang yang berangkat dari jejak-jejak masa lalu yang terhubung satu sama lain dan membentuk ekosistem kebudayaan, dan memandang laut sebagai simbol kekayaan dan kesejahteraan.</p>
                            <p>Program Jalur Rempah berupaya menampilkan bahari sebagai khazanah, sebuah pemberian alamiah yang membuat Indonesia memiliki panjang pantai lebih dari 95.000 kilometer dan menjadikan negara ini memiliki garis pantai terpanjang kedua di dunia sekaligus negara kepulauan terbesar.</p>
                            <p>Lewat cara pandang ini, program Jalur Rempah menghidupkan kembali gagasan ini melalui identifikasi jejak budaya, potensinya di masa mendatang dan rekonstruksi jalur budaya sebagai sebuah pekerjaan kolektif. Rempah sebagai masa depan: industri, warisan nenek moyang tentang kecantikan, kesehatan, hingga pangan. Sebuah kerja berkelanjutan, menghidupi, juga membahagiakan manusia yang terlibat di dalamnya.</p>
                        </section>
                    </div>
                    <section id="artikelTentang">
                        <div class="row justify-content-center">
                            <div class="col-lg-11">
                                <div class="row">
                                    @foreach( $artikel as $a )
                                    <div class="col-lg-6 mb-1">
                                        <div class="card no-border no-background">
                                            <div class="card-body row">
                                                <div class="col-5">
                                                    <img src="{{ asset('storage/assets/artikel/thumbnail/' . $a->thumbnail) }}" width="100%">
                                                </div>
                                                <div class="col-7 center-v">
                                                    <h3 class="judul-artikel judul-artikel-tentang">{{ $a->judul_english ?? $a->judul_indo }}</h3>
                                                    <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_english ?? $a->konten_indo, 50, $end='...') !!}</p> -->
                                                </div>
                                            </div>
                                            <a href="{{ route('article_detail', $a->slug) }}" class="stretched-link"></a>
                                        </div>
                                    </div>
                                    @endforeach
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
                                            <h3 class="judul-card-info">Masa Depan</h3>
                                            <p class="des-card-info">Merangkai Budaya Nusantara Melalui Jalur Rempahs</p>
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
@endsection