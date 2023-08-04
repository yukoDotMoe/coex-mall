<x-changer-layout>
    <x-slot name="header">
        Xác thực tài khoản
    </x-slot>

    <div class="mt-5 p-md-3 p-5">
        <div class="mb-5">
            <div class="mb-1">Ảnh mặt trước CMT/CCCD</div>
            <input hidden="" type="file" id="frontID" name="mat_truoc" accept="image/*" class="imgInput"><label for="frontID"
                                                                              class="flex rounded border-2 border-dashed cursor-pointer hover:border-neutral-400">
                <div class="MuiCardMedia-root flex justify-center items-center bg-contain bg-neutral-50 h-[200px] w-full css-pqdqbj">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium w-[64px] h-[64px] css-1w6o56t"
                         focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddAPhotoIcon">
                        <path d="M3 4V1h2v3h3v2H5v3H3V6H0V4h3zm3 6V7h3V4h7l1.83 2H21c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V10h3zm7 9c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-3.2-5c0 1.77 1.43 3.2 3.2 3.2s3.2-1.43 3.2-3.2-1.43-3.2-3.2-3.2-3.2 1.43-3.2 3.2z"></path>
                    </svg>
                </div>
            </label></div>
        <div>
            <div class="mb-1">Ảnh mặt sau CMT/CCCD</div>
            <input hidden="" type="file" id="backID" name="mat_sau" accept="image/*" class="imgInput"><label for="backID"
                                                                             class="flex rounded border-2 border-dashed cursor-pointer hover:border-neutral-400">
                <div class="MuiCardMedia-root flex justify-center items-center bg-contain bg-neutral-50 h-[200px] w-full css-pqdqbj">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium w-[64px] h-[64px] css-1w6o56t"
                         focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddAPhotoIcon">
                        <path d="M3 4V1h2v3h3v2H5v3H3V6H0V4h3zm3 6V7h3V4h7l1.83 2H21c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V10h3zm7 9c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-3.2-5c0 1.77 1.43 3.2 3.2 3.2s3.2-1.43 3.2-3.2-1.43-3.2-3.2-3.2-3.2 1.43-3.2 3.2z"></path>
                    </svg>
                </div>
            </label></div>
        <div class="pt-4">
            <button class="submit MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth css-1mvs4o1"
                    tabindex="0" type="button" id=":re:">Gửi yêu cầu<span class="MuiTouchRipple-root css-w0pj6f"></span>
            </button>
        </div>
    </div>

    @section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast';

        document.addEventListener("DOMContentLoaded", () => {
            const imageInputs = $(".imgInput");
            const imagePreviews = $(".css-pqdqbj");

            // Add event listeners to each image input
            imageInputs.each(function(index, element) {
                const imageInput = $(element);
                const imagePreview = imagePreviews.eq(index);

                // Add event listener to each image input
                imageInput.on("change", function() {
                    updateImagePreview(imageInput, imagePreview);
                });
            });

            function updateImagePreview(imageInput, imagePreview) {
                // Check if any file is selected
                if (imageInput[0].files && imageInput[0].files[0]) {
                    // Get the selected file
                    const file = imageInput[0].files[0];

                    // Create a FileReader to read the file as a data URL
                    const reader = new FileReader();

                    // When the file is read successfully, set its data URL as the background image
                    reader.onload = function(e) {
                        imagePreview.empty();
                        imagePreview.css("background-image", `url(${e.target.result})`);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                } else {
                    // If no file is selected, remove the background image
                    imagePreview.css("background-image", "none");
                    imagePreviews.append(`
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium w-[64px] h-[64px] css-1w6o56t"
                         focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddAPhotoIcon">
                        <path d="M3 4V1h2v3h3v2H5v3H3V6H0V4h3zm3 6V7h3V4h7l1.83 2H21c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V10h3zm7 9c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-3.2-5c0 1.77 1.43 3.2 3.2 3.2s3.2-1.43 3.2-3.2-1.43-3.2-3.2-3.2-3.2 1.43-3.2 3.2z"></path>
                    </svg>
                    `)
                }
            }

            function clearFileInput(ctrl) {
                try {
                    ctrl.value = null;
                } catch (ex) {}
                if (ctrl.value) {
                    ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
                }
            }

            function resizeImage(file, maxWidth, maxHeight) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const image = new Image();
                        image.src = event.target.result;

                        image.onload = function() {
                            let width = image.width;
                            let height = image.height;

                            if (width > height) {
                                if (width > maxWidth) {
                                    height *= maxWidth / width;
                                    width = maxWidth;
                                }
                            } else {
                                if (height > maxHeight) {
                                    width *= maxHeight / height;
                                    height = maxHeight;
                                }
                            }

                            const canvas = document.createElement('canvas');
                            canvas.width = width;
                            canvas.height = height;

                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(image, 0, 0, width, height);

                            canvas.toBlob(resolve, 'image/jpeg');
                        };

                        image.onerror = reject;
                    };

                    reader.readAsDataURL(file);
                });
            }
            $('.reduceSize').on('change', function(e) {
                const file = e.target.files[0];
                var _this = $(this)
                if (file) {
                    resizeImage(file, 800, 600)
                        .then(function(resizedImage) {
                            var file = new File([resizedImage], new Date().getTime() + '.jpeg', {
                                type: 'image/jpeg',
                                lastModified: new Date().getTime()
                            }, 'utf-8');
                            var fileInputElement = document.getElementById(_this.attr('id'));
                            clearFileInput(fileInputElement);
                            let container = new DataTransfer();
                            container.items.add(file);
                            fileInputElement.files = container.files;
                        })
                }
            });

            $('.submit').click(function (e) {
                e.preventDefault()
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', false);
                }, 300);
                var formData = new FormData();

                // Get the selected files from the input fields
                var file1 = $('#frontID')[0].files[0];
                var file2 = $('#backID')[0].files[0];

                // Add the files to the FormData object
                formData.append('mat_truoc', file1);
                formData.append('mat_sau', file2);

                $.ajax({
                    url: "{{route('account.verify.post')}}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if(data.success)
                        {
                            toast.success(`${data.message}`)
                            setTimeout(function(){
                                window.location.href = data.data.redirect_url;
                            },1000);
                        }else{
                            toast.error(`Lỗi: ${data.message}`)
                            setTimeout(function () {
                                _this.html('Gửi yêu cầu');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    },
                    error: function (data) {
                        toast.error(data.responseJSON.message ?? data.message);
                        setTimeout(function () {
                            _this.html('Gửi yêu cầu');
                            _this.prop('disabled', false);
                        }, 300);
                    }
                });
            })
        });
    </script>
    @endsection
</x-changer-layout>
