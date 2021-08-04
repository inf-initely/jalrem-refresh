@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Master Data
@endsection

@section('content')
    <form method="post" action="{{ route('admin.rempah.store') }}">
        @csrf
          <!-- Begin Page Content -->
          <div class="container-fluid" id="contentWrapper">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Jenis Rempah</h2>
                  </div>
                  <div class="card-body">
                    
                      <div class="mb-3">
                        <label for="namaRempah" class="form-label">Nama Rempah</label>
                        <input required name="nama_rempah" type="text" class="form-control" id="namaRempah" placeholder="masukkan nama rempah">
                      </div>
                      <div class="mb-3">
                        <label for="keteranganRempah" class="form-label">Keterangan Rempah</label>
                        <textarea required name="keterangan_rempah" class="form-control" id="isiArtikelBahasa" rows="8"></textarea>
                        <!-- <div id="toolbar-container"></div> -->
                        <!-- This container will become the editable. -->
                        <!-- <div id="editor" style="border: 1px solid #F5F6F9;">
                          <p>This is the initial editor content.</p>
                        </div> -->
                      </div>
                    </form>
                  </div>
                  <div class="card-footer text-end">
                    <button class="btn btn-success" id="btnSimpan">
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