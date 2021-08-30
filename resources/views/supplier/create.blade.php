@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mt-2">
      <div class="card-body">
        <form action="/supplier/store" method="post">
          @csrf
          <div class="row mb-2">
            <div class="col-md-4">
              <x-inputtext label="Kode Supplier" placeholder="Kode Supplier" value={{$kode_supplier}}
                field="kode_supplier" readonly="true" icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2'
                stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                <path stroke='none' d='M0 0h24v24H0z' fill='none' />
                <path d='M4 7v-1a2 2 0 0 1 2 -2h2' />
                <path d='M4 17v1a2 2 0 0 0 2 2h2' />
                <path d='M16 4h2a2 2 0 0 1 2 2v1' />
                <path d='M16 20h2a2 2 0 0 0 2 -2v-1' />
                <rect x='5' y='11' width='1' height='2' />
                <line x1='10' y1='11' x2='10' y2='13' />
                <rect x='14' y='11' width='1' height='2' />
                <line x1='19' y1='11' x2='19' y2='13' /></svg>" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Nama Supplier" placeholder="Nama Supplier" field="nama_supplier"
                icon='
              <!-- Download SVG icon from http://tabler-icons.io/i/building-store -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="21" x2="21" y2="21" /><path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" /><line x1="5" y1="21" x2="5" y2="10.85" /><line x1="19" y1="21" x2="19" y2="10.85" /><path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" /></svg>' />
            </div>
          </div>

          <div class="rom mb-2">
            <x-inputtextarea label="Alamat" field="alamat_supplier" />
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Contact Person" placeholder="Contact Person" field="contact_person"
                icon='
                <!-- Download SVG icon from http://tabler-icons.io/i/users -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>' />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <x-inputtext label="No Telepon" placeholder="No Telepon" field="no_telepon"
                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>' />
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