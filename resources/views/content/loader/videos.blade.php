@include("partials.content-loader")
<script>
    videosEl = $('#videos')
    function displayVideos(videos) {
        for (const video of videos) {
            let categories = video.categories?.map(item => {
                if (item == 'Indepth') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if (item == 'Jurnal Artikel') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).join("")

            videosEl.append(`
                <div class="col-md-12 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                        <iframe width="100%" height="190" src="//www.youtube.com/embed/${video.youtube_key}?rel=0&amp;fs=0&amp;showinfo=0" frameborder="0" allowfullscreen>
                        </iframe>
                        <a class="stretched-link lightbox" href="/video/${video.slug}"></a>
                        <div class="card-body">
                            <p class="card-text">${video.title}</p>
                            ${categories}
                        </div>
                    </div>
                </div>
            `)
        }
    }

    InitContentLoader("", displayVideos)
</script>
