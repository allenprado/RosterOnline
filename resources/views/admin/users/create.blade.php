@extends('layouts.app')

@section('content')
    @page_(['page'=>__('word.create_crud',['page'=>$page_create]), 'nColumn'=>'12'])

        @alert_(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_

        @breadcrumb_(['page'=>$page,'items'=>$breadcumber ?? []])
        @endbreadcrumb_

        @form_(['action'=>@route($routeName.".store"), 'method'=>'POST'])

        @include('admin.'.$routeName.'.form')

        <button class="btn btn-primary btn-lg float-right">@lang('word.adicionar')</button>
        @endform_
    @endpage_
@endsection
