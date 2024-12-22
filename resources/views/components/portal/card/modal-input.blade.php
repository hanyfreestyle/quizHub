<div id="{{$modalId}}" class="modal fade bd-example-modal-lg modalCardInput" tabindex="-1" role="dialog" aria-labelledby="{{$modalId}}" aria-hidden="true" data-bs-backdrop="static"
     data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header input_color_boxX {{ $inputData->name_key }}">
                <h4 class="modal-title "><i class="{{$inputData->icon_i}}"></i> {{$inputData->name}} </h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body dark-modal">
                <form class="g-3 needs-validation custom-input {{$formName}} customForm formInputCollects" method="post" data-modal-id="{{$modalId}}" novalidate="" data-parsley-validate="">
                    @csrf
                    <input type="hidden" id="cardID" name="card_id" value="{{$cardId}}">
                    <input type="hidden" id="editID" name="edit_id" value="{{$editId}}">
                    <input type="hidden" name="input_id" value="{{$inputData->id}}">
                    <input type="hidden" name="cat_id" value="{{$inputData->cat_id}}">
                    <input type="hidden" name="input_key" value="{{$inputData->input_id}}">


                    <div class="row">
                        <div class="col-12 inpuntdbInfo" style="direction: ltr!important;">
                            id => {{$inputData->id}}<br>
                            input_id => {{$inputData->input_id}}<br>
                            cat_id => {{$inputData->cat_id}} <br>
                            url_user => {{$inputData->url_user }}<br>
                            url_user => {{$inputData->regex }}<br>
                            type => {{$inputData->type }}<br>

{{--                            <a class="btn btn-danger" target="_blank" href="google.com">Edit</a>--}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 formControl">
                                <label class="form-label">{{ $form['t_value'] }}</label>
                                <div class="input_container">
                                    <input id="{{$inputData->id}}" class="form-control {{ $form['css'] }}" type="{{ $form['formType'] }}" name="value" value="{{$cardData->value ?? null}}"
                                        {!! $form['req'] !!} >
                                    <i class="fa-solid fa-trash-can" onclick="clearInput(this, 'value')"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 formControl">
                                <label class="form-label">{{$form['t_label']}}</label>
                                <div class="input_container">
                                    <input class="form-control" type="text" name="label" value="{{$cardData->label ?? null}}"  {{$form['req_label']}} >
                                    <i class="fa-solid fa-trash-can" onclick="clearInput(this, 'label')"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="mb-3 suggestions_label">
                                @foreach($form['suggestions'] as $key => $value )
                                    <div class="label" onclick="addToLabel('{{ $value->name ?? $value->suggestion }}')">{{ $value->name ?? $value->suggestion }}</div>
                                @endforeach
                            </div>
                        </div>

                        <x-portal.form.button n="crop" bg="s"/>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

