<form action="/opname/updateopname" method="post" id="formOpname">
  @csrf
  <div class="modal-header" style="background-color:#206bc4; color:white;">
    <h5 class="w-100 text-center modal-title h4">
      <div class="d-flex justify-content-between">
        <div class="p-2">
          <a href="#" class="close-opnameproduk">
            <i class=" fa fa-arrow-circle-left" style="font-size:32px"></i>
          </a>

        </div>
        <div class="p-2">Stock Opname {{$produk->nama_produk}}
        </div>
        <div class="p-2">
          <button type="submit" class="btn btn-success"><i class="fa fa-send mr-2"></i>Simpan</button>
        </div>
      </div>

    </h5>
  </div>
  <div class="table-responsive">
    <table class="table table-boredered table-striped" id="tabelstok">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Lokasi Simpan</th>
          <th>Expired Date</th>
          <th style="text-align:center">Kode Batch</th>
          <th style=" text-align:center">Stok Sistem ({{ucwords($produk->satuan)}}</th>
          <th style="text-align:center">Stok Fisik ({{ucwords($produk->satuan)}})</th>
          <th style="text-align:center">Penyesuaian ({{ucwords($produk->satuan)}}</th>
          <th style="text-align:center">Catatan</th>
          <th style="text-align:center">Verifikasi</th>
        </tr>
      </thead>
      <tbody id="loadstokproduk">
      </tbody>
    </table>
  </div>
  <center>
    <div class="col-md-3 mt-4">
      <a href="#" class="btn btn-pill btn-primary w-100" id="tambahstok"><i class="fa fa-plus mr-2"></i> Tambah Stok
        Baru</a>
    </div>
  </center>
</form>

<div class="modal modal-blur fade" id="modal-tambahstok" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#206bc4; color:white;">
        <h5 class="modal-title">Tambah Stok Baru</h5>
        <button type="button" class="btn-close close-tambahstok"></button>
      </div>
      <div class="modal-body">

        <div class="row">
          <label for="" class="form-label">Lokasi Produk</label>
          <div class="form-group">
            <select name="id_lokasiproduk" id="id_lokasiproduk" class="form-select">
              <option value="">Pilih Lokasi Produk</option>
              @foreach ($lokasiproduk as $d)
              <option value="{{$d->id_lokasiproduk}}">{{$d->lokasi_produk}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label for="" class="form-label">Supplier</label>
            <select name="kode_supplier" id="kode_supplier" class="form-select">
              <option value="">Tidak Tahu</option>
              @foreach ($supplier as $d)
              <option value="{{$d->kode_supplier}}">{{$d->nama_supplier}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-2">
          <x-inputtext label="Tanggal Expired" placeholder="Tanggal Expired" field="tgl_expired"
            icon='
            <!-- Download SVG icon from http://tabler-icons.io/i/calendar-event -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>' />
        </div>
        <div class="row mb-2">
          <x-inputtext label="Kode Batch" placeholder="Kode Batch" field="kode_batch"
            icon='
            <!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><rect x="5" y="11" width="1" height="2" /><line x1="10" y1="11" x2="10" y2="13" /><rect x="14" y="11" width="1" height="2" /><line x1="19" y1="11" x2="19" y2="13" /></svg>' />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="simpanstok">Simpan</button>
      </div>
    </div>
  </div>
</div>
<script>

</script>
<script>
  flatpickr(document.getElementById('tgl_expired'), {});
</script>
<script>
  $(function(){
   
    $(".close-tambahstok").click(function(){
      $("#modal-tambahstok").modal("hide");
    });
    $(".close-opnameproduk").click(function(){
      $("#modal-opnameproduk").modal("hide");
    });
    $("#tambahstok").click(function(){
      $('#modal-tambahstok').modal({
        show:true,
        backdrop:'static'
      });
      
      $('#modal-tambahstok').modal('show');  
    });

    function loadstokproduk(){
      var kode_produk = "{{$produk->kode_produk}}";
      $.ajax({
        type:'POST',
        url:'/opname/loadstokproduk',
        data:{_token: "{{ csrf_token() }}",kode_produk:kode_produk},
        cache:false,
        success:function(respond){
          $("#loadstokproduk").html(respond)
        }
      });
    }
    loadstokproduk();
    $("#simpanstok").click(function(e){
      e.preventDefault();
      var id_lokasiproduk = $("#id_lokasiproduk").val();
      var tgl_expired = $("#tgl_expired").val();
      var kode_produk = "{{$produk->kode_produk}}";
      var kode_supplier = $("#kode_supplier").val();
      var kode_batch = $("#kode_batch").val();
      if(id_lokasiproduk==""){
        swal("Oops","Harus Pilih Lokasi Produk Dulu !","warning");
      }else if(tgl_expired ==""){
        swal("Oops","Tanggal Expired Harus Dipilih","warning");
      }else{
        $.ajax({
          type:'POST',
          url:'/opname/storestok',
          data:{
            _token: "{{ csrf_token() }}",
            kode_produk:kode_produk,
            id_lokasiproduk:id_lokasiproduk,
            kode_supplier:kode_supplier,
            tgl_expired:tgl_expired,
            kode_batch:kode_batch
          },
          cache:false,
          success:function(respond){
            if(respond==1){
              swal("Berhasil","Stok Berhasil ditambahkan !","success");
              loadstokproduk();
              $("#modal-tambahstok").modal("hide");
            }else{
              swal("Error","Stok Gagal Ditambahkan","danger");
            }
          }
        });
      }
    });
  });
</script>