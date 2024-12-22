@push('addThisStyle')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/template_preview.css',$cssMinifyType,true) !!}
@endpush
<div class="card">
    <div class="card-body">
        <div class="templateCard">

            @if($viewType == 'list')
                <h3>{{ $template->name }}</h3>
                <div class="previewTemplateStar">
                    @if($card->layout_id == $template->layout_id)
                        <span class="btn btn-warning"><i class="fa-solid fa-star"></i></span>
                    @endif
                </div>
            @endif
            <x-portal.card-template.photo-preview :template="$template" :card="$card"/>

            @if($viewType == 'list')
                <div class="template_but">
                    @if ($template->status == 'Edit')
                        <a class="btn btn-outline-info" href="{{ route('portal.cards.editTemplateSettings', ['uuid' => $template->uuid]) }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                            {{__('portal/card_template.but_edit')}}

                        </a>

                        @if($card->layout_id != $template->layout_id)
                            <a class="btn btn-outline-warning" href="{{ route('portal.cards.defSetTemplateCard', ['uuid' => $template->uuid]) }}">
                                <i class="fa-solid fa-bullseye"></i>
                                {{__('portal/card_template.but_set')}}
                            </a>
                        @endif

                    @elseif ($template->status == 'Create')
                        <a class="btn btn-outline-secondary"
                           href="{{ route('portal.cards.createTemplateSettings', ['uuid' => $card->uuid,'layout_id' => $template->layout_id]) }}">
                            <i class="fa-solid fa-gear"></i>
                            {{__('portal/card_template.but_add')}}
                        </a>
                    @endif
                </div>
            @endif

            @if($viewType == 'edit')
                <div class="template_but">
                    <a class="btn btn-outline-info" href="{{ route('portal.cards.cardEditTemplate', ['uuid' =>$card->uuid]) }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                        {{__('portal/card_template.but_view_all')}}
                    </a>

                    @if($card->layout_id != $template->layout_id)
                        <a class="btn btn-outline-warning" href="{{ route('portal.cards.defSetTemplateCard', ['uuid' => $template->uuid]) }}">
                            <i class="fa-solid fa-bullseye"></i>
                            {{__('portal/card_template.but_set')}}
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>
