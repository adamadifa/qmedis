@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mt-2">
      <div class="card-body">
        <form action="/lokasiproduk/{{$lokasiproduk->id_lokasiproduk}}/update" method="post">
          @csrf

          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Lokasi Produk" placeholder="Lokasi Produk" field="lokasi_produk"
                value="{{$lokasiproduk->lokasi_produk}}"
                icon='
                <!-- Download SVG icon from http://tabler-icons.io/i/map-pin -->
	              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="11" r="3" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>' />
            </div>
          </div>
          <button class="btn btn-primary  w-100"><i class="fa fa-send mr-2"></i>Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('myscript')

<script>
  $(function() {   
    $('.uppercase').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
 
    $("#harga_beli").maskNumber({
      integer:true,
      thousands:'.'
    });
  });
</script>
@endpush