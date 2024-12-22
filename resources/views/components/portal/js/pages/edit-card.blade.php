<script>
    $(document).on('submit', '.SaveDataForm', function (event) {
        event.preventDefault();  // لمنع إرسال النموذج بالطريقة التقليدية
        var form = $(this);  // الحصول على النموذج الحالي
        var formData = form.serialize();  // جمع البيانات من النموذج
        var cardID = form.find('#cardID').val();

        $.ajax({
            url: '{{route('portal.cards.inputSaveData')}}',  // تأكد من أن هذا هو الرابط الصحيح لحفظ البيانات
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                if (response.success) {
                    // إغلاق الـ modal بعد الحفظ
                    $('#modalCardDataAdd').modal('hide');
                    window.location.reload();
                    // updateIcon(response.data);
                    // reloadCardPreview(cardID);
                } else {
                    alert('{{__('portal/dash.err_save_err')}}');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('{{__('portal/dash.err_server_err')}}');
            }
        });
    });

    $(document).on('submit', '.EditDataForm', function (event) {
        event.preventDefault();  // لمنع إرسال النموذج بالطريقة التقليدية
        var form = $(this);  // الحصول على النموذج الحالي
        var formData = form.serialize();  // جمع البيانات من النموذج
        var cardID = form.find('#cardID').val();
        $.ajax({
            url: '{{route('portal.cards.inputEditData')}}',  // تأكد من أن هذا هو الرابط الصحيح لحفظ البيانات
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#modalCardDataEdit').modal('hide');
                    // reloadCardPreview(cardID);
                    window.location.reload();  // إعادة تحميل الصفحة بعد التحديث
                } else {
                    alert('{{__('portal/dash.err_save_err')}}');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('{{__('portal/dash.err_server_err')}}');
            }
        });
    });

    function reloadCardPreview(cardId) {
        $.ajax({
            url: '{{route('portal.cards.getCardPreview')}}',
            method: 'GET',
            data: {card_id: cardId},
            success: function (response) {
                if (response.success) {
                    $('#MyCardPreview').html(response.html);
                    // makeSortable();
                } else {
                    alert('حدث خطأ أثناء تحميل البيانات.');
                }
            },
            // error: function (xhr, status, error) {
            //     console.error('Error occurred:', error);
            //     console.error('Status:', status);
            //     console.error('XHR:', xhr);
            // }
        });
    }

    function updateIcon(data) {
        // var iconElement = $('[data-bs-target="#badge_' + data.field_id + '"]');
        var iconElement = $('#' + 'badge_' + data.field_id);  // استخدام الـ id مباشرة
        var countElement = iconElement.find('.badge_count');

        if (countElement.length) {
            countElement.text(data.count);
        } else {
            iconElement.append('<span class="badge_count">' + data.count + '</span>');
        }
    }

    $(document).on('hidden.bs.modal', '.modal', function () {
        $(this).find('form')[0].reset();
    });

    function clearInput(iconElement, inputName) {
        $(iconElement).closest('.formInputCollects').find("input[name='" + inputName + "']").val('');
    }

    // دالة لإضافة النص إلى حقل label عند الضغط على suggestion
    function addToLabel(text) {
        $("input[name='label']").val(text);  // إضافة النص في حقل label
    }

</script>
