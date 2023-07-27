@include("partials.content-loader")
<script>
    const eventsEl = $('#events')
    function displayEvents(events) {
        for (const event of events) {
            let categories = event?.categories?.map(item => {
                if (item == 'Indepth') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if (item == 'Jurnal Artikel') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).join("")

            eventsEl.append(`
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                        <img src="{{ asset('storage/assets/kegiatan/thumbnail/') }}/${event.thumbnail}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title judul-artikel">${event.title}</h3>
                            <p class="penulis-artikel">${event.author}</p>
                            <p class="tgl-artikel">${event.published_at}</p>
                            ${categories}
                        </div>
                        <a href="/event_detail/${event.slug}" class="stretched-link"></a>
                    </div>
                </div>
            `)
        }
    }

    InitContentLoader("", displayEvents)
</script>
