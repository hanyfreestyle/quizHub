@extends('admin.layouts.app')

@section('StyleFile')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-12 dir_button">
                <a class="btn btn-primary" href="{{route($PrefixRoute.".create")}}">{{__('admin/portalCard.form_add')}}</a>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row">

            @foreach($rowData as $question)
                <x-admin.card.normal col="col-lg-3" title="">
                    <div data-index="{{$question->id}}" data-position="{{$question->position}}">
                        <div class="input_div">
                            <div class="mm">{{$question->question}}</div>

                            <div class="action mt-2">
                                <a class="btn btn-primary" href="{{ route($PrefixRoute.'.edit', $question->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger sweet_daleteBtn_noForm" href="#" id="{{route( $PrefixRoute.'.delete',$question->id)}}"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </x-admin.card.normal>
            @endforeach

        </div>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    {{--    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>--}}
    {{--    <x-admin.ajax.sort-code url="{{ route($PrefixRoute.'.sortInput') }}"/>--}}
    {{--    <script>--}}
    {{--        $(document).on('click', '.toggle-status', function () {--}}
    {{--            let button = $(this);--}}
    {{--            let inputId = button.data('id');--}}
    {{--            let currentStatus = button.data('status');--}}

    {{--            let reloadId = button.closest('[data-reloadId]').data('reloadid');--}}
    {{--            // alert(reloadId);--}}
    {{--            // Toggle status--}}
    {{--            let newStatus = currentStatus === 1 ? 0 : 1;--}}

    {{--            $.ajax({--}}
    {{--                url: "{{ route($PrefixRoute.'.toggleStatus') }}",--}}
    {{--                type: "POST",--}}
    {{--                data: {--}}
    {{--                    _token: "{{ csrf_token() }}",--}}
    {{--                    id: inputId,--}}
    {{--                    status: newStatus--}}
    {{--                },--}}
    {{--                success: function (response) {--}}
    {{--                    if (response.success) {--}}
    {{--                        // تحديث الزر بناءً على الحالة الجديدة--}}
    {{--                        // button.data('status', newStatus);--}}
    {{--                        // if (newStatus === 1) {--}}
    {{--                        //     button.removeClass('btn-danger').addClass('btn-success').text('Active');--}}
    {{--                        // } else {--}}
    {{--                        //     button.removeClass('btn-success').addClass('btn-danger').text('Inactive');--}}
    {{--                        // }--}}
    {{--                        reloadDiv(reloadId)--}}
    {{--                    } else {--}}
    {{--                        alert('Error: ' + response.message);--}}
    {{--                    }--}}
    {{--                },--}}
    {{--                error: function () {--}}
    {{--                    alert('An error occurred while updating the status.');--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}

    {{--        function reloadDiv(reloadId) {--}}
    {{--            let div = $('[data-reloadId="' + reloadId + '"]');--}}
    {{--            let url = "{{ route($reloadRoute) }}"; // تأكد من أن هذا المسار يعيد جزء HTML المطلوب--}}

    {{--            $.ajax({--}}
    {{--                url: url,--}}
    {{--                type: "GET",--}}
    {{--                success: function (response) {--}}
    {{--                    // تحديث محتوى الـ div--}}
    {{--                    div.html($(response).find('[data-reloadId="' + reloadId + '"]').html());--}}
    {{--                },--}}
    {{--                error: function () {--}}
    {{--                    alert('An error occurred while reloading the section.');--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}

    {{--    </script>--}}
@endpush

