<div class="row" id="icons-container">
    @foreach ($icons['icons'] as $icon)
        <div class="col-lg-2 icon">
            <svg>
                <use href="{{ svgIcon($icon)}}"></use>
            </svg>
            <div class="name">
                {{$icon}}
            </div>
        </div>
    @endforeach
</div>
