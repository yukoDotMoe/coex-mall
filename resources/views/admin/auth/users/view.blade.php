<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <div class="container row">
        <div class="col-md-7 col-12">
            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">LỊCH SỬ ĐÁNH GIÁ</h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Phiên</th>
                                <th scope="col">Kết quả phiên</th>
                                <th scope="col">Thời gian phiên</th>
                                <th scope="col">Đánh giá</th>
                                <th scope="col">Số điểm</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($games as $game)
                                <tr>
                                    @php($sessionGame = \App\Http\Controllers\ApiController::getSessionFromGameId($game->game_id))
                                    <td>{{ $sessionGame->id }}</td>
                                    <td>{{ $sessionGame->gia_tri }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('YmdHis', $game->game_id)->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        @switch($game->thao_tac)
                                            @case(1)
                                                <span class="badge text-bg-primary" style="background-color: #f73007 !important;">Vote</span>
                                                @break
                                            @case(2)
                                                <span class="badge text-bg-primary" style="background-color: #00af52 !important;">Like</span>
                                                @break
                                            @case(3)
                                                <span class="badge text-bg-primary" style="background-color: #009cd9 !important;">5 Sao</span>
                                                @break
                                            @case(4)
                                                <span class="badge text-bg-primary" style="background-color: #9534f0 !important;">3 sao</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $game->so_luong }}</td>
                                    <td>@switch($game->trang_thai)
                                            @case(0)
                                                *Chờ*
                                                @break
                                            @case(1)
                                                Thắng
                                                @break
                                            @case(2)
                                                Thua
                                                @break
                                        @endswitch</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $games->links() }}
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">LỊCH SỬ NẠP </h5>
                        <small class="text-danger fw-bold d-flex justify-content-center">TRẠNG THÁI ĐÃ THAY ĐỔI KHÔNG HOÀN TÁC ĐƯỢC</small>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Số điểm</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recharge as $plus)
                                <tr>
                                    <td>{{ $plus->created_at->format('d/m/Y H:m:i') }}</td>
                                    <td>{{ $plus->amount }}</td>
                                    <td>
                                        @switch($plus->status)
                                            @case(1)
                                                <span class="badge rounded-pill text-bg-success text-white">Thành công</span>
                                                @break

                                            @case(2)
                                                <span class="badge rounded-pill text-bg-danger text-white">Thu hồi</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($plus->status == 1)
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-danger revoke" data-id="{{ $plus->id }}">Thu hồi</button>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $recharge->links() }}
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">LỊCH SỬ RÚT</h5>
                        <small class="text-danger fw-bold d-flex justify-content-center">TRẠNG THÁI ĐÃ THAY ĐỔI KHÔNG HOÀN TÁC ĐƯỢC</small>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Số điểm</th>
                                <th scope="col">STK</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdraw as $minus)
                                <tr>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($minus->created_at)) }}</td>
                                    <td>{{ $minus->amount }}</td>
                                    <td>{{ $minus->card_number }}</td>
                                    <td>
                                        @switch($minus->status)
                                            @case(0)
                                                <span class="badge rounded-pill text-bg-secondary text-white">Chờ duyệt</span>
                                                @break

                                            @case(1)
                                                <span class="badge rounded-pill text-bg-success text-white">Thành công</span>
                                                @break

                                            @case(2)
                                                <span class="badge rounded-pill text-bg-danger text-white">Từ chối</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($minus->status == 0)
                                            <div class="btn-group" role="group">
                                                <button data-bs-toggle="modal" data-bs-target="#withdrawDetail" type="button" class="btn btn-outline-danger withdrawDetail" data-id="{{ $minus->id }}">Chi tiết</button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $withdraw->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-12">
            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">THÔNG TIN TÀI KHOẢN</h5>
                    <div class="list-group w-100">
                        <div class="list-group-item list-group-item-action h4 text-danger fw-bold border-2 rounded border-danger">
                            <i class="bi-camera-fill"></i> Số dư
                            <span class="float-end"
                                  id="userBalance">{{ $user->balanceFormated() }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-camera-fill"></i> ID
                            <span class="float-end">{{ $user->id }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-camera-fill"></i> Username
                            <span class="float-end">{{ $user->username }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-camera-fill"></i> Đại lí
                            <span class="float-end">{{ $user->promo_code }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-camera-fill"></i> Tình trạng
                            <span class="float-end">
                                @if($user->banned == 1)
                                    <span class="badge text-bg-danger">Đang bị khóa</span>
                                @else
                                    <span class="badge text-bg-success">Hoạt động</span>

                                @endif
                            </span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="d-grid gap-2 d-md-block mt-3">
                                <a href="{{ route('admin.lockUser', $user->id) }}" type="button"
                                   class="btn btn-outline-danger">
                                    @if($user->banned == 1)
                                        <i class="fa-solid fa-lock-open fa-fade"></i> Mở khóa
                                    @else
                                        <i class="fa-solid fa-lock"></i> Khóa
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">THÔNG TIN CÁ NHÂN
                    </h5>
                    <div class="list-group w-100">
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-music-note-beamed"></i> STK
                            <span
                                class="float-end">{{ (empty($user->getBank())) ? 'Chưa liên kết' : $user->getBank()->card_number }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-film"></i> Tên
                            <span
                                class="float-end">{{ (empty($user->getBank())) ? 'Chưa liên kết' : $user->getBank()->card_holder }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-film"></i> Bank
                            <span
                                class="float-end">{{ (empty($user->getBank())) ? 'Chưa liên kết' : \App\Models\Banks::where('id', $user->getBank()->bank_id)->first()->name }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-camera-fill"></i> Địa chỉ
                            <span class="float-end"
                                  id="userBalance">{{ $user->address ?? 'Trống' }}</span>
                        </div>
                        <div class="list-group-item list-group-item-action">
                            <i class="bi-camera-fill"></i> SDT
                            <span class="float-end"
                                  id="userBalance">{{ $user->phone ?? 'Trống'  }}</span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="d-grid gap-2 d-md-block mt-3">
                                <button data-bs-toggle="modal" data-bs-target="#userEdit" type="button"
                                        class="btn btn-outline-warning userEdit" data-id="{{ $user->id }}"><i
                                        class="fa-solid fa-user-pen"></i> Chỉnh sửa TT</button>
                                <button data-bs-toggle="modal" data-bs-target="#passwordChange" type="button"
                                        class="btn btn-outline-info passwordChange" data-id="{{ $user->id }}"><i
                                        class="fa-solid fa-key"></i> Đổi mật khẩu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">XÁC THỰC TÀI KHOẢN</h5>
                    <div class="card">
                        <div class="d-flex justify-content-center">
                            <a data-fslightbox href="@if(empty($user->mat_truoc)) {{ asset('/noimage.png') }} @else {{ asset($user->mat_truoc) }} @endif">
                                <img
                                    src="@if(empty($user->mat_truoc)) {{ asset('/noimage.png') }} @else {{ asset($user->mat_truoc) }} @endif"
                                    class="card-img-top" style="height: 10rem; width: 18rem;">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text">Mặt trước CMT</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="d-flex justify-content-center">

                        <a data-fslightbox href="@if(empty($user->mat_sau)) {{ asset('/noimage.png') }} @else {{ asset($user->mat_sau) }} @endif">
                            <img
                                src="@if(empty($user->mat_sau)) {{ asset('/noimage.png') }} @else {{ asset($user->mat_sau) }} @endif"
                                class="card-img-top" style="height: 10rem; width: 18rem;">
                        </a>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text">Mặt sau CMT</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ID: <span id="modalUid"></span> | Username:
                        <span id="modalUsername"></span></h1>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thay đổi mật khẩu: <span
                            id="modalUsername"></span></h1>
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

    <div class="modal fade" id="withdrawDetail" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin chi tiết rút tiền #<span id="withdrawId"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body my-3">
                        <div class="list-group w-100">
                            <div class="list-group-item list-group-item-action">
                                <i class="bi-music-note-beamed"></i> Số lượng
                                <span
                                    class="float-end" id="withdrawAmount"></span>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <i class="bi-music-note-beamed"></i> Thành tiền
                                <span
                                    class="float-end" id="withdrawFinalAmount"></span>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <i class="bi-music-note-beamed"></i> Bank
                                <span
                                    class="float-end" id="withdrawBank"></span>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <i class="bi-music-note-beamed"></i> STK
                                <span
                                    class="float-end" id="withdrawNumber"></span>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <i class="bi-music-note-beamed"></i> Tên
                                <span
                                    class="float-end" id="withdrawName"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="" id="withdrawQr" style="width: 70%">
                    </div>
                    <small class="text-danger fw-bold d-flex justify-content-center text-center">TRẠNG THÁI ĐÃ THAY ĐỔI KHÔNG HOÀN TÁC ĐƯỢC. VUI LÒNG KIỂM TRA KĨ THÔNG TIN</small>
                    <div class="btn-group mt-3 d-flex justify-content-center" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-success actionWithdraw" data-action="1" data-id="">Duyệt</button>
                        <button type="button" class="btn btn-danger actionWithdraw" data-action="2" data-id="">Từ chối</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast';

        let balActionType;
        window.addEventListener('DOMContentLoaded', function () {
            $('.withdrawDetail').click(function (e) {
                e.preventDefault()

                $('#withdrawId').html('')
                $('#withdrawAmount').html('')
                $('#withdrawFinalAmount').html('')
                $('#withdrawNumber').html('')
                $('#withdrawBank').html('')
                $('#withdrawName').html('')
                $('.actionWithdraw').attr('data-id', '')
                $('#withdrawQr').attr('src', '')

                const wid = $(this).data('id')
                $.ajax({
                    url: "{{route('admin.findWithdraw')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({wid: wid }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        $('#withdrawId').html(data.data.data.id)
                        $('#withdrawAmount').html(data.data.data.amount)
                        $('#withdrawFinalAmount').html(data.data.final)
                        $('#withdrawNumber').html(data.data.data.card_number)
                        $('#withdrawBank').html(data.data.data.bank)
                        $('#withdrawName').html(data.data.data.card_holder)
                        $('.actionWithdraw').attr('data-id', data.data.data.id)
                        $('#withdrawQr').attr('src', data.data.qr)
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
                    },
                });
            })

            $('.actionWithdraw').click(function (e) {
                e.preventDefault()
                const chargeId = $(this).data('id')
                const action = $(this).data('action')
                $.ajax({
                    url: "{{route('admin.withdraw.post')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({wid: chargeId, action: action }), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        toast.success(data.message);
                        location.reload()
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
                    },
                });
            })

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
                    data: JSON.stringify({idUser: $(this).data('id')}), // Use the FormData object with all the fields
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

            $('.passwordChange').click(function (e) {
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
        })
    </script>
@endsection
