@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Publikasi
@endsection

@section('content')
        <!-- Begin Page Content -->
        <form method="post" action="{{ route('admin.publication.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid" id="contentWrapper">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  @if (count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                      {{ $errors->first() }} 
                    </div>
                  @endif
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Bahasa</h2>
                  </div>
                  <div class="card-body">
                      <div class="mb-3">
                        <label for="judulArtikelBahasa" class="form-label">Judul</label>
                        <input required value="{{ old('judul_indo') }}" type="text" name="judul_indo" class="form-control" id="judulArtikelBahasa" placeholder="masukkan judul artikel">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                        <textarea required class="form-control editor" name="konten_indo" id="editor" rows="8">{{ old('konten_indo') }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="metaDesID" class="form-label">Meta Description</label>
                        <textarea name="meta_indo" class="form-control" id="metaDesID" rows="2" maxlength="160" placeholder="masukkan meta description">{{ old('meta_indo') }}</textarea>
                        <little>maks 160 karakter</little>
                      </div>
                      <div class="mb-3">
                        <label for="keywordsID" class="form-label">Keywords</label>
                        <input name="keywords_indo" value="{{ old('keywords_indo') }}" id="keywordsID" type="text" class="form-control tagin">
                        <little>gunakan tombol "," (koma) untuk memisahkan keyword</little>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">English</h2>
                  </div>
                  <div class="card-body">
                      <div class="mb-3">
                        <label for="judulArtikelEnglish" class="form-label">Judul</label>
                        <input value="{{ old('judul_english') }}" type="text" class="form-control" name="judul_english" id="judulArtikelEnglish" placeholder="masukkan judul artikel">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                        <textarea class="form-control editor" name="konten_english" id="isiArtikelEnglish" rows="8">{{ old('konten_english') }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="metaDesEN" class="form-label">Meta Description</label>
                        <textarea name="meta_english" class="form-control" id="metaDesEN" rows="2" maxlength="160" placeholder="masukkan meta description">{{ old('meta_english') }}</textarea>
                        <little>maks 160 karakter</little>
                      </div>
                      <div class="mb-3">
                        <label for="keywordsEN" class="form-label">Keywords</label>
                        <input value="{{ old('keywords_english') }}" name="keywords_english" id="keywordsEN" type="text" class="form-control tagin" data-separator=",">
                        <little>gunakan tombol "," (koma) untuk memisahkan keyword</little>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Konten Sematan</h2>
                  </div>
                  <div class="card-body">
                    <div class="mb-3">
                      <label for="kontenSematan" class="form-label">Konten</label>
                      <input required type="text" class="form-control" id="kontenSematan" name="iframe" placeholder="<iframe>....</iframe>">
                      <little>gunakan field ini untuk menyematkan flipsnack atau google form</little>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Thumbnail Artikel</h2>
                  </div>
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <img class="preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                      </div>
                    </div>
                    <div class="mb-4"> 
                      <input required class="form-control" id="uploadThumbnail" name="thumbnail" type="file" data-preview=".preview" accept="image/png, image/jpeg">
                    </div>
                    <div class="mb-3">
                      <h5>Panduan unggah gambar</h5>
                      <ol>
                        <li>Resolusi gambar yang di unggah, <b>1280 x 720</b></li>
                        <li>Ukuran gambar tidak lebih dari <b>1 Mb</b></li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Tag Artikel</h2>
                  </div>
                  <div class="card-body">
                      <div class="mb-3">
                        <label for="lokasiArtikel" class="form-label">Lokasi</label>
                        <select id="pilihLokasi" class="form-select select2-style" name="id_lokasi" aria-label="Default select example">
                          <option value="" selected>Pilih Lokasi</option>
                          @foreach( $lokasi as $l )
                            <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Jenis Rempah</label>
                        <div class="px-3 row">
                          @foreach( $rempahs as $r )
                          <div class="col-lg-4">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="rempah[]" value="{{ $r->id }}" id="flexCheckDefault">
                              <label class="form-check-label" for="flexCheckDefault">
                                {{ $r->jenis_rempah }}
                              </label>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Kategori</label>
                        <div class="px-3 row">
                          <div class="col-lg-4">
                            @foreach( $kategori_show as $k )
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="kategori_show[]" value="{{ $k->id }}" id="flexCheckDefault">
                              <label class="form-check-label" for="flexCheckDefault">
                                {{ $k->isi }}
                              </label>
                            </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Pengaturan</label>
                        <div class="px-3 row">
                          <div class="col-lg-4">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="contributor" value="kontributor umum/pamong budaya" id="peng-kontributor">
                              <label class="form-check-label" for="peng-kontributor">
                                Kontributor Umum/Pamong Budaya
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="slider_utama" value="slider_utama" id="peng-slider">
                              <label class="form-check-label" for="peng-slider">
                                Tampilkan di Slider Utama
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div id="fotoSlider" class="col-lg-12 mb-3" style="display: none;">
                <div class="card shadow mb-4">
                 <div class="card-header py-3">
                   <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Foto Slider</h2>
                 </div>
                 <div class="card-body ">
                   <div class="row">
                     <div class="col-lg-12 text-center">
                       <img class="foto-slider preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                     </div>
                   </div>
                   <div class="mb-4">
                     <input class="form-control" name="slider" id="uploadSlider" type="file" data-preview=".foto-slider" accept="image/png, image/jpeg" >
                   </div>
                    <div class="mb-3">
                      <h5>Panduan unggah gambar</h5>
                      <ol>
                        <li>Resolusi gambar yang di unggah, <b>1280 x 720</b></li>
                        <li>Ukuran gambar tidak lebih dari <b>1 Mb</b></li>
                      </ol>
                    </div>
                 </div>
               </div>
             </div>
             <div id="kontributor" class="col-lg-12 mb-3" style="display: none;">
               <div class="card shadow mb-4">
                 <div class="card-header py-3">
                   <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Kontributor</h2>
                 </div>
                 <div class="card-body ">
                   <div class="mb-3">
                     <label for="jenisKontributor" class="form-label">Jenis Kontributor</label>
                       <select name="contributor_type" class="form-select mb-4" aria-label="select kontributor">
                         <option value="" selected>Jenis Kontributor</option>
                         <option value="pamong budaya">Kontributor Pamong Budaya</option>
                         <option value="umum ">Kontributor Umum</option>
                       </select>
                   </div>
                   <div class="mb-3">
                     <label for="namaKontributor" class="form-label">Nama Kontributor</label>
                     <select id="namaKontributor" name="id_kontributor" class="form-select select2-style" aria-label="Default select example">
                       <option value="" selected>Pilih Kontributor</option>
                       @foreach( $kontributor as $k ) 
                         <option value="{{ $k->id }}">{{ $k->nama }}</option>
                       @endforeach
                     </select>
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-12 mb-3">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Tanggal Konten</h2>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class='col-lg-6'>
                      <label for="tanggalPublish" class="form-label">Tanggal Publish</label>
                      <input required name="publish_date" type="date" class="form-control" id="tanggalPublish">
                    </div>
                    <div class='col-lg-6'>
                      <label for="waktuPublish" class="form-label">Waktu Publish</label>
                      <input required name="publish_time" type="time" class="form-control" id="waktuPublish">
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-lg-12 mb-5 text-center">
                <button type="submit" value="draft" name="draft" class="btn btn-lg btn-secondary mr-3">
                  Save as Draft
                </button>
                <button type="submit" value="publish" name="publish" class="btn btn-lg btn-success">
                  Publish
                </button>
              </div>
            </div>
          <!-- /.container-fluid -->
         </div>
        <!-- End of Main Content -->
        </div>
      </form>
        
@endsection

@section('js')
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
    $(document).ready(function() {
      $("#peng-kontributor").click(function() {
        $("#kontributor").toggle();
        $("#namaKontributor").select2();
      });
      $("#peng-slider").click(function() {
        $("#fotoSlider").toggle();

      });

    });
  </script>
@endsection
