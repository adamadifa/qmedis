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
          <img src="{{asset('assets/static/avatars/produk.png')}}" alt="">
        </span>
        <h3 class="m-0 mb-1"><a href="#">{{$produk->nama_produk}}</a></h3>
        <div class="text-muted">{{$produk->kode_produk}}</div>
        <div class="mt-3">
          <center>@php $barcode = \DNS1D::getBarcodeHTML($produk->barcode, "I25+"); echo $barcode;
            @endphp</center>
          <span class="badge bg-green-lt">{{$produk->barcode}}</span>
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
        <a href="/produk/{{$produk->kode_produk}}/edit" class="card-btn"
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
            <th>Kode Produk</th>
            <th></th>
            <td>{{$produk->kode_produk}}</td>
          </tr>
          <tr>
            <th>Nama Produk</th>
            <th></th>
            <td>{{$produk->nama_produk}}</td>
          </tr>
          <tr>
            <th>Kategori</th>
            <th></th>
            <td>{{$produk->kategori}}</td>
          </tr>
          <tr>
            <th>Satuan</th>
            <th></th>
            <td>{{$produk->satuan}}</td>
          </tr>
          <tr>
            <th>Minimal Stock</th>
            <th></th>
            <td>{{$produk->min_stock}}</td>
          </tr>
          <tr>
            <th>Deskripsi</th>
            <th></th>
            <td>{{$produk->deskripsi}}</td>
          </tr>
          <tr>
            <th>Harga Beli</th>
            <th></th>
            <td>{{$produk->harga_beli}}</td>
          </tr>

        </table>
      </div>
    </div>
  </div>
</div>
@endsection