@include("partials.content-loader")
<script>
    const photoEl = $('#photos')
    function displayPhotos(photos) {
        for (const photo of photos) {
            let categories = photo.categories?.map(item => {
                if (item == 'Indepth') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if (item == 'Jurnal Artikel') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).join("")


            photoEl.append(`
                <div class="col-lg-4 mb-4">
                    <div class="img-bg-wrap">
                        <img src="{{ asset('storage/assets/foto/thumbnail/') }}/${photo.thumbnail}">
                        <div class="text-img">
                            <p class="judul-img">${photo.title}</p>
                            <p class="author-img">${photo.author}</p>
                            <p class="tgl-img">${photo.published_at}</p>
                        </div>
                        ${categories}
                        <a class="stretched-link lightbox" href="/foto/${photo.slug}"></a>
                    </div>
                </div>
            `)
        }
    }

    InitContentLoader("", displayPhotos)
</script>
