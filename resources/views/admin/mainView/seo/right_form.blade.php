@if(getSettingValue($controllerName, $modelSettings, 'seo_view'))
    <ul class="nav nav-tabs" id="seo-tab" role="tablist">
        @foreach ( $LangAdd as $key=>$lang )
            <li class="nav-item">
                <a class="nav-link @if($loop->index == 0) active @endif" id="seo-{{$key}}-tab" data-toggle="pill" href="#seo-{{$key}}" role="tab" aria-controls="seo-{{$key}}"
                   @if($loop->index == 0) aria-selected="true" @endif>{{$lang}}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="seo-tabContent">
        @foreach ( $LangAdd as $key=>$lang )
            <div class="tab-pane fade @if($loop->index == 0) show active @endif" id="seo-{{$key}}" role="tabpanel" aria-labelledby="seo-{{$key}}-tab">
                <div class="row">
                    <x-admin.form.trans-input name="g_title" :key="$key" :row="$rowData" :req="false" :label="__('admin/form.text_g_title')" :tdir="$key"/>
                    <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$rowData" :req="false" :label="__('admin/form.text_g_des')" :tdir="$key"/>
                </div>
            </div>
        @endforeach
    </div>
@endif

