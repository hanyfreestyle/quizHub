@php
    $p ="portal/card_template.";
@endphp

<div class="row">
    <div class="col-lg-12">
        <x-portal.html.form-massage/>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <x-portal.html.form :route="route('portal.cards.saveTemplateSettings',$template->uuid)" :err="false">

            <div class="row templateEdit">
                <h3>{{getNameFromCollect($templateList, $template->layout_id, 'name')}}</h3>
                <hr>
            </div>

            <div class="row">
                <x-portal.form.input input-type="color" :row="$template" name="color" col="3|6" lt="{{$p}}fr_color"/>
            </div>

            <div class="row">
                @if(isset($formData['mode']))
                    <x-portal.form.input name="mode" :v="$formData['mode']" :sel-arr="$formInput['mode']"
                                         input-type="defCat" col="4|12" lt="{{$p}}sel_dark_mode_t"/>
                @endif

                @if(isset($formData['desk']))
                    <x-portal.form.input name="desk" :v="$formData['desk']" :sel-arr="$formInput['GridArr']"
                                         input-type="defCat" col="4|12" lt="{{$p}}sel_view_desk_t"/>
                @endif

                @if(isset($formData['mobile']))
                    <x-portal.form.input name="mobile" :v="$formData['mobile']" :sel-arr="$formInput['GridArr']"
                                         input-type="defCat" col="4|12" lt="{{$p}}sel_view_mobile_t"/>
                @endif

                @if(isset($formData['iRadius']))
                    <x-portal.form.input name="iRadius" :v="$formData['iRadius']" :sel-arr="$formInput['iRadius']"
                                         input-type="defCat" col="4|6" lt="{{$p}}sel_icon_radius_t"/>
                @endif

                @if(isset($formData['iColor']))
                    <x-portal.form.input name="iColor" :v="$formData['iColor']" :sel-arr="$formInput['iColor']"
                                         input-type="defCat" col="4|6" lt="{{$p}}sel_icon_color_t"/>
                @endif

                @if(isset($formData['iBorder']))
                    <x-portal.form.input name="iBorder" :v="$formData['iBorder']" :sel-arr="$formInput['iBorder']"
                                         input-type="defCat" col="4|6" lt="{{$p}}sel_icon_border_t"/>
                @endif

                @if(isset($formData['iName']))
                    <x-portal.form.input name="iName" :v="$formData['iName']" :sel-arr="$formInput['iName']"
                                         input-type="defCat" col="4|6" lt="{{$p}}sel_icon_color_t"/>
                @endif

            </div>
            <x-portal.form.button n="edit"/>
        </x-portal.html.form>
    </div>
</div>
