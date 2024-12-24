@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-12">
                <x-app-plugin.quiz.filter-form form-name="{{$formName}}" :row="$rowData" :config="$config"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-12 dir_button">
                <a class="btn btn-primary" href="{{route($PrefixRoute.".create")}}">{{__('admin/portalCard.form_add')}}</a>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_250 desktop">السؤال</th>
                    <th class="TD_80 ">الوحدة</th>
                    <th class="TD_80 ">القسم</th>
{{--                    <th class="TD_100">{{__('admin/usersApp.table_phone')}}</th>--}}
{{--                    <th class="TD_100 desktop">{{__('admin/usersApp.table_email')}}</th>--}}

                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete" :view-but="true"/>

                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </x-admin.card.def>
    </x-admin.hmtl.section>

@endsection

@push('JsCode')

    <x-admin.data-table.sweet-dalete/>
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 25,
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "remove_id"},

                    {data: 'question', name: 'question', orderable: true, searchable: true},

                    {data: 'unit_id', name: 'unit_id', orderable: true, searchable: false, className: "text-center"},
                    {data: 'section_id', name: 'section_id', orderable: true, searchable: false, className: "text-center"},
                    {{--{data: 'email', name: 'users_app.email', orderable: true, searchable: true, className: "text-center"},--}}
                    {{--@if($pageViewIndex == "SoftDelete")--}}
                    {{--@include('datatable.index_action_but',['type'=> 'deleted_at','view'=>true  ])--}}
                    {{--@include('datatable.index_action_but',['type'=> 'Restore','view'=>true  ])--}}
                    {{--@include('datatable.index_action_but',['type'=> 'ForceDelete','view'=>true  ])--}}

                    {{--@include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>"passwordEdit"])--}}
                    {{--@include('datatable.index_action_but',['type'=> 'isActive'])--}}
                    {{--@include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>"isArchived"])--}}
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=>true  ])

                ],
            });
        });
    </script>
@endpush

