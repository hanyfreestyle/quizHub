<div class="card text-center ">
    <div class="row">
        <div id="MyCardPreview" class="inputRow">
            <div class="inputEditPageListGrid">
                @foreach($card->card_data as $data)
                    <div class="social-item input_color_box {{ $data->input_info->name_key }} sweetDiv" data-id="{{ $data->id }}" id="item-{{ $data->id }}">
                        <div class="social-info">
                            <i class="{{$data->input_info->icon_i}}"></i>
                            <span>{{$data->label}}</span>
                        </div>
                        <div class="social-actions">
                            <div class="modalCardDataEditBut" data-card-id="{{$data->card_id}}" data-temp-id="{{$data->input_id}}" data-card-data-id="{{$data->id}}"><i class="fa fa-pen"></i></div>
                            <div onclick="deleteItem(this)" class="btns delete-btn"><i class="fa-solid fa-trash"></i></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
