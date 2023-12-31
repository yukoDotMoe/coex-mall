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
    <div class="btn-group mb-3" role="group" aria-label="Basic example">
        <a href="{{ route('admin.news.create') }}" type="button" class="btn btn-primary">Tạo bài viết</a>
    </div>
    <table class="table table-striped display" id="myTable">
        <thead>
        <tr>
            <th scope="col">Thời gian</th>
            <th scope="col">Tên</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Nội dung</th>
            <th scope="col">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\BaiViet::orderBy('created_at', 'desc')->get() as $post)
            <tr>
                <th>{{ $post->created_at->format('Y-m-d H:i:s') }}</th>
                <th>{{ mb_strimwidth($post->title, 0, 20, '...') }}</th>
                <th>{{ \App\Models\DanhMuc::where('id', $post->danh_muc)->first()->name ?? '-' }}</th>
                <th>{{ mb_strimwidth($post->content, 0, 50, '...') }}</th>
                <th>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.news.edit', $post->post_id) }}" class="btn btn-outline-warning"><i
                                class="fa-solid fa-pencil"></i></a>
                        <a href="{{ route('admin.news.delete', $post->post_id) }}" class="btn btn-outline-danger"><i
                                class="fa-solid fa-trash-can"></i></a>
                    </div>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>

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
            $('.editPost').click(function () {
                $('#set_vote').val(randomIntFromInterval(30, 50))
                $('#set_like').val(randomIntFromInterval(30, 50))
                $('#set_vote_stars').val(randomIntFromInterval(3, 5))
            })
            $('#submitCreate').click(function (event) {
                event.preventDefault();
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', true);
                }, 300);

                var formData = new FormData();
                formData.append('title', $('#title').val()); // Add the 'title' field
                formData.append('vote', $('#set_vote').val()); // Add the 'title' field
                formData.append('vote_stars', $('#set_vote_stars').val()); // Add the 'title' field
                formData.append('like', $('#set_like').val()); // Add the 'title' field
                formData.append('limit_vote', $('#limit_vote').val()); // Add the 'title' field
                formData.append('limit_like', $('#limit_like').val()); // Add the 'title' field
                formData.append('price', $('#small_title').val()); // Add the 'price' field
                formData.append('danh_muc', $('#danh_muc').val()); // Add the 'danh_muc' field
                formData.append('thumbnail', $('#thumbnail')[0].files[0]); // Add the 'thumbnail' file input
                formData.append('inside_content', $('#inside_content').val()); // Add the 'inside_content' field

                $.ajax({
                    url: "{{route('admin.news.create.post')}}",
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
