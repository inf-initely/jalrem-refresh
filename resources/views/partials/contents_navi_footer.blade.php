<section id="mediaJalurRempah">
    <section class="container" id="artikel">
        <header class="row justify-content-start mb-2">
            <div class="col-md-6">
                <h2 class="sub-judul">{{__("The Spice Routes Contents")}}</h2>
            </div>
        </header>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row text-center justify-content-center">
                    <div class="col mb-1">
                        <div class="card no-border card-media">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/icon-publication.webp') }}" width="32.5%">
                                <p class="judul-media">{{__("Article")}}</p>
                                <p class="des-media">

                                </p>
                            </div>
                            <a href="{{ route('articles.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col mb-1">
                        <div class="card no-border card-media">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/icon-image.webp') }}" width="32.5%">
                                <p class="judul-media">{{__("Photo")}}</p>
                                <p class="des-media">

                                </p>
                            </div>
                            <a href="{{ route('photos.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col mb-1">
                        <div class="card no-border card-media">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/icon-video.webp') }}" width="32.5%">
                                <p class="judul-media">{{__("Video")}}</p>
                                <p class="des-media">

                                </p>
                            </div>
                            <a href="{{ route('videos.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col mb-1">
                        <div class="card no-border card-media">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/icon-publication.webp') }}" width="32.5%">
                                <p class="judul-media">{{__("Publication")}}</p>
                                <p class="des-media">

                                </p>
                            </div>
                            <a href="{{ route('publications.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col d-none d-lg-block d-xl-none mb-1">
                        <div class="card no-border card-media">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/icon-sound.webp') }}" width="32.5%">
                                <p class="judul-media">{{__("Audio")}}</p>
                                <p class="des-media">

                                </p>
                            </div>
                            <a href="{{ route('audios.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-1 d-lg-none d-xl-block">
                        <div class="card no-border card-media">
                            <div class="card-body">
                                <img src="{{ asset('assets/img/icon-sound.webp') }}" width="32.5%">
                                <p class="judul-media">{{__("Audio")}}</p>
                                <p class="des-media">

                                </p>
                            </div>
                            <a href="{{ route('audios.'.$lang) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
