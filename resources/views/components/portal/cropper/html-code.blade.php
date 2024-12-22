<div class="card {{$style}}">
    <div class="card-header pb-0">
        @if($t)
            <h4>{{$t}}</h4>
        @endif
{{--        @if($p)--}}
{{--            <p class="f-m-light mt-1">{{$p}}</p>--}}
{{--        @endif--}}
    </div>
    <div class="card-body main-custom-form input-group-wrapper ">
        <div class="img-container" id="{{$prefix}}imageContainer">
            <img id="{{$prefix}}image" src="">
        </div>

        <div class="file-upload-container" id="{{$prefix}}fileUpload2">
            <div class="file_container">
                <div class="icon"><i class="fas fa-upload"></i></div>
                <div class="file-upload-text" id="{{$prefix}}fileText2">{{__('portal/cropper.text_select_file')}}</div>
                <input type="file" id="{{$prefix}}inputImage">
            </div>
            <div class="button_container">
                <button class="cancel-button" id="{{$prefix}}cancelButton2">{{__('portal/cropper.text_select_file_resset')}}</button>
            </div>
        </div>

        <p id="{{$prefix}}errorMessage" class="error"></p>
        <input type="hidden" id="{{$prefix}}updateId" value="{{$row->uuid}}">
        <x-portal.form.button type="button" id="{{$prefix}}cropButton" n="crop" :back="$route"/>
    </div>
</div>

@push('JsCode')
    <script>
        const container = document.querySelector('.file-upload-container');

        if (container) {
            const fileInput = container.querySelector('input[type="file"]');
            const cancelButton = container.querySelector('.cancel-button');
            const fileContainer = container.querySelector('.file_container');

            fileContainer.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileContainer.classList.add('hidden'); // إخفاء الرمز
                    cancelButton.style.display = 'inline-block'; // إظهار زر الإلغاء
                }
            });

            cancelButton.addEventListener('click', () => {
                fileInput.value = ''; // إعادة تعيين المدخل
                cancelButton.style.display = 'none'; // إخفاء زر الإلغاء
                fileContainer.classList.remove('hidden'); // إظهار الرمز
            });
        }
    </script>
@endpush

