@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Foto
@endsection

@section('content')
        <form method="POST" action="{{ route('admin.photo.update', $foto->id) }}" enctype="multipart/form-data">
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
                        <input required type="text" name="judul_indo" class="form-control" id="judulArtikelBahasa" placeholder="masukkan judul artikel" value="{{ $foto->judul_indo }}">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                        <textarea required class="form-control editor" name="konten_indo" id="isiArtikelBahasa" rows="8">{{ $foto->konten_indo }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="metaDesID" class="form-label">Meta Description</label>
                        <textarea required name="meta_indo" class="form-control" id="metaDesID" rows="2" maxlength="160" placeholder="masukkan meta description">{{ $foto->meta_indo }}</textarea>
                        <little>maks 160 karakter</little>
                      </div>
                      <div class="mb-3">
                        <label for="keywordsID" class="form-label">Keywords</label>
                        <input value="{{ $foto->keywords_indo }}" required name="keywords_indo" id="keywordsID" type="text" class="form-control tagin">
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
                        <input type="text" name="judul_english" class="form-control" id="judulArtikelEnglish" placeholder="masukkan judul artikel" value="{{ $foto->judul_english }}">
                      </div>
                      <div class="mb-3">
                        <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                        <textarea class="form-control editor" name="konten_english" id="isiArtikelEnglish" rows="8">{{ $foto->konten_english }}</textarea>
                      </div>
                      <div class="mb-3">
                        <label for="metaDesEN" class="form-label">Meta Description</label>
                        <textarea name="meta_english" class="form-control" id="metaDesEN" rows="2" maxlength="160" placeholder="masukkan meta description">{{ $foto->meta_english }}</textarea>
                        <little>maks 160 karakter</little>
                      </div>
                      <div class="mb-3">
                        <label for="keywordsEN" class="form-label">Keywords</label>
                        <input value="{{ $foto->keywords_english }}" name="keywords_english" id="keywordsEN" type="text" class="form-control tagin" data-separator=",">
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
                        <img class="preview mb-3 text-center" src="{{ asset('assets/foto/thumbnail/' .$foto->thumbnail) }}" />
                      </div>
                    </div>
                    <div class="mb-4">
                      <input class="form-control" id="uploadThumbnail" type="file" data-preview=".preview">
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
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Slider Foto</h2>
                  </div>
                  <div class="card-body row">
                    <div class="col-lg-6">
                      <input id="files" type="file" multiple />
                    </div>
                    <div class="col-lg-6 text-right">
                      <button id="btnReset" class="btn btn-danger">
                        <i class="fa fa-retweet mr-2"></i> Reset
                      </button>
                    </div>
                    <div class="row">
                      @foreach( unserialize($foto->slider_foto) as $s )
                        <div class="col-lg-4">
                          <img class="output_multiple_image mb-3" src="{{ asset('assets/foto/slider_foto/' . $s) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
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
                            @if( $l->id == $foto->id_lokasi )
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
                          @php $ids = $foto->rempahs->pluck('id'); @endphp
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
                            @php $ids = $foto->kategori_show->pluck('id'); @endphp
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
                              @if( $foto->penulis == 'Kontributor Umum/Pamong' )
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
                              @if( $foto->slider_utama == null )
                                <input class="form-check-input" type="checkbox" name="slider_utama" value="slider_utama" id="flexCheckDefault"">
                              @else
                                <input checked class="form-check-input" type="checkbox" name="slider_utama" value="slider_utama" id="flexCheckDefault"">
                              @endif
                              <label class="form-check-label-slider"" for="flexCheckDefault-slider"">
                                Tampilkan di Slider Utama
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="lokasiArtikel" class="form-label">Jenis Kontributor</label>
                        <select name="contributor_type" class="form-select mb-4" aria-label="select kontributor">
                          @if( $foto->contributor == 'Kontributor Pamong Budaya' )
                            <option value="" selected>Jenis Kontributor</option>
                            <option selected value="Kontributor Pamong Budaya">Kontributor Pamong Budaya</option>
                            <option value="Kontributor Umum">Kontributor Umum</option>
                          @elseif( $foto->contributor == 'Kontributor Umum' )
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
                        @if( $foto->slider_file == null )
                          <img class="preview mb-3 text-center" src="{{ asset('assets/admin/img/noimage.jpg') }}" />
                        @else
                          <img class="preview mb-3 text-center" src="{{ asset('assets/foto/slider/' . $foto->slider_file) }}" />
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