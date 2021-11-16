@extends('layout.app')

@section('title')
    Semua Video - Jalur Rempah Kemdikbudristek Republik Indonesia
@endsection

@section('content')
<header id="hero">
    <img class="hero-img-2" src="assets/img/hero/hero-4.jpg">
    <div class="text-hero-2">
      <div class="">
        <div class="col-lg-12 text-center">
          <h1>Video</h1>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div id="content">
      <section id="sejarahRempah">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <section id="tabLine">
                <div class="row justify-content-center" id="videos">
                  @foreach( $video as $v )
                  <div class="col-md-12 col-lg-4 mb-4">
                    <div class="card no-border card-artikel">
                      <iframe width="100%" height="190" src="//www.youtube.com/embed/{{ $v->youtube_key }}?rel=0&amp;fs=0&amp;showinfo=0" frameborder="0" allowfullscreen>
                      </iframe>
                      <a class="stretched-link lightbox" href="{{ route('video_detail', $v->slug) }}"></a>
                      <div class="card-body">
                        <p class="card-text">{{ $v->judul_indo }}</p>
                        @foreach( $v->kategori_show as $ks )
                            @if( $ks->isi == 'Indepth' )
                            <span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>
                            @endif
                        @endforeach
                        @foreach( $v->kategori_show as $ks )
                            @if( $ks->isi == 'Jurnal Artikel' )
                            <span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>
                            @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="d-flex justify-content-center">
                  <div class="loader"></div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/ytdefer.min.js') }}"></script>
<script>
$(document).ready(function() {
  if ($(window).width() <= 1000) {
    $(".navbar").addClass("bg-nav");
    $(".navbar").removeClass("bg-trans");
  }
});
$(window).scroll(function() {

  if ($(window).width() >= 1000) {
    var scroll = $(window).scrollTop();
    //>=, not <=
    if (scroll >= 50) {
      //clearHeader, not clearheader - caps H
      $(".navbar").addClass("bg-nav");
      $(".navbar").removeClass("bg-trans");
    } else {
      $(".navbar").addClass("bg-trans");
      $(".navbar").removeClass("bg-nav");
    }
  } else {
    $(".navbar").addClass("bg-nav");
    $(".navbar").removeClass("bg-trans");
  }

}); //missing );
</script>
<script>
$(function() {

  var minimized_elements = $('p.minimize');

  minimized_elements.each(function() {
    var t = $(this).text();
    if (t.length < 90) return;

    $(this).html(
      t.slice(0, 90) + '<span>...' +
      '<span style="display:none;">' + t.slice(90, t.length)
    );

  });

});
</script>

<script>
  window.addEventListener('load', ytdefer_setup);
</script>

<script>
  var page = 1
  var mentok = false;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
          if( !mentok ) {
          page++;
          loadMoreData(page);
          }
      }
  });
  $('.loader').hide();
  
  function loadMoreData(page) {
      $.ajax({
          url: '?page=' + page,
          type: 'GET',
          beforeSend: function() {
          $('.loader').show();
          }
      })
      .done(function(data)
      {
          // console.log(data.data[0].profile.photo_url);
          // if(data.html == " "){
          //       // $('.ajax-load').html("No more records found");
          //       return;
          // }
          
          for( let i = 0; i < data.data.length; i++ ) {
            let kategori_show = data?.data[i]?.kategori_show?.map(item => {
                if( item == 'Indepth' ) {
                    return '<span class="badge rounded-pill py-1 px-3 bg-success">Indepth</span>'
                } else if( item == 'Jurnal Artikel' ) {
                    return '<span class="badge rounded-pill py-1 px-3 bg-secondary">Jurnal Artikel</span>'
                }
                return '<div></div>';
            }).toString().replaceAll(',', ' ')

            if( kategori_show == undefined ) {
                kategori_show = '';
            }
            $('#videos').append(`
            <div class="col-md-12 col-lg-4 mb-4">
              <div class="card no-border card-artikel">
                <iframe width="100%" height="190" src="//www.youtube.com/embed/${data.data[i].youtubekey}?rel=0&amp;fs=0&amp;showinfo=0" frameborder="0" allowfullscreen>
                </iframe>
                <a class="stretched-link lightbox" href="/video/${data.data[i].slug}"></a>
                <div class="card-body">
                  <p class="card-text">${data.data[i].judul}</p>
                  ${kategori_show}
                </div>
              </div>
            </div>
                `)
            }
            if( data.data.length <= 0 ) {
                mentok = true;
            }
            $('.loader').hide();
      })
      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
          alert('server not responding...');
      });
  }
  </script>
      <script>
      $('.menu-toggle').click(function(){
         $(".nav2").toggleClass("mobile-nav");
         $(".nav2").removeClass("temp-pos");
         $(this).toggleClass("is-active");
      });
    </script><img src="">
@endsection
