<option value="">Kelurahan</option>
@foreach ($kelurahan as $k)
<option @if ($id_kelurahan==$k->id)
    selected
    @endif value="{{$k->id}}">{{$k->vill_name}}</option>
@endforeach
