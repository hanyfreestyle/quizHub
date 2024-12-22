<div class="modal-header">
    <h4 class="modal-title "><i class="fa-solid fa-qrcode"></i> {{$card->card_name}} </h4>
    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body dark-modal">
    <div class="row">
        <div class="col-lg-12">
            <div class="qrCodeImg qrCodeImgModal">
                {!! $qrCode !!}
            </div>
        </div>
        <div class="d-flex gap-2 justify-content-end formSubmit">
            <a class="btn btn-secondary" href="{{route('portal.cards.getQrCodeDownload',$card->uuid)}}" >
                <i class="fa-solid fa-download"></i> {{__('portal/dash.but_download')}}
            </a>
        </div>
    </div>

</div>
