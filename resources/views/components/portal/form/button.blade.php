<div class="d-flex gap-2 justify-content-end formSubmit">
    @if($type == 'submit')
        <button type="submit" class="btn btn-{{$bg}}">
            @if($i)
                <i class="{{$i}}"></i>
            @endif
            {{$n}}
        </button>
    @elseif( $type == 'button')
        <button id="{{$id}}" class="btn btn-{{$bg}}">
            @if($i)
                <i class="{{$i}}"></i>
            @endif
            {{$n}}
        </button>
    @endif
    @if($back)
        @if($back == 'self')
            <a class="btn btn-danger" onclick="location.reload();"><i class="fa-solid fa-xmark"></i> {{__('portal/dash.but_cancel')}}</a>
        @else
            <a class="btn btn-danger" href="{{$back}}"><i class="fa-solid fa-xmark"></i> {{__('portal/dash.but_cancel')}}</a>
        @endif

    @endif
</div>

