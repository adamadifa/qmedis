<option value="">Kecamatan</option>
@foreach ($kecamatan as $k)
<option @if ($id_kecamatan==$k->id)
    selected
    @endif value="{{$k->id}}">{{$k->dist_name}}</option>
@endforeach
