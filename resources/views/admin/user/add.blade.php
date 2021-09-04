@extends('admin.layout.app')

@section('title')
  ADMIN - Jalur Rempah
@endsection

@section('topbar-title')
    Konten - User Data
@endsection

@section('content')
        <form method="POST" action="{{ route('admin.user.store') }}">
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
                        <input type="text" required name="nama" class="form-control" id="namapenulis">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" required name="email" class="form-control" id="email">
                      </div>
                      <div class="mb-3">
                        <label for="domisili" class="col-form-label">Domisili</label>
                        <select id="domisili" name="domisili" required class="form-select select2-style" aria-label="Default select example">
                          <option value="" selected>Pilih Lokasi</option>
                          @foreach( $lokasi as $l )
                            <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                          @endforeach
                        </select>
                      </div>
                      {{-- <div class="mb-3">
                        <label for="atribusi" class="col-form-label">Role</label>
                        <input type="text" class="form-control" id="atribusi">
                      </div> --}}
                      <div class="mb-3">
                        <label for="atribusi" class="col-form-label">Password</label>
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
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <script>
    $("#sidebarToggle").click(function() {
    $("#topNavbar").toggleClass("shrink");
    $("#contentWrapper").toggleClass("content-shrink");
    $("#logoNavbar").toggleClass("logo-shrink")
    $("footer").toggleClass("footer-shrink")
    });
    </script>
    <script>
    $(document).on('click', '#btnSimpan', function(e) {
    Swal.fire({
        title: 'Ingin Menyimpan User?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Simpan`,
        denyButtonText: `Batal`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
        Swal.fire('Tersimpan!', '', 'success')
        } else if (result.isDenied) {
        Swal.fire('Dibatalkan', '', 'info')
        }
    })
    });
    </script>
    <script>
    $("#domisili").select2({
    placeholder: "Pilih Domisili",
    allowClear: true
    });
    </script>
    <script>
    $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
    });
    </script>
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