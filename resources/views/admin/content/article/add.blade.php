@extends('admin.layout.app')

@section('title')
    ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Artikel
@endsection

@section('content')
          <!-- Begin Page Content -->
          <form method="post" action="{{ route('admin.article.store') }}" enctype="multipart/form-data">
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
                        <input type="text" name="judul_indo" class="form-control" id="judulArtikelBahasa" placeholder="masukkan judul artikel">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                        <textarea class="form-control editor" name="konten_indo" id="editor" rows="8"></textarea>
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
                        <input type="text" class="form-control" name="judul_english" id="judulArtikelEnglish" placeholder="masukkan judul artikel">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                        <textarea class="form-control editor" name="konten_english" id="isiArtikelEnglish" rows="8"></textarea>
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
                      <input class="form-control" id="uploadThumbnail" name="thumbnail" type="file" data-preview=".preview">
                    </div>
                    <div class="mb-3">
                      <h5>Panduan unggah gambar</h5>
                      <ol>
                        <li>Lorem Ipsum Dolor Sit Amet</li>
                        <li>Lorem Ipsum Dolor Sit Amet</li>
                        <li>Lorem Ipsum Dolor Sit Amet</li>
                        <li>Lorem Ipsum Dolor Sit Amet</li>
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
                              <input class="form-check-input-{{ $r->id }}" type="checkbox" name="rempah[]" value="{{ $r->id }}" id="flexCheckDefault-{{ $r->id }}"">
                              <label class="form-check-label-{{ $r->id }}"" for="flexCheckDefault-{{ $r->id }}"">
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
                              <input class="form-check-input-{{ $k->id }}" type="checkbox" name="kategori_show[]" value="{{ $k->id }}" id="flexCheckDefault-{{ $k->id }}"">
                              <label class="form-check-label-{{ $k->id }}"" for="flexCheckDefault-{{ $k->id }}"">
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
                              <input class="form-check-input-contributor" type="checkbox" name="contributor" value="contributor" id="flexCheckDefault-contributor"">
                              <label class="form-check-label-contributor"" for="flexCheckDefault-contributor"">
                                Kontributor Umum/Pamong
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input-slider" type="checkbox" name="slider" value="slider" id="flexCheckDefault-slider"">
                              <label class="form-check-label-slider"" for="flexCheckDefault-slider"">
                                Tampilkan di Slider Utama
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="lokasiArtikel" class="form-label">Jenis Kontributor</label>
                        <select class="form-select mb-4" aria-label="select kontributor">
                          <option selected>Jenis Kontributor</option>
                          <option value="1">Kontributor Pamong Budaya</option>
                          <option value="2">Kontributor Umum</option>
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
                        <img class="preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                      </div>
                    </div>
                    <div class="mb-4">
                      <input class="form-control" name="slider" id="uploadSlider" type="file" data-preview=".preview">
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