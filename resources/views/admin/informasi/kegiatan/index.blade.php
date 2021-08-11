@extends('admin.layout.app')

@section('title')
    ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Kegiatan
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
                  <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">List Kegiatan</h2>
                </div>
                <div class="col-6 text-end">
                  <a href="{{ route('admin.kegiatan.add') }}" class="btn btn-primary">
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
                    <th>Judul Kegiatan</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $kegiatan as $k )
                  <tr>
                    <td>#</td>
                    <td>{{ $k->created_at->isoFormat('DD/MM/YYYY'); }}</td>
                    <td>{{ $k->judul_indo }}</td>
                    <td>{{ $k->penulis != 'admin' ? $k->kontributor_relasi->nama : 'admin' }}</td>
                    <td>
                      <span class="badge rounded-pill py-1 px-3 {{ $k->status == 'publikasi' ? 'bg-success' : 'bg-secondary' }}">{{ $k->status == 'publikasi' ? 'Aktif' : 'Draft' }}</span>
                    </td>
                    <td>
                      <a href="{{ route('event_detail', $k->id) }}" class="btn btn-sm btn-outline-primary">
                        View
                      </a>
                      <a href="{{ route('admin.kegiatan.edit', $k->id) }}" class="btn btn-sm btn-outline-info">
                        Edit
                      </a>
                      <a href="{{ route('admin.kegiatan.delete', $k->id) }}" class="btn btn-sm btn-outline-danger btn-hapus">
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