<script>
    function deleteItem(element) {
        var parentDiv = $(element).closest('.{{$parentDiv}}');
        var elementId = parentDiv.data('id');
        Swal.fire({
            title: '{!! __('portal/sweet.title') !!}',
            text: "{!! __('portal/sweet.text') !!}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{!! __('portal/sweet.confirm_button_text') !!}',
            cancelButtonText: '{!! __('portal/sweet.cancel_button_text') !!}',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{$r}}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        thisId: elementId
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            Swal.fire(
                                '{!! __('portal/sweet.delete_done_1') !!}',
                                '{!! __('portal/sweet.delete_done_2') !!}',
                                'error'
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire(
                            '{!! __('portal/sweet.delete_done_1') !!}',
                            '{!! __('portal/sweet.delete_done_3') !!}',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
