@include("partials.content-loader")
<script>
    const audiosEl = $('#audios')
    function displayAudios(audios) {
        for (const audio of audios) {
            let kategori_show = audio.kategori_show?.map(item => {
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
            audiosEl.append(`
                <div class="col-md-12 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                        <iframe width="100%" height="190" src="//www.youtube.com/embed/${audio.cloudkey}?rel=0&amp;fs=0&amp;showinfo=0" frameborder="0" allowfullscreen>
                        </iframe>
                        <a class="stretched-link lightbox" href="/audio/${audio.slug}"></a>
                        <div class="card-body">
                            <p class="card-text">${audio.judul}</p>
                            ${kategori_show}
                        </div>
                    </div>
                </div>
            `)
        }
    }

    InitContentLoader("", displayAudios)
</script>
