<x-admin.card.collapsed :open="true" :filter="true" :row="$row">
{{--    isset($getSessionData)--}}
    <div class="row">
        <div class="col-lg-12">

            <form action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">

                    <x-admin.form.select-arr name="unit_id" sendvalue="{{old('unit_id',issetArr($getSessionData,'unit_id'))}}" :labelview="true"
                                             select-type="DefCat" :send-arr="$quizCat['units']" label="الوحدة" :filter-form="true" col="2"/>

                    <x-admin.form.select-arr name="section_id" sendvalue="{{old('section_id',issetArr($getSessionData,'section_id'))}}" :labelview="true"
                                             select-type="DefCat" :send-arr="$quizCat['sections']" label="القسم" :filter-form="true" col="2"/>

{{--                    @if(IsConfig($config,'evaluation'))--}}
{{--                        <x-admin.form.select-data name="evaluation_id" sendvalue="{{old('evaluation_id',issetArr($getSessionData,'evaluation_id'))}}" :labelview="false"--}}
{{--                                                  cat-id="EvaluationCust" :label="__($defLang.'form_evaluation')" :filter-form="true" col="2" :req="false"/>--}}
{{--                    @endif--}}

{{--                    @if(IsConfig($config,'gender'))--}}
{{--                        <x-admin.form.select-arr name="gender_id" sendvalue="{{old('gender_id',issetArr($getSessionData,'gender_id'))}}" :labelview="false"--}}
{{--                                                 select-type="DefCat" :send-arr="$DefCat['gender']" :label="__($defLang.'form_gender')" :filter-form="true" col="2"/>--}}
{{--                    @endif--}}


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
