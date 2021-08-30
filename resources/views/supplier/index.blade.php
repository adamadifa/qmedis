@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="card mt-2">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <form action="/supplier" method="GET">
          <div class="input-group">
            <div class="input-icon">
              <span class="input-icon-addon">
                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <circle cx="10" cy="10" r="7" />
                  <line x1="21" y1="21" x2="15" y2="15" /></svg>
              </span>
              <input type="text" class="form-control" value="{{ Request::get('cari') }}" placeholder="Pencarian Data"
                name="cari">
            </div>
            <button type="submit" class="btn btn-success">Cari Data</button>
          </div>
        </form>
      </div>
      <div>
        <a href="/supplier/create" class="btn btn-primary d-none d-sm-inline-block mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
            <th>Kode Supplier</th>
            <th>Nama Supplier</th>
            <th>Alamat</th>
            <th>Contact Person</th>
            <th>No Telepon</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($supplier as $d)
          <tr>
            <td>{{ $loop->iteration + $supplier->firstItem() - 1 }}</td>
            <td>{{$d->kode_supplier}}</td>
            <td>{{$d->nama_supplier}}</td>
            <td>{{$d->alamat_supplier}}</td>
            <td>{{$d->contact_person}}</td>
            <td>{{$d->no_telepon}}</td>

            <td>
              <div class="grid-container">
                <div class="grid-item">
                  <a href="/supplier/{{$d->kode_supplier}}/edit" class="btn btn-sm btn-primary"><i
                      class="fa fa-pencil"></i></a>
                </div>
                <div class="grid-item">
                  <form action="/supplier/{{$d->kode_supplier}}/delete" id="deleteform" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm delete-confirm"><i class="fa fa-trash-o"></i></button>
                  </form>
                </div>

              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4" style="float:right">{{$supplier->links()}}
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