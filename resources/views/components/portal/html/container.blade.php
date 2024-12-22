<div class="{{$style}} container_body">
    <div class="row">
        @if($oneDiv)
            <div class="col-lg-12">
                {{$slot}}
            </div>
        @else
            {{$slot}}
        @endif
    </div>
</div>
