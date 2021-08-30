@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')

<div class="card mt-2">
    <div class="card-body">
        <div class="row mb-1">
            <form action="/penjualan" method="GET">
                <div class="mb-1">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="input-icon">
                                <input id="dari" type="date" placeholder="Dari" value="{{ Request::get('dari') }}"
                                    class="form-control" name="dari" />
                                <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <rect x="4" y="5" width="16" height="16" rx="2" />
                                        <line x1="16" y1="3" x2="16" y2="7" />
                                        <line x1="8" y1="3" x2="8" y2="7" />
                                        <line x1="4" y1="11" x2="20" y2="11" />
                                        <line x1="11" y1="15" x2="12" y2="15" />
                                        <line x1="12" y1="15" x2="12" y2="18" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-icon">
                                <input id="sampai" type="date" value="{{ Request::get('sampai') }}" placeholder="Sampai"
                                    class="form-control" name="sampai" />
                                <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <rect x="4" y="5" width="16" height="16" rx="2" />
                                        <line x1="16" y1="3" x2="16" y2="7" />
                                        <line x1="8" y1="3" x2="8" y2="7" />
                                        <line x1="4" y1="11" x2="20" y2="11" />
                                        <line x1="11" y1="15" x2="12" y2="15" />
                                        <line x1="12" y1="15" x2="12" y2="18" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="kode_apotek" id="kode_apotek" class="form-select">
                                <option value="">Pilih Apotek</option>
                                @foreach ($apotek as $d)
                                <option @if (Request::get('kode_apotek')==$d->kode_apotek)
                                    selected
                                    @endif value="{{$d->kode_apotek}}">{{$d->nama_apotek}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary  mb-3"><i class="fa fa-search mr-2"></i> Cari</button>
                    <button class="btn btn-success  mb-3"><i class="fa fa-file-excel-o mr-2"></i> Export to
                        Excel</button>
                </div>
            </form>
        </div>
        @include('layouts.notification')

        <div class="table-responsive">
            <table class="table table-boredered table-striped" id="tabelpenjualan">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>No. Faktur</th>
                        <th>Tgl Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Apotek</th>
                        <th>Subtotal</th>
                        <th style="text-align: center">Diskon(%)</th>
                        <th style="text-align: center">PPN(%)</th>
                        <th>Total</th>
                        <th>Petugas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan as $d)
                    @php
                    $total_harga = $d->total_harga;
                    $total = $total_harga - (($d->diskon/100)*$total_harga) + (($d->ppn/100) * ($total_harga -
                    (($d->diskon/100)*$total_harga))) ;
                    @endphp
                    <tr>
                        <td>{{$loop->iteration + $penjualan->firstItem() - 1}}</td>
                        <td>{{$d->no_faktur}}</td>
                        <td>{{date('d-m-Y',strtotime($d->tgl_transaksi))}}</td>
                        <td>{{$d->nama_customer}}</td>
                        <td>{{$d->nama_apotek}}</td>
                        <td align="right">{{ number_format($d->total_harga,'0','','.')}}</td>
                        <td align="center">{{$d->diskon}}%</td>
                        <td align="center">{{$d->ppn}}%</td>
                        <td align="right">{{ number_format($total,'0','','.')}}</td>
                        <td>{{$d->name}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-print mr-2"></i> Cetak
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" target="_blank"
                                        href="/penjualan/{{$d->no_faktur}}/76mm/cetakstruk">Struk
                                        Kecil (76mm)</a>
                                    <a class="dropdown-item" target="_blank"
                                        href="/penjualan/{{$d->no_faktur}}/a5/cetakstruk">Invoice</a>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

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
<script>
    document.addEventListener("DOMContentLoaded", function() {
      flatpickr(document.getElementById('dari'), {});
      flatpickr(document.getElementById('sampai'), {});
    });
</script>
@endpush
