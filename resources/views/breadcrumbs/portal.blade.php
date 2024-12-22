@unless ($breadcrumbs->isEmpty())
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if(count($breadcrumbs) == 1)
                <li class="breadcrumb-item"><a href="{!! $breadcrumb->url !!}">{!! $breadcrumb->title !!}</a></li>
            @else
                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="breadcrumb-item">
                        <a itemprop="item" href="{!! $breadcrumb->url !!}">
                            {!! $breadcrumb->title !!}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active">{!! $breadcrumb->title !!}</li>
                @endif
            @endif
        @endforeach
    </ol>
@endunless
