@if($print == 'html')
    <div id="modalCardDataAdd" class="modal fade bd-example-modal-lg modalCardDataAdd" aria-labelledby="modalCardDataAdd"
         tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form class="SaveDataForm g-3 needs-validation custom-input customForm formInputCollects" method="post" novalidate="" data-parsley-validate="">
                    <div id="modalCardDataAddView">

                    </div>
                </form>
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

@endif

@if($print == 'js')
    <script>
        $('.modalCardDataAddBut').on('click', function () {
            var cardId = $(this).data('card-id'); // الحصول على الـ ID من data-id
            var tempId = $(this).data('temp-id'); // الحصول على الـ ID من data-id
            var cardDataId = $(this).data('card-data-id'); // الحصول على الـ ID من data-id

            $.ajax({
                url: '{{route('portal.cards.getDataInput')}}', // المسار الذي يستعلم عن البيانات باستخدام الـ ID
                method: 'GET', // يمكنك استخدام POST إذا كان الطلب يتطلب POST
                data: {cardId: cardId, tempId: tempId, cardDataId: cardDataId}, // إرسال الـ ID في البيانات
                success: function (response) {
                    $('#modalCardDataAddView').html(response.html); // عرض البيانات في المودال
                    $('#modalCardDataAdd').modal('show'); // فتح المودال
                },
                error: function () {
                    $('#modalCardDataAddView').html('حدث خطأ أثناء تحميل البيانات');
                    $('#modalCardDataAdd').modal('show'); // فتح المودال
                }
            });
        });

        $('.modalCardDataEditBut').on('click', function () {
            var cardId = $(this).data('card-id'); // الحصول على الـ ID من data-id
            var tempId = $(this).data('temp-id'); // الحصول على الـ ID من data-id
            var cardDataId = $(this).data('card-data-id'); // الحصول على الـ ID من data-id
            $.ajax({
                url: '{{route('portal.cards.getDataInput')}}', // المسار الذي يستعلم عن البيانات باستخدام الـ ID
                method: 'GET', // يمكنك استخدام POST إذا كان الطلب يتطلب POST
                data: {cardId: cardId, tempId: tempId, cardDataId: cardDataId}, // إرسال الـ ID في البيانات
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
@endif
