<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Kontributor</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('assets/kontributor/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="{{ asset('assets/kontributor/img/logo/favicon.PNG') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/kontributor/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">
</head>

<body>
  <nav class="navbar navbar-light bg-light bg-gradient-primary sticky-top">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand">
          <img src="{{ asset('assets/img/logo/logo-3.png') }}" height="50px">
      </a>
      <div class="d-flex">
        <h2 class="sub-judul"><i class="fa fa-edit"></i> Kontributor</h2>
      </div>
    </div>
  </nav>
  <form method="POST" action="{{ route('article_upload_contributor') }}" enctype="multipart/form-data">
    @csrf
  <section id="jelajah">
    <div class="container pb-5 pt-5">
      <img class="item-jelajah item-jelajah-1" src="assets/kontributor/img/item-daun-1.svg">
      <img class="item-jelajah item-jelajah-2" src="assets/kontributor/img/item-daun-2.svg">
        <div class="col-lg-12 mb-4">
          <div class="card shadow">
            <div class="card-header py-3">
              <h2 class="m-0 font-weight-bold text-gray-800 sub-judul-form">Konten Artikel</h2>
            </div>
            @if (count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                {{ $errors->first() }} 
              </div>
            @endif
            <div class="card-body ">
              <div class="mb-3">
                <label for="judulartikel" class="col-form-label">Judul Artikel</label>
                <input required value="{{ old('judul_indo') }}" name="judul_indo" type="text" class="form-control" id="judulartikel">
              </div>
              <div class="mb-3">
                <label for="isiArtikel" class="col-form-label">Isi Artikel/Foto/Video</label>
                <div class="form-floating">
                  <textarea required class="form-control editor" name="konten_indo" id="isiArtikelEnglish" rows="8">{{ old('konten_indo') }}</textarea>
                </div>
              </div>
              <div class="mb-3">
                <label for="thumbnail" class="col-form-label">Foto Utama</label>
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <img class="foto-utama preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                  </div>
                </div>
                <input required type="file" name="thumbnail" class="form-control" id="thumbnail" data-preview=".foto-utama" accept="image/png, image/jpeg">
                <div class="mb-3">
                  <h5>Panduan unggah gambar</h5>
                  <ol>
                    <li>Resolusi gambar yang di unggah, <b>1280 x 720</b></li>
                    <li>Ukuran gambar tidak lebih dari <b>1 Mb</b></li>
                  </ol>
                </div>
              </div>
              <div class="mb-3">
                <label for="linkItem" class="col-form-label">Link/Foto/Video/Dsb(Link Google Drive)</label>
                <input value="{{ old('link') }}" type="text" name="link" class="form-control" id="linkItem">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 mb-4">
          <div class="card shadow">
            <div class="card-header py-3">
              <h2 class="m-0 font-weight-bold text-gray-800 sub-judul-form">Profil Penulis</h2>
            </div>
            <div class="card-body ">
              <div class="mb-3">
                <label for="namapenulis" class="col-form-label">Nama Penulis</label>
                <input value="{{ old('penulis') }}" name="penulis" required type="text" class="form-control" id="penulis">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Email</label>
                <input value="{{ old('email') }}" name="email" required type="email" class="form-control" id="email">
              </div>
              <div class="mb-3">
                <label for="domisili" class="col-sm-2 col-form-label">Domisili</label> <br>
                <select required id="domisili" name="domisili" class="form-select select2-style" aria-label="Default select example">
                  <option value="" selected>Pilih Lokasi</option>
                  @foreach ($lokasi as $l)
                    <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>    
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="atribusi" class="col-form-label">Atribusi</label>
                <input value="{{ old('atribusi') }}" required name="atribusi" type="text" class="form-control" id="atribusi">
              </div>
              <div class="mb-3">
                <label for="atribusi2" class="col-sm-2 col-form-label">Kategori</label>
                <select required name="kategori" class="form-select" aria-label="Default select example">
                  <option value="" selected></option>
                  <option value="umum">Umum</option>
                  <option value="pamong budaya">Pamong Budaya</option>
                </select>
              </div>
              <div class="form-group mt-4 mb-4">
                <div class="captcha" style="display: flex;">
                    <input id="captcha" type="text" style="width: 150px;" class="form-control" placeholder="masukkan Captcha" name="captcha">
                    <span style="margin-left: 5px; margin-right: 5px;">{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                        &#x21bb;
                    </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="col-lg-12 text-center">
        <button class="btn btn-lg btn-success btn-primary-jarem">
          Kirim Tulisan
        </button>
      </div>
    </div>
  </section>
  </form>
  <footer>
    <div class="container-fluid">
      <div class="row text-center">
        <div class="col-12 bg-gradient-primary text-white p-2 pt-3">
          <p>Copyright © Jalur Rempah Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi 2021</p>
        </div>
      </div>
    </div>
  </footer>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="assets/kontributor/vendor/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  {{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/decoupled-document/ckeditor.js"></script> --}}
  <script>
    $(function() {
      $("input[data-preview]").change(function() {
        var input = $(this);
        var oFReader = new FileReader();
        oFReader.readAsDataURL(this.files[0]);
        oFReader.onload = function(oFREvent) {
          $(input.data('preview')).attr('src', oFREvent.target.result);
        };
      });
    })
  </script>
  <script>
  $("#domisili").select2({
    placeholder: "Pilih Domisili",
    allowClear: true
  });
  </script>
  <script>
  DecoupledEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
      const toolbarContainer = document.querySelector('#toolbar-container');

      toolbarContainer.appendChild(editor.ui.view.toolbar.element);
    })
    .catch(error => {
      console.error(error);
    });
  </script>

  <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
  <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
  </script>
  {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> --}}
  <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
  <script>
  $('textarea.editor').ckeditor(options);
  </script>
  <script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
  
  </script>
  <script>
    $('.menu-toggle').click(function(){
       $(".nav2").toggleClass("mobile-nav");
       $(".nav2").removeClass("temp-pos");
       $(this).toggleClass("is-active");
    });
  </script>

</html>
