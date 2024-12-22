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


                    <div class="container">


                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route($PrefixRoute.'.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="question">السؤال</label>
                                <input type="text" name="question" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="answers">الإجابات (يجب إضافة 4 إجابات على الأقل)</label>
                                <div id="answers">
                                    @for($i = 0; $i < 4; $i++)
                                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="إجابة {{ $i + 1 }}" required>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="correct_answer">الإجابة الصحيحة</label>
                                <select name="correct_answer" class="form-control" required>
                                    @foreach(range(1, 4) as $index)
                                        <option value="{{ $index }}">إجابة {{ $index }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mb-5">إضافة السؤال</button>
                        </form>
                    </div>


            </x-admin.card.normal>
        </div>


    </x-admin.hmtl.section>


@endsection

@push('JsCode')

@endpush
