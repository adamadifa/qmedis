@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card mt-2">
            <div class="card-body">
                <form action="/laporan/cetakpenjualan" method="POST">
                    @csrf
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
                                    <input id="sampai" type="date" value="{{ Request::get('sampai') }}"
                                        placeholder="Sampai" class="form-control" name="sampai" />
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

                    <button class="btn btn-primary  mb-3"><i class="fa fa-print mr-2"></i> Cetak</button>
                    <button class="btn btn-success  mb-3"><i class="fa fa-file-excel-o mr-2"></i> Export to
                        Excel</button>

                </form>
            </div>
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
