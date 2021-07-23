@extends('admin.layout.app')

@section('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ADMIN - Jalur Rempah</title>
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link href="{{ asset('assets/css/my-style.css' ) }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">
@endsection

@section('content')
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      @include('admin.partials.sidebar')
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          @include('admin.partials.topbar')
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
                        <a href="tambah-konten-artikel.html" class="btn btn-primary">
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
        </div>
        <!-- End of Main Content -->
        @include('admin.partials.footer')
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin untuk melakukan Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">dengan memilih "logout" anda akan keluar dari website ini</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../public/login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
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
    $(document).ready(function() {
      var t = $('#listArtikel').DataTable({
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": [0, 3]
        }],
        "order": [
          [1, 'asc']
        ]
      });
  
      t.on('order.dt search.dt', function() {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
        });
      }).draw();
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
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    });
    </script>
  </body>
@endsection