@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Kiriman Kontributor
@endsection

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid" id="contentWrapper">
            <!-- Page Heading -->
            <div class="row">
              <div class="col-lg-12 mb-3">
                @if(Session::has('message'))
                  <div class="alert alert-danger" role="alert">
                    {{ Session::get('message') }}
                  </div>
                @endif
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <div class="row">
                      <div class="col-6">
                        <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">List Kiriman Kontributor</h2>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="listArtikel" class="table" style="width:100%">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Penulis</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach( $artikel as $a )
                          <tr>
                            <td>#</td>
                            <td>{{ $a->created_at->isoFormat('YYYY/MM/DD'); }}</td>
                            <td>{{ $a->kontributor_relasi->nama }}</td>
                            <td>{{ $a->judul_indo }}</td>
                            <td> 
                              <span class="badge rounded-pill py-1 px-3 {{ $a->kontributor_relasi->kategori == 'pamong' ? 'bg-success' : 'bg-secondary' }}">{{ $a->kontributor_relasi->kategori }}</span>
                            </td>
                            <td>
                              <a href="{{ route('article_detail', $a->slug) }}" class="btn btn-sm btn-outline-primary">
                                View
                              </a>
                              <a href="{{ route('admin.article.edit', $a->id) }}" class="btn btn-sm btn-outline-info">
                                Edit
                              </a>
                              <button class="btn btn-sm btn-outline-danger btn-hapus" data-id="{{ $a->id }}">
                                Hapus
                              </button>
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

@section('js')
  <script>
    $(document).on('click', '.btn-hapus', function(e) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          let id = $(this).attr("data-id");
          window.location.href = `/admin/master/kontributor/delete/${id}`
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    });
    </script>
@endsection