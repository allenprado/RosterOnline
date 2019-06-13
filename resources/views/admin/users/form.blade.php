<div class="row">
  <div class="form-group col-6">
    <label for="name">@lang('word.name')</label>
    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? ($register->name ?? '')}}">
    @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
    <label for="email">@lang('word.email')</label>
    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  value="{{ old('email') ?? ($register->email ?? '') }}">
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
      <label for="password">@lang('word.password')</label>
      <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  value="">
      @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
  </div>
  <div class="form-group col-6">
      <label for="password-confirmation">@lang('word.confirm_password')</label>
      <input type="password" class="form-control" name="password_confirmation" value="">
  </div>

  <div class="form-group col-6">
    <label for="roles">{{ __('word.role') }}</label>
    <select class="form-control" multiple name="roles[]">
      @foreach ($roles as $key => $value)
        @php
          $select = '';
          if(old('roles') ?? false){
            foreach (old('roles') as $key => $id) {
              if($id == $value->id){
                $select = "selected";
              }
            }
          }else{
            if($register ?? false){

              foreach ($register->roles as $key => $role) {
                if($role->id  == $value->id){
                  $select = "selected";
                }
              }
            }
          }
        @endphp
        <option {{$select}} value="{{$value->id}}">{{$value->name}}</option>
      @endforeach
    </select>
  </div>
</div>