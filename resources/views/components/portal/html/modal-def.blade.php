<div id="{{$id}}" class="modal fade {{$modalStyle}}" tabindex="-1" role="dialog" aria-labelledby="{{$id}}" aria-hidden="true" {!! $static !!} >
    <div class="modal-dialog {{$modal}} {{$centered}} ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myExtraLargeModal">Large modal</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body dark-modal">

                <h2>{{$inputData->name}}</h2>
                <form id="popup-form">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" id="name" name="name" />
                    </div>
                    <div class="form-group">
                        <label for="icon">الأيقونة</label>
                        <input type="text" id="icon" name="icon" />
                    </div>
                    <div class="form-group">
                        <button type="submit">حفظ</button>
                    </div>
                </form>

                <div class="large-modal-header"><i data-feather="chevrons-right"></i>
                    <h6>Start with your goals </h6>
                </div>
                <p class="modal-padding-space mb-0">No matter how talented you are as a content writer or creator, you will always fail if you don't have a clear set of goals.</p>
                <p class="modal-padding-space mb-0">First of all, without goals, there is no way to determine your success. Additionally, you lack direction.</p>
                <p class="modal-padding-space mb-0">Together with your team, respond to the following questions to make sure they are:</p>
                <div class="large-modal-body"><i data-feather="corner-up-right"></i>
                    <p class="ps-1">What must you achieve, and by when?</p>
                </div>
                <div class="large-modal-body"><i data-feather="corner-up-right"></i>
                    <p class="ps-1">How will you evaluate your level of success?</p>
                </div>
                <div class="large-modal-body"><i data-feather="corner-up-right"></i>
                    <p class="ps-1">Can you accomplish it with the available resources?</p>
                </div>
                <div class="large-modal-body"><i data-feather="corner-up-right"></i>
                    <p class="ps-1">Does it advance your core business aims?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button">Save </button>
            </div>
        </div>
    </div>
</div>
