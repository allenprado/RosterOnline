
<form class="form-inline" method="get" action="{{route($routeName.'.index')}}">


@if($routeName == 'users')
  @can ('create-users')
    <div class="form-group mb-2">
        <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2">@lang('word.adicionar')</a>
    </div>
  @endcan
@endif
@if($routeName == 'rules')
  @can ('create-rules')
    <div class="form-group mb-2">
        <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2">@lang('word.adicionar')</a>
    </div>
  @endcan
@endif
@if($routeName == 'permissions')
  @can ('create-permissions')
    <div class="form-group mb-2">
        <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2">@lang('word.adicionar')</a>
    </div>
  @endcan
@endif
@if($routeName == 'companies')
  @can ('create-companies')
    <div class="form-group mb-2">
        <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2">@lang('word.adicionar')</a>
    </div>
  @endcan
@endif
@if($routeName == 'shifts')
  @can ('create-shifts')
    <div class="form-group mb-2">
        <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2">@lang('word.adicionar')</a>
    </div>
  @endcan
@endif
@if($routeName == 'specialHours')
  @can ('create-specialHours')
    <div class="form-group mb-2">
        <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2">@lang('word.adicionar')</a>
    </div>
  @endcan
@endif



    <div class="form-group mx-sm-3 mb-2">
        <input type="search" class="form-control" name="search" placeholder="@lang('word.busca')" value="{{$search}}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">@lang('word.buscar')</button>
    <a href="{{route($routeName.'.index')}}" class="btn btn-warning mb-2">@lang('word.limpar')</a>
</form>
