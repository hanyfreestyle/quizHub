@extends('quiz.layouts.app')

@section('content')
    <x-portal.quiz.template.temp2  :questions="$questions" />
@endsection
