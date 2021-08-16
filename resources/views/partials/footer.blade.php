<footer>
    <img class="footer-bg-1" src="{{ asset('assets/img/asset-jelajah.png') }}" width="50%">
    <img class="footer-bg-2 d-none" src="{{ asset('assets/img/asset-jelajah2.png') }}" width="50%">
    <div class="container wrap-footer">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-3 footer-content mb-4">
          <img class="logo-footer" src="{{ asset('assets/img/logo-footer.png') }}" width="70%">
          <p class="footer-alamat">Kompleks Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi, Jalan Jenderal Sudirman, Senayan, Jakarta 10270</p>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4 footer-content">
          <h3 class="menu-footer mb-4">KONTAK</h3>
          <ul>
            <li>
              <p>jalurrempah@kemdikbud.go.id</p>
            </li>
            <li>
              <p>021-5703303 / 021-57903020</p>
            </li>
            <li>
              <p>021-5733125</p>
            </li>
          </ul>
        </div>
        <div class="col-12 col-md-6 col-lg-2 mb-4 footer-content">
          <h3 class="menu-footer">TENTANG</h3>
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
          <h3 class="menu-footer">KONTEN</h3>
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
          <h3 class="menu-footer">MEDIA SOSIAL</h3>
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
