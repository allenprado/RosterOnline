@if ($msg)
    @php
        switch ($status)
        {
            case "error":
                $status = "danger";
                break;
            case "notification":
                $status = "info";
                break;
            default:
                $status = "success";
        }
    @endphp
    <div class="alert alert-{{ $status }}" role="alert">
        {{ $msg }}
    </div>
@endif
