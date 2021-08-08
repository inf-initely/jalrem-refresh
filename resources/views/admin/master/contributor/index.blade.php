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
                        <a href="{{ route('admin.contributor.add') }}" class="btn btn-primary">
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
                          <th>Tanggal</th>
                          <th>Nama Kontributor</th>
                          <th>Domisili</th>
                          <th>Kategori</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach( $kontributor as $k )
                        <tr>
                          <td>#</td>
                          <td>{{ $k->created_at->isoFormat('DD/MM/YYYY'); }}</td>
                          <td>{{ $k->nama }}</td>
                          <td>{{ $k->domisili }}</td>
                          <td>{{ $k->kategori }}</td>
                          <td>
                            <a href="{{ route('admin.contributor.edit', $k->id) }}" class="btn btn-sm btn-outline-info">
                              Edit
                            </a>
                            <a href="{{ route('admin.contributor.delete', $k->id) }}" class="btn btn-sm btn-outline-danger btn-hapus">
                              Hapus
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
@endsection