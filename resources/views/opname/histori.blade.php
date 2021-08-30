@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')

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
            <th>Tgl Opname</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Satuan</th>
            <th>Petugas</th>
            <th style="text-align:center">Penyesuaian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($opname as $d)
          <tr>
            <td>{{ $loop->iteration + $opname->firstItem() - 1 }}</td>
            <td>{{date("d-m-Y",strtotime($d->tgl_opname))}}</td>
            <td>{{$d->kode_produk}}</td>
            <td>{{$d->nama_produk}}</td>
            <td>{{$d->satuan}}</td>
            <td>{{$d->name}}</td>
            <td align="center">{{number_format($d->penyesuaian,'0','','.')}}</td>
            <td>
              <div class="grid-container">
                <div class="grid-item">
                  <a href="#" data-kodeopname="{{$d->kode_opname}}" data-kodeproduk="{{$d->kode_produk}}"
                    class="btn btn-sm btn-info detail"><i class="fa fa-list"></i></a>
                </div>
                <div class="grid-item">
                  <form action="/opname/{{$d->kode_opname}}/delete" id="deleteform" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm delete-confirm"><i class="fa fa-trash-o"></i></button>
                  </form>
                </div>

              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4" style="float:right">{{$opname->links()}}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-detailopname" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content loadetailopname">


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

    $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Anda Yakin?',
                text: 'Data ini akan didelete secara permanen!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                   $("#deleteform").submit();
                }
            });
        });
    $(".detail").click(function(e){
      var kode_opname = $(this).attr("data-kodeopname");
      var kode_produk = $(this).attr("data-kodeproduk");
      $.ajax({
        url:'/opname/detailopname',
        type:'POST',
        data:{
          _token: "{{ csrf_token() }}",
          kode_opname:kode_opname,
          kode_produk:kode_produk
        },
        cache:false,
        success:function(respond){
          $(".loadetailopname").html(respond);
        }
      });
      $("#modal-detailopname").modal('show');
    });
       
  });
</script>
@endpush