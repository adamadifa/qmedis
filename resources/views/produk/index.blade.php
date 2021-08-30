@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <form action="/produk" method="GET">
                    <div class="input-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" /></svg>
                            </span>
                            <input type="text" class="form-control" value="{{ Request::get('cari') }}"
                                placeholder="Pencarian Data" name="cari">
                        </div>
                        <button type="submit" class="btn btn-success">Cari Data</button>
                    </div>
                </form>
            </div>
            <div>
                <a href="/produk/create" class="btn btn-primary d-none d-sm-inline-block mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tambah Data
                </a>
            </div>

        </div>
        @include('layouts.notification')

        <div class="table-responsive">
            <table class="table table-boredered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Min Stock</th>
                        <th style="text-align:right">Harga Beli</th>
                        <th style="text-align:center">Barcode</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $d)
                    <tr>
                        <td>{{ $loop->iteration + $produk->firstItem() - 1 }}</td>
                        <td>{{$d->kode_produk}}</td>
                        <td>{{$d->nama_produk}}</td>
                        <td>{{$d->kategori}}</td>
                        <td>{{$d->satuan}}</td>
                        <td>{{number_format($d->min_stock,'0','','.')}}</td>
                        <td align="right">{{number_format($d->harga_beli,'0','','.')}}</td>
                        <td style="text-align: center">
                            @if (empty($d->barcode))
                            <span class="badge bg-red">Belum di Atur</span>
                            @else
                            <center>@php $barcode = \DNS1D::getBarcodeHTML($d->barcode, "I25+"); echo $barcode;
                                @endphp</center>
                            @endif

                        </td>
                        <td>
                            <div class="grid-container">
                                <div class="grid-item">
                                    <a href="/produk/{{$d->kode_produk}}/edit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="/produk/{{$d->kode_produk}}/show" class="btn btn-sm btn-info"><i
                                            class="fa fa-list"></i></a>
                                    <a href="/produk/{{$d->kode_produk}}/show" class="btn btn-sm btn-info"><i
                                            class="fa fa-file-text mr-2"></i>Kartu Stok</a>
                                </div>
                                <div class="grid-item">
                                    <form action="/produk/{{$d->kode_produk}}/delete" id="deleteform" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm delete-confirm"><i
                                                class="fa fa-trash-o"></i></button>
                                    </form>
                                </div>

                            </div>
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
@endsection

@push('myscript')
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
      });
</script>
@endpush
