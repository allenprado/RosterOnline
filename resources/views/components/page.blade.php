
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-{{$nColumn}}">
              <div class="card shadow mb-4">
                <div class="card-header py-3">{{$page}}</div>

                    <div class="card-body">

                        {{$slot}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
