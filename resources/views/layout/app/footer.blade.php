<footer>
    <img class="footer-bg-1"
        srcset="{{ asset('assets/img/asset-jelajah-576px.webp') }} 576w, {{ asset('assets/img/asset-jelajah-768px.webp') }} 768w, {{ asset('assets/img/asset-jelajah-992px.webp') }} 992w, {{ asset('assets/img/asset-jelajah-1200px.webp') }} 1200w, {{ asset('assets/img/asset-jelajah.webp') }}"
        sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
        src="{{ asset('assets/img/asset-jelajah.webp') }}" alt="" width="50%" loading="lazy" />
    <img class="footer-bg-2 d-none"
        srcset="{{ asset('assets/img/asset-jelajah2-576px.webp') }} 576w, {{ asset('assets/img/asset-jelajah2-768px.webp') }} 768w, {{ asset('assets/img/asset-jelajah2-992px.webp') }} 992w, {{ asset('assets/img/asset-jelajah2-1200px.webp') }} 1200w, {{ asset('assets/img/asset-jelajah2.webp') }}"
        sizes="(max-width: 576px) 576px, (max-width: 768px) 768px, (max-width: 992px) 992px, (max-width: 1200px) 1200px, 100vw"
        src="{{ asset('assets/img/asset-jelajah2.webp') }}" alt="" width="50%" loading="lazy" />
    <div class="container wrap-footer">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-3 footer-content mb-4">
                <img class="logo-footer" src="{{ asset('assets/img/logo-footer-3.webp') }}" width="50%">
                <p class="footer-alamat">{{__("footer.address")}}</p>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4 footer-content">
                <h3 class="menu-footer mb-3">{{strtoupper(__("Contact"))}}</h3>
                <ul>
                    <li>
                        jalurrempah@kemdikbud.go.id
                    </li>
                    <li>
                        021-5703303 / 021-57903020
                    </li>
                    <li>
                        021-5733125
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
                <h3 class="menu-footer mb-3">{{strtoupper(__("About"))}}</h3>
                <ul>
                    <li>
                        <a href="{{ route('the-route.'.$lang) }}">{{__("common.the_route")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('the-trail.'.$lang) }}">{{__("common.the_trail")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('the-future.'.$lang) }}">{{__("common.the_future")}}</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
                <h3 class="menu-footer mb-3">{{strtoupper(__("Contents"))}}</h3>
                <ul>
                    <li>
                        <a href="{{ route('articles.'.$lang) }}">{{__("Article")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('photos.'.$lang) }}">{{__("Photo")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('videos.'.$lang) }}">{{__("Video")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('publications.'.$lang) }}">{{__("Publication")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('audios.'.$lang) }}">{{__("Audio")}}</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
                <h3 class="menu-footer mb-3">{{strtoupper(__("Social Media"))}}</h3>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">
                        <a target="_blank" href="https://web.facebook.com/jalurrempahri">
                            <img src="{{ asset('assets/img/icon-media-sosial/icon-facebook.svg') }}" width="25px">
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a target="_blank" href="https://www.youtube.com/channel/UCyhHsv7jCOiE12pGXbkINoA">
                            <img src="{{ asset('assets/img/icon-media-sosial/icon-youtube.svg') }}" width="25px">
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a target="_blank" href="https://www.instagram.com/jalurrempahri/?hl=id">
                            <img src="{{ asset('assets/img/icon-media-sosial/icon-instagram.svg') }}"
                                width="25px">
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a target="_blank" href="https://twitter.com/JalurrempahRI">
                            <img src="{{ asset('assets/img/icon-media-sosial/icon-twitter.svg') }}" width="25px">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="wrap-footer-down">
        <div class="row text-center">
            <div class="col-12">
                <p>{{__("footer.bottom_text")}}</p>
            </div>
        </div>
    </div>
</footer>
