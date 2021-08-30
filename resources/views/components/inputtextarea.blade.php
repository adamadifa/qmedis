<label for="" class="form-label">{{$label}}</label>
<div class="form-group @error($field) is-invalid @enderror">
  <textarea name="{{$field}}" id="{{$field}}" cols="30" rows="4"
    class="form-control @error($field) is-invalid @enderror ">
    @isset($value) {{old($field) ? old($field) : $value}} @else
    {{old($field)}} @endisset</textarea>
</div>
@error($field) <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror