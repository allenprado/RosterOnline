<table class="table table-striped">
    <thead>
    <tr>
        @foreach($columnList as $key => $value)

            <th scope="col">{{$value}}</th>

        @endforeach
            <th scope="col">@lang('word.action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($list as $key => $value)
        <tr>
            @foreach($columnList as $key2 => $value2)

                @if($key2 == 'id')
                    <th scope="row">@php echo $value->{$key2} @endphp</th>
                @else
                    <td>@php echo $value->{$key2} @endphp</td>


                @endif

            @endforeach
                <td>

                @if($routeName == 'users')
                  @can('show-users')
                    <a href="{{route($routeName.'.show',$value->id)}}"><i class="fas fa-search-plus" style="color:blue"></i></a>
                  @endcan
                @endif

                @if($routeName == 'permissions')
                  @can('show-permissions')
                    <a href="{{route($routeName.'.show',$value->id)}}"><i class="fas fa-search-plus" style="color:blue"></i></a>
                  @endcan
                @endif

                @if($routeName == 'roles')
                  @can('show-rules')
                    <a href="{{route($routeName.'.show',$value->id)}}"><i class="fas fa-search-plus" style="color:blue"></i></a>
                  @endcan
                @endif

                @if($routeName == 'companies')
                  @can('show-companies')
                    <a href="{{route($routeName.'.show',$value->id)}}"><i class="fas fa-search-plus" style="color:blue"></i></a>
                  @endcan
                @endif

                @if($routeName == 'shifts')
                  @can('show-shifts')
                    <a href="{{route($routeName.'.show',$value->id)}}"><i class="fas fa-search-plus" style="color:blue"></i></a>
                  @endcan
                @endif

                @if($routeName == 'specialHours')
                  @can('show-specialHours')
                    <a href="{{route($routeName.'.show',$value->id)}}"><i class="fas fa-search-plus" style="color:blue"></i></a>
                  @endcan
                @endif


                    &nbsp;
                    &nbsp;
                    &nbsp;

                    @if($routeName == 'users')
                      @can('edit-users')
                          <a href="{{route($routeName.'.edit',$value->id)}}"><i class="fas fa-edit" style="color:green"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'permissions')
                      @can('edit-permissions')
                          <a href="{{route($routeName.'.edit',$value->id)}}"><i class="fas fa-edit" style="color:green"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'roles')
                      @can('edit-roles')
                        <a href="{{route($routeName.'.edit',$value->id)}}"><i class="fas fa-edit" style="color:green"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'companies')
                      @can('edit-companies')
                        <a href="{{route($routeName.'.edit',$value->id)}}"><i class="fas fa-edit" style="color:green"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'shifts')
                      @can('edit-shifts')
                        <a href="{{route($routeName.'.edit',$value->id)}}"><i class="fas fa-edit" style="color:green"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'specialHours')
                      @can('edit-specialHours')
                        <a href="{{route($routeName.'.edit',$value->id)}}"><i class="fas fa-edit" style="color:green"></i></a>
                      @endcan
                    @endif

                    &nbsp;
                    &nbsp;
                    &nbsp;

                    @if($routeName == 'users')
                      @can('delete-users')
                          <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}"><i class="far fa-trash-alt" style="color:red"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'permissions')
                      @can('delete-permissions')
                          <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}"><i class="far fa-trash-alt" style="color:red"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'roles')
                      @can('delete-roles')
                        <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}"><i class="far fa-trash-alt" style="color:red"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'companies')
                      @can('delete-companies')
                        <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}"><i class="far fa-trash-alt" style="color:red"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'shifts')
                      @can('delete-shifts')
                        <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}"><i class="far fa-trash-alt" style="color:red"></i></a>
                      @endcan
                    @endif

                    @if($routeName == 'specialHours')
                      @can('delete-specialHours')
                        <a href="{{route($routeName.'.show',[$value->id,'delete=1'])}}"><i class="far fa-trash-alt" style="color:red"></i></a>
                      @endcan
                    @endif


                </td>
        </tr>
    @endforeach
    </tbody>
</table>
