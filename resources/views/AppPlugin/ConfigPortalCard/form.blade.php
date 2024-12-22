@extends('admin.layouts.app')
@section('StyleFile')
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>--}}
@endsection
@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <x-admin.card.normal :title="$title">
                @if($errors->has([]) )
                    <div class="alert alert-danger alert-dismissible mt-2">
                        {{__('admin/alertMass.form_has_error')}}
                    </div>
                @endif

                <form class="mainForm" action="{{route($PrefixRoute.'.saveUpdate',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <x-admin.form.select-arr name="cat_id" select-type="DefCat" :row="$rowData" :send-arr="$DefCat['PortalInputCategory']" label="Category" col="3" :req="false"/>
                        <x-admin.form.select-arr name="type" select-type="DefCat" :row="$rowData" :send-arr="$catArr['inputType']" label="Input Type" col="2" />
                        <x-admin.form.select-arr name="input_dir" select-type="DefCat" :row="$rowData" :send-arr="$catArr['inputDir']" label="Input Dir" col="2" />
                        <x-admin.form.input name="input_id" label="Input ID" :row="$rowData" col="3" tdir="en" :req="false"/>
                        <x-admin.form.select-arr name="vip" select-type="DefCat" :row="$rowData" :send-arr="$catArr['inputVip']" label="Vip" col="2" />
                    </div>


                    <div class="row">
                        <x-admin.form.input name="name_key" label="Name Key" :row="$rowData" col="3" tdir="en" :req="false"/>
                        <x-admin.form.input name="icon_i" :row="$rowData" label="Icon" col="3" tdir="en" :req="false"/>
                    </div>
                    <div class="row">
                        @foreach ( config('app.web_lang') as $key=>$lang )
                            <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" col="6" :label="__('admin/form.text_name')" :tdir="$key"/>
                        @endforeach
                    </div>
                    <div class="row">
                        <x-admin.form.input name="url" label="URL" :row="$rowData" col="6" tdir="en" :req="false"/>
                        <x-admin.form.input name="url_user" label="URL User" :row="$rowData" col="6" tdir="en" :req="false"/>
                    </div>

                    <div class="row">
                        <x-admin.form.input name="regex" label="Regex" :row="$rowData" col="12" tdir="en" :req="false"/>
                        <x-admin.form.input name="err_ar" label="Error Ar" :row="$rowData" col="6" tdir="ar" :req="false"/>
                        <x-admin.form.input name="err_en" label="Error En" :row="$rowData" col="6" tdir="en" :req="false"/>
                    </div>



                    <hr>
                    <x-admin.form.submit-role-back :page-data="$pageData"/>
                </form>
            </x-admin.card.normal>
        </div>

        @if($pageData['ViewType'] == 'Edit')
            <x-admin.card.normal title="Existing Suggestions">
                @if($rowData->suggestion_list->isNotEmpty())
                    <form action="{{ route($PrefixRoute.'.updateExistingSuggestions', $rowData->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            @foreach(config('app.portal_lang') as $key => $value )
                                <div class="col-6">
                                    @foreach($rowData->suggestion_list->where('locale',$key) as $suggestion)
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="existingSuggestions[{{ $suggestion->id }}][suggestion]" value="{{ $suggestion->suggestion }}">
                                                <div class="input-group-append">
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger removeExistingBtn"
                                                        data-id="{{ $suggestion->id }}">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                @endif
            </x-admin.card.normal>

            <x-admin.card.normal title="Existing Suggestions">

                <form action="{{ route($PrefixRoute.'.addNewSuggestions', $rowData->id) }}" method="POST" id="suggestionsForm">
                    @csrf

                    <div id="newSuggestionsContainer" class="rows"></div>


                    <button type="button" class="btn btn-secondary mt-2" id="addSuggestionBtn">+ Add Suggestion</button>
                    <button type="submit" class="btn btn-primary mt-3">Add Suggestions</button>
                </form>


            </x-admin.card.normal>
        @endif

    </x-admin.hmtl.section>


@endsection

@push('JsCode')
    <script>
        $(document).ready(function () {
            let suggestionCount = 0;

            $('#addSuggestionBtn').on('click', function () {
                suggestionCount++;
                let newFields = `
            <div class="col-12 dynamic-suggestion-group mb-3" id="suggestionGroup${suggestionCount}">
                <div class="row">
                    <div class="col-5">
                        <label>New Suggestion (Arabic):</label>
                        <input type="text" class="form-control" name="suggestions[${suggestionCount}][ar]" placeholder="Enter suggestion in Arabic" required>
                    </div>
                    <div class="col-5">
                        <label>New Suggestion (English):</label>
                        <input type="text" class="form-control" name="suggestions[${suggestionCount}][en]" placeholder="Enter suggestion in English" required>
                    </div>
                    <div class="col-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger removeSuggestionBtn" data-id="${suggestionCount}">Remove</button>
                    </div>
                </div>
            </div>`;


                $('#newSuggestionsContainer').append(newFields);
            });


            $(document).on('click', '.removeSuggestionBtn', function () {
                let id = $(this).data('id');
                $(`#suggestionGroup${id}`).remove();
            });


            // Remove an existing suggestion
            $(document).on('click', '.removeExistingBtn', function () {
                let id = $(this).data('id');
                let url = "{{ route($PrefixRoute.'.deleteExistingSuggestions', ':id') }}".replace(':id', id);
                if (confirm('Are you sure you want to delete this suggestion?')) {
                    $.ajax({
                        url: url ,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            location.reload();
                        },
                        error: function () {
                            alert('An error occurred while deleting the suggestion.');
                        },
                    });
                }
            });
        });


    </script>
@endpush
