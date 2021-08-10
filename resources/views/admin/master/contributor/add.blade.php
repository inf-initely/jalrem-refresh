@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Master Data
@endsection

@section('content')
    <form method="post" action="{{ route('admin.contributor.store') }}">
        @csrf
          <!-- Begin Page Content -->
        <div class="container-fluid" id="contentWrapper">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Profil Kontributor</h2>
                  </div>
                  <div class="card-body">
                      <div class="mb-3">
                        <label for="namapenulis" class="col-form-label">Nama Penulis</label>
                        <input required name="nama_penulis" type="text" class="form-control" id="namapenulis">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input required name="email" type="email" class="form-control" id="email">
                      </div>
                      <div class="mb-3">
                        <label for="domisili" class="col-form-label">Domisili</label>
                        <select required name="domisili" id="domisili" class="form-select select2-style" aria-label="Default select example">
                          <option value="">Pilih Lokasi</option>
                          @foreach( $lokasi as $l )
                            <option value="{{ $l->nama_lokasi }}">{{ $l->nama_lokasi }}</option>
                          @endforeach
                          {{-- <optgroup label="Dalam Negeri">
                            <option value="1">Lokasi 1</option>
                            <option value="2">Lokasi 2</option>
                            <option value="3">Lokasi 3</option>
                            <option value="4">Lokasi 4</option>
                            <option value="5">Lokasi 5</option>
                          </optgroup>
                          <optgroup label="Luar Negeri">
                            <option value="1a">Location 1</option>
                            <option value="2a">Location 2</option>
                            <option value="3a">Location 3</option>
                            <option value="4a">Location 4</option>
                            <option value="5a">Location 5</option>
                          </optgroup> --}}
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="atribusi" class="col-form-label">Artribusi</label>
                        <input required name="atribusi" type="text" class="form-control" id="atribusi">
                      </div>
                      <div class="mb-3">
                        <label for="atribusi2" class="col-form-label">Kategori</label>
                        <select required name="kategori" class="form-select" aria-label="Default select example">
                          <option value="" selected></option>
                          <option value="Umum">Umum</option>
                          <option value="Pamong Budaya">Pamong Budaya</option>
                        </select>
                      </div>
                  </div>
                  <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success" id="btnSimpan">
                      <i class="fa fa-save mr-1"></i> Simpan
                    </button>
                    <button class="btn btn-danger">
                      <i class="fa fa-times mr-1"></i> Batal
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </form>
@endsection