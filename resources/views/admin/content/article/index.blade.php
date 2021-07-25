@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
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
                        <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">List Artikel</h2>
                      </div>
                      <div class="col-6 text-end">
                        <a href="{{ route('admin.article.add') }}" class="btn btn-primary">
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
                          <th>Judul Artikel</th>
                          <th>Penulis</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>#</td>
                          <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
                          <td>Anonim</td>
                          <td>
                            <a href="../public/detail-berita.html" class="btn btn-sm btn-outline-primary">
                              View
                            </a>
                            <a href="{{ route('admin.article.edit') }}" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td>#</td>
                          <td>Lorem Ipsum</td>
                          <td>Anonim</td>
                          <td>
                            <a href="../public/detail-berita.html" class="btn btn-sm btn-outline-primary">
                              View
                            </a>
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
                          <td>Source undefine</td>
                          <td>Anonim</td>
                          <td>
                            <a href="../public/detail-berita.html" class="btn btn-sm btn-outline-primary">
                              View
                            </a>
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
                          <td>Source undefine</td>
                          <td>Anonim</td>
                          <td>
                            <a href="../public/detail-berita.html" class="btn btn-sm btn-outline-primary">
                              View
                            </a>
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
                          <td>Source undefine</td>
                          <td>Anonim</td>
                          <td>
                            <a href="../public/detail-berita.html" class="btn btn-sm btn-outline-primary">
                              View
                            </a>
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