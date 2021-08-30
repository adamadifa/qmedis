@php
$grandtotal = 0;
@endphp
@foreach ($produktemp as $d)
@php
$harga_jual = $d->harga_beli + ($d->harga_beli * ($d->persentase_laba/100));
$total = ($harga_jual * $d->qty)-(($harga_jual * $d->qty) * ($d->diskon/100));
$diskonrupiah = ($harga_jual * $d->qty) * ($d->diskon/100);
$grandtotal += round($total);
@endphp
<tr>
  <td>
    {{$d->kode_produk}}
    <input type="hidden" class="form-control kode_produk" style="text-align:center"
      data-kodeproduk="{{$d->kode_produk}}" value="{{$d->kode_produk}}" name="kode_produk[]" id="kode_produk">
  </td>
  <td>{{$d->nama_produk}}</td>
  <td align="center">
    <input type="text" class="form-control qty" style="text-align:center" data-kodeproduk="{{$d->kode_produk}}"
      value="{{$d->qty}}" name="qty[]" id="qty">
  </td>
  <td>{{$d->satuan}}</td>
  <td align="right">
    <input type="hidden" class="form-control harga_jual" style="text-align:center" "
    value=" {{$harga_jual}}" name="harga_jual[]" id="harga_jual">
    {{number_format($harga_jual,'0','','.')}}
  </td>
  <td align="center">
    <input type="text" class="form-control diskon" style="text-align:center" data-kodeproduk="{{$d->kode_produk}}"
      value="{{number_format($d->diskon,'2',',','.')}}" name="diskon[]" id="diskon">
  </td>
  <td align="center">
    <input type="text" class="form-control diskonrupiah" style="text-align:right" data-kodeproduk="{{$d->kode_produk}}"
      value="{{number_format($diskonrupiah,'0','','.')}}" name="diskonrupiah[]" id="diskonrupiah">
  </td>
  <td align="right" class="total">{{number_format($total,'0','','.')}}</td>
  <td align="center">
    <a href="#" class="btn btn-danger hapus" data-kodeproduk="{{$d->kode_produk}}"><i class="fa fa-trash-o"></i></a>
  </td>
</tr>
@endforeach

