@include('layouts.style')

<style>
    body {
        background-color: #ffffff !important;
    }

    .box {
        position: relative;
        border-radius: 3px;
        background: #ffffff;

        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    }

    .box-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        padding: 10px;
    }

    .box-header:before,
    .box-body:before,
    .box-footer:before,
    .box-header:after,
    .box-body:after,
    .box-footer:after {
        content: " ";
        display: table;
    }

    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .box-header:after,
    .box-body:after,
    .box-footer:after {
        clear: both;
    }

    .box-header:before,
    .box-body:before,
    .box-footer:before,
    .box-header:after,
    .box-body:after,
    .box-footer:after {
        content: " ";
        display: table;
    }

    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .box-control {
        background-color: #f4f4f4;
        min-height: 180px;
        position: relative;
    }

    /* .resTable {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  } */
    #tabelproduktemp tr th:nth-child(1) {
        width: 1%;
        white-space: nowrap;
    }

    #tabelproduktemp tr th:nth-child(3) {
        width: 5%;
        white-space: nowrap;
    }

    #tabelproduktemp tr th:nth-child(4) {
        width: 1%;
        white-space: nowrap;
    }

    #tabelproduktemp tr td:nth-child(5) {
        width: 1%;
        white-space: nowrap;
    }

    #tabelproduktemp tr th:nth-child(6) {
        width: 5%;
        white-space: nowrap;
    }

    #tabelproduktemp tr td:nth-child(7) {
        width: 10%;
        white-space: nowrap;
    }

    #tabelproduktemp tr td:nth-child(8) {
        width: 5%;
        white-space: nowrap;
    }

    #tabelproduktemp tr td:nth-child(9) {
        width: 5%;
        white-space: nowrap;
    }

    .responsive {
        min-height: .01%;
        overflow-x: auto;
    }

    h1,
    h2,
    p,
    a {
        font-family: var(--tblr-font-sans-serif);
        font-weight: bold;
    }

    .jam-digital-malasngoding {
        overflow: hidden;
        width: 200px;
        margin: 20px auto;
        margin-left: 10px;
        /* border: 5px solid #efefef; */
    }

    .kotak {
        float: left;
        width: 50px;
        height: 50px;
        background-color: #189fff;
        margin-left: 10px;
    }

    .jam-digital-malasngoding p {
        color: #ffffff;
        font-size: 36px;
        text-align: center;
        margin-bottom: 5px;
    }
