@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Publikasi
@endsection

@section('content')
<form method="POST" action="{{ route('admin.publication.update', $publikasi->id) }}" enctype="multipart/form-data">
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
                  <input required type="text" name="judul_indo" class="form-control" value="{{ $publikasi->judul_indo }}" id="judulArtikelBahasa" placeholder="masukkan judul artikel">
                </div>
                <div class="mb-3">
                  <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                  <textarea required class="form-control editor" name="konten_indo" id="isiArtikelBahasa" rows="8">{{ $publikasi->konten_indo }}</textarea>
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
                  <input type="text" name="judul_english" class="form-control" id="judulArtikelEnglish" placeholder="masukkan judul artikel" value="{{ $publikasi->judul_english }}">
                </div>
                <div class="mb-3">
                  <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                  <textarea class="form-control editor" name="konten_english" id="isiArtikelEnglish" rows="8">{{ $publikasi->judul_english }}</textarea>
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
                  <img class="preview mb-3 text-center" src="{{ asset('/assets/publikasi/thumbnail/' . $publikasi->thumbnail) }}" />
                </div>
              </div>
              <div class="mb-4">
                <input required class="form-control" name="thumbnail" id="uploadThumbnail" type="file" data-preview=".preview">
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
                  <select id="pilihLokasi" name="id_lokasi" class="form-select select2-style" name="id_lokasi" aria-label="Default select example">
                    <option value="" selected>Pilih Lokasi</option>
                    @foreach( $lokasi as $l ) 
                      @if( $l->id == $publikasi->id_lokasi )
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
                    @php $ids = $publikasi->rempahs->pluck('id'); @endphp
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
                <div class="mb-3">
                  <label for="isiArtikelEnglish" class="form-label">Kategori</label>
                  <div class="px-3 row">
                    <div class="col-lg-4">
                      @php $ids = $publikasi->kategori_show->pluck('id'); @endphp
                      @foreach( $kategori_show as $k )
                        <div class="form-check">
                          @php
                            $checked = ''; 
                            foreach( $ids as $id ) {
                              if( $id == $k->id ) {
                                $checked = 'checked';
                              }
                            } 
                            @endphp
                            <input class="form-check-input" {{ $checked }} name="kategori_show[]" type="checkbox" value="{{ $k->id }}" id="flexCheckDefault">
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
                        @if( $publikasi->penulis == 'Kontributor Umum/Pamong' )
                          <input checked class="form-check-input" type="checkbox" name="contributor" 
                          value="contributor" id="flexCheckDefault"">
                        @else
                          <input class="form-check-input" type="checkbox" name="contributor" 
                          value="contributor" id="flexCheckDefault"">
                        @endif
                          <label class="form-check-label"" for="flexCheckDefault"">
                          Kontributor Umum/Pamong
                        </label>
                      </div>
                      <div class="form-check">
                        @if( $publikasi->slider_utama == null )
                          <input class="form-check-input" type="checkbox" name="slider_utama" value="slider_utama" id="flexCheckDefault"">
                        @else
                          <input checked class="form-check-input" type="checkbox" name="slider_utama" value="slider_utama" id="flexCheckDefault"">
                        @endif
                        <label class="form-check-label" for="flexCheckDefault"">
                          Tampilkan di Slider Utama
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="lokasiArtikel" class="form-label">Jenis Kontributor</label>
                  <select name="contributor_type" class="form-select mb-4" aria-label="select kontributor">
                    @if( $publikasi->contributor == 'Kontributor Pamong Budaya' )
                      <option value="" selected>Jenis Kontributor</option>
                      <option selected value="Kontributor Pamong Budaya">Kontributor Pamong Budaya</option>
                      <option value="Kontributor Umum">Kontributor Umum</option>
                    @elseif( $publikasi->contributor == 'Kontributor Umum' )
                      <option value="" selected>Jenis Kontributor</option>
                      <option value="Kontributor Pamong Budaya">Kontributor Pamong Budaya</option>
                      <option selected value="Kontributor Umum">Kontributor Umum</option>
                    @else
                      <option value="" selected>Jenis Kontributor</option>
                      <option value="Kontributor Pamong Budaya">Kontributor Pamong Budaya</option>
                      <option value="Kontributor Umum">Kontributor Umum</option>
                    @endif
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
                  @if( $publikasi->slider_file == null )
                    <img class="preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                  @else
                    <img class="preview mb-3 text-center" src="{{ asset('assets/publikasi/slider/' . $publikasi->slider_file) }}" />
                  @endif
                </div>
              </div>
              <div class="mb-4">
                <input class="form-control" name="slider" id="uploadSlider" type="file" data-preview=".preview">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 mb-5 text-center">
          <button type="submit" name="draft" value="draft" class="btn btn-lg btn-secondary mr-3">
            Save as Draft
          </button>
          <button type="submit" name="publish" value="publish" class="btn btn-lg btn-success">
            Publish
          </button>
        </div>
      </div>
    </div>
  </form>
    <!-- /.container-fluid -->
@endsection