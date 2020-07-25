@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(isset($log))
    @if(count($log) > 0)
        @if(array_key_exists('danger', $log))
            @foreach($log['danger'] as $value)
                <div class="alert alert-danger" role="alert">{{$value}}</div>
            @endforeach
        @endif
        @if(array_key_exists('warning', $log))
            @foreach($log['warning'] as $value)
                <div class="alert alert-warning" role="alert">{{$value}}</div>
            @endforeach
        @endif
        @if(array_key_exists('success', $log))
            @foreach($log['success'] as $value)
                <div class="alert alert-success" role="alert">{{$value}}</div>
            @endforeach
        @endif
    @endif
@endif
