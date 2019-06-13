

<div class="form-group col-6">
  <label for="date">{{ __('word.date') }}</label>
  <div id="date" class="input-append date">
    <input type="text" id="date" class="add-on form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') ?? ($register->date ?? '') }}">
  </div>
  @if ($errors->has('date'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('date') }}</strong>
      </span>
  @endif
</div>

<div class="form-group col-6">
  <label for="hourEnd">{{ __('word.hourEnd') }}</label>
  <div id="time" class="input-append hourStart">
    <input type="text" id="time" class="add-on form-control{{ $errors->has('hourStart') ? ' is-invalid' : '' }}" name="hourStart" value="{{ old('hourStart') ?? ($register->hourStart ?? '') }}" placeholder="00:15:00">
  </div>
  @if ($errors->has('hourStart'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('hourStart') }}</strong>
      </span>
  @endif
</div>

<div class="form-group col-6">
  <label for="hourEnd">{{ __('word.hourEnd') }}</label>
  <div id="time2" class="input-append hourEnd">
    <input type="text" id="time" class="add-on form-control{{ $errors->has('hourEnd') ? ' is-invalid' : '' }}" name="hourEnd" value="{{ old('hourEnd') ?? ($register->hourEnd ?? '') }}" placeholder="00:15:00">
  </div>
  @if ($errors->has('hourEnd'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('hourEnd') }}</strong>
      </span>
  @endif
</div>

<div class="form-group col-6">
  <label for="breakTime">{{ __('word.breakTime') }}</label>
  <div id="time3" class="input-append breakTime">
    <input type="text" id="time" class="add-on form-control{{ $errors->has('breakTime') ? ' is-invalid' : '' }}" name="breakTime" value="{{ old('breakTime') ?? ($register->breakTime ?? '') }}" placeholder="00:15:00">
  </div>
  @if ($errors->has('breakTime'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('breakTime') }}</strong>
      </span>
  @endif
</div>

<div class="form-group col-6">
  <label for="hourSpec">@lang('word.hourSpec')</label>
    <select class="form-control{{ $errors->has('hourSpec') ? ' is-invalid' : '' }}" name="hourSpec">
      @foreach ($listRel2 as $key => $value)
        @php
          $select = '';

          if(old('hourSpec') ?? false){
            if(old('hourSpec') == $value->id){
              $select = 'selected';
            }
          }else{
            if($register_specialhours ?? false){
              if($register_specialhours == $value->id){
              $select = 'selected';
              }
            }
          }
        @endphp
        <option {{$select}} value="{{$value->id}}">{{$value->name}}</option>
        <li>{{$value->name}}</li>
      @endforeach
    </select>
    @if ($errors->has('hourSpec'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('hourSpec') }}</strong>
        </span>
    @endif
</div>

<div class="form-group col-6">
  <label for="company_id">@lang('word.company')</label>
    <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id">
      @foreach ($listRel as $key => $value)
        @php
          $select = '';

          if(old('company_id') ?? false){
            if(old('company_id') == $value->id){
              $select = 'selected';
            }
          }else{
            if($register->company_id ?? false){
              if($register->company_id == $value->id){
              $select = 'selected';
              }
            }
          }
        @endphp
        <option {{$select}} value="{{$value->id}}">{{$value->name}}</option>
        <li>{{$value->name}}</li>
      @endforeach
    </select>
    @if ($errors->has('company_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('company_id') }}</strong>
        </span>
    @endif
</div>
