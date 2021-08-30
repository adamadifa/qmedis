<script src="https://code.jquery.com/jquery-1.11.2.min.js"
  integrity="sha256-Ls0pXSlb7AYs7evhd+VLnWsZ/AqEHcXBeMZUycz/CcA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="{{asset('assets/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/dist/libs/selectize/dist/js/standalone/selectize.min.js')}}"></script>
<script src="{{asset('assets/dist/libs/flatpickr/dist/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/dist/libs/inputmask/jquery.masknumber.min.js')}}"></script>
<script src="{{asset('assets/dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/dist/libs/jqvmap/dist/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/basic/ckeditor.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


<script src="{{asset('assets/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<!-- Tabler Core 
  -->
<script src="{{asset('assets/dist/js/tabler.min.js')}}"></script>

<script>
  document.body.style.display = "block"
</script>
<script>
  $(function() {
    function toggleZoomScreen() {
      var width = window.screen.width;
      if (width <= 1366) {
        document.body.style.zoom = "80%";
      }
    }
    toggleZoomScreen();
  });
</script>
@stack('myscript')