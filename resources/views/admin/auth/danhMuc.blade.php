<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <style>
        .sortable li.sortable-drag {
            animation: shake 0.4s infinite;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25%, 75% {
                transform: translateX(-5px);
            }
            50% {
                transform: translateX(5px);
            }
        }
        .sortable li {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        /* Apply smooth animation during dragging */
        .sortable li.sortable-chosen {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="d-grid gap-2 mb-2">
        <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#create">Tạo mới</button>
    </div>
    <hr>
    <div class="m-4">
        <ul id="example1" class="list-group col">
            @foreach(\App\Models\DanhMuc::orderBy('order', 'asc')->get() as $col)
                <li class="list-group-item d-flex justify-content-between align-items-center" data-order-item="{{ $col->order ?? $loop->index+1 }}" data-id="{{ $col->id }}">
                    <span><span class="badge bg-primary rounded-pill bruh">{{ $col->order ?? $loop->index+1 }}</span> | {{ $col->name }}</span>
                    <span>Số bài viết: {{ \App\Models\BaiViet::where('danh_muc', $col->id)->count() }}</span>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button data-bs-toggle="modal" data-bs-target="#edit" type="button" class="btn btn-info text-white editBtn" data-cat-id="{{ $col->id }}" data-cat-name="{{ $col->name }}"><i class="fa-solid fa-file-pen"></i></button>
                        <a onclick = "if (! confirm(`Bạn có chắc muốn xoá danh mục này? Xoá danh mục đồng nghĩa với việc xoá tất cả bài viết thuộc danh mục đó.\n\n👛 Thứ tự danh mục: {{ $col->order }}\n🙋‍♀️ Tên danh mục: {{ $col->name }}\n📭 Tổng số bài viết: {{ \App\Models\BaiViet::where('danh_muc', $col->id)->count() }}\n\n⚠ Vui lòng xác nhận kĩ trước khi xoá, nếu thao tác không thể hoàn tác`)) { return false; }" type="button" class="btn btn-danger text-white deleteBtn num-{{ $col->id }}" data-name="{{ $col->name }}" href="{{ route('admin.danh_muc.delete', ['id' => $col->id]) }}"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <hr>
    <div class="card my-2 border-danger">
        <div class="card-body fw-bold">
            Kéo để thay đổi thứ tự
        </div>
    </div>

    <div class="modal fade" id="create" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo danh mục mới<span id="withdrawId"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.danh_muc.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                        </div>
                        <button class="btn btn-primary" type="submit">Tạo</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa danh mục <span class="editCatId"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.danh_muc.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput44" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="exampleFormControlInput44" name="name">
                        </div>
                        <input name="id" class="editCatId" type='text' hidden>
                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        function calculate() {
            var elements = [];
            $(`[data-order-item]`).each(function (e) {
                $(this).find(".bruh").html($(this).attr('data-order-item'))
                elements.push({name: $(this).data('id'), order: $(this).attr('data-order-item')})
            })
            post(elements)
        }

        function post(dataArray)
        {
            fetch('{{ route('admin.danh_muc.sort') }}', {
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

            $('.editBtn').click(function (e) {
                e.preventDefault()
                let catId = $(this).attr('data-cat-id')
                let catName = $(this).attr('data-cat-name')
                var elms = $('.editCatId')
                $('#exampleFormControlInput44').val(catName)
                elms.each(function (e) {
                    if ($(this).is("input[type='text'], input[type='password'], textarea")) {
                        $(this).val(catId)
                    } else {
                        $(this).html(catName)
                    }
                })
            })
        })
    </script>
@endsection
