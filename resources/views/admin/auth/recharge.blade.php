<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <x-auto-reload-checkbox />
    <small class="text-danger fw-bold d-flex justify-content-center text-center">TRẠNG THÁI ĐÃ THAY ĐỔI KHÔNG HOÀN TÁC ĐƯỢC. VUI LÒNG KIỂM TRA KĨ THÔNG TIN</small>

    <div class="btn-group mb-3" role="group" aria-label="Basic example">
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Nạp tiền</button>
        <button data-bs-toggle="modal" data-bs-target="#exampleModal1" type="button" class="btn btn-warning">Nạp khuyến mại</button>
    </div>
    <table class="table table-striped display"  id="myTable">
        <thead>
        <tr>
            <th scope="col">Thời gian</th>
            <th scope="col">ID User</th>
            <th scope="col" style="width: 10%">Username</th>
            <th scope="col" style="width: 10%">Đại lí</th>
            <th scope="col">Giá trị</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Hóa đơn</th>
            <th scope="col" style="width: 20%">Ghi chú</th>
            <th scope="col">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($recharges as $rc)
            <tr>
                <th>{{ $rc->created_at->format('Y-m-d H:i:s') }}</th>
                <th>{{ $rc->user_id }}</th>
                <th><a class="link-underline link-underline-opacity-0" href="{{ route('admin.users.find', $rc->user_id) }}">{{ $rc->username }}</a></th>
                <th>{{ $rc->promo_code ?? '-' }}</th>
                <th>{{ $rc->amount }}</th>
                <th>@switch($rc->status)
                        @case(0)
                            <span class="badge rounded-pill text-bg-secondary">Không</span>
                        @break

                        @case(1)
                        <span class="badge rounded-pill text-bg-success text-white">Thành công</span>
                        @break

                        @case(2)
                        <span class="badge rounded-pill text-bg-danger text-white">Thu hồi</span>
                        @break
                @endswitch</th>
                <th>@if($rc->bill)
                        <span class="badge rounded-pill text-bg-success">Có</span>
                    @else
                        <span class="badge rounded-pill text-bg-secondary">Không</span>
                    @endif</th>
                <th>{{ ($rc->note == '.') ? null : $rc->note }}</th>
                <th>
                    @if($rc->status <= 1)
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-danger text-white fw-bold revoke" data-id="{{ $rc->id }}"><i class="fa-solid fa-clock-rotate-left"></i> Thu hồi</button>
                    </div>
                    @endif
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nạp tiền</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.recharge.post') }}" method="POST" id="recharge">
                        <div class="mb-3 row">
                            <div class="col-auto">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Người chơi">
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">ID Người dùng</label>
                                <input type="number" class="form-control" id="inputPassword2" name="user_id" required>
                            </div>
                            <div class="col-auto">
                                <button id="checkId" class="btn btn-primary mb-3">Kiểm tra</button>
                            </div>
                        </div>

                        <span id="normalIdSpan" class="text-center"></span>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Giá trị</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="amount" min="1" required>
                        </div>

                        <input name="type" value="normal" hidden>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Khuyến mãi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.recharge.post') }}" method="POST" id="recharge1">
                        <div class="mb-3 row">
                            <div class="col-auto">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Người chơi">
                            </div>
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">ID Người dùng</label>
                                <input type="number" class="form-control" id="inputPassword2" name="user_id1" required>
                            </div>
                            <div class="col-auto">
                                <button id="checkId1" class="btn btn-primary mb-3">Kiểm tra</button>
                            </div>
                        </div>

                        <span id="normalIdSpan1" class="text-center"></span>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Giá trị</label>
                            <input type="number" class="form-control" id="exampleFormControlInput11" name="amount1" min="1" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" id="genFake">Tạo nội dung</button>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reason1"></textarea>
                        </div>

                        <input name="type" value="ad" hidden>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit" id="submit-qweqweweq">Xác nhận</button>
                        </div>
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
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "order": [[ 0, 'desc' ]]
                });
            });
            function formatNumber(n, dp)
            {
                var w = n.toFixed(dp),
                    k = w | 0,
                    b = n < 0 ? 1 : 0,
                    u = Math.abs(w - k),
                    d = ('' + u.toFixed(dp)).substr(2, dp),
                    s = '' + k,
                    i = s.length,
                    r = '';

                while ((i -= 3) > b) {
                    r = ',' + s.substr(i, 3) + r;
                }

                // Check if the decimal part is zero, if yes, don't include it
                var decimalPart = d ? '.' + d : '';

                return s.substr(0, i + 3) + r + decimalPart;
            }
            $('#genFake').click(function (e) {
                e.preventDefault()
                if($('#exampleFormControlInput11').val() == '') return false;
                const amount = $('#exampleFormControlInput11').val()
                var content = `★★★Chúc mừng quý khách nhận được phần quà may mắn ngẫu nhiên từ •{{ \App\Http\Controllers\ApiController::getSetting('page_title') }}• trị giá ${(formatNumber(parseInt(amount) * 1000, 2)).toString().replace(".00", "")} VND. Quý khách vui lòng liên hệ CSKH để xác minh chủ sở hữu phần quà.`
                console.log(content)
                $('#exampleFormControlTextarea1').val(content)
            })
            $('#searchInput').on('keyup', function() {
                let searchTerm = $(this).val().toLowerCase();
                if (searchTerm.length >= 2) {
                    $.ajax({
                        url: "{{ route('admin.recharge.ajax') }}",
                        method: 'GET',
                        data: {
                            searchTerm: searchTerm
                        },
                        success: function(data) {
                            $('#myTable tbody').html(data);
                        }
                    });
                } else {
                    // If the search term is less than 2 characters, clear the table
                    $('#myTable tbody').empty();
                }
            });

            $('.revoke').click(function () {
                const chargeId = $(this).data('id')
                $.ajax({
                    url: "{{route('admin.recharge.revoke')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({chargeId: chargeId }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        toast.success(`Thu hồi thành công`);
                        location.reload()
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
                    },
                });
            })

            $('#checkId').click(function (e){
                e.preventDefault()
                if($('[name="user_id"]').val() == '') return false;
                $('#normalIdSpan').html('')
                $.ajax({
                    url: "{{route('admin.findById')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({idUser:$('[name="user_id"]').val() }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        $('#normalIdSpan').html(`🤷‍♀️ Username: <strong>${data.user.username}</strong> | 👛 Số dư: <strong>${data.balance}</strong>`)
                    },
                    error: function (data) {
                        $('#normalIdSpan').html('<span class="text-danger">không tìm thấy</span>')
                    },
                });
            })

            $('#checkId1').click(function (e){
                e.preventDefault()
                if($('#exampleModal1 input[name="user_id1"]').val() == '') return false;
                $('#normalIdSpan1').html('')
                $.ajax({
                    url: "{{route('admin.findById')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({idUser:$('#exampleModal1 input[name="user_id1"]').val() }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        $('#normalIdSpan1').html(`🤷‍♀️ Username: <strong>${data.user.username}</strong> | 👛 Số dư: <strong>${data.balance}</strong>`)
                    },
                    error: function (data) {
                        $('#normalIdSpan1').html('<span class="text-danger">không tìm thấy</span>')
                    },
                });
            })

            $('#recharge').submit(function (data) {
                data.preventDefault()
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', false);
                }, 300);
                $.ajax({
                    url: "{{route('admin.recharge.post')}}",
                    type: 'POST',
                    dataType: "json",
                    data: $('#recharge').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
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
                                _this.html('Cập nhật thông tin');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    },
                    error: function (data) {
                        toast.error(data.responseJSON.message ?? data.message);
                        setTimeout(function () {
                            _this.html('Cập nhật thông tin');
                            _this.prop('disabled', false);
                        }, 300);
                    }
                });
            });

            $('#recharge1').submit(function (data) {
                data.preventDefault()
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', false);
                }, 300);
                $.ajax({
                    url: "{{route('admin.recharge.post')}}",
                    type: 'POST',
                    dataType: "json",
                    data: $('#recharge1').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
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
                                _this.html('Cập nhật thông tin');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    },
                    error: function (data) {
                        toast.error(data.responseJSON.message ?? data.message);
                        setTimeout(function () {
                            _this.html('Cập nhật thông tin');
                            _this.prop('disabled', false);
                        }, 300);
                    }
                });
            });
        })
    </script>
@endsection
