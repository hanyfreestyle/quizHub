@extends('portal.layouts.app')

@section('StyleFile')
    {!! $MinifyTools->setWebAssets('assets/portal/')->MinifyCss('css/card/edit_menu.css',$cssMinifyType,true) !!}
@endsection

@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body cardAddForm">
        <div class="row justify-content-center">
            <x-portal.card.edit-menu :card="$card" :sel-route="$selRoute"/>

            <div class="col-lg-11">
                <div class="gridSocialItemSort" id="sortable-list">
                    @foreach($card->card_data as $data)
                        <div class="social-item input_color_box {{ $data->input_info->name_key }}" data-id="{{ $data->id }}" id="item-{{ $data->id }}">
                            <div class="social-info">
                                <i class="{{$data->input_info->icon_i}}"></i>
                                <span>{{$data->label}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {!! printViewCardTemp($card) !!}
@endsection

@section('AddScript')

    <script>
        $(document).ready(function () {
            makeSortable();  // تشغيل makeSortable عند بداية عرض الصفحة
        });

        function makeSortable() {
            var sortable = new Sortable(document.getElementById('sortable-list'), {
                handle: '.social-item',  // تحديد الجزء الذي يتم سحبه (مثل العنصر الرئيسي)
                animation: 150,  // إضافة تأثير السحب
                onEnd: function (evt) {
                    console.log('تم تغيير ترتيب العناصر');
                    var itemOrder = [];
                    $('#sortable-list .social-item').each(function () {
                        itemOrder.push($(this).data('id'));  // الحصول على id العنصر بعد الترتيب
                    });
                    console.log('ترتيب العناصر الجديد:', itemOrder);
                    // يمكنك إرسال الترتيب الجديد إلى الخادم عبر AJAX لتحديثه في قاعدة البيانات

                    $.ajax({
                        url: '{{ route('portal.cards.updateCardOrder') }}',  // مسار تحديث الترتيب
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            order: itemOrder
                        },
                        success: function (response) {

                        }
                    });
                },
            });
        }
    </script>
@endsection
