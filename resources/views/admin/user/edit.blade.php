@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - User Data
@endsection

@section('content')
        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
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
                    <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Profil User</h2>
                  </div>
                  <div class="card-body">
                      <div class="mb-3">
                        <label for="namapenulis" class="col-form-label">Nama</label>
                        <input type="text" value="{{ $user->nama }}" required name="nama" class="form-control" id="namapenulis">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" value="{{ $user->email }}" required name="email" class="form-control" id="email">
                      </div>
                      <div class="mb-3">
                        <label for="domisili" class="col-form-label">Domisili</label>
                        <select id="domisili" name="domisili" required class="form-select select2-style" aria-label="Default select example">
                          <option value="" selected>Pilih Lokasi</option>
                          @foreach( $lokasi as $l )
                            @if( $l->id == $user->lokasi->id )
                                <option value="{{ $l->id }}" selected>{{ $l->nama_lokasi }}</option>
                            @else
                                <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      {{-- <div class="mb-3">
                        <label for="atribusi" class="col-form-label">Role</label>
                        <input type="text" class="form-control" id="atribusi">
                      </div> --}}
                      <div class="mb-3">
                        <label for="atribusi" class="col-form-label">Password(Kosongkan jika tidak diganti)</label>
                        <div class="input-group mb-4">
                          <input id="inputPassword" type="password" name="password" class="form-control" placeholder="masukkan password" aria-label="password" aria-describedby="icon-pass">
                          <span class="input-group-text" id="icon-pass">
                            <i toggle="#inputPassword" class="fa  fa-eye toggle-password"></i>
                          </span>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success" id="btnSimpan">
                      <i class="fa fa-save mr-1"></i> Simpan
                    </button>
                    <a href="javascript:history.back()" class="btn btn-danger">
                      <i class="fa fa-times mr-1"></i> Batal
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </form>
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