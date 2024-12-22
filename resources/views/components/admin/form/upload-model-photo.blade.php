<div class="col-lg-{{$col}}">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group RightPhotoView">
                @if($viewType == true)
                    @if(isset($row->$dbName) and $row->$dbName != '')
                        <div class="col-md-12 form_current_photo">
                            <img src="{{defImagesDir($row->$dbName)}}">
                        </div>
                        @if($remove)
                            <div class="form_current_remove">
                                <x-admin.form.action-button url="{{route($PrefixRoute.$route,$row->id)}}" type="delete" :tip="false"/>
                            </div>
                        @endif
                    @endif
                @endif

                <input class="form-control @error($fileName) is-invalid @enderror" type="file" name="{{$fileName}}@if($multiple)[]@endif" accept="{{$acceptFile}}" @if($multiple) multiple @endif >
                @error($fileName)
                <div class="invalid-feedback" role="alert">
                    <strong>{{ \App\Helpers\AdminHelper::error($message,$fileName,$label) }}</strong>
                </div>
                @enderror

            </div>
        </div>
    </div>
    <div class="row">
        @if($addFilterList)
            @if(intval(issetArr($modelSettings,$controllerName."_select_filter_form",0)) == true)
                <x-admin.form.select-arr
                    :label="__('admin/config/upFilter.form_select_filter_lable')" :send-arr="$filterTypes" :labelview="false"
                    :name="$filterInputName" col="12" :sendvalue="intval(issetArr($modelSettings,$controllerName.$filterName,0))"/>
            @else
                @if(intval(issetArr($modelSettings,$controllerName.$filterName,0)) == 0)
                    <x-admin.form.select-arr :label="__('admin/config/upFilter.form_select_filter_lable')" :name="$filterInputName" col="12"
                                             sendvalue="old($filterInputName)" :send-arr="$filterTypes"/>
                @else
                    <input type="hidden" name="{{$filterInputName}}" value="{{intval(issetArr($modelSettings,$controllerName.$filterName,0))}}">
                @endif
            @endif
        @endif
    </div>
</div>

