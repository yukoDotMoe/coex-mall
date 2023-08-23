<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <div class="d-grid gap-2 mb-2">
        <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#create">Tạo mới</button>
    </div>
    <div class="m-4">
        <ul id="example1" class="list-group col">
            @foreach(\App\Models\Headers::orderBy('order', 'asc')->get() as $col)
                <li class="list-group-item d-flex justify-content-between align-items-center" data-order-item="{{ $col->order ?? $loop->index+1 }}" data-id="{{ $col->id }}">
                    <span class="badge bg-primary rounded-pill bruh">Thứ tự: {{ $col->order ?? $loop->index+1 }}</span>
                    <span class="badge bg-info rounded-pill">ID: {{ $col->id }}</span>
                    <div class="text-center">
                        <img src="{{ $col->path }}" class="rounded mx-auto d-block w-25">
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-info text-white editBtn" data-cat-id="{{ $col->id }}"><i class="fa-solid fa-file-pen"></i></button>
                        <a class="btn btn-danger text-white" href="{{ route('admin.headers.delete', ['id' => $col->id]) }}"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="modal fade" id="create" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chèn header mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.headers.create') }}" method="POST" id="updateForm">
                        @csrf
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="thumbnail" name=thumbnail" accept=".jpg, .png, .pdf, .jpeg">
                        </div>
                        <button class="btn btn-primary submit" type="submit">Tạo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa header: <span class="badge bg-info rounded-pill editCatId"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.headers.update') }}" method="POST" id="replaceForm">
                        @csrf
                        <div class="mb-3">
                            <label for="thumbnail2" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="thumbnail2" name=thumbnail" accept=".jpg, .png, .pdf, .jpeg">
                        </div>
                        <input name="id" class="editCatId" id="replaceFormId" type='text' hidden>
                        <button class="btn btn-primary submit" type="submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="module">
        import { toast } from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {
            var el = document.getElementById('example1');
            var sortable = Sortable.create(el, {
                animation: 150,
                easing: "cubic-bezier(1, 0, 0, 1)",
                onEnd: function(event) {
                    const itemElements = event.from.children;
                    for (let i = 0; i < itemElements.length; i++) {
                        itemElements[i].setAttribute("data-order-item", i + 1);
                    }
                    calculate()
                },
            });

            function post(dataArray)
            {
                fetch('{{ route('admin.headers.order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Laravel CSRF token
                    },
                    body: JSON.stringify(dataArray),
                })
                    .then(response => response.json())
                    .then(data => {
                        toast.success('Thành công')
                    })
                    .catch(error => {
                        toast.success(error.message)
                    });
            }

            function calculate() {
                var elements = [];
                $(`[data-order-item]`).each(function (e) {
                    $(this).find(".bruh").html('Thứ tự: ' + $(this).attr('data-order-item'))
                    elements.push({name: $(this).data('id'), order: $(this).attr('data-order-item')})
                })
                post(elements)
            }

            $('#updateForm').submit(function (event) {
                event.preventDefault();
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', true);
                }, 300);

                var formData = new FormData();
                if ( $('#thumbnail')[0].files.length > 0) {
                    formData.append('thumbnail', $('#thumbnail')[0].files[0]);
                } // Add the 'thumbnail' file input

                $.ajax({
                    url: "{{route('admin.headers.create')}}",
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
            $('#replaceForm').submit(function (event) {
                event.preventDefault();
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', true);
                }, 300);

                var formData = new FormData();
                if ( $('#thumbnail2')[0].files.length > 0) {
                    formData.append('thumbnail', $('#thumbnail2')[0].files[0]);
                } // Add the 'thumbnail' file input
                formData.append('picId', $('#replaceFormId').val()); // Add the 'title' field

                $.ajax({
                    url: "{{route('admin.headers.update')}}",
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
            $('.editBtn').click(function (e) {
                e.preventDefault()
                let catId = $(this).attr('data-cat-id')
                var elms = $('.editCatId')

                elms.each(function (e) {
                    if ($(this).is("input[type='text'], input[type='password'], textarea")) {
                        $(this).val(catId)
                    } else {
                        $(this).html(catId)
                    }
                })
            })
        })
    </script>
@endsection
