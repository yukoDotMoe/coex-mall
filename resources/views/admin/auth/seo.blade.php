<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')

    <form id="updateForm" action="{{ route('admin.seo.post') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ \App\Http\Controllers\ApiController::getSetting('page_title') }}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ \App\Http\Controllers\ApiController::getSetting('page_decs') }}</textarea>
        </div>
        @php($thumbnail = \App\Http\Controllers\ApiController::getSetting('page_thumbnail'))
        <div class="form-group">
            <label for="thumbnail">Thumbnail (jpg, png, pdf, max 2MB)</label>
            <input type="file" class="form-control-file reduceSize" id="thumbnail" name="thumbnail" accept=".jpg, .png, .pdf" required>
            <!-- Thumbnail Preview -->
            <div class="thumbnail-container">
                <div class="thumbnail-preview"></div>
            </div>
        </div>
        @if(!empty($thumbnail))
            <div class="mb-3">
                <img src="{{ asset($thumbnail) }}" class="img-fluid w-50" id="thumbnailPre">
            </div>
        @endif
        @csrf
        <div class="d-grid gap-2">
            <button class="btn btn-primary submit" type="submit">Lưu</button>
        </div>
    </form>

@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {
            function displayThumbnailPreview(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#thumbnailPre').remove   ()
                        const previewElement = input.closest('.form-group').querySelector('.thumbnail-preview');
                        const previewImg = document.createElement('img');
                        previewImg.setAttribute('src', e.target.result);
                        previewImg.setAttribute('class', 'img-fluid w-50');
                        previewElement.innerHTML = '';
                        previewElement.appendChild(previewImg);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            document.getElementById('thumbnail').addEventListener('change', function () {
                displayThumbnailPreview(this);
            });

            $('#updateForm').submit(function (data) {
                data.preventDefault()
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', true);
                }, 300);

                var formData = new FormData();
                formData.append('title', $('#exampleFormControlInput1').val()); // Add the 'title' field
                formData.append('decs', $('#exampleFormControlTextarea1').val()); // Add the 'title' field
                formData.append('thumbnail', $('#thumbnail')[0].files[0]); // Add the 'title' field

                $.ajax({
                    url: "{{route('admin.seo.post')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    data: formData, // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false, // Set to false, since we are using FormData object
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        toast.success("Đăng kí tài khoản thành công.");
                        setTimeout(function () {
                            location.reload()
                        }, 1000)
                    },
                    error: function (data) {
                        if (data.responseJSON === undefined || data.responseJSON === null) {
                            toast.success("Đăng kí tài khoản thành công.");
                            setTimeout(function () {
                                location.reload()
                            }, 1000)
                        }else{
                            toast.error(data.responseJSON.message);
                            setTimeout(function () {
                                _this.html('Đăng kí');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    }
                });
            })
        })
    </script>
@endsection
