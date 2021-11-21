@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
                {{--<span class="float-end" onclick="this.parentNode.parentNode.removeChild(this.parentNode)">&times;</span>--}}
                <span class="btn-close float-end" onclick="this.parentNode.parentNode.removeChild(this.parentNode)"></span>
            </p>
        </div>
    @endif
@endforeach
