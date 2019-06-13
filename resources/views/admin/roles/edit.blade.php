@extends('layouts.app')

@section('content')
    @page_(['page'=>__('word.edit_crud',['page'=>$page2]), 'nColumn'=>'12'])

        @alert_(['msg'=>session('msg'), 'status'=>session('status')])
        @endalert_

        @breadcrumb_(['page'=>$page,'items'=>$breadcumber ?? []])
        @endbreadcrumb_

        @form_(['action'=>@route($routeName.".update",$register->id), 'method'=>'PUT'])

        @include('admin.'.$routeName.'.form')

        <button class="btn btn-primary btn-lg float-right">@lang('word.edit')</button>
        @endform_
    @endpage_
@endsection
