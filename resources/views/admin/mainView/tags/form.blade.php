@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="config" value="{{json_encode($config)}}">

                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-12">
                            <div class="row">
                                <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" col="6" :label="__('admin/form.text_name')" :tdir="$key"/>
                                <x-admin.form.slug :viewtype="$pageData['ViewType']" :key="$key" :row="$rowData"/>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr>
                <div class="row">
                    <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"
                                               page-view="{{$pageData['ViewType']}}"/>

                </div>
                <hr>
                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
@endpush
