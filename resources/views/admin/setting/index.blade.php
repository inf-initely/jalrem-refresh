@extends('admin.layout.app')

@section('content')
    <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
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
                <h2 class="m-0 font-weight-bold text-gray-800 sub-judul">Pengaturan Profil</h2>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <h2 class="sub-judul text-center mb-4">Foto Profil</h2>
                      <div class="row justify-content-center">
                        <div class="col-lg-12 text-center mb-3">
                          <img class="preview-profil-photo avatar-photo text-center" src="{{ asset('storage/assets/user/' . auth()->user()->photo) }}" />
                        </div>
                        <div class="col-lg-12 mb-4">
                          <input name="photo" class="form-control" id="uploadThumbnail" type="file" data-preview=".avatar-photo" />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <h2 class="sub-judul mb-4">Informasi</h2>
                      <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input name="name" type="text" class="form-control" id="nama" value="{{ auth()->user()->nama }}" placeholder="isi nama yang akan ditampilkan disini" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input name="email" type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled="" />
                        </div>
                        
                      </div>
                      <div class="mb-3 row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="role" value="{{ auth()->user()->role }}" disabled="" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="bio" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea name="bio" id="" cols="30" rows="7" class="form-control">{{ auth()->user()->bio }}</textarea>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="pass1" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#buatPassword">Buat Password Baru</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer text-end">
                <button class="btn btn-success" id="btnSimpan"><i class="fa fa-save mr-1"></i> Simpan</button>
                <button class="btn btn-danger"><i class="fa fa-times mr-1"></i> Batal</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="buatPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Password Baru</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="passwordBaru" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="passwordBaru" />
              </div>
              <div class="mb-3">
                <label for="ulangPassword" class="form-label">Ulangi Password</label>
                <input name="password_conf" type="password" class="form-control" id="ulangPassword" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </form>
@endsection

@section('js')
    <script>
    // $(document).on("click", "#btnSimpan", function (e) {
    //   Swal.fire({
    //     title: "Simpan Pengaturan?",
    //     showDenyButton: true,
    //     showCancelButton: false,
    //     confirmButtonText: `Simpan`,
    //     denyButtonText: `Batal`,
    //   }).then((result) => {
    //     /* Read more about isConfirmed, isDenied below */
    //     if (result.isConfirmed) {
    //       Swal.fire("Tersimpan!", "", "success");
    //     } else if (result.isDenied) {
    //       Swal.fire("Dibatalkan", "", "info");
    //     }
    //   });
    // });

    $(document).on("click", "#btnSimpanPassword", function (e) {
        Swal.fire({
          title: "Simpan Password?",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: `Simpan`,
          denyButtonText: `Batal`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire("Tersimpan!", "", "success");
          } else if (result.isDenied) {
            Swal.fire("Dibatalkan", "", "info");
          }
        });
      });
    </script>
    <script>
    $(function () {
      $("input[data-preview]").change(function () {
        var input = $(this);
        var oFReader = new FileReader();
        oFReader.readAsDataURL(this.files[0]);
        oFReader.onload = function (oFREvent) {
          $(input.data("preview")).attr("src", oFREvent.target.result);
        };
      });
    });
  </script>
  <script>
    $(".toggle-password").click(function () {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  </script>
@endsection
