@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Foto
@endsection

@section('content')
      <form method="post" action="{{ route('admin.photo.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Begin Page Content -->
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
                        <input required type="text" name="judul_indo" class="form-control" id="judulArtikelBahasa" placeholder="masukkan judul artikel">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                        <textarea required class="form-control editor" name="konten_indo" editor" id="isiArtikelBahasa" rows="8"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="metaDesID" class="form-label">Meta Description</label>
                        <textarea required name="meta_indo" class="form-control" id="metaDesID" rows="2" maxlength="160" placeholder="masukkan meta description"></textarea>
                        <little>maks 160 karakter</little>
                      </div>
                      <div class="mb-3">
                        <label for="keywordsID" class="form-label">Keywords</label>
                        <input required name="keywords_indo" id="keywordsID" type="text" class="form-control tagin">
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
                        <input name="judul_english" type="text" class="form-control" id="judulArtikelEnglish" placeholder="masukkan judul artikel">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                        <textarea name="konten_english" class="form-control editor" id="isiArtikelEnglish" rows="8"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="metaDesEN" class="form-label">Meta Description</label>
                        <textarea name="meta_english" class="form-control" id="metaDesEN" rows="2" maxlength="160" placeholder="masukkan meta description"></textarea>
                        <little>maks 160 karakter</little>
                      </div>
                      <div class="mb-3">
                        <label for="keywordsEN" class="form-label">Keywords</label>
                        <input name="keywords_english" id="keywordsEN" type="text" class="form-control tagin" data-separator=",">
                        <little>gunakan tombol "," (koma) untuk memisahkan keyword</little>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Thumbnail</h2>
                  </div>
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <img class="preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                      </div>
                    </div>
                    <div class="mb-4">
                      <input required name="thumbnail" class="form-control" id="uploadThumbnail" type="file" data-preview=".preview">
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
                <div class="card shadow mb-4" id="containerSliderFoto">
                  <div class="card-header py-3">
                    <div class="row">
                      <div class="col-6">
                        <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Slider</h2>
                      </div>
                      <div class="col-6 text-end">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPanduan">
                          <i class="fa fa-book"></i> Panduan
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body row" id="fotoSliderBody">
                    <div class="col-md-12 wrapper-foto-slider">
                      <div class="row">
                        <div class="col-sm-4">
                          <img class="sliderPreview" src="{{ asset('assets/admin/img/noimage.jpg') }}" width="100%">
                        </div>
                        <div class="col-sm-7">
                          <div class="row">
                            <div class="col-12 mb-2">
                              <input required class="form-control" name="slider_foto[]" id="uploadThumbnail" type="file" data-preview=".sliderPreview">
                            </div>
                            <div class="col-12 mb-2">
                              <textarea name="caption_slider_foto[]" required maxlength="100" class="form-control" id="captionFoto" rows="2" placeholder="masukkan caption disini"></textarea>
                              <little><sup>*</sup> maksimsal 100 karakter</little>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-1">
                          <button type="button" class="btn btn-danger btn-hapus-foto" disabled="">
                            <i class="fa fa-trash-alt"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" id="tambahFoto">
                      <i class="fa fa-plus"></i> Tambah Foto
                    </button>
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
                        <select id="pilihLokasi" name="id_lokasi" class="form-select select2-style" name="id_lokasi" aria-label="Default select example">
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
                              <input class="form-check-input" type="checkbox" name="rempah[]" value="{{ $r->id }}" id="flexCheckDefault"">
                              <label class="form-check-label"" for="flexCheckDefault"">
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
                              <input class="form-check-input" type="checkbox" name="kategori_show[]" value="{{ $k->id }}" id="flexCheckDefault"">
                              <label class="form-check-label" for="flexCheckDefault"">
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
                              <input class="form-check-input-contributor" type="checkbox" name="penulis" value="Kontributor Umum/Pamong" id="flexCheckDefault-contributor">
                              <label class="form-check-label-contributor" for="flexCheckDefault-contributor">
                                Kontributor Umum/Pamong
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input-slider" type="checkbox" name="slider_utama" value="slider_utama" id="flexCheckDefault-slider">
                              <label class="form-check-label-slider" for="flexCheckDefault-slider">
                                Tampilkan di Slider Utama
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="lokasiArtikel" class="form-label">Jenis Kontributor</label>
                        <select name="contributor_type" class="form-select mb-4" aria-label="select kontributor">
                          <option value="" selected>Jenis Kontributor</option>
                          <option value="Kontributor Pamong Budaya">Kontributor Pamong Budaya</option>
                          <option value="Kontributor Umum">Kontributor Umum</option>
                        </select>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Foto Slider</h2>
                  </div>
                  <div class="card-body ">
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <img class="mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                      </div>
                    </div>
                    <div class="mb-4">
                      <input class="form-control" name="slider" id="uploadSlider" type="file" data-preview=".preview">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-5 text-center">
                <button name="draft" value="draft" class="btn btn-lg btn-secondary mr-3">
                  Save as Draft
                </button>
                <button name="publish" value="publish" class="btn btn-lg btn-success">
                  Publish
                </button>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </form>
@endsection