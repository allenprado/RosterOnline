@extends('layouts.app')

@section('content')
    @page_(['page'=>__('word.show_crud',['page'=>$page2]), 'nColumn'=>'12'])

        @alert_(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_

        @breadcrumb_(['page'=>$page,'items'=>$breadcumber ?? []])
        @endbreadcrumb_

    <p>@lang('word.date'): <b>{{$register->date}}</b></p>
    <p>@lang('word.company_name'): <b>{{$register->company_name}}</b></p>
    <p>@lang('word.hourStart'): <b>{{$register->hourStart}}</b></p>
    <p>@lang('word.hourEnd'): <b>{{$register->hourEnd}}</b></p>
    <p>@lang('word.breakTime'): <b>{{$register->breakTime}}</b></p>
    <p>@lang('word.hourSpec'): <b>{{$register->hourSpec}}</b></p>
    <p>@lang('word.total_day'): <b>{{$register->total_day}}</b></p>
    <p>@lang('word.total_money'): <b>{{$register->total_money}}</b></p>

        @if($delete)
            @form_(['action'=>@route($routeName.".destroy",$register->id), 'method'=>'DELETE'])
                <button class="btn btn-danger btn-lg">@lang('word.delete')</button>
            @endform_
        @endif

    @endpage_
@endsection
