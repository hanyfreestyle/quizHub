<div class="{{$col}}">
    <div class="{{$style}}">
        @if($t)
            <div class="card-header bg-info">
                <h4>
                    @if($i)
                        <i class="{{$i}}"></i>
                    @endif
                    {{$t}}
                </h4>
            </div>
        @endif
        <div class="card-body">
            {{$slot}}
        </div>
        @if($f)
            <div class="card-footer bg-info">
                <h3 class="mb-0 text-end"> {{$f}}</h3>
            </div>
        @endif
    </div>
</div>
