@extends('layouts.tabler')
@section('title',$title)
@section('page-pretitle',$title)
@section('page-title',$title)
@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card mt-2">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
          </div>
          <div>
            <a href="/satuan/create" class="btn btn-primary d-none d-sm-inline-block mb-3">
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
          <table class="table table-boredered table-striped" id="mytable">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Satuan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($satuan as $d)
              <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{$d->satuan}}</td>

                <td>
                  <div class="grid-container">
                    <div class="grid-item">
                      <a href="/satuan/{{$d->id_satuan}}/edit" class="btn btn-sm btn-primary"><i
                          class="fa fa-pencil"></i></a>
                    </div>
                    <div class="grid-item">
                      <form action="/satuan/{{$d->id_satuan}}/delete" id="deleteform" method="post">
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
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('myscript')
<script>
  $(function(){
        $("#mytable").DataTable();
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