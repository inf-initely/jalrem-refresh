<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('assets/js/tagin.min.js') }}"></script>
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
var i = 1;
  var x = 1;
  $("#tambahFoto").click(function() {
    i++;
    if (x < 10) {
      x++;
      document.querySelector('#fotoSliderBody').insertAdjacentHTML(
        'beforeend',
        `<div class="col-md-12 wrapper-foto-slider" data-id="` + i + `">
            <div class="row">
              <div class="col-sm-4">
                <img src="{{ asset('assets/admin/img/noimage.jpg') }}" width="100%" class="sliderPreview` + i + `" name="preview-slider` + i + `">
              </div>
              <div class="col-sm-7">
                <div class="row">
                  <div class="col-12 mb-2">
                    <input required class="form-control" name="slider_foto[]" id="uploadThumbnail" type="file" data-preview=".sliderPreview` + i + `" name="uploadThumbnail` + i + `">
                  </div>
                  <div class="col-12 mb-2">
                    <textarea name="caption_slider_foto[]"  required maxlength="100" class="form-control" id="captionFoto" rows="2" placeholder="masukkan caption disini" name="captionFoto` + i + `"></textarea>
                    <little><sup>*</sup> maksimsal 100 karakter</little>
                  </div>
                </div>
              </div>
              <div class="col-sm-1">
                <button class="btn btn-danger btn-hapus-foto" data-id="` + i + `">
                  <i class="fa fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>`
      )
    } else {
      alert("Sudah melebihi batas")
    }
    console.log(x);


  });

  $('#fotoSliderBody').on('click', '.btn-hapus-foto', function(e) {
    x--;
    console.log(x);
    let id = $(this).data('id');
    // alert(id);
    $('.wrapper-foto-slider[data-id="' + id + '"]').remove();
  });
  </script>
  <script>
  $(function() {
    $("input[data-preview]").change(function() {
      var input = $(this);
      var oFReader = new FileReader();
      oFReader.readAsDataURL(this.files[0]);
      oFReader.onload = function(oFREvent) {
        $(input.data('preview')).attr('src', oFREvent.target.result);
      };
    });
  })
  </script>

<script>
  for (const el of document.querySelectorAll('.tagin')) {
    tagin(el)
  }
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