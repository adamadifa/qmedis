@foreach ($stokproduk as $d)
<tr>
  <td>{{$loop->iteration}}</td>
  <td>{{$d->lokasi_produk}}</td>
  <td>{{date('d-m-Y',strtotime($d->tgl_expired))}}</td>
  <td align="center">{{$d->kode_batch}}</td>
  <td align="center">{{$d->jml_stok}}</td>
  <td>
    <input type="hidden" id="kode_stok" value="{{$d->kode_stok}}" class="form-control kode_stok" name="kode_stok[]">
    <input type="hidden" id="stok_sistem" value="{{$d->jml_stok}}" class="form-control stok_sistem"
      name="stok_sistem[]">
    <input type="text" id="stok_fisik" value="{{$d->jml_stok}}" class="form-control stok_fisik" name="stok_fisik[]">

  </td>
  <td>
    <input type="text" id="penyesuaian" class="form-control penyesuaian" name="penyesuaian[]">
  </td>
  <td>
    <input type="text" id="catatan" class="form-control catatan" name="catatan[]">
  </td>
  <td align="center">
    <label class="form-check">
      <input class="form-check-input verifikasi" type="checkbox">
    </label>
  </td>
</tr>

@endforeach

<script>
  $(function(){

    $("#formOpname").submit(function(){
      var jmlcheckbox = $(".verifikasi:checkbox").length;
      var jmlchecklist = $(".verifikasi:checkbox:checked").length;

      if(jmlchecklist != jmlcheckbox){
        swal('Warning',"Pastikan Dulu Semua Sudah Di Checklist / Verifikasi","warning");
        return false;
      }
     
    });


    $('.penyesuaian').prop('readonly', true);
    var $tblrows = $("#tabelstok tbody tr");
    $tblrows.each(function(index) {
      var $tblrow = $(this);
      $tblrow.find('.stok_fisik').on('input', function() {
        var stok_sistem = $tblrow.find("[id=stok_sistem]").val();
        var stok_fisik = $tblrow.find("[id=stok_fisik]").val();
        if (stok_sistem.length === 0) {
          var stok_sistem = 0;
        } else {
          var stok_sistem = parseInt(stok_sistem);
        }
        if (stok_fisik.length === 0) {
          var stok_fisik = 0;
        } else {
          var stok_fisik = parseInt(stok_fisik);
        }
        var penyesuaian = stok_fisik - stok_sistem;
        if (!isNaN(penyesuaian)) {
          $tblrow.find('.penyesuaian').val(penyesuaian);
          var grandTotal = 0;
          $(".penyesuaian").each(function() {
            var stval = parseInt($(this).val());
            grandTotal += isNaN(stval) ? 0 : stval;
          });
        //$('.grdtot').val(grandTotal.toFixed(2));
        }
      });
    });
  });
</script>