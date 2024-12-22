<x-admin.card.collapsed :open="isset($getSessionData)" :filter="true" :row="$row">
    <div class="row">
        <div class="col-lg-12">

            <form action="{{route($PrefixRoute.$defRoute)}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    @if(IsConfig($config,'TableCategory'))
                        <x-admin.form.select-multiple name="category_ids" :categories="$CashCategoriesList" :label-view="false" :placeholder="__('admin/proProduct.app_menu_category')"
                                                      :sel-cat="getFilterData($getSessionData, 'category_ids')" :col="6"/>
                    @endif

                    <x-admin.form.input name="name" :value="getFilterData($getSessionData, 'name')" col="6" :labelview="false" :placeholder="true" :label="__('admin/proProduct.pro_text_name')"/>
                </div>

                <div class="row">
                    @if(IsConfig($config,'TableBrand'))
                        <x-admin.form.select-arr name="brand_id" :sendvalue="getFilterData($getSessionData, 'brand_id')" :send-arr="$CashBrandList"
                                                 :l="__('admin/proProduct.app_menu_brand')" col="3" :labelview="false"/>
                    @endif
                    <x-admin.form.select-arr name="on_stock" :sendvalue="getFilterData($getSessionData, 'on_stock')" :labelview="false"
                                             :send-arr="$OnStock_Arr" label="{{__('admin/proProduct.pro_status_stock')}}" col="3"/>

                    <x-admin.form.select-arr name="is_active" :sendvalue="getFilterData($getSessionData, 'is_active')" :labelview="false"
                                             :send-arr="$IsActive_Arr" label="{{__('admin/proProduct.pro_status_is_active')}}" col="3"/>

                    @if(IsConfig($config,'TableAttribute'))
                        <x-admin.form.select-arr name="type" :sendvalue="getFilterData($getSessionData, 'type')" :send-arr="$ProductType_Arr"
                                                 label="{{__('admin/proProduct.pro_type')}}" col="3" :labelview="false"/>
                    @endif


                </div>
                <div class="row">
                    @if($fiterPrice)
                        <x-admin.form.input name="price_from" :value="getFilterData($getSessionData, 'price_from')" col="3" :labelview="false" :placeholder="true"
                                            :label="__('admin/proProduct.pro_filter_price_from')"/>

                        <x-admin.form.input name="price_to" :value="getFilterData($getSessionData, 'price_to')" col="3" :labelview="false" :placeholder="true"
                                            :label="__('admin/proProduct.pro_filter_price_to')"/>
                    @endif

                    @if($fiterDate)
                        <x-admin.form.date type="fromDate" :value="getFilterData($getSessionData, 'from_date')" :labelview="false"/>
                        <x-admin.form.date type="toDate" :value="getFilterData($getSessionData, 'to_date')" :labelview="false"/>
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




@push('JsCode')
    @if($fiterDate)
        <script>
            $('.FilterForm').daterangepicker({
                singleDatePicker: true,
                autoApply: true,
                autoUpdateInput: false,
                showDropdowns: true,
                minYear: 2020,
                locale: {
                    format: "YYYY-MM-DD",
                    cancelLabel: 'Clear'
                },
                maxYear: new Date().getFullYear() + 1, // استخدام JavaScript لاستخراج السنة الحالية
            });

            $('.FilterForm').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('.FilterForm').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });


        </script>
    @endif

@endpush
