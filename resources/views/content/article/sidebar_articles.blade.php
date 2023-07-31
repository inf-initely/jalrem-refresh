<div class="col-12 mb-2">
    <div class="card no-border no-background">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <img class="kegiatan-img" id="imgKegiatan" name="imgKegiatan"
                        src="{{ asset('storage/assets/artikel/thumbnail/' . $article['thumbnail']) }}">
                </div>
                <div class="col-7 center-v">
                    <h3 class="judul-berita-aside" id="jdlKegiatan" name="jdlKegiatan">{{ $article['title'] }}</h3>
                    <p class="tgl-berita-aside" id="tglKegiatan" name="tglKegiatan">{{ $article['published_at'] }}</p>
                </div>
            </div>
            <a href="{{ route('article_detail', $article['slug']) }}" class="stretched-link"></a>
        </div>
    </div>
</div>
