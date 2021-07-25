@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Publikasi
@endsection

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid" id="contentWrapper">
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12 mb-3">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Bahasa</h2>
                </div>
                <div class="card-body">
                  <form>
                    <div class="mb-3">
                      <label for="judulArtikelBahasa" class="form-label">Judul</label>
                      <input type="text" class="form-control" id="judulArtikelBahasa" placeholder="masukkan judul artikel" value="lorem ipsum">
                    </div>
                    <div class="mb-3">
                      <label for="isiArtikelBahasa" class="form-label">Isi Konten</label>
                      <textarea class="form-control" id="isiArtikelBahasa" rows="8">Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-12 mb-3">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">English</h2>
                </div>
                <div class="card-body">
                  <form>
                    <div class="mb-3">
                      <label for="judulArtikelEnglish" class="form-label">Judul</label>
                      <input type="text" class="form-control" id="judulArtikelEnglish" placeholder="masukkan judul artikel" value="lorem ipsum">
                    </div>
                    <div class="mb-3">
                      <label for="isiArtikelEnglish" class="form-label">Isi Konten</label>
                      <textarea class="form-control" id="isiArtikelEnglish" rows="8">Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</textarea>
                    </div>
                  </form>
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
                      <img class="preview mb-3 text-center" src="assets/img/noimage.jpg" />
                    </div>
                  </div>
                  <div class="mb-4">
                    <input class="form-control" id="uploadThumbnail" type="file" data-preview=".preview">
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
                  <form>
                    <div class="mb-3">
                      <label for="lokasiArtikel" class="form-label">Lokasi</label>
                      <select id="pilihLokasi" class="form-select select2-style" aria-label="Default select example">
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
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Jenis Rempah 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              Jenis Rempah 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Jenis Rempah 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              Jenis Rempah 2
                            </label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Jenis Rempah 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              Jenis Rempah 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Jenis Rempah 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              Jenis Rempah 2
                            </label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Jenis Rempah 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              Jenis Rempah 2
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Jenis Rempah 1
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                              Jenis Rempah 2
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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
        </div>
        <!-- /.container-fluid -->
        
@endsection