<script>
    $('.status-toggle').on('click', function () {
        var status = $(this).data('status');  // الحالة الحالية (1 أو 0)
        var cardId = $(this).data('id');
        var newStatus = status === 1 ? 0 : 1;
        var self = $(this);
        $.ajax({
            url: '{{route('portal.cards.cardUpdateStatus')}}',
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                card_id: cardId,
                is_active: newStatus
            },
            success: function (response) {
                if (response.success) {
                    self.data('status', newStatus);
                    var svgIcon = newStatus === 1 ? 'profile-check' : 'profile-disabled';
                    self.find('use').empty().attr('href', '{{defPortalAssets('svg/icon-sprite.svg#')}}' + svgIcon);
                } else {
                    alert('حدث خطأ أثناء تحديث الحالة');
                }
            },
            // error: function (xhr, status, error) {
            //     console.error('Error occurred:', error);
            //     console.error('Status:', status);
            //     console.error('XHR:', xhr);
            // }
        });
    });
</script>
