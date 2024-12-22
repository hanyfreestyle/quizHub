<script>
    const image = document.getElementById('{{$prefix}}image');
    const inputImage = document.getElementById('{{$prefix}}inputImage');
    const errorMessage = document.getElementById('{{$prefix}}errorMessage');
    const cropButton = document.getElementById('{{$prefix}}cropButton');
    const imageContainer = document.getElementById('{{$prefix}}imageContainer');
    let cropper;

    // تعطيل الزر في البداية
    cropButton.disabled = true;

    inputImage.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file) {
            errorMessage.textContent = '{{__('portal/cropper.err_choose_a_picture_first')}}';
            return;
        }

        const isValid = await validateImage(file);
        if (!isValid) {
            inputImage.value = ''; // إعادة تعيين الحقل
            cropButton.disabled = true; // تعطيل الزر
            return;
        }
        // إذا كانت الصورة صالحة
        errorMessage.textContent = ''; // مسح رسالة الخطأ
        cropButton.disabled = false; // تمكين الزر

        const url = URL.createObjectURL(file);
        if (cropper) {
            cropper.replace(url);
        } else {
            cropper = new Cropper(image, {
                aspectRatio: {{$aspectRatio}},
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                guides: false,
                center: false,
                highlight: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                toggleDragModeOnDblclick: false,
            });
            cropper.replace(url);
        }
    });

    cropButton.addEventListener('click', () => {
        if (!cropper) {
            alert('{{__('portal/cropper.err_choose_a_picture_first')}}');
            return;
        }

        const canvas = cropper.getCroppedCanvas();
        canvas.toBlob((blob) => {
            const formData = new FormData();
            formData.append('image', blob);
            formData.append('imageType', '{{$imageType}}');
            fetch('{{ $route }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '{{ $back }}';
                    } else {
                        alert(data.message || '{{__('portal/cropper.err_on_save')}}');
                    }
                })
                .catch(() => {
                    alert('{{__('portal/cropper.err_on_save')}}');
                });
        });
    });

    document.getElementById('resetButton').addEventListener('click', () => {
        location.reload();
    });

    // الدالة التي تتحقق من نوع الملف وأبعاده
    function validateImage(file) {
        // مسح رسائل الخطأ السابقة
        errorMessage.innerHTML = '';

        const cropperMessages = {
            err_min_width: "{{ __('portal/cropper.err_min_width') }}",
            err_max_width: "{{ __('portal/cropper.err_max_width') }}",
            err_min_height: "{{ __('portal/cropper.err_min_height') }}",
            err_max_height: "{{ __('portal/cropper.err_max_height') }}",
        };

        const getCropperErrorMessage = (key, minWidth, currentWidth) => {
            const message = cropperMessages[key];
            if (!message) {
                return 'رسالة غير معروفة.';
            }
            return message
                .replace('{minWidth}', minWidth)
                .replace('{currentWidth}', currentWidth);
        };

        // التحقق من الامتداد
        const validExtensions = ['image/jpeg', 'image/png', 'image/webp'];
        if (!validExtensions.includes(file.type)) {
            errorMessage.textContent = '{{__('portal/cropper.err_min')}}';
            inputImage.value = ''; // إعادة تعيين الحقل
            return false;
        }

        {{--if (file.size > 200000) {  // 200000 bytes = 200KB--}}
        {{--    errorMessage.textContent = '{{__('portal/cropper.err_min')}}';--}}
        {{--    inputImage.value = ''; // إعادة تعيين الحقل--}}
        {{--    return false;--}}
        {{--}--}}


        const img = new Image();
        const url = URL.createObjectURL(file);
        img.src = url;

        return new Promise((resolve, reject) => {
            img.onload = function () {

                // التحقق من أبعاد الصورة
                const minWidth = {{$minWidth}};
                const minHeight = {{$minHeight}};
                const maxWidth = {{$maxWidth}};
                const maxHeight = {{$maxHeight}};
                let hasError = false;

                if (img.width < minWidth) {
                    const msg = getCropperErrorMessage('err_min_width', minWidth, img.width);
                    const p = document.createElement("p");
                    p.innerHTML = msg;
                    errorMessage.appendChild(p);
                    hasError = true;
                }

                if (img.width > maxWidth) {
                    const msg = getCropperErrorMessage('err_max_width', maxWidth, img.width);
                    const p = document.createElement("p");
                    p.innerHTML = msg;
                    errorMessage.appendChild(p);
                    hasError = true;
                }

                if (img.height < minHeight) {
                    const msg = getCropperErrorMessage('err_min_height', minHeight, img.height);
                    const p = document.createElement("p");
                    p.innerHTML = msg;
                    errorMessage.appendChild(p);
                    hasError = true;
                }

                if (img.height > maxHeight) {
                    const msg = getCropperErrorMessage('err_max_height', maxHeight, img.height);
                    const p = document.createElement("p");
                    p.innerHTML = msg;
                    errorMessage.appendChild(p);
                    hasError = true;
                }

                if (hasError) {
                    resolve(false);
                } else {
                    resolve(true);
                }
            };

            img.onerror = function () {
                errorMessage.textContent = 'الملف الذي اخترته ليس صورة صالحة.';
                inputImage.value = ''; // إعادة تعيين الحقل
                resolve(false);
            };
        });
    }
</script>
