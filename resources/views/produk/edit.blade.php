@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mt-2">
      <div class="card-body">
        <form action="/produk/update" method="post">
          @csrf
          <div class="row mb-2">
            <div class="col-md-4">
              <x-inputtext label="Kode Produk" placeholder="Kode Produk" value="{{$produk->kode_produk}}"
                field="kode_produk" readonly="true" icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2'
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
              <x-inputtext label="Nama Produk" placeholder="Nama Produk" field="nama_produk"
                value="{{$produk->nama_produk}}" icon='
                <svg xmlns=" http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                <line x1="12" y1="12" x2="20" y2="7.5" />
                <line x1="12" y1="12" x2="12" y2="21" />
                <line x1="12" y1="12" x2="4" y2="7.5" /></svg>' />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label">Kategori</label>
              <div class="form-group  @error('id_kategori') is-invalid @enderror">
                <select name="id_kategori" id="id_kategori"
                  class="form-select  @error('id_kategori') is-invalid @enderror">
                  <option value="">Kategori</option>
                  @foreach ($kategori as $p)
                  <option @isset($produk->id_kategori) @if(old("id_kategori"))
                    {{old("id_kategori")==$p->id_kategori ? "selected":""}} @else
                    {{$produk->id_kategori==$p->id_kategori ? "selected":""}} @endif @else
                    {{old("id_kategori")==$p->id_kategori ? "selected":""}}
                    @endisset value="{{$p->id_kategori}}">
                    {{$p->kategori}}
                  </option>
                  @endforeach
                </select>
              </div>
              @error('id_spesialis') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label">Satuan</label>
              <div class="form-group  @error('id_satuan') is-invalid @enderror">
                <select name="id_satuan" id="id_satuan" class="form-select  @error('id_satuan') is-invalid @enderror">
                  <option value="">Satuan</option>
                  @foreach ($satuan as $p)
                  <option @isset($produk->id_satuan) @if(old("id_satuan"))
                    {{old("id_satuan")==$p->id_satuan ? "selected":""}} @else
                    {{$produk->id_satuan==$p->id_satuan ? "selected":""}} @endif @else
                    {{old("id_satuan")==$p->id_satuan ? "selected":""}}
                    @endisset value="{{$p->id_satuan}}">
                    {{$p->satuan}}
                  </option>
                  @endforeach
                </select>
              </div>
              @error('id_spesialis') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="rom mb-2">
            <x-inputtextarea label="Deskripsi" field="deskripsi" value="{{$produk->deskripsi}}" />
          </div>
          <div class=" row mb-2">
            <div class="col-md-4">
              <x-inputtext label="Minimal Stock" placeholder="Minimal Stock" field="min_stock"
                value="{{$produk->min_stock}}" icon='
                <svg xmlns=" http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
                <line x1="12" y1="12" x2="20" y2="7.5" />
                <line x1="12" y1="12" x2="12" y2="21" />
                <line x1="12" y1="12" x2="4" y2="7.5" /></svg>' />
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-4">
              <x-inputtext label="Harga Beli" placeholder="Harga Beli" field="harga_beli" style="text-align:right"
                value="{{number_format($produk->harga_beli,'0','','.')}}" icon='
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-money" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                <path d="M12 17v1m0 -8v1"></path>
             </svg>' />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Barcode" placeholder="Barcode" field="barcode" value="{{$produk->barcode}}" icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2'
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