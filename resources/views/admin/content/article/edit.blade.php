@extends('admin.layout.app')

@section('title')
    ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Artikel
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.article.update', $artikel->id) }}" enctype="multipart/form-data">
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
                    <label for="judulArtikelBahasa" class="form-label" >Judul</label>
                    <input type="text" name="judul_indo" class="form-control" value="{{ $artikel->judul_indo }}" id="judulArtikelBahasa" placeholder="masukkan judul artikel">
                  </div>
                  <div class="mb-3">
                    <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                    <textarea class="form-control editor" name="konten_indo" id="isiArtikelBahasa" rows="8">{{ $artikel->konten_indo }}</textarea>
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
                    <input type="text" name="judul_english" class="form-control" id="judulArtikelEnglish" placeholder="masukkan judul artikel" value="{{ $artikel->judul_english }}">
                  </div>
                  <div class="mb-3">
                    <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                    <textarea class="form-control editor" name="konten_english" id="isiArtikelEnglish" rows="8">{{ $artikel->judul_english }}</textarea>
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
                    <img class="preview mb-3 text-center" src="{{ asset('/assets/artikel/thumbnail/' . $artikel->thumbnail) }}" />
                  </div>
                </div>
                <div class="mb-4">
                  <input class="form-control" name="thumbnail" id="uploadThumbnail" type="file" data-preview=".preview">
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
                    <select id="pilihLokasi" name="id_lokasi" class="form-select select2-style" aria-label="Default select example">
                      <option value="" selected>Pilih Lokasi</option>
                      @foreach( $lokasi as $l ) 
                        @if( $l->id == $artikel->id_lokasi )
                          <option selected value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                        @else
                          <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="isiArtikelEnglish" class="form-label">Jenis Rempah</label>
                    <div class="px-3 row">
                      @php $ids = $artikel->rempahs->pluck('id'); @endphp
                      @foreach( $rempahs as $r )
                      <div class="col-lg-4">
                        <div class="form-check">
                          @php
                          $checked = ''; 
                          foreach( $ids as $id ) {
                            if( $id == $r->id ) {
                              $checked = 'checked';
                            }
                          } 
                          @endphp
                          <input class="form-check-input" {{ $checked }} name="rempah[]" type="checkbox" value="{{ $r->id }}" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            {{ $r->jenis_rempah }}
                          </label>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 mb-5 text-center">
            <button type="submit" value="draft" class="btn btn-lg btn-secondary mr-3">
              Save as Draft
            </button>
            <button type="submit" value="publish" class="btn btn-lg btn-success">
              Publish
            </button>
          </div>
        </div>
      </div>
    </form>
      <!-- /.container-fluid -->
@endsection