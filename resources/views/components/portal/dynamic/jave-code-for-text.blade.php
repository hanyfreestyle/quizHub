<script>
    function editField(element) {
        var parentCard = $(element).closest('.{{$parentCard}}');
        var fieldText = parentCard.find('.field-text');
        var fieldInput = parentCard.find('.field-input');
        var actionButtons = parentCard.find('.action-buttons');
        // إخفاء النص الحالي وظهور حقل النص مع تأثير الانزلاق
        fieldText.hide();
        fieldInput.show().css('opacity', 1); // تظهر الحقل مع تأثير انزلاق
        actionButtons.show(); // إظهار الأزرار
    }

    // دالة لحفظ التعديل وتحديثه في قاعدة البيانات
    function saveField(element) {
        var parentCard = $(element).closest('.{{$parentCard}}');
        var newFieldValue = parentCard.find('.field-input').val();
        var cardId = parentCard.data('card-id');
        var fieldName = parentCard.data('field-name');
        // إخفاء رسائل الخطأ أو النجاح السابقة
        parentCard.find('.error-message').hide();
        parentCard.find('.success-message').hide();


        // التحقق من الحقل الديناميكي بناءً على نوعه
        var validationError = validateField(fieldName, newFieldValue);
        if (validationError) {
            parentCard.find('.error-message').text(validationError).show(); // إظهار رسالة الخطأ
            return; // إيقاف تنفيذ الكود إذا كانت الشروط غير متوافقة
        }

        // // التحقق من أن النص لا يقل عن 4 أحرف ولا يزيد عن 50 حرفًا
        // if (newFieldValue.length < 4 || newFieldValue.length > 50) {
        //     parentCard.find('.error-message').show(); // إظهار رسالة الخطأ
        //     return; // إيقاف تنفيذ الكود إذا كانت الشروط غير متوافقة
        // }

        // إرسال البيانات إلى الخادم لتحديث قاعدة البيانات
        $.ajax({
            url: '{{$routeAction}}', // المسار الخاص بتحديث الحقل في قاعدة البيانات
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                card_id: cardId,
                field_name: fieldName,  // إرسال اسم الحقل
                field_value: newFieldValue
            },
            success: function (response) {
                if (response.success) {
                    // تحديث واجهة المستخدم بعد الحفظ
                    parentCard.find('.field-text').text(newFieldValue).show();
                    parentCard.find('.field-input').hide();
                    parentCard.find('.action-buttons').hide();
                    parentCard.find('.success-message').show().css('opacity', 1);
                    setTimeout(function () {
                        parentCard.find('.success-message').fadeOut(); // اختفاء الرسالة
                    }, 1000);  // 3000 ميللي ثانية = 3 ثوانٍ
                } else {
                    alert('حدث خطأ أثناء حفظ الحقل');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('حدث خطأ أثناء التواصل مع الخادم');
            }
        });
    }


    function validateField(fieldName, value) {
        // تحقق من المسميات الوظيفية
        if (fieldName === 'job_title') {
            if (value.length < 4 || value.length > 50) {
                return 'المسمى الوظيفي يجب أن يتراوح طوله بين 4 و 50 حرفًا.';
            }
        }

        // تحقق للبريد الإلكتروني
        if (fieldName === 'email') {
            var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
            if (!emailRegex.test(value)) {
                return 'البريد الإلكتروني غير صالح.';
            }
        }

        // تحقق للبعض من الحقول الأخرى إذا لزم الأمر

        return null; // لا توجد أخطاء
    }

    // دالة لإلغاء التعديل
    function cancelEdit(element) {
        var parentCard = $(element).closest('.{{$parentCard}}');
        parentCard.find('.field-text').show(); // إظهار النص مرة أخرى مع تأثير انزلاق
        parentCard.find('.field-input').hide(); // إخفاء حقل النص
        parentCard.find('.action-buttons').hide(); // إخفاء أزرار الحفظ والإلغاء
        parentCard.find('.error-message').hide();
    }
</script>
