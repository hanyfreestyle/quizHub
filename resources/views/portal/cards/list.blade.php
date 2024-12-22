@extends('portal.layouts.app')
@section('BeforStrap')

@endsection
@section('content')
    <x-portal.dash.layouts.breadcrumb :page="$page"/>
    <div class="container-fluid container_body_x cardListPage">
        <div class="row" id="section-to-refresh">

            <x-portal.card.profile-list :row="$cards"/>

            <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
                <div class="card addNewCard">
                    <div class="card-body">
                        <a href="{{ route('portal.cards.cardAdd') }}">
                            <div class="btnAdd"><i class="fa fa-plus"></i></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div id="modalCardDataEdit" class="modal fade bd-example-modal-lg modalCardDataEdit" aria-labelledby="modalCardDataEdit"
             tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form class="EditDataForm g-3 needs-validation custom-input customForm formInputCollects" method="post" novalidate="" data-parsley-validate="">
                        <div id="modalCardDataEditView">

                        </div>
                    </form>
                </div>
            </div>
        </div>


@endsection

@section('AddScript')
    <script>

        $('.modalOpenQrCode').on('click', function () {
            var cardId = $(this).data('card-id'); // الحصول على الـ ID من data-id
            // alert(cardId);

            $.ajax({
                url: '{{route('portal.cards.getQrCodePopUp')}}', // المسار الذي يستعلم عن البيانات باستخدام الـ ID
                method: 'GET', // يمكنك استخدام POST إذا كان الطلب يتطلب POST
                data: {cardId: cardId}, // إرسال الـ ID في البيانات
                success: function (response) {
                    $('#modalCardDataEditView').html(response.html); // عرض البيانات في المودال
                    $('#modalCardDataEdit').modal('show'); // فتح المودال
                },
                error: function () {
                    $('#modalCardDataEditView').html('حدث خطأ أثناء تحميل البيانات');
                    $('#modalCardDataEdit').modal('show'); // فتح المودال
                }
            });
        });
    </script>

    <x-portal.dynamic.jave-code-for-text parent-card="card_dynamic_field" :route-action="route('portal.cards.updateJobTitle')"/>
    <x-portal.js.card-status-toggle/>
    <x-portal.js.sweet-alert-def/>
@endsection



