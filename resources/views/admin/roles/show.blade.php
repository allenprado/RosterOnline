@extends('layouts.app')

@section('content')
    @page_(['page'=>__('word.show_crud',['page'=>$page2]), 'nColumn'=>'12'])

        @alert_(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_

        @breadcrumb_(['page'=>$page,'items'=>$breadcumber ?? []])
        @endbreadcrumb_

    <p>@lang('word.name'): <b>{{$register->name}}</b></p>
    <p>@lang('word.description'): <b>{{$register->description}}</b></p>

        @if($delete)
            @form_(['action'=>@route($routeName.".destroy",$register->id), 'method'=>'DELETE'])
                <button class="btn btn-danger btn-lg">@lang('word.delete')</button>
            @endform_
        @endif

    @endpage_
@endsection
