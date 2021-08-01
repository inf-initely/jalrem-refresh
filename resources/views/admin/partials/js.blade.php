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
{{-- <script>
  window.onload = function() {
    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
      var filesInput = document.getElementById("files");

      filesInput.addEventListener("change", function(event) {

        var files = event.target.files; //FileList object
        var output = document.getElementById("result");

        for (var i = 0; i < files.length; i++) {
          var file = files[i];

          //Only pics
          if (!file.type.match('image'))
            continue;

          var picReader = new FileReader();

          picReader.addEventListener("load", function(event) {

            var picFile = event.target;

            var div = document.createElement("div");

            div.className = "col-lg-4";

            div.innerHTML = "<img class='output_multiple_image mb-3' src='" + picFile.result + "'" +
              "title='" + picFile.name + "'/>";

            output.insertBefore(div, null);

          });

          //Read the image
          picReader.readAsDataURL(file);
        }

      });
      $("#btnReset").on("click", function() {
        // console.log($(this).attr('src'));
        $("#result div").remove();
      });
    } else {
      console.log("Your browser does not support File API");
    }
  }
  </script> --}}
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