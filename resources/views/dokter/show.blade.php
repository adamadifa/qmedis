@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body p-4 text-center">
        <span class="avatar avatar-xl mb-3 avatar-rounded">
          <img src="{{asset('assets/static/avatars/default-avatar.png')}}" alt="">
        </span>
        <h3 class="m-0 mb-1"><a href="#">{{$dokter->nama_dokter}}</a></h3>
        <div class="text-muted">{{$dokter->kode_dokter}}</div>
        <div class="mt-3">
          <span class="badge bg-green-lt">{{$dokter->spesialis}}</span>
        </div>
      </div>
      <div class="d-flex">
        <a href="#" class="card-btn" style="background-color:#8cc63e; color:white">
          <!-- Download SVG icon from http://tabler-icons.io/i/camera -->
          <svg xmlns='http://www.w3.org/2000/svg' class='icon me-2' width='24' height='24' viewBox='0 0 24 24'
            stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
            <path stroke='none' d='M0 0h24v24H0z' fill='none' />
            <path
              d='M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2' />
            <circle cx='12' cy='13' r='3' /></svg>
          Ganti Foto</a>
        <a href="/dokter/{{$dokter->kode_dokter}}/edit" class="card-btn"
          style="background-color: #1a86c7; color:white ">
          <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
          <!-- Download SVG icon from http://tabler-icons.io/i/pencil -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
          Edit Data</a>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Kode Dokter</th>
            <th></th>
            <td>{{$dokter->kode_dokter}}</td>
          </tr>
          <tr>
            <th>NIK</th>
            <th></th>
            <td>{{$dokter->nik}}</td>
          </tr>
          <tr>
            <th>Nama Dokter</th>
            <th></th>
            <td>{{$dokter->nama_dokter}}</td>
          </tr>
          <tr>
            <th>No. STR</th>
            <th></th>
            <td>{{$dokter->no_str}}</td>
          </tr>
          <tr>
            <th>Spesialis</th>
            <th></th>
            <td>{{$dokter->spesialis}}</td>
          </tr>
          <tr>
            <th>Alamat</th>
            <th></th>
            <td>{{$dokter->alamat}}</td>
          </tr>
          <tr>
            <th>Kelurahan</th>
            <th></th>
            <td>{{$dokter->vill_name}}</td>
          </tr>
          <tr>
            <th>Kecamatan</th>
            <th></th>
            <td>{{$dokter->dist_name}}</td>
          </tr>
          <tr>
            <th>Kota</th>
            <th></th>
            <td>{{$dokter->regc_name}}</td>
          </tr>
          <tr>
            <th>Propinsi</th>
            <th></th>
            <td>{{$dokter->prov_name}}</td>
          </tr>
          <tr>
            <th>No. Telepon</th>
            <th></th>
            <td>{{$dokter->no_telepon}}</td>
          </tr>
          <tr>
            <th>Tanggal Mulai Tugas</th>
            <th></th>
            <td>{{date('d-m-Y',strtotime($dokter->tgl_mulai_tugas))}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection