

<div class="form-group col-6">
  <label for="name">{{ __('word.name') }}</label>
  <div id="name" class="input-append name">
    <input type="text" id="name" class="add-on form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? ($register->name ?? '') }}">
  </div>
  @if ($errors->has('name'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>


<div class="form-group col-6">
  <label for="type">{{ __('word.type') }}</label>
  <div id="type" class="input-append type">
    <input type="text" id="type" class="add-on form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') ?? ($register->type ?? '') }}">
  </div>
  @if ($errors->has('type'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('type') }}</strong>
      </span>
  @endif
</div>

<div class="form-group col-6">
  <label for="operator">{{ __('word.operator') }}</label>
  <div id="operator" class="input-append operator">
    <input operator="text" maxlength="1" id="operator" class="add-on form-control{{ $errors->has('operator') ? ' is-invalid' : '' }}" name="operator" value="{{ old('operator') ?? ($register->operator ?? '') }}">
  </div>
  @if ($errors->has('operator'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('operator') }}</strong>
      </span>
  @endif
</div>

<div class="form-group col-6">
  <label for="value">{{ __('word.value') }}</label>
  <div id="value" class="input-append value">
    <input type="text" id="value" class="add-on form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ old('value') ?? ($register->value ?? '') }}">
  </div>
  @if ($errors->has('value'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('value') }}</strong>
      </span>
  @endif
</div>
