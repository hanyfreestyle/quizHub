<script>
    function deleteItem(element) {
        var parentCard = $(element).closest('.profile-card');
        var cardId = parentCard.data('card-id'); // الحصول على card_id من data attribute
        Swal.fire({
            title: '{!! __('portal/sweet.title') !!}',
            text: "{!! __('portal/sweet.text') !!}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{!! __('portal/sweet.confirm_button_text') !!}',
            cancelButtonText: '{!! __('portal/sweet.cancel_button_text') !!}',
            customClass: {
                popup: 'mySweetPopup',  // فئة مخصصة للنافذة
                title: 'mySweetTitle',  // فئة مخصصة للعنوان
                content: 'mySweetContent',  // فئة مخصصة للمحتوى
                confirmButton: 'mySweetConfirmBtn',  // فئة مخصصة للزر
                cancelButton: 'mySweetCancelBtn',  // فئة مخصصة للزر الإلغاء
            },
            backdrop: true,  // يمكنك إلغاء الخلفية الشفافة
            theme: 'dark',  // تفعيل الوضع الداكن
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{route('portal.cards.deleteItem')}}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        card_id: cardId
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#section-to-refresh').load(location.href + ' #section-to-refresh');
                            Swal.fire(
                                '{!! __('portal/sweet.delete_done_1') !!}',
                                '{!! __('portal/sweet.delete_done_2') !!}',
                                'success'
                            );
                            parentCard.remove();
                        } else {
                            Swal.fire(
                                '{!! __('portal/sweet.err_1') !!}',
                                '{!! __('portal/sweet.err_2') !!}',
                                'error'
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire(
                            '{!! __('portal/sweet.err_1') !!}',
                            '{!! __('portal/sweet.err_3') !!}',
                            'error'
                        );
                    }
                });
            } else {
                Swal.fire(
                    '{!! __('portal/sweet.user_cancel_1') !!}',
                    '{!! __('portal/sweet.user_cancel_2') !!}',
                    'info'
                );
            }
        });
    }
</script>
