<option value="">Kabupaten/Kota</option>
@foreach ($kota as $k)
<option @if ($id_kota==$k->id)
    selected
    @endif value="{{$k->id}}">{{$k->regc_name}}</option>
@endforeach
