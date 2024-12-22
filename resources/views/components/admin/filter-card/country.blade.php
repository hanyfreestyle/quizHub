<x-admin.card.collapsed :open="isset($getSessionData)" :filter="true" :row="$row">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    @if($isActive)
                        <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',issetArr($getSessionData,'is_active',null))}}"
                                                 :labelview="false" select-type="selActiveFilter" label="{{__('admin/formFilter.fr_satus')}}" :required-span="false" col="3"/>
                    @endif
                    @if($continent)
                        <x-admin.form.select-arr name="continent_code" sendvalue="{{old('continent_code',issetArr($getSessionData,'continent_code'))}}"
                                                 :labelview="false" :send-arr="$Continent_Arr" label="{{__('admin/dataCountry.t_continent')}}" col="3" :required-span="false"/>
                    @endif
                    @if($countryId)
                        @if(File::isFile(base_path('routes/AppPlugin/data/country.php')))
                            <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($getSessionData,'country_id'))"
                                                     add-filde="phone" :send-arr="$CashCountryList" label="{{__('admin/def.form_country')}}" :required-span="false"
                                                     :labelview="false" col="3"/>
                        @endif
                    @endif

                    @if($cityId)
                        @if(issetArr($getSessionData,'country_id') and count($cityList) > 0 )
                            <x-admin.form.select-arr name="city_id" :sendvalue="old('city_id',issetArr($getSessionData,'city_id'))"
                                                     :labelview="false" :send-arr="$cityList" label="{{__('admin/dataArea.form_sel_city')}}" :required-span="false" col="3"/>
                        @endif
                    @endif

                    @if($areaId)
                        @if(issetArr($getSessionData,'city_id') and count($areaList) > 0 )
                            <x-admin.form.select-arr name="area_id" :sendvalue="old('area_id',issetArr($getSessionData,'area_id'))"
                                                     :labelview="false" :send-arr="$areaList" label="{{__('admin/dataArea.form_sel_area')}}" :required-span="false" col="3"/>
                        @endif
                    @endif


                </div>
                <div class="row formFilterBut">
                    <button type="submit" name="Forget" class="btn btn-dark btn-sm adminButMobile"><i class="fas fa-filter"></i> {{__('admin/formFilter.but_filter')}}</button>
                </div>
            </form>
            @if(isset($getSessionData))
                <div class="row formForgetBut">
                    <form action="{{route('admin.ForgetSession')}}" method="post">
                        @csrf
                        <input type="hidden" name="formName" value="{{$formName}}">
                        <button type="submit" name="Forget" class="btn btn-danger btn-sm adminButMobile"><i class="fas fa-trash-alt"></i> {{__('admin/formFilter.but_clear')}}</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-admin.card.collapsed>
