<div class="row">
    <div class="form-group col-6">
        <label for="name">@lang('word.name')</label>
        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"  value="{{ old('name') ?? ($register->name ?? '')}}">
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="valHour">@lang('word.valHour')</label>
        <input type="text" id="currency" class="form-control{{ $errors->has('valHour') ? ' is-invalid' : '' }}" name="valHour"  value="{{ old('valHour') ?? ($register->valHour ?? '')}}">
        @if ($errors->has('valHour'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('valHour') }}</strong>
            </span>
        @endif
    </div>
</div>
<script type="text/javascript">
  $("#currency").maskMoney();
</script>
