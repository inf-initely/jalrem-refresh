@include("partials.content-loader")
<script>
    const articlesEl = $('#articles')
    function displayArticles(articles) {
        for(const article of articles) {
            let kategori_show = article?.kategori_show?.map(item => {
                if( item == 'Indepth' ) {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if( item == 'Jurnal Artikel' ) {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).toString().replaceAll(',', ' ')

            if( kategori_show == undefined ) {
                kategori_show = '<div></div>';
            }

            articlesEl.append(`
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                        <img src="{{ asset('storage/assets/artikel/thumbnail')}}/${article.thumbnail}" class="card-img-top img-thumbnail" alt="...">
                        <div class="card-body">
                            <h3 class="card-title judul-artikel">${article.judul}</h3>
                            <p class="penulis-artikel">
                                ${article.penulis}
                            </p>
                            <p class="tgl-artikel">
                                ${article.published_at}
                            </p>
                            ${kategori_show}
                        </div>
                        <a href="/artikel/${article.slug}" class="stretched-link"></a>
                    </div>
                </div>
            `)
        }

    }

    InitContentLoader("", displayArticles)
</script>
