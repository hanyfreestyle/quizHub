@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_50 desktop">{{__('admin/usersApp.table_date')}}</th>
                    <th class="TD_200 ">{{__('admin/usersApp.table_name')}}</th>
                    <th class="TD_100">{{__('admin/usersApp.table_phone')}}</th>
                    <th class="TD_100 desktop">{{__('admin/usersApp.table_email')}}</th>
                    @if($pageViewIndex == "SoftDelete")
                        <x-admin.table.soft-delete/>
                    @else
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="isActive"/>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="delete" :view-but="true"/>
                    @endif
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
                pageLength: {{$yajraPerPage}},
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable",['pageViewIndex'=>$pageViewIndex,'formName'=>$formName]) }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: true, className: "remove_id"},
                    {'name': 'created_at', 'data': {'_': 'created_at.display', 'sort': 'created_at.timestamp'}},
                    {data: 'name', name: 'users_app.name', orderable: true, searchable: true},
                    {data: 'phone', name: 'users_app.phone', orderable: true, searchable: true, className: "text-center"},
                    {data: 'email', name: 'users_app.email', orderable: true, searchable: true, className: "text-center"},
                    @if($pageViewIndex == "SoftDelete")
                    @include('datatable.index_action_but',['type'=> 'deleted_at','view'=>true  ])
                    @include('datatable.index_action_but',['type'=> 'Restore','view'=>true  ])
                    @include('datatable.index_action_but',['type'=> 'ForceDelete','view'=>true  ])
                    @else
                    @include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>"passwordEdit"])
                    @include('datatable.index_action_but',['type'=> 'isActive'])
                    @include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>"isArchived"])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=>true  ])
                    @endif
                ],
            });
        });
    </script>
@endpush
