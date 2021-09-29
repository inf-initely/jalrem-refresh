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
<script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/tagin.min.js') }}"></script>
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
      "searchable": true,
      "orderable": true,
      "targets": [0, 2]
    }],
    "order": [
      [1, 'desc']
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
  for (const el of document.querySelectorAll('.tagin')) {
    tagin(el)
  }
</script>

