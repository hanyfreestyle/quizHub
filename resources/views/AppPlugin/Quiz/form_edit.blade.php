@extends('admin.layouts.app')
@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <x-admin.card.normal title="تعديل السؤال">
                @if($errors->has([]) )
                    <div class="alert alert-danger alert-dismissible mt-2">
                        {{__('admin/alertMass.form_has_error')}}
                    </div>
                @endif


                    <div class="container">


                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route($PrefixRoute.'.update', ['id' => $question->id]) }}" method="POST">
                            @csrf


                            <div class="form-group">
                                <label for="question">السؤال</label>
                                <input type="text" name="question" class="form-control" value="{{ old('question', $question->question) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="answers">الإجابات</label>
                                <div id="answers">
                                    @foreach($question->answers as $index => $answer)
                                        <input type="text" name="answers[]" class="form-control mb-2" value="{{ old('answers.' . $index, $answer->answer) }}" required>
                                        <input type="hidden" name="answer_ids[]" value="{{ $answer->id }}">
                                    @endforeach
                                <!-- إضافة إجابات إضافية -->
                                    @for($i = count($question->answers); $i < 4; $i++)
                                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="إجابة {{ $i + 1 }}" required>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="correct_answer">الإجابة الصحيحة</label>
                                <select name="correct_answer" class="form-control" required>
                                    @foreach($question->answers as $index => $answer)
                                        <option value="{{ $index + 1 }}" {{ $answer->is_correct == 1 ? 'selected' : '' }}>إجابة {{ $index + 1 }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">تحديث السؤال</button>
                        </form>
                    </div>


            </x-admin.card.normal>
        </div>


    </x-admin.hmtl.section>


@endsection

@push('JsCode')

@endpush
