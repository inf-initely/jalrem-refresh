<div id="share" class="mt-4">
    <h3>Bagikan:</h3>
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item">
        <a target="_blank" href="https://wa.me/?text={{ route( $konten_name .'_detail', $konten->slug) }}">
          <img src="{{ asset('assets/img/icon-media-sosial/icon-whatsapp.svg') }}" width="30px">
        </a>
      </li>
      <li class="list-group-item">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route( $konten_name .'_detail', $konten->slug) }}">
          <img src="{{ asset('assets/img/icon-media-sosial/icon-facebook.svg') }}" width="30px">
        </a>
      </li>
      <li class="list-group-item">
        <a target="_blank" href="https://social-plugins.line.me/lineit/share?url={{ route($konten_name .'_detail', $konten->slug) }}">
          <img src="{{ asset('assets/img/icon-media-sosial/icon-line.svg') }}" width="30px">
        </a>
      </li>
      <li class="list-group-item">
        <a target="_blank" blank="" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route( $konten_name .'_detail', $konten->slug) }}&amp;title={{ $konten->judul_indo }}">
          <img src="{{ asset('assets/img/icon-media-sosial/icon-linkedin.svg') }}" width="30px">
        </a>
      </li>
      <li class="list-group-item">
        <a target="_blank" href="https://twitter.com/intent/tweet?text={{ $konten->judul_indo }}&amp;url={{ route( $konten_name .'_detail', $konten->slug) }}">
          <img src="{{ asset('assets/img/icon-media-sosial/icon-twitter.svg') }}" width="30px">
        </a>
      </li>
    </ul>
  </div>