</style>
<form name="autoSumForm" autocomplete="off" action="/penjualan/store" class="formValidate form-horizontal"
    id="formValidate" method="POST">
    @csrf
    <div class="box box-info main-body" style="box-shadow: none;height:488px">
        <div class="box-header section-head" style="padding-bottom: 0px !important; height: auto">
            <div class="pull-left logo">
                <img src="{{asset('qmedis/css/logo2.png')}}" alt=""
                    style="width: 200px; margin-left: 15px; margin-top:10px">
            </div>
            <div class="pull-left" style="margin-top: 20px; margin-left: 10px;">
                <a href="/dashboard" class="btn btn-success"><i class="fa fa-home"></i></a>
                <button type="button" id="reset" class="btn btn-warning" style="margin:5px 5px 5px 5px"><i
                        class="fa fa-refresh"></i></button> </div>

            <div class="pull-left"
                style="margin-left: 10px;padding-right: 10px !important; margin-top: 20px; border-right: 2px rgba(0,0,0,.4) solid">
                <h6 class="h3" style="margin-top: 3.5px; margin-bottom: 5px;">Kasir :
                    {{Auth::guard('user')->user()->name}}</h6>
                <h6 class="h3" style="margin-top: 0;">{{date("d-m-Y")}}</h6>
            </div>
            <div class="pull-left">
                <div class="jam-digital-malasngoding">
                    <div class="kotak">
                        <p id="jam"></p>
                    </div>

                    <div class="kotak">
                        <p id="menit"></p>
                    </div>
                    <div class="kotak">
                        <p id="detik"></p>
                    </div>
                </div>
            </div>
            <div class="pull-right  box-grandtotal"
                style="width: 50%; border: 1px rgba(0,0,0,.1) solid; background-color:#dff0d8; margin-top:10px">
                <h1 align="center" id="grandtotal"
                    style="margin-right: 5px; margin-top: 10px; padding-right: 5px; font-size: 50px; text-align: right;">
                </h1>
            </div>
        </div>
        <div class="box-body section-main" style="height:auto;">
            @include('layouts.notification')
            <div class="box-info" style="border: 1px rgba(0,0,0,.1) solid !important;">
                <div class="row" id="frmcariObat" style="margin-top:5px">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" id="barcode" name="produk" class="form-control" autocomplete="off"
                                    placeholder="Ketik Kode Obat, Nama Obat / Scan Barcode Obat [F2]">
                                <span class="input-group-btn">
                                    <button type="button" id="caribarcodebutton" class="btn btn-info wahyu"><i
                                            class="fa fa-search"></i>
                                        Cari</button>
                                </span>
                            </div>
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="grid-view" id="w2">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="responsive" style="height: 80%">
                                <table class="table table-bordered table-striped resTable" id="tabelproduktemp">
                                    <thead class="thead-none">
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th style="text-align:center">Qty</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th style="text-align:center">Diskon(%)</th>
                                            <th>Diskon(Rp)</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadproduktemp">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body section-footer" style="padding-top: 0px !important;height: 201px;">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="progress card-progress">
                            <div class="progress-bar bg-green" style="width: 20%" role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100">
                                <span class="visually-hidden">20% Complete</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="#">Kategori Harga</a>
                            </h3>
                            <div>
                                @foreach ($persentase_laba as $d)
                                <label class="form-check">
                                    <input class="form-check-input" @if ($d->id_persentaselaba=="2")
                                    checked
                                    @endif type="radio" value="{{$d->persentase}}" name="kategori_harga">
                                    <span class="form-check-label">{{ucfirst(strtolower($d->kategori_laba))}}
                                        ({{$d->persentase}})
                                        %</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">No. Faktur</label>
                        <div class="col">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/calendar.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" class="form-control" placeholder="No. Faktur" value="Auto" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Lokasi</label>
                        <div class="col">
                            <select name="id_lokasiproduk" id="id_lokasiproduk" class="form-select">
                                @foreach ($lokasiproduk as $d)
                                <option value="{{$d->id_lokasiproduk}}">{{$d->lokasi_produk}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Pelanggan</label>
                        <div class="col">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/customer.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" class="form-control" name="id_customer" id="id_customer"
                                    placeholder="Pelanggan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="form-label col-3 col-form-label">Apotek</label>
                        <div class="col">
                            <select name="kode_apotek" id="kode_apotek" class="form-select">
                                @foreach ($apotek as $d)
                                <option value="{{$d->kode_apotek}}">{{$d->nama_apotek}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Subtotal</label>
                        <div class="col">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/money.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" n style="text-align: right" class="form-control" onkeyup="calc()"
                                    id="subtotal" placeholder="Subtotal" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Diskon</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/price-tag.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" style="text-align: center" onkeyup="calc()" class="form-control"
                                    id="diskonfaktur" placeholder="Diskon" value="0" name="diskonfaktur">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/indonesian-rupiah.svg')}}" width="25px"
                                        height="25px" alt="">
                                </span>
                                <input type="text" style="text-align: right" onkeyup="calc()" readonly
                                    class="form-control" id="diskonfakturrupiah" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">PPN</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/taxes.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" style="text-align: center" class="form-control" id="ppn"
                                    placeholder="PPN" value="0" name="ppn">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/indonesian-rupiah.svg')}}" width="25px"
                                        height="25px" alt="">
                                </span>
                                <input type="text" style="text-align: right" readonly class="form-control"
                                    id="ppnrupiah" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="form-label col-3 col-form-label">Jenis Struk</label>
                        <div class="col">
                            <select name="struk" id="struk" class="form-select">
                                <option value="76mm">Struk Kecil (76mm)</option>
                                <option value="a5">Invoice (A5)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Jumlah Tunai</label>
                        <div class="col">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/money.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" n style="text-align: right" class="form-control" id="jumlah_tunai"
                                    placeholder="Jumlah Tunai" name="jumlah_tunai" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Total</label>
                        <div class="col">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/money.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" n style="text-align: right" class="form-control" id="total"
                                    placeholder="Total" readonly value="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="form-label col-3 col-form-label">Kembalian</label>
                        <div class="col">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <img src="{{asset('assets/dist/icon/money.svg')}}" width="25px" height="25px"
                                        alt="">
                                </span>
                                <input type="text" n style="text-align: right" class="form-control" id="kembalian"
                                    placeholder="Kembalian" readonly value="">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">
                        Simpan
                    </button>
                </div>
            </div>

        </div>

    </div>
</form>



@include('layouts.script')
<script>
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

    startCalc();
    function startCalc() {
      interval = setInterval("calc()", 1)
    }

    function calc() {
      subtotal = document.getElementById('subtotal').value;
		  uangsubtotal = subtotal.replace(/\./g, '');
      diskonfaktur = document.getElementById('diskonfaktur').value;
      diskonfakturrupiah = document.getElementById('diskonfakturrupiah').value;
      total = document.getElementById('total').value;
      uangtotal = total.replace(/\./g, '');
      ppn = document.getElementById('ppn').value;
      ppnrupiah = document.getElementById('ppnrupiah').value;
      uangppnrupiah = ppnrupiah.replace(/\./g, '');
      jumlah_tunai = document.getElementById('jumlah_tunai').value;
		  uangjumlah_tunai = jumlah_tunai.replace(/\./g, '');
      kembalian = document.getElementById('kembalian').value;
		  uangkembalian = kembalian.replace(/\./g, '');

      if (uangsubtotal == "") {
        uangsubtotal = 0;
      }

      if (uangjumlah_tunai == "") {
        uangjumlah_tunai = 0;
      }

      if (uangkembalian == "") {
        uangkembalian = 0;
      }

      if (diskonfaktur == "") {
        diskonfaktur = 0;
      }

      if (diskonfakturrupiah == "") {
        diskonfakturrupiah = 0;
      }

      if (uangtotal == "") {
        uangtotal = 0;
      }

      if (ppn == "") {
        ppn = 0;
      }

      if (uangppnrupiah == "") {
        uangppnrupiah = 0;
      }

      var dr = (parseInt(diskonfaktur)/100) * parseInt(uangsubtotal);
      var ppnrp = (parseInt(ppn) / 100) * (parseInt(uangsubtotal) - parseInt(dr));
      var total = parseInt(uangsubtotal) - parseInt(dr) + parseInt(Math.floor(ppnrp)) ;
      var uk = parseInt(uangjumlah_tunai) - parseInt(total) ;

      var result = parseInt(dr);
      if (!isNaN(result)) {
         diskonrp = document.getElementById('diskonfakturrupiah').value = convertToRupiah(result);
      }

      if (!isNaN(total)) {
        total = document.getElementById('total').value = convertToRupiah(total);
      }

      if (!isNaN(ppnrp)) {
        ppnrp = document.getElementById('ppnrupiah').value = convertToRupiah(Math.floor(ppnrp));
      }

      if (!isNaN(uk)) {
        uk = document.getElementById('kembalian').value = convertToRupiah(uk);
      }




    }
</script>
<script>
    window.setTimeout("waktu()", 1000);

	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}
</script>
<script>
    $(function(){
    $('body').keypress(function(e){
      //alert(e.which);
      if(e.which == 13){
        swal.close();
      }
    });

    $("#formValidate").submit(function(){
        var jumlah_tunai = $("#jumlah_tunai").val();
        var uang_tunai = jumlah_tunai.replace(".","");
        var total = $("#total").val();
        var uang_total = total.replace(".","");

        if(jumlah_tunai == ""){
            swal("Oops","Jumlah Uang Tunai Harus Diisi !","warning");
            return false;
        }else{
            if(parseInt(uang_tunai) < parseInt(uang_total)){
                swal("Oops","Jumlah Bayar Kurang !","warning")
                return false;
            }else{
                return true;
            }
        }


    });

    $("#jumlah_tunai").maskNumber({
      integer:true,
      thousands:'.'
    });
    //$("#barcode").focus();
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

    function loadtotal(){
        var total = $("#total").val();
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

    loadtotal();
    loadproduktemp();
    $( "#barcode" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"/getautocompleteproduk",
            type: 'post',
            dataType: "json",
            data: {
              _token: "{{ csrf_token() }}",
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#barcode').val(ui.item.label);
           var kode_produk = ui.item.val;
           var persentase_laba = $("input[name='kategori_harga']:checked").val();
           var id_lokasiproduk = $("#id_lokasiproduk").val();
           $.ajax({
            type:'POST',
            url:'/penjualan/storeproduktemp',
            data:{ _token: "{{ csrf_token() }}",kode_produk:kode_produk,persentase_laba:persentase_laba,id_lokasiproduk:id_lokasiproduk},
            cache:false,
            success:function(respond){
              if(respond=="2"){
                swal("Oops","Data Barang Sudah Ada !","warning");
                $("#barcode").focus();
              }else if(respond=="0"){
                swal("Oops","Stok di "+ $("#id_lokasiproduk option:selected").text() +" Kosong !","warning");
                $("#barcode").focus();
              }else{
                loadproduktemp();
                $("#barcode").val("");
              }



            }
           });
           //$('#employeeid').val(ui.item.value);
           return false;
        }
      });

      $('input[type=radio][name=kategori_harga]').change(function() {
          var persentase_laba = $(this).val();
          $.ajax({
            type :'POST',
            url :'/updatepersentaselaba',
            data:{_token:"{{ csrf_token() }}", persentase_laba:persentase_laba},
            cache:false,
            success:function(respond){
              loadproduktemp();
              loadtotal();
            }
          });
      });
  });
</script>
