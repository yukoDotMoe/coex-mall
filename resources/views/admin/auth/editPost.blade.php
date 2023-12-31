<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <style>
        .thumbnail-container {
            width: 200px; /* Set the desired width */
            height: 200px; /* Set the desired height */
            border: 1px solid #ccc;
            overflow: hidden;
        }

        .thumbnail-preview {
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    <form id="updateForm" action="{{ route('admin.news.edit.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>

        <!-- Small Title -->
        <div class="form-group">
            <label for="small_title">Price</label>
            <input type="text" class="form-control" id="small_title" name="price" value="{{ $post->price }}" required>
        </div>


        <div class="form-group">
            <label for="set_vote_stars">Set display vote stars</label>
            <input type="number" class="form-control" id="set_vote_stars" name="vote" value="{{ $post->order }}" required>
        </div>

        <div class="form-group">
            <label for="set_vote">Predefined Vote</label>
            <input type="number" class="form-control" id="set_vote" name="vote" value="{{ $post->vote }}" required>
        </div>

        <div class="form-group">
            <label for="set_like">Predefined Like</label>
            <input type="number" class="form-control" id="set_like" name="like" value="{{ $post->like }}" required>
        </div>

        <div class="form-group">
            <label for="limit_vote">Limit Vote</label>
            <input type="number" class="form-control" id="limit_vote" value="{{ $post->limit_vote }}" required>
        </div>

        <div class="form-group">
            <label for="limit_like">Limit Like</label>
            <input type="number" class="form-control" id="limit_like" value="{{ $post->limit_like }}" required>
        </div>

        <!-- Danh Muc -->
        <div class="form-group">
            <label for="danh_muc">Danh Muc</label>
            <select class="form-select form-select-lg mb-3" name="danh_muc" id="danh_muc">
                @foreach(\App\Models\DanhMuc::orderBy('order', 'asc')->get() as $dm)
                    <option value="{{ $dm->id }}" @if($post->danh_muc == $dm->id) selected @endif>{{ $dm->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="thumbnail" class="form-label">Thumbnail (jpg, png, pdf, max 2MB)</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".jpg, .png, .pdf">
            <!-- Thumbnail Preview -->
            <div class="thumbnail-container">
                <div class="thumbnail-preview">
                    <img src="{{ asset($post->thumbnail) }}" class="img-thumbnail"/>
                </div>
            </div>
        </div>

        <!-- Inside Content -->
        <div class="form-group">
            <label for="inside_content">Inside Content</label>
            <textarea class="form-control" id="inside_content" name="inside_content" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit btn btn-primary">Submit</button>
    </form>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast';
        @if( !empty(session()->get('success')))
            @if(!empty(Session::get('msg')))
                toast.error('{{ Session::get('msg')  }}')
            @else
                toast.success('Thành công')
            @endif
        @endif
        function randomIntFromInterval(min, max) { // min and max included
            return Math.floor(Math.random() * (max - min + 1) + min)
        }

        window.addEventListener('DOMContentLoaded', function () {
            $('#updateForm').submit(function (event) {
                event.preventDefault();
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', true);
                }, 300);

                var formData = new FormData();
                formData.append('post_id', '{{ $post->post_id }}'); // Add the 'title' field
                formData.append('title', $('#title').val()); // Add the 'title' field
                formData.append('vote', $('#set_vote').val()); // Add the 'title' field
                formData.append('vote_stars', $('#set_vote_stars').val()); // Add the 'title' field
                formData.append('like', $('#set_like').val()); // Add the 'title' field
                formData.append('limit_vote', $('#limit_vote').val()); // Add the 'title' field
                formData.append('limit_like', $('#limit_like').val()); // Add the 'title' field
                formData.append('price', $('#small_title').val()); // Add the 'price' field
                formData.append('danh_muc', $('#danh_muc').val()); // Add the 'danh_muc' field
                if ( $('#thumbnail')[0].files.length > 0) {
                    formData.append('thumbnail', $('#thumbnail')[0].files[0]);
                } // Add the 'thumbnail' file input
                formData.append('inside_content', $('#inside_content').val()); // Add the 'inside_content' field

                $.ajax({
                    url: "{{route('admin.news.edit.post')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    data: formData, // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false, // Set to false, since we are using FormData object
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        if (data.success) {
                            toast.success(`${data.message}`);
                            setTimeout(function () {
                                window.location.href = data.data.redirect_url;
                            }, 1000);
                        } else {
                            toast.error(`Lỗi: ${data.message}`);
                        }
                    },
                    error: function (data) {
                        toast.error(data.responseJSON.message ?? data.message);
                    },
                    complete: function () {
                        setTimeout(function () {
                            _this.html('Submit');
                            _this.prop('disabled', false);
                        }, 300);
                    }
                });
            });

            function clearFileInput(ctrl) {
                try {
                    ctrl.value = null;
                } catch (ex) {
                }
                if (ctrl.value) {
                    ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
                }
            }

            function resizeImage(file, maxWidth, maxHeight) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const image = new Image();
                        image.src = event.target.result;

                        image.onload = function () {
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

            $('.reduceSize').on('change', function (e) {
                const file = e.target.files[0];
                var _this = $(this)
                if (file) {
                    resizeImage(file, 800, 600)
                        .then(function (resizedImage) {
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

            $('#danh_muc').select2();

            // Function to display the thumbnail preview
            function displayThumbnailPreview(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewElement = input.closest('.form-group').querySelector('.thumbnail-preview');
                        const previewImg = document.createElement('img');
                        previewImg.setAttribute('src', e.target.result);
                        previewImg.setAttribute('class', 'img-thumbnail');
                        previewElement.innerHTML = '';
                        previewElement.appendChild(previewImg);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Event listener for the thumbnail input change
            document.getElementById('thumbnail').addEventListener('change', function () {
                displayThumbnailPreview(this);
            });
        })
    </script>
@endsection
