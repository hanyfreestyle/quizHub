<x-admin.hmtl.section>
    @if($pageData['ViewType'] == 'Edit')
        <div class="row mb-3">
            <div class="col-5">
                <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
            </div>
            <div class="col-7 dir_button">
                @if(IsConfig($config,'TableMorePhotos'))
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.morePhotos_list',$row->id)}}" :tip="false" type="morePhoto"/>
                @endif
                @if($webSlug != '#' and $row->slug)
                    <x-admin.form.action-button url="{{route($webSlug,$row->slug)}}" type="webView" :tip="false"/>
                @endif
            </div>
        </div>

    @elseif( $pageData['ViewType'] == 'ManageAttribute')
        <div class="row mb-3">
            <div class="col-5">
                <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
            </div>
            <div class="col-7 dir_button">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.edit',$row->id)}}" type="back" :tip="false"/>
            </div>
        </div>
    @endif
</x-admin.hmtl.section>
