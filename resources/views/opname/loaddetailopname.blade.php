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
      <tbody>
        @foreach ($opname as $d)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$d->lokasi_produk}}</td>
          <td>{{$d->tgl_expired}}</td>
          <td align="center">{{$d->kode_batch}}</td>
          <td align="center">{{number_format($d->stok_sistem,'0','','.')}}</td>
          <td align="center">{{number_format($d->stok_fisik,'0','','.')}}</td>
          <td align="center">{{number_format($d->stok_fisik-$d->stok_sistem,'0','','.')}}</td>
          <td>{{$d->catatan}}</td>
          <td align="center"><i class="fa fa-check"></i></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</form>

<script>
  $(function(){
    $(".close-opnameproduk").click(function(){
      $("#modal-detailopname").modal("hide");
    });
  })
</script>