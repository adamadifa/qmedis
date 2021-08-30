<label class="form-label">{{$label}}</label>
<div class="form-group @error($field) is-invalid @enderror">
  <select name=" {{$field}}" id="{{$field}}" class="form-select @error($field) is-invalid @enderror">
    <option value="">Jenis Kelamin</option>
    <option @isset($value) @if (old($field)) {{old($field)=="L"?"selected" :""}} @else {{$value=="L"?"selected" :""}}
      @endif @else {{old($field)=="L"?"selected" :""}} @endisset value="L">
      Laki - Laki
    </option>

    <option @isset($value) @if (old($field)) {{old($field)=="P"?"selected" :""}} @else {{$value=="P"?"selected" :""}}
      @endif @else {{old($field)=="P"?"selected" :""}} @endisset value="P">Perempuan</option>
  </select>
</div>
@error($field) <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror