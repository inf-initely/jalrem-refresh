@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Master Data
@endsection

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid" id="contentWrapper">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <div class="row">
                      <div class="col-6">
                        <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">List Kontributor</h2>
                      </div>
                      <div class="col-6 text-end">
                        <a href="tambah-kontributor.html" class="btn btn-primary">
                          <i class="fa fa-plus mr-1"></i> Tambah
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="listArtikel" class="table" style="width:100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Kontributor</th>
                          <th>Domisili</th>
                          <th>Kategori</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#</td>
                          <td>Ahmad Rifaldi</td>
                          <td>Sulawesi Selatan</td>
                          <td>Umum</td>
                          <td>
                            <a href="edit-konten-artikel.html" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>Fascal Ivandry</td>
                          <td>Sulawesi Selatan</td>
                          <td>Pamong Budaya</td>
                          <td>
                            <a href="edit-konten-artikel.html" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>Nijar Ali</td>
                          <td>Sulawesi Selatan</td>
                          <td>Pamong Budaya</td>
                          <td>
                            <a href="edit-konten-artikel.html" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>Saiful Abdullah</td>
                          <td>Kalimantan Utara</td>
                          <td>Umum</td>
                          <td>
                            <a href="edit-konten-artikel.html" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>Akbar Basith</td>
                          <td>Jakarta</td>
                          <td>Umum</td>
                          <td>
                            <a href="edit-konten-artikel.html" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
@endsection