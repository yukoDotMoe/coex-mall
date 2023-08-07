<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <table class="table table-striped display" id="myTable">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Đại lí</th>
            <th scope="col">Số điểm</th>
            <th scope="col">STK</th>
            <th scope="col">Ảnh CMT</th>
            <th scope="col">Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th>{{ $user->id }}</th>
                <td @if($user->banned == 1) class="text-danger fw-bold" @endif>{{ $user->username }}</td>
                <td>{{ $user->promo_code ?? "..." }}</td>
                <td>{{ $user->balanceFormated() }}</td>
                <td>{{ $user->getBank()->card_number ?? '...' }}</td>
                <td>
                    @if($user->is_verify())
                        <span class="badge text-bg-success">Có</span>
                    @else
                        <span class="badge text-bg-danger">Không</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.users.find', $user->id) }}" type="button"
                           class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#userEdit" type="button" class="btn btn-outline-warning userEdit" data-id="{{ $user->id }}"><i
                                class="fa-solid fa-user-pen"></i></button>
                        <button data-bs-toggle="modal" data-bs-target="#passwordChange" type="button" class="btn btn-outline-info passwordChange" data-id="{{ $user->id }}"><i class="fa-solid fa-key"></i></button>
                        <a href="{{ route('admin.lockUser', $user->id) }}" type="button"
                           class="btn btn-outline-danger">
                            @if($user->banned == 1)
                                <i class="fa-solid fa-lock-open fa-fade"></i>
                            @else
                                <i class="fa-solid fa-lock"></i>
                            @endif
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="userEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ID: <span id="modalUid"></span> | Username: <span id="modalUsername"></span> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.recharge.post') }}" method="POST" id="recharge">
                        <div class="mb-3">
                            <label for="promo_code" class="form-label">Đại lí</label>
                            <input type="text" class="form-control" id="promo_code">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">SDT</label>
                            <input type="text" class="form-control" id="phone">
                        </div>

                        <div class="mb-3">
                            <label for="bankSelect" class="form-label">Bank</label>

                            <select class="form-control" id="bankSelect" aria-label="Default select example">
                                <option value="0" disabled>Trống</option>
                                @foreach(\App\Models\Banks::all() as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->code }} | {{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="bankNumber" class="form-label">STK</label>
                            <input type="text" class="form-control" id="bankNumber">
                        </div>

                        <div class="mb-3">
                            <label for="bankHolder" class="form-label">Tên STK</label>
                            <input type="text" class="form-control" id="bankHolder">
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" id="postEdit" data-post-id="">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordChange" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thay đổi mật khẩu: <span id="passModalUsername"></span> (<span id="passModalId"></span>)</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nhập mật khẩu mới" id="newUserPass">
                        <button class="btn btn-outline-secondary" type="button" id="button-password">Ngẫu nhiên</button>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" id="passwordEdit" data-post-id="">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast';

        window.addEventListener('DOMContentLoaded', function () {

            $(document).ready(function() {
                $('#myTable').DataTable({
                    "order": [[ 0, 'desc' ]]
                });
            });
            $('.userEdit').click(function (e) {
                $('#modalUid').val('')
                $('#modalUsername').val('')
                $('#username').val('')
                $('#promo_code').val('')
                $('#address').val('')
                $('#phone').val('')

                $('#bankSelect').val(0)
                $('#bankNumber').val('')
                $('#bankHolder').val('')
                $.ajax({
                    url: "{{route('admin.findById')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({idUser:$(this).data('id') }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        $('#postEdit').attr('data-post-id', data.user.id)
                        $('#modalUid').html(data.user.id)
                        $('#modalUsername').html(data.user.username)
                        $('#promo_code').val(data.user.promo_code)
                        $('#address').val(data.user.address)
                        $('#phone').val(data.user.phone)

                        $('#bankSelect').val(data.bank.bank_id)
                        $('#bankNumber').val(data.bank.card_number)
                        $('#bankHolder').val(data.bank.card_holder)
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
                    },
                });
            })

            $('.passwordChange').click(function (e) {
                e.preventDefault()
                $('#passModalId').html('')
                $('#passModalUsername').html('')
                $.ajax({
                    url: "{{route('admin.findById')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({idUser:$(this).data('id') }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        $('#passModalId').html(data.user.id)
                        $('#passModalUsername').html(data.user.username)
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
                    },
                });
            })

            function makeid(length) {
                let result = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const charactersLength = characters.length;
                let counter = 0;
                while (counter < length) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    counter += 1;
                }
                return result;
            }

            $('#button-password').click(function (e) {
                e.preventDefault()
                $('#newUserPass').val(makeid(16))
            })

            $('.passwordChange').click(function (e)
            {
                e.preventDefault()
                $('#passwordEdit').attr('data-post-id', $(this).data('id'))
                $('#newUserPass').val('')
            })

            $('#passwordEdit').click(function (e) {
                e.preventDefault()
                const userid = $(this).data('post-id');
                $.ajax({
                    url: "{{route('admin.changePass')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        password: $('#newUserPass').val(),
                        user_id: userid,
                    }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        toast.success(data.message);
                        location.reload()
                    },
                    error: function (data) {
                        toast.error('Cập nhật thất bại');
                    },
                });
            })
            $('#postEdit').click(function (e) {
                e.preventDefault()
                const userid = $(this).data('post-id');
                $.ajax({
                    url: "{{route('admin.updateUser')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        username: $('#username').val(),
                        promo_code: $('#promo_code').val(),
                        address: $('#address').val(),
                        phone: $('#phone').val(),
                        bank_id: $('#bankSelect').val(),
                        card_number: $('#bankNumber').val(),
                        card_holder: $('#bankHolder').val(),
                        user_id: userid,
                    }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        toast.success(data.message);
                        location.reload()
                    },
                    error: function (data) {
                        toast.error('Cập nhật thất bại');
                    },
                });
            })
            $('#searchInput').on('keyup', function () {
                let searchTerm = $(this).val().toLowerCase();
                if (searchTerm.length >= 2) {
                    $.ajax({
                        url: "{{ route('admin.users.ajax') }}",
                        method: 'GET',
                        data: {
                            searchTerm: searchTerm
                        },
                        success: function (data) {
                            $('#myTable tbody').html(data);
                        }
                    });
                } else {
                    // If the search term is less than 2 characters, clear the table
                    $('#myTable tbody').empty();
                }
            });
        })
    </script>
@endsection
