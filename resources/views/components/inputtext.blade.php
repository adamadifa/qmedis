<label class="form-label">{{$label}}</label>
<div class="input-icon @error($field) is-invalid @enderror">
  <span class="input-icon-addon">
    {!! $icon !!}
  </span>
  <input type="text" name="{{$field}}" id="{{$field}}" @isset($value) value="{{old($field) ? old($field) : $value}}"
    @else value="{{old($field)}}" @endisset @isset($readonly) readonly="{{$readonly}}" @endisset @isset($style)
    style="{{$style}}" @endisset class="form-control uppercase @error($field) is-invalid @enderror"
    placeholder="{{$placeholder}}">
</div>
@error($field) <div class="mb-2 mt-2 invalid-feedback">{{ucwords($message)}}</div> @enderror