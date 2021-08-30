@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mt-2">
      <div class="card-body">
        <form action="/dokter/store" method="post">
          @csrf
          <div class="row mb-2">
            <div class="col-md-4">
              <x-inputtext label="Kode Dokter" placeholder="Kode Dokter" value={{$kode_dokter}} field="kode_dokter"
                readonly="true" icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2'
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
              <x-inputtext label="Nomor Induk Kependudukan (NIK)" placeholder="NIK" field="nik"
                icon="<svg xmlns='<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='3' y='5' width='18' height='14' rx='3' /><line x1='3' y1='10' x2='21' y2='10' /><line x1='7' y1='15' x2='7.01' y2='15' /><line x1='11' y1='15' x2='13' y2='15' /></svg>" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Nama Dokter" placeholder="Nama Dokter" field="nama_dokter"
                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='7' r='4' /><path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /></svg>" />
            </div>
          </div>
          <div class="rom mb-2">
            <x-inputtextarea label="Alamat" field="alamat" />
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <label for="" class="form-label">Propinsi</label>
              <div class="form-group  @error('id_propinsi') is-invalid @enderror">
                <select name="id_propinsi" id="id_propinsi"
                  class="form-select  @error('id_propinsi') is-invalid @enderror">
                  <option value="">Propinsi</option>
                  @foreach ($propinsi as $p)
                  <option {{old('id_propinsi')==$p->id ? 'selected':''}} value="{{$p->id}}">
                    {{$p->prov_name}}
                  </option>
                  @endforeach
                </select>
              </div>
              @error('id_propinsi') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <label for="" class="form-label">Kabupaten/Kota</label>
              <div class="form-group  @error('id_kota') is-invalid @enderror">
                <select name="id_kota" id="id_kota" class="form-select  @error('id_kota') is-invalid @enderror">
                  <option value="">Kabupaten/Kota</option>
                </select>
              </div>
              @error('id_kota') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <label for="" class="form-label @error('id_kecamatan') is-invalid @enderror">Kecamatan</label>
              <div class="form-group">
                <select name="id_kecamatan" id="id_kecamatan"
                  class="form-select @error('id_kecamatan') is-invalid @enderror">
                  <option value="">Kecamatan</option>
                </select>
              </div>
              @error('kecamatan') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <label for="" class="form-label">Kelurahan</label>
              <div class="form-group @error('id_kelurahan') is-invalid @enderror">
                <select name="id_kelurahan" id="id_kelurahan"
                  class="form-select @error('id_kelurahan') is-invalid @enderror">
                  <option value="">Kelurahan</option>
                </select>
              </div>
              @error('id_kelurahan') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="No STR" placeholder="No STR" field="no_str" icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2'
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
            <div class="col-md-6">
              <label for="" class="form-label">Spesialis</label>
              <div class="form-group  @error('id_spesialis') is-invalid @enderror">
                <select name="id_spesialis" id="id_spesialis"
                  class="form-select  @error('id_spesialis') is-invalid @enderror">
                  <option value="">Pilih Spesialis</option>
                  @foreach ($spesialis as $p)
                  <option {{old('id_spesialis')==$p->id_spesialis ? 'selected':''}} value="{{$p->id_spesialis}}">
                    {{$p->spesialis}}
                  </option>
                  @endforeach
                </select>
              </div>
              @error('id_spesialis') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-6">
              <x-inputtext label="No Telepon" placeholder="No Telepon" field="no_telepon"
                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>' />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <x-inputtext label="Tanggal Mulai Tugas" placeholder="Tanggal Mulai Tugas" field="tgl_mulai_tugas"
                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='4' y='5' width='16' height='16' rx='2' /><line x1='16' y1='3' x2='16' y2='7' /><line x1='8' y1='3' x2='8' y2='7' /><line x1='4' y1='11' x2='20' y2='11' /><rect x='8' y='15' width='2' height='2' /></svg>" />
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
  document.addEventListener("DOMContentLoaded", function() {
  flatpickr(document.getElementById('tgl_mulai_tugas'), {});
});
</script>
<script>
  $(function() {   
    $('.uppercase').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $("#id_propinsi").change(function(){
      var id_propinsi = $("#id_propinsi").val();
      $.ajax({
        type:'POST',
        url:'/kota/getkota',
        data:{
          _token: "{{ csrf_token() }}",
          id_propinsi:id_propinsi
          },
        cache:false,
        success:function(respond){
          $("#id_kota").html(respond);
        }
      });
    });

    $("#id_kota").change(function(){
      var id_kota = $("#id_kota").val();
      $.ajax({
        type:'POST',
        url:'/kecamatan/getkecamatan',
        data:{
          _token: "{{ csrf_token() }}",
          id_kota:id_kota
          },
        cache:false,
        success:function(respond){
          $("#id_kecamatan").html(respond);
        }
      });
    });

    $("#id_kecamatan").change(function(){
      var id_kecamatan = $("#id_kecamatan").val();
      $.ajax({
        type:'POST',
        url:'/kelurahan/getkelurahan',
        data:{
          _token: "{{ csrf_token() }}",
          id_kecamatan:id_kecamatan
          },
        cache:false,
        success:function(respond){
          $("#id_kelurahan").html(respond);
        }
      });
    });
  });
</script>
@endpush