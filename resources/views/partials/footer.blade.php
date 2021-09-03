@if( Session::get('lg') == 'en' )
<footer>
    <img class="footer-bg-1" src="{{ asset('assets/img/asset-jelajah.png') }}" width="50%">
    <img class="footer-bg-2 d-none" src="{{ asset('assets/img/asset-jelajah2.png') }}" width="50%">
    <div class="container wrap-footer">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-3 footer-content mb-4">
          <img class="logo-footer" src="{{ asset('assets/img/logo-footer-3.png') }}" width="50%">
          <p class="footer-alamat">The Ministry of Education, Culture, Research, and Technology, Jl. Jenderal Sudirman, Senayan, Jakarta 10270</p>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4 footer-content">
          <h3 class="menu-footer mb-3">CONTACT</h3>
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
          <h3 class="menu-footer mb-3">ABOUT</h3>
          <ul>
            <li>
              <a href="{{ route('tentangjalur') }}">The Route</a>
            </li>
            <li>
              <a href="{{ route('tentangjejak') }}">The Trace</a>
            </li>
            <li>
              <a href="{{ route('tentangmasadepan') }}">The Future</a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
          <h3 class="menu-footer mb-3">CONTENTS</h3>
          <ul>
            <li>
              <a href="{{ route('articles') }}">Article</a>
            </li>
            <li>
              <a href="{{ route('photos') }}">Photo</a>
            </li>
            <li>
              <a href="{{ route('videos') }}">Video</a>
            </li>
            <li>
              <a href="{{ route('publications') }}">Publication</a>
            </li>
            <li>
              <a href="{{ route('audios') }}">Audio</a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
          <h3 class="menu-footer mb-3">SOCIAL MEDIA</h3>
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
                <img src="{{ asset('assets/img/icon-media-sosial/icon-instagram.svg') }}" width="25px">
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
          <p>The Ministry of Education, Culture, Research, and Technology, Jl. Jenderal Sudirman, Senayan, Jakarta 10270</p>
        </div>
      </div>
    </div>
  </footer>

  @else
  <footer>
    <img class="footer-bg-1" src="{{ asset('assets/img/asset-jelajah.png') }}" width="50%">
    <img class="footer-bg-2 d-none" src="{{ asset('assets/img/asset-jelajah2.png') }}" width="50%">
    <div class="container wrap-footer">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-3 footer-content mb-4">
          <img class="logo-footer" src="{{ asset('assets/img/logo-footer-3.png') }}" width="50%">
          <p class="footer-alamat">Kompleks Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi, Jalan Jenderal Sudirman, Senayan, Jakarta 10270</p>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4 footer-content">
          <h3 class="menu-footer mb-3">KONTAK</h3>
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
          <h3 class="menu-footer mb-3">TENTANG</h3>
          <ul>
            <li>
              <a href="{{ route('tentangjalur') }}">Jalur</a>
            </li>
            <li>
              <a href="{{ route('tentangjejak') }}">Jejak</a>
            </li>
            <li>
              <a href="{{ route('tentangmasadepan') }}">Masa Depan</a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
          <h3 class="menu-footer mb-3">KONTEN</h3>
          <ul>
            <li>
              <a href="{{ route('articles') }}">Artikel</a>
            </li>
            <li>
              <a href="{{ route('photos') }}">Foto</a>
            </li>
            <li>
              <a href="{{ route('videos') }}">Video</a>
            </li>
            <li>
              <a href="{{ route('publications') }}">Publikasi</a>
            </li>
            <li>
              <a href="{{ route('audios') }}">Audio</a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
          <h3 class="menu-footer mb-3">MEDIA SOSIAL</h3>
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
                <img src="{{ asset('assets/img/icon-media-sosial/icon-instagram.svg') }}" width="25px">
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
          <p>Kompleks Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi, Jalan Jenderal Sudirman, Senayan, Jakarta 10270</p>
        </div>
      </div>
    </div>
  </footer>
  @endif
