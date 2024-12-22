@php
    $p ="portal/cards.";
@endphp

@if($formType == 'add')
    <div class="row">
        <x-portal.form.input info="0" :row="$card" name="card_name" col="6|7" lt="{{$p}}fr_card_label" req-type="len[3,20]" i="fa-solid fa-user"/>
        <x-portal.form.input input-type="sel" info="1" name="lang" col="6|5" lt="{{$p}}fr_lang" :sel-arr="config('app.portal_lang')"/>
    </div>
@else
    <div class="row">
        <x-portal.form.input info="1" :row="$card" name="card_name" col="6|7" lt="{{$p}}fr_card_label" i="fa-solid fa-user"/>
        <input type="hidden" name="uuid" value="{{$card->uuid}}">
    </div>
@endif
<div class="row">
    <x-portal.form.input info="1" :row="$card" name="first_name" col="6|12" lt="{{$p}}fr_n_first_name" req-type="len[3,20]" i="fa-solid fa-user"/>
    <x-portal.form.input info="1" :row="$card" name="last_name" col="6|12" lt="{{$p}}fr_n_last_name" req-type="len[3,20]" i="fa-solid fa-user" :req="false"/>

    <x-portal.form.input info="1" :row="$card" name="middle_name" col="5|12" lt="{{$p}}fr_n_middle_name" req-type="len[3,20]" i="fa-solid fa-id-card" :req="false"/>
    <x-portal.form.input info="1" :row="$card" name="prefix" col="3|5" lt="{{$p}}fr_n_prefix" i="fa-solid fa-gem" req-type="len[3,20]" :req="false"/>
    <x-portal.form.input info="1" :row="$card" name="preferred_name" col="4|7" lt="{{$p}}fr_n_preferred_name" req-type="len[3,20]" i="fa fa-user-edit" :req="false"/>
</div>


@if($formType == 'edit')
    <div class="row g-3">
        <x-portal.form.input info="1" :row="$card" name="company_name" col="6|12" lt="{{$p}}fr_company_name" i="fa-solid fa-building" req-type="len[3,50]" :req="false"/>
        <x-portal.form.input info="1" :row="$card" name="job_title" col="6|7" lt="{{$p}}fr_job_title" i="fa-solid fa-id-badge" req-type="len[3,50]" :req="false"/>
        <x-portal.form.input info="1" :row="$card" name="department" col="6|5" lt="{{$p}}fr_department" i="fa-solid fa-briefcase" req-type="len[3,40]" :req="false"/>
        <x-portal.form.input input-type="text" info="1" :row="$card" name="bio" col="6|12" lt="{{$p}}fr_bio" i="fa-solid fa-book-open" req-type="len[10,160]" :req="false"/>
    </div>
@endif

