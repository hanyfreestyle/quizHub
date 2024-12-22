@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.$route,$rowData->uuid ?? 0)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">

                <div class="row">
                    <x-admin.form.input :row="$rowData" name="name" :label="__('admin/usersApp.form_name')" col="6"/>
                </div>

                <div class="row">
                    <x-admin.form.phone name="phone" :row="$rowData" :label="__('admin/resume.from_main_phone')"
                                        :initial-country="issetArr($rowData,'phone_code',IsConfig($config,'defCountry'))" col="4" :req="false"/>

                    <x-admin.form.phone name="whatsapp" :row="$rowData" :label="__('admin/resume.from_main_whatsapp')"
                                        :initial-country="issetArr($rowData,'whatsapp_code',IsConfig($config,'defCountry'))" col="4" :req="false"/>

                    <x-admin.form.input name="email" :row="$rowData" :req="false" :label="__('admin/resume.from_main_email')" col="4" tdir="en" :req="false"/>
                </div>

                <hr>

                <div class="row">
                    <x-admin.form.check-active name="is_active" :row="$rowData" lable="{{__('admin/def.status')}}" :page-view="$pageData['ViewType']"/>
                </div>

                <x-admin.form.submit-role-back :page-data="$pageData"/>

            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')

@endpush
