@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')

<style>
  /* #tabelopname tr th:last-child,
  th:nth-child(1),
  th:nth-child(2),
  td:nth-child(3),
  th:nth-child(3),
  th:nth-child(6),
  th:nth-child(5) {
    width: 1%;
    white-space: nowrap;
  } */

  #tabelopname tr th:last-child {
    width: 1%;
    white-space: nowrap;
  }

  #tabelopname tr th:nth-child(1) {
    width: 1%;
    white-space: nowrap;
  }

  #tabelopname tr th:nth-child(2) {
    width: 1%;
    white-space: nowrap;
  }

  #tabelopname tr th:nth-child(3) {
    width: 1%;
    white-space: nowrap;
  }

  #tabelopname tr th:nth-child(6) {
    width: 1%;
    white-space: nowrap;
  }

  #tabelopname tr th:nth-child(5) {
    width: 1%;
    white-space: nowrap;
  }

  #tabelstok tr th:nth-child(6) {
    width: 1%;
    white-space: nowrap;
  }

  #tabelstok tr th:nth-child(7) {
    width: 1%;
    white-space: nowrap;
  }
</style>
<div class="card mt-2">
  <div class="card-body">
    <div class="row mb-1">
      <form action="/opname" method="GET">
        <div class="input-icon">
          <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="10" cy="10" r="7" />
              <line x1="21" y1="21" x2="15" y2="15" /></svg>
          </span>
          <input type="text" class="form-control cariproduk" autocomplete="off" value="{{ Request::get('cari') }}"
            placeholder="Cari Produk" name="cari">
        </div>
      </form>
    </div>
    @include('layouts.notification')

    <div class="table-responsive">
      <table class="table table-boredered table-striped" id="tabelopname">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Kode Produk</th>
            <th> Nama Produk</th>
            <th>Satuan</th>
            <th style="text-align:center">Stok Total</th>
            <th style="text-align:center">Opname Terakhir</th>
            <th style="text-align:center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($produk as $d)
          <tr>
            <td>{{ $loop->iteration + $produk->firstItem() - 1 }}</td>
            <td>{{$d->kode_produk}}</td>
            <td>{{$d->nama_produk}}</td>
            <td>{{$d->satuan}}</td>
            <td style="text-align:center">{{number_format($d->total_stok,'0','','.')}}</td>
            <td style="text-align:center">

              @if (!empty($d->tgl_opname))
              <span class="badge bg-cyan">
                {{date('d-m-Y',strtotime($d->tgl_opname))}} {{$d->jam_opname}}
              </span>
              @endif

            </td>
            <td style="text-align:center">
              <a href="#" class="btn btn-success btn-sm opname" data-kodeproduk="{{$d->kode_produk}}"> <i
                  class="fa fa-pencil mr-2"></i>Opname</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4" style="float:right">{{$produk->links()}}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-opnameproduk" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content loadopnameproduk">


    </div>
  </div>
</div>


@endsection

@push('myscript')
<script type="text/javascript">
  var path = "{{ route('autocompleteproduk') }}";
  $('input.cariproduk').typeahead({
      source:  function (query, process) {
      return $.get(path, { query: query }, function (data) {
              return process(data);
          });
      },   
  });
</script>
<script>
  $(function(){
    $(".opname").click(function(e){
      var kode_produk = $(this).attr("data-kodeproduk");
      $.ajax({
        url:'/opname/loadpageopname',
        type:'POST',
        data:{
          _token: "{{ csrf_token() }}",
          kode_produk:kode_produk
        },
        cache:false,
        success:function(respond){
          $(".loadopnameproduk").html(respond);
        }
      });
      $("#modal-opnameproduk").modal('show');
    });
       
  });
</script>
@endpush