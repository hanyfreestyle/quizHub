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


                <div class="row">
                    <div class="col-lg-12">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route($PrefixRoute.'.store') }}" method="POST">
                            @csrf


                            <div class="row">
                                <input type="hidden" name="class_id" value="1">
                                <input type="hidden" name="subject_id" value="1">
                                <input type="hidden" name="term_id" value="1">
                                <x-admin.form.select-arr name="unit_id" sendvalue="{{old('unit_id')}}" :labelview="true"
                                                         select-type="DefCat" :send-arr="$quizCat['units']" label="الوحدة" :filter-form="true" col="2"/>
                                <x-admin.form.select-arr name="section_id" sendvalue="{{old('section_id')}}" :labelview="true"
                                                         select-type="DefCat" :send-arr="$quizCat['sections']" label="القسم" :filter-form="true" col="2"/>

                            </div>

                            <div class="form-group">
                                <label for="question">السؤال</label>
                                <input type="text" name="question" value="{{ old('question') }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="answers">الإجابات (يجب إضافة 4 إجابات على الأقل)</label>
                                <div id="answers">
                                    @for($i = 0; $i < 4; $i++)
                                        {{--                                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="إجابة {{ $i + 1 }}" @if($i < 2) required @endif>--}}
                                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="إجابة {{ $i + 1 }}" value="{{ old('answers.' . $i) }}"
                                               @if($i < 2) required @endif>                                    @endfor
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="correct_answer">الإجابة الصحيحة</label>
                                <select name="correct_answer" class="form-control" required>
                                    @foreach(range(1, 4) as $index)
                                        {{--                                        <option value="{{ $index }}">إجابة {{ $index }}</option>--}}
                                        <option value="{{ $index }}" @if(old('correct_answer') == $index) selected @endif>إجابة {{ $index }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mb-5">إضافة السؤال</button>
                        </form>

                    </div>
                </div>


            </x-admin.card.normal>
        </div>


    </x-admin.hmtl.section>


@endsection

@push('JsCode')

@endpush
