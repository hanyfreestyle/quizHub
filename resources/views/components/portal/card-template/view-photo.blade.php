@foreach($templatePhotos as $key => $value)
    @php
        $dbName = $key;
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="templateCard">
                <h3> {{ __('portal/card_template.h3_'.$key)}}</h3>
                <div class="template_img_div">
                    <img src="{{getCardPhoto($template->$dbName,$key,'m')}}">
                </div>

                <div class="template_but">
                    <a class="btn btn-outline-info" href="{{ route('portal.cards.editTemplatePhoto', ['uuid' =>$template->uuid,'key' => $key]) }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                        {{__('portal/card_template.but_edit')}}
                    </a>

                    @if($template->$dbName)
                        <a class="btn btn-outline-danger" href="{{ route('portal.cards.deleteTemplatePhoto',['uuid' =>$template->uuid,'key' => $key]) }}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach


