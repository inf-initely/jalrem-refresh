@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - Suara
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
                      <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">List Suara</h2>
                    </div>
                    <div class="col-6 text-end">
                      <a href="{{ route('admin.audio.add') }}" class="btn btn-primary">
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
                        <th>Judul Artikel</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $audio as $a )
                      <tr>
                        <td>#</td>
                        <td>{{ $a->created_at->isoFormat('DD/MM/YYYY') }}</td>
                        <td>{{ $a->judul_indo }}</td>
                        <td>{{ $a->penulis }}</td>
                        <td>
                          <span class="badge rounded-pill py-1 px-3 {{ $a->status == 'publikasi' ? 'bg-success' : 'bg-secondary' }}">{{ $a->status == 'publikasi' ? 'Aktif' : 'Draft' }}</span>
                        </td>
                        <td>
                          <a href="#" class="btn btn-sm btn-outline-primary">
                            View
                          </a>
                          <a href="{{ route('admin.audio.edit', $a->id) }}" class="btn btn-sm btn-outline-info">
                            Edit
                          </a>
                          <a href="{{ route('admin.audio.delete', $a->id) }}" class="btn btn-sm btn-outline-danger btn-hapus">
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