<script>
  $(function(){

    // var totalall = "{{$grandtotal}}";

    // function loadgrandtotal(){
    //   $("#grandtotal").text(convertToRupiah(totalall));
    // }

    function loadtotal(){
      $.ajax({
        type:'POST',
        url:'/loadtotalpenjualan',
        data:{_token:"{{ csrf_token() }}"},
        success:function(respond){
          $("#grandtotal").text(respond);
          $("#subtotal").val(respond);
        }
      });
    }
    function loadproduktemp(){
      var id_user = "{{Auth::guard('user')->user()->id}}";
      $.ajax({
        type:'POST',
        url:"/getproduktemp",
        data:{_token:"{{ csrf_token() }}",id_user:id_user},
        cache:false,
        success:function(respond){
          $("#loadproduktemp").html(respond);
          loadtotal();
        }
      });
    }
    //loadgrandtotal();

    $(".hapus").click(function(){
      var kode_produk = $(this).attr("data-kodeproduk");
      $.ajax({
        type:'POST',
        url:'/deleteproduktemp',
        data:{_token: "{{ csrf_token() }}",kode_produk:kode_produk},
        cache:false,
        success:function(respond){
          loadproduktemp();
        }

      })
    });
    function convertToRupiah(number) {
      if (number) {
        var rupiah = "";
        var numberrev = number
          .toString()
          .split("")
          .reverse()
          .join("");
        for (var i = 0; i < numberrev.length; i++)
          if (i % 3 == 0) rupiah += numberrev.substr(i, 3) + ".";
        return (
          rupiah
            .split("", rupiah.length - 1)
            .reverse()
            .join("")
        );
      } else {
        return number;
      }
    }
      var $tblrows = $("#tabelproduktemp tbody tr");
      $tblrows.each(function(index) {
      var $tblrow = $(this);
      $tblrow.find('.qty').on('input', function() {
        var qty = $tblrow.find("[id=qty]").val();
        var diskon = $tblrow.find("[id=diskon]").val();
        var harga_jual = $tblrow.find("[id=harga_jual]").val();
        if (qty.length === 0) {
          var qty = 0;
        } else {
          var qty = parseInt(qty);
        }
        if (diskon.length === 0) {
          var diskon = 0;
        } else {
          var diskon = parseInt(diskon);
        }

        if (harga_jual.length === 0) {
          var harga_jual = 0;
        } else {
          var harga_jual = parseInt(harga_jual);
        }
        var total = (harga_jual * qty) - ((harga_jual*qty)*(diskon/100));
        if (!isNaN(total)) {
          $tblrow.find('.total').text(convertToRupiah(total));
          var grandTotal = 0;
          $(".total").each(function() {
            var stval = parseInt($(this).val());
            grandTotal += isNaN(stval) ? 0 : stval;
          });
        //$('.grdtot').val(grandTotal.toFixed(2));
        }
      });


      $tblrow.find('.diskon').on('input', function() {
        var qty = $tblrow.find("[id=qty]").val();
        var diskon = $tblrow.find("[id=diskon]").val();
        var harga_jual = $tblrow.find("[id=harga_jual]").val();

        if (qty.length === 0) {
          var qty = 0;
        } else {
          var qty = parseInt(qty);
        }
        if (diskon.length === 0) {
          var diskon = 0;
        } else {
          var diskon = parseInt(diskon);
        }

        if (harga_jual.length === 0) {
          var harga_jual = 0;
        } else {
          var harga_jual = parseInt(harga_jual);
        }
        var total = (harga_jual * qty) - ((harga_jual*qty)*(diskon/100));
        var diskonrupiah = (harga_jual*qty)*(diskon/100);
        if (!isNaN(total)) {
          $tblrow.find('.total').text(convertToRupiah(total));
          $tblrow.find('.diskonrupiah').val(convertToRupiah(diskonrupiah));
          var grandTotal = 0;
          $(".total").each(function() {
            var stval = parseInt($(this).val());
            grandTotal += isNaN(stval) ? 0 : stval;
          });
        //$('.grdtot').val(grandTotal.toFixed(2));
        }
      });


      $tblrow.find('.diskonrupiah').on('input', function() {
        var qty = $tblrow.find("[id=qty]").val();
        var diskonrupiah = $tblrow.find("[id=diskonrupiah]").val();
        var harga_jual = $tblrow.find("[id=harga_jual]").val();
        var kode_produk = $tblrow.find("[id=kode_produk]").val();
      
        if (qty.length === 0) {
          var qty = 0;
        } else {
          var qty = parseInt(qty);
        }
        if (diskonrupiah.length === 0) {
          var diskonrupiah = 0;
        } else {
          var diskonrupiah = parseInt(diskonrupiah);
        }

        if (harga_jual.length === 0) {
          var harga_jual = 0;
        } else {
          var harga_jual = parseInt(harga_jual);
        }

        
        var total = (harga_jual * qty) - diskonrupiah;
        var diskonrupiah = (diskonrupiah/(harga_jual*qty)) *100;
        var diskon = diskonrupiah.toFixed(3);
        var diskonshow = diskonrupiah.toFixed(2);
        
        
        if (!isNaN(total)) {
          //alert(total);
          $tblrow.find('.total').text(convertToRupiah(total));
          $tblrow.find('.diskon').val(diskonshow.replace(".",","));

          $.ajax({
            type:'post',
            url:'/updatediskon',
            data:{_token: "{{ csrf_token() }}", kode_produk:kode_produk,diskon:diskon},
            cache:false,
            success:function(respond){
              console.log(respond);
              loadtotal();
            }
          });
          var grandTotal = 0;
          $(".total").each(function() {
            var stval = parseInt($(this).val());
            grandTotal += isNaN(stval) ? 0 : stval;
          });
        //$('.grdtot').val(grandTotal.toFixed(2));
        }
      });
    });

    $(".diskon").keyup(function(){
     var kode_produk = $(this).attr("data-kodeproduk");
     var diskon = $(this).val();
     $.ajax({
      type:'post',
      url:'/updatediskon',
      data:{_token: "{{ csrf_token() }}", kode_produk:kode_produk,diskon:diskon},
      cache:false,
      success:function(respond){
        console.log(respond);
        loadtotal();
      }
     });
    });

   

    $(".qty").keyup(function(){
     var kode_produk = $(this).attr("data-kodeproduk");
     var qty = $(this).val();
     $.ajax({
      type:'post',
      url:'/updateqty',
      data:{_token: "{{ csrf_token() }}", kode_produk:kode_produk,qty:qty},
      cache:false,
      success:function(respond){
        console.log(respond);
        loadtotal();
      }
     });
    });
  });
</script>