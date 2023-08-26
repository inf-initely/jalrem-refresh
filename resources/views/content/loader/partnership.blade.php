@include("partials.content-loader")
<script>
    const pubEl = $('#partnertships')
    function displayPartnerships(partnerships) {
        for (const partner of partnerships) {
            let categories = partner.categories?.map(item => {
                if (item == 'Indepth') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if (item == 'Jurnal Artikel') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).join("")

            pubEl.append(`
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                        <img src="{{ asset('storage/assets/publikasi/thumbnail/') }}/${partner.thumbnail}" class="card-img-top img-thumbnail" alt="...">
                        <div class="card-body">
                            <h3 class="card-title judul-artikel">${partner.title}</h3>
                            <p class="penulis-artikel">
                                ${partner.author}
                            </p>
                            <p class="tgl-artikel">
                                ${partner.published_at}
                            </p>
                                ${categories}
                        </div>
                        <a href="/publikasi/${partner.slug}" class="stretched-link"></a>
                    </div>
                </div>
            `)
        }
    }

    InitContentLoader("", displayPartnerships)
</script>
