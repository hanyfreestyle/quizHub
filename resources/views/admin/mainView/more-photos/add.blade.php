@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.confirm-massage/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-lg-6">
                <h1 class="def_h1_new">{!! print_h1($Model) !!}</h1>
            </div>
            <div class="col-lg-6 dir_button">
                {{--                @if( IsConfig($config,'MorePhotosEdit'))--}}
                {{--                    @can($PrefixRole.'_edit')--}}
                {{--                        <td class="tc">--}}
                {{--                            <x-admin.form.action-button url="{{route($PrefixRoute.'.More_PhotosEditAll',$Model->id)}}" type="edit" :tip="false"/>--}}
                {{--                        </td>--}}
                {{--                    @endcan--}}
                {{--                @endif--}}
                <x-admin.form.action-button url="{{route($PrefixRoute.'.edit', $Model->id)}}" type="back"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-9">
                <x-admin.card.normal>
                    <div class="row">
                        @if(count($ListPhotos)>0)
                            <div class="row col-lg-12 mb-3 text-left float-left">
                                @can($PrefixRole.'_delete')
                                    <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.morePhotos_deleteAll',$Model->id)}}" :tip="false" type="deleteSweetAll"/>
                                @endcan
                            </div>

                            <div class="row col-lg-12 hanySort">
                                @foreach($ListPhotos as $Photo)
                                    <div class="col-lg-2 ListThisItam" data-index="{{$Photo->id}}" data-position="{{$Photo->position}}">
                                        <p class="PhotoImageCard"><img src="{{ defImagesDir($Photo->photo) }}"></p>
                                        <div class="buttons mb-3">
                                            @can($PrefixRole.'_delete')
                                                <td class="tc">
                                                    <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.morePhotos_delete',$Photo->id)}}" type="deleteSweet"/>
                                                </td>
                                            @endcan
                                            @if(IsConfig($config,'MorePhotosEdit'))
                                                @can($PrefixRole.'_edit')
                                                    <td class="tc">
                                                        <x-admin.form.action-button url="{{route($PrefixRoute.'.morePhotos_edit',$Photo->id)}}" type="edit"/>
                                                    </td>
                                                @endcan
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="col-lg-12">
                                <x-admin.hmtl.alert-massage type="nodata"/>
                            </div>
                        @endif
                    </div>
                </x-admin.card.normal>
            </div>
            <div class="col-lg-3">
                <x-admin.card.normal>

                    <div class="row">
                        <form class="mainForm" action="{{route($PrefixRoute.'.morePhotos_add')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if($errors->has([]) )
                                <div class="liError">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ trim(str_replace('image', "", $error))  }}</li>
                                    @endforeach
                                </div>
                            @endif

                            <input type="hidden" name="model_id" value="{{intval($Model->id)}}">
                            <input type="hidden" name="name" value="{{$Model->slug}}">
                            <div class="row">
                                <x-admin.form.upload-file-more-photo filterid="{{ IsArr($modelSettings,$controllerName.'_morephoto_filterid',0) }}"/>
                            </div>
                            <div class="container-fluid">
                                <x-admin.form.submit text="Add"/>
                            </div>
                        </form>

                    </div>
                </x-admin.card.normal>
            </div>
        </div>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>
    <x-admin.ajax.sort-code url="{{ route($PrefixRoute.'.morePhotos.saveSort') }}"/>
@endpush
