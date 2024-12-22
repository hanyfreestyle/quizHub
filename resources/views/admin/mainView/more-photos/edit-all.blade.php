@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-lg-7">
                <h1 class="def_h1">{{ print_h1($thisModel)}}</h1>
            </div>
            <div class="col-lg-5 dir_button">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.more_photos_list', $thisModel->id )}}" type="sort" :tip="false"/>
                <x-admin.form.action-button url="{{route($PrefixRoute.'.edit', $thisModel->id)}}" type="back"/>
            </div>
        </div>
    </x-admin.hmtl.section>


    <x-admin.hmtl.section>
        <x-admin.card.normal :title="__('admin/form.more_photo_edit')">
            <x-admin.hmtl.confirm-massage/>

            @if(count($rowData)>0)
                <form class="mainForm" action="{{route($PrefixRoute.'.morePhotos_updateAll',intval($thisModel->id))}}" method="post">
                    <div class="row">
                        @csrf

                        @foreach($rowData as $photo)
                            <div class="col-lg-12 mb-5">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <input type="hidden" name="id[]" value="{{$photo['id']}}">
                                        <x-admin.form.select-arr label="Photo Position" name="print_photo_{{$photo['id']}}"
                                                                 col="12" sendvalue="{{$photo['print_photo']}}"
                                                                 :send-arr="$PrintPhotoPosition" :labelview="false"/>
                                        <p class="PhotoImageCard mt-3"><img src="{{ defImagesDir($photo['photo']) }}"></p>
                                        @can($PrefixRole.'_edit')
                                            <x-admin.form.action-button url="{{route($PrefixRoute.'.morePhotos_edit',$photo->id)}}" type="edit" :tip="false"/>
                                        @endcan
                                        @can($PrefixRole.'_delete')

                                            <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.morePhotos_delete',$photo->id)}}" :tip="false" type="deleteSweet"/>

                                        @endcan

                                    </div>

                                    @foreach ( config('app.web_lang') as $key=>$lang )
                                        <div class="col-lg-{{getColLang(5,10)}}">
                                            <x-admin.form.text-area name="des_{{$key}}_{{$photo['id']}}" :labelview="false" id="des_{{$key}}_{{$photo['id']}}"
                                                                    value="{!! $photo->translateOrNew($key)->des !!}" :tdir="$key" col="12"/>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                            </div>
                        @endforeach
                        <div class="container-fluid mb-5">
                            <x-admin.form.submit text="Edit"/>
                        </div>
                    </div>
                </form>
            @else
                <div class="col-lg-12">
                    <x-admin.hmtl.alert-massage type="nodata"/>
                </div>
            @endif
        </x-admin.card.normal>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
    @foreach($rowData as $photo)
        @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.java.ckeditor4 name="des_{{$key}}_{{$photo['id']}}" id="des_{{$key}}_{{$photo['id']}}" :dir="$key" :soft="true"/>
        @endforeach
    @endforeach
@endpush
