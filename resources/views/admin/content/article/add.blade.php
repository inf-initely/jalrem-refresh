@extends('admin.layout.app')

@section('title')
    ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Artikel
@endsection

@section('content')
          <!-- Begin Page Content -->
          <form method="post" action="{{ route('admin.article.store') }}">
          @csrf
          <div class="container-fluid" id="contentWrapper">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
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
                        <textarea class="form-control" name="konten_indo" id="isiArtikelBahasa" rows="8"></textarea>
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
                        <textarea class="form-control" name="konten_english" id="isiArtikelEnglish" rows="8"></textarea>
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
                          <option selected>Pilih Lokasi</option>
                          <option value="1">Lokasi 1</option>
                          <option value="2">Lokasi 2</option>
                          <option value="3">Lokasi 3</option>
                          <option value="4">Lokasi 4</option>
                          <option value="5">Lokasi 5</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Jenis Rempah</label>
                        <div class="px-3 row">
                          <div class="col-lg-4">
                            @foreach( $rempahs as $r )
                            <div class="form-check">
                              <input class="form-check-input-{{ $r->id }}" type="checkbox" name="rempah-{{ $r->id }}" value="{{ $r->id }}" id="flexCheckDefault-{{ $r->id }}"">
                              <label class="form-check-label-{{ $r->id }}"" for="flexCheckDefault-{{ $r->id }}"">
                                {{ $r->jenis_rempah }}
                              </label>
                            </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mb-5 text-center">
                <button class="btn btn-lg btn-secondary mr-3">
                  Save as Draft
                </button>
                <button class="btn btn-lg btn-success">
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