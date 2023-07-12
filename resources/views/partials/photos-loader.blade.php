@include("partials.content-loader")
<script>
    const photoEl = $('#photos')
    function displayPhotos(photos) {
        for (const photo of photos) {
            let kategori_show = photo.kategori_show?.map(item => {
                if (item == 'Indepth') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if (item == 'Jurnal Artikel') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).toString().replaceAll(',', ' ')

            if (kategori_show == undefined) {
                kategori_show = '<div></div>';
            }

            photoEl.append(`
                <div class="col-lg-4 mb-4">
                    <div class="img-bg-wrap">
                        <img src="{{ asset('storage/assets/foto/thumbnail/') }}/${photo.thumbnail}">
                        <div class="text-img">
                            <p class="judul-img">${photo.judul}</p>
                            <p class="author-img">${photo.penulis}</p>
                            <p class="tgl-img">${photo.published_at}</p>
                        </div>
                        ${kategori_show}
                        <a class="stretched-link lightbox" href="/foto/${photo.slug}"></a>
                    </div>
                </div>
            `)
        }
    }

    InitContentLoader("", displayPhotos)
</script>
