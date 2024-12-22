@if($err)
    <x-portal.html.form-massage :full-err="false"/>
@endif
<form action="{{$route}}" method="{{$method}}" class="{{$style}}" {!! $req !!} >
    @csrf
    {{$slot}}
</form>
