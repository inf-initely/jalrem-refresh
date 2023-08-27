@include("partials.content-loader")
<script>
    el = $('#contents')
    function display(contents) {
        for (const content of contents) {
            const categories = content.categories?.map(item => {
                if (item == 'Indepth') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if (item == 'Jurnal Artikel') {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).join("")


            const spicesLen = content.spices.length
            const spices = content.spices?.map((item, i) => {
                const sep = spicesLen - 1 === i ? "" : " | "
                return `<a href="/funfact/${item.type}" class="text-danger text-decoration-none">${item.type}</a>` + sep
            }).join("")

            const media =
            content.type == "audio" ?
            `<div class="col-5 center-v">
                <div class="video media-video" style="height: 170px;" data-video-id="${content.cloud_key}">
                    <div class="video-layer">
                        <div class="video-placeholder">
                        </div>
                    </div>
                    <div class="video-preview" style="background: url('https://img.youtube.com/vi/${content.cloud_key}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                        <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                        <svg viewBox="0 0 74 74">
                            <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                            <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                            <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                        </svg>
                    </div>
                </div>
            </div>` :
            content.content_type == "video" ?
            `<div class="video media-video" style="height: 170px;" data-video-id="${content.youtube_key}">
                <div class="video-layer">
                    <div class="video-placeholder">
                    </div>
                </div>
                <div class="video-preview" style="background: url('https://img.youtube.com/vi/${content.youtube_key}/hqdefault.jpg') 50% 50% no-repeat; background-size: cover;">
                    <!-- this icon would normally be implemented as a character in an icon font or svg spritesheet, or similar -->
                    <svg viewBox="0 0 74 74">
                        <circle style="opacity:0.64;stroke:#fff" cx="37" cy="37" r="36.5"></circle>
                        <circle fill="none" stroke="#fff" cx="37" cy="37" r="36.5"></circle>
                        <polygon fill="#fff" points="33,22 33,52 48,37"></polygon>
                    </svg>
                </div>
            </div>`
            :
            `<img class="tentang-thumbnail" src="{{ asset('storage/assets/${content.table_name.replace(/s$/, "")}/thumbnail/${content.thumbnail}') }}" width="100%">`

            el.append(`
            <div class="col-lg-6 mb-1">
                <div class="card no-border no-background">
                    <div class="card-body row">
                        <div class="col-5 center-v">
                            ${media}
                        </div>
                        <div class="col-7 center-v">
                            <a href="#" class="text-danger m-0 p-0 text-decoration-none wilayah"><small>${locations[content.location]?.name ?? ""}</small></a>
                            <h3 class="judul-artikel judul-artikel-tentang"><a href="video/${content.slug}" class="text-decoration-none clr-black">${content.title}</a> </h3>
                            <div class="wrap-tag-rempah">
                                ${spices}
                            </div>
                            ${categories}
                        </div>
                    </div>
                </div>
            </div>`)
        }
    }

    InitContentLoader("", display)
</script>
