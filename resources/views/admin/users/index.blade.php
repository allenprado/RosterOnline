@extends('layouts.app')

@section('content')
    @page_(['page'=>__('word.list',['page'=>$page]), 'nColumn'=>'12'])

    @alert_(['msg'=>session('msg'), 'status'=>session('status')])
    @endalert_

    @breadcrumb_(['page'=>$page,'items'=>$breadcumber ?? []])
    @endbreadcrumb_


    @search_(['routeName'=>$routeName,'search'=>$search])
    @endsearch_

    @table_(['columnList'=>$columnList, 'list'=>$list, 'routeName'=>$routeName])
    @endtable_

    @paginate_(['search'=>$search,'list'=>$list])
    @endpaginate_

    @endpage_
@endsection
