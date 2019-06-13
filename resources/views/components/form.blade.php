@php


    $method_input = "";
    $method = strtolower($method);
     switch ($method)
        {
            case "post":
                $method = "post";
                break;
            case "put":
                $method = "post";
                $method_input = method_field('PUT');
                break;
            case "delete":
                $method = "post";
                $method_input = method_field('DELETE');
                break;
            default:
                $method = "get";
        }
@endphp

<form action="{{$action}}" method="{{$method}}">
    @csrf

    {{$method_input}}

    {{$slot}}

</form>
