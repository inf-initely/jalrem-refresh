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
                                                    <h3 class="judul-artikel judul-artikel-tentang">{{ $a->judul_english }}</h3>
                                                    <!-- <p class="des-artikel des-artikel-tentang minimize">{!! Str::limit($a->konten_english ?? $a->konten_indo, 50, $end='...') !!}</p> -->
                                                    @if( $a->rempahs != null )
                                                        <div class="wrap-tag-rempah">
                                                                @foreach( $a->rempahs as $r )
                                                                <a href="{{ route('rempah_detail', $r->id) }}" class="text-danger text-decoration-none">{{ $r->jenis_rempah }}</a>|
                                                                @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{ route('article_detail', $a->slug_english ?? $a->slug) }}" class="stretched-link"></a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center mt-2">
                                        {!! $artikel->links() !!}
                                    </div>
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
                                            <p class="des-card-info">A means of reconstruction and revitalization of the maritime</p>
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
