@extends('layouts.app')

@section('content')
    @page_(['page'=>__('word.list',['page'=>$page]), 'nColumn'=>'12'])

    @alert_(['msg'=>session('msg'), 'status'=>session('status')])
    @endalert_

    @breadcrumb_(['page'=>$page,'items'=>$breadcumber ?? []])
    @endbreadcrumb_


    @search_(['routeName'=>$routeName,'search'=>$search])
    @endsearch_

    <table class="table table-striped">
        <thead>
        <tr>
            @foreach($columnList as $key => $value)

                <th scope="col">{{$value}}</th>

            @endforeach

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
                    
            </tr>
        @endforeach
        </tbody>
    </table>

    @paginate_(['search'=>$search,'list'=>$list])
    @endpaginate_

    @endpage_
@endsection
