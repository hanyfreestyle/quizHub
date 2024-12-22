<div class="template_img_divx previewTemplate_{{$template->layout_id}}">
    @if($template->layout_id == 1)
        <div class="holder">
            <div class="photos">
                <div class="cover">
                    <img src="{{  getCardPhoto($card->all_templates->where('layout_id',1)->first()->cover ?? null,'cover','m')}}" alt="profile">
                </div>
                <div class="profile dir_{{$card->lang}}">
                    <img src="{{  getCardPhoto($card->all_templates->where('layout_id',1)->first()->profile ?? null ,'profile','m')}}" alt="profile">
                </div>
            </div>
            <div class="name dir_{{$card->lang}}">
                <h1> {{$card->first_name }} <span style="color: {{$card->all_templates->where('layout_id',1)->first()->color}}">{{$card->last_name }}</span></h1>
            </div>
            <div class="icons">
                @foreach($card->card_data->take(12) as $data)
                    <i class="{{$data->input_info->icon_i }} input_color_box {{$data->input_info->name_key }}"></i>
                @endforeach
            </div>
        </div>
    @elseif($template->layout_id == 2)
        <div class="holder">
            <div class="profile">
                <img src="{{  getCardPhoto($card->all_templates->where('layout_id',2)->first()->profile ?? null,'profile','m-w')}}" alt="profile">
            </div>
            <div class="name">
                <h1> {{$card->first_name }} <span style="color: {{$card->all_templates->where('layout_id',1)->first()->color}}">{{$card->last_name }}</span></h1>
            </div>
        </div>
    @elseif($template->layout_id == 3)
    @elseif($template->layout_id == 4)

    @endif

</div>


<div class="previewTemplate_1">
    <div class="holder">
        <div class="photos">
            <div class="cover">
                <img>
            </div>
            <div class="profile">
                <img>
            </div>
        </div>
        <div class="name">
            <h1>Hany Darwish</h1>
        </div>
        <div class="icons">

        </div>
    </div>
</div>
