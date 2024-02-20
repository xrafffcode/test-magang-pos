<div class="row align-items-center my-2">
  <div class="col-md-4">
    <label>{{ $label }}</label>
  </div>
  <div class="col-md-6">
    <textarea class="form-control" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" cols="30" rows="5" {{ $required ?? "" }}>{{ $value ?? '' }}</textarea>
    <div></div>
  </div>
</div>