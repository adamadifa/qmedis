@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mt-2">
      <div class="card-body">
        <form action="/persentaselaba/store" method="post">
          @csrf

          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Kategori Laba" placeholder="Kategori Laba" field="kategori_laba"
                icon='
                <!-- Download SVG icon from http://tabler-icons.io/i/3d-cube-sphere -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 17.6l-2 -1.1v-2.5" /><path d="M4 10v-2.5l2 -1.1" /><path d="M10 4.1l2 -1.1l2 1.1" /><path d="M18 6.4l2 1.1v2.5" /><path d="M20 14v2.5l-2 1.12" /><path d="M14 19.9l-2 1.1l-2 -1.1" /><line x1="12" y1="12" x2="14" y2="10.9" /><line x1="18" y1="8.6" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="14.5" /><line x1="12" y1="18.5" x2="12" y2="21" /><path d="M12 12l-2 -1.12" /><line x1="6" y1="8.6" x2="4" y2="7.5" /></svg>' />
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-4">
              <x-inputtext label="Persentase Laba" placeholder="Persentase Laba" field="persentase"
                icon='
                <!-- Download SVG icon from http://tabler-icons.io/i/percentage -->
	              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="17" cy="17" r="1" /><circle cx="7" cy="7" r="1" /><line x1="6" y1="18" x2="18" y2="6" /></svg>' />
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