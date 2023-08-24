<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <div class="d-grid gap-2 mb-2">
        <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#create">Tạo mới</button>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Giới thiệu
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="m-4">
                        <ul id="example1" class="list-group col">
                            @foreach(\App\Models\ImgIntro::orderBy('order', 'asc')->get() as $col)
                                <li class="list-group-item d-flex justify-content-between align-items-center" data-order-item="{{ $col->order ?? $loop->index+1 }}" data-id="{{ $col->id }}">
                                    <span class="badge bg-primary rounded-pill bruh">Thứ tự: {{ $col->order ?? $loop->index+1 }}</span>
                                    <span class="badge bg-info rounded-pill">ID: {{ $col->id }}</span>
                                    <div class="text-center">
                                        <img src="{{ $col->path }}" class="rounded mx-auto d-block w-25">
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-info text-white editBtn" data-type="intro" data-cat-id="{{ $col->id }}"><i class="fa-solid fa-file-pen"></i></button>
                                        <a class="btn btn-danger text-white" href="{{ route('admin.img.delete', ['id' => $col->id, 'type' => 'intro']) }}"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Đối tác lớn
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="m-4">
                        <ul id="example2" class="list-group col">
                            @foreach(\App\Models\ImgRetail::orderBy('order', 'asc')->get() as $col)
                                <li class="list-group-item d-flex justify-content-between align-items-center" data-order-item="{{ $col->order ?? $loop->index+1 }}" data-id="{{ $col->id }}">
                                    <span class="badge bg-primary rounded-pill bruh">Thứ tự: {{ $col->order ?? $loop->index+1 }}</span>
                                    <span class="badge bg-info rounded-pill">ID: {{ $col->id }}</span>
                                    <div class="text-center">
                                        <img src="{{ $col->path }}" class="rounded mx-auto d-block w-25">
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-info text-white editBtn" data-type="retail" data-cat-id="{{ $col->id }}"><i class="fa-solid fa-file-pen"></i></button>
                                        <a class="btn btn-danger text-white" href="{{ route('admin.img.delete', ['id' => $col->id, 'type' => 'retail']) }}"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Về chúng tôi
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="m-4">
                        <ul id="example3" class="list-group col">
                            @foreach(\App\Models\ImgAbout::orderBy('order', 'asc')->get() as $col)
                                <li class="list-group-item d-flex justify-content-between align-items-center" data-order-item="{{ $col->order ?? $loop->index+1 }}" data-id="{{ $col->id }}">
                                    <span class="badge bg-primary rounded-pill bruh">Thứ tự: {{ $col->order ?? $loop->index+1 }}</span>
                                    <span class="badge bg-info rounded-pill">ID: {{ $col->id }}</span>
                                    <div class="text-center">
                                        <img src="{{ $col->path }}" class="rounded mx-auto d-block w-25">
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-info text-white editBtn" data-type="about" data-cat-id="{{ $col->id }}"><i class="fa-solid fa-file-pen"></i></button>
                                        <a class="btn btn-danger text-white" href="{{ route('admin.img.delete', ['id' => $col->id, 'type' => 'about']) }}"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Trụ sở
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="m-4">
                        <ul id="example3" class="list-group col">
                            @foreach(\App\Models\ImgLocation::orderBy('order', 'asc')->get() as $col)
                                <li class="list-group-item d-flex justify-content-between align-items-center" data-order-item="{{ $col->order ?? $loop->index+1 }}" data-id="{{ $col->id }}">
                                    <span class="badge bg-primary rounded-pill bruh">Thứ tự: {{ $col->order ?? $loop->index+1 }}</span>
                                    <span class="badge bg-info rounded-pill">ID: {{ $col->id }}</span>
                                    <div class="text-center">
                                        <img src="{{ $col->path }}" class="rounded mx-auto d-block w-25">
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-info text-white editBtn" data-type="location" data-cat-id="{{ $col->id }}"><i class="fa-solid fa-file-pen"></i></button>
                                        <a class="btn btn-danger text-white" href="{{ route('admin.img.delete', ['id' => $col->id, 'type' => 'location']) }}"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="create" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.img.create') }}" method="POST" id="updateForm">
                        @csrf
                        <select name="type" id="typeForm" class="form-select" aria-label="Default select example">
                            @foreach($editList as $option => $value)
                                <option value="{{ $option }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="thumbnail" name=thumbnail" accept=".jpg, .png, .pdf, .jpeg">
                        </div>
                        <input name="id" class="editCatId" id="replaceFormId" type='text' hidden>
                        <button class="btn btn-primary submit" type="submit">Tạo mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa <span class="editTypeC"></span>: <span class="badge bg-info rounded-pill editCatId"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.img.update') }}" method="POST" id="replaceForm">
                        @csrf
                        <select name="type" class="form-select editTypeC" aria-label="Default select example">
                            @foreach($editList as $option => $value)
                                <option value="{{ $option }}">{{ $value }}</option>
                            @endforeach
                        </select>
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
        import {toast} from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {
            Sortable.create(document.getElementById('example1'), {
                animation: 150,
                easing: "cubic-bezier(1, 0, 0, 1)",
                onEnd: function(event) {
                    const itemElements = event.from.children;
                    for (let i = 0; i < itemElements.length; i++) {
                        itemElements[i].setAttribute("data-order-item", i + 1);
                    }
                    calculate('intro')
                },
            });
            Sortable.create(document.getElementById('example2'), {
                animation: 150,
                easing: "cubic-bezier(1, 0, 0, 1)",
                onEnd: function(event) {
                    const itemElements = event.from.children;
                    for (let i = 0; i < itemElements.length; i++) {
                        itemElements[i].setAttribute("data-order-item", i + 1);
                    }
                    calculate('retail')
                },
            });
            Sortable.create(document.getElementById('example3'), {
                animation: 150,
                easing: "cubic-bezier(1, 0, 0, 1)",
                onEnd: function(event) {
                    const itemElements = event.from.children;
                    for (let i = 0; i < itemElements.length; i++) {
                        itemElements[i].setAttribute("data-order-item", i + 1);
                    }
                    calculate('about')
                },
            });
            function post(type, dataArray)
            {
                var data = {
                    single_input: type,
                    array_input: dataArray
                };
                fetch('{{ route('admin.img.order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Laravel CSRF token
                    },
                    body: JSON.stringify(data),
                })
                    .then(response => response.json())
                    .then(data => {
                        toast.success('Thành công')
                    })
                    .catch(error => {
                        toast.success(error.message)
                    });
            }
            function calculate(type) {
                var sechjoke;
                switch (type) {
                    case 'intro':
                        sechjoke = 'example1';
                        break;
                    case 'retail':
                        sechjoke = 'example2';
                        break;
                    case 'about':
                        sechjoke = 'example3';
                        break;
                }
                var elements = [];
                console.log($(`#${sechjoke} > [data-order-item]`))
                $(`#${sechjoke} > [data-order-item]`).each(function (e) {
                    $(this).find(".bruh").html('Thứ tự: ' + $(this).attr('data-order-item'))
                    elements.push({name: $(this).data('id'), order: $(this).attr('data-order-item')})
                })
                post(type, elements)
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
                formData.append('type', $('#typeForm').val()); // Add the 'title' field


                $.ajax({
                    url: "{{route('admin.img.create')}}",
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
                formData.append('type', $('#typeForm').val()); // Add the 'title' field
                formData.append('catId', $('#replaceFormId').val()); // Add the 'title' field


                $.ajax({
                    url: "{{route('admin.img.update')}}",
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
                let catType = $(this).attr('data-type')
                var elms = $('.editCatId')

                elms.each(function (e) {
                    if ($(this).is("input[type='text'], input[type='password'], textarea")) {
                        $(this).val(catId)
                    } else {
                        $(this).html(catId)
                    }
                })

                var elmss = $('.editTypeC')

                elmss.each(function (e) {
                    if ($(this).is("input[type='text'], input[type='password'], textarea, select")) {
                        $(this).val(catType)
                    } else {
                        $(this).html(catType)
                    }
                })
            })
        })
    </script>
@endsection
