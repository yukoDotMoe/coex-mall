<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <table class="table table-striped display" id="myTable">
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Tìm theo SDT  ...">
        </div>
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên đăng nhập</th>
            <th scope="col">SDT</th>
            <th scope="col">Số dư ví</th>
            <th scope="col">Đại lí</th>
            <th scope="col">Chức năng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th>{{ $user->id }}</th>
                <td @if($user->banned == 1) class="text-danger fw-bold" @endif>{{ $user->username }}</td>
                <td>{{ $user->phone ?? '...' }}</td>
                <td>{{ $user->balanceFormated() }}</td>
                <td>{{ $user->promo_code ?? "..." }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.users.find', $user->id) }}" type="button"
                           class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-outline-warning userEdit" data-id="{{ $user->id }}"><i
                                class="fa-solid fa-user-pen"></i></button>
                        <a href="{{ route('admin.lockUser', $user->id) }}" type="button"
                           class="btn btn-outline-danger">
                            @if($user->banned == 1)
                                <i class="fa-solid fa-lock-open"></i>
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
    {{ $users->links() }}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nạp tiền</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.recharge.post') }}" method="POST" id="recharge">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username">
                        </div>

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
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast';

        window.addEventListener('DOMContentLoaded', function () {

            $(document).ready(function() {
            });
            $('.userEdit').click(function (e) {
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
                        $('#username').val(data.user.username)
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
