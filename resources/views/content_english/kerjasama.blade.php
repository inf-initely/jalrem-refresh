@extends('layout.app')

@section('title')
    All Partnership - Jalur Rempah Kemdikbudristek Republik Indonesia
@endsection

@section('content')

<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-4.jpg">
    <div class="text-hero-2">
        <div class="">
            <div class="col-lg-12 text-center">
                <h1>Partnership</h1>
            </div>
        </div>
    </div>
</header>
<main>
    <div id="content">
        <section id="sejarahRempah">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach( $kerjasama as $k )
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card no-border card-artikel">
                            <img src="{{ asset('storage/assets/kerjasama/thumbnail/' . $k->thumbnail) }}" class="card-img-top img-thumbnail" alt="...">
                            <div class="card-body">
                                <h3 class="card-title judul-artikel">{{ $k->judul_english }}</h3>
                                {{-- <p class="card-text des-artikel minimize">{!! Str::limit($k->konten_indo, 50, $end='...') !!}</p> --}}
                                <p class="penulis-artikel">
                                    {{ $k->penulis != 'admin' ? $k->kontributor_relasi->nama : 'admin' }}
                                </p>
                                <p class="tgl-artikel">
                                    {{ $k->created_at->isoFormat('D MMMM Y'); }}
                                </p>
                                @foreach( $k->kategori_show as $ks )
                                    @if( $ks->isi == 'Indepth' )
                                    <span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>
                                    @endif
                                @endforeach
                                @foreach( $k->kategori_show as $ks )
                                    @if( $ks->isi == 'Jurnal Artikel' )
                                    <span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{ route('kerjasama_detail', $k->slug_english ?? $k->slug_indo ) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                {!! $kerjasama->links() !!}
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        if ($(window).width() <= 1000) {
            $(".navbar").addClass("bg-nav");
            $(".navbar").removeClass("bg-trans");
        }
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
                $(".navbar").removeClass("bg-nav");
            }
        } else {
            $(".navbar").addClass("bg-nav");
            $(".navbar").removeClass("bg-trans");
        }

    }); //missing );
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
