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
                                    <td>@switch($game->thao_tac)
                                            @case(1)
                                                LIKE
                                                @break
                                            @case(2)
                                                VOTE
                                                @break
                                            @case(3)
                                                5 SAO
                                                @break
                                            @case(4)
                                                3 SAO
                                                @break
                                    @endswitch</td>
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
                    <h5 class="card-title">NẠP TIỀN</h5>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Phương Thức</th>
                            <th scope="col">Số tiền	</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recharge as $plus)
                            <tr>
                                <td>{{ $plus->id }}</td>
                                <td>Chuyển khoản</td>
                                <td>{{ $plus->amount }}</td>
                                <td>Thành công</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">RÚT TIỀN</h5>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Thời gian tạo	</th>
                            <th scope="col">Tài khoản nhận	</th>
                            <th scope="col">Số tiền	</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraw as $minus)
                            <tr>
                                <td>{{ $minus->id }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($minus->created_at)) }}</td>
                                <td>{{ $minus->card_holder }}</td>
                                <td>{{ $minus->amount }}</td>
                                <td>Thành công</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">XÁC THỰC TÀI KHOẢN</h5>
                <div class="row gx-3">
                    <div class="col-6">
                        <div class="card">
                            <img src="@if(empty($user->mat_truoc)) {{ asset('/noimage.png') }} @else {{ asset($user->mat_truoc) }} @endif" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <p class="card-text">Mặt trước CMT</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <img src="@if(empty($user->mat_sau)) {{ asset('/noimage.png') }} @else {{ asset($user->mat_sau) }} @endif" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <p class="card-text">Mặt sau CMT</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-5 col-12">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">THÔNG TIN CÁ NHÂN</h5>
                <div class="list-group w-100">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-camera-fill"></i> ID
                        <span class="badge rounded-pill bg-primary float-end">{{ $user->id }}</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-camera-fill"></i> SDT
                        <span class="badge rounded-pill bg-primary float-end">{{ $user->username }}</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-camera-fill"></i> Login lần cuối
                        <span class="badge rounded-pill bg-primary float-end">{{ date('d-m-Y H:i:s', strtotime($user->updated_at)) }}</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-music-note-beamed"></i> Số tài khoản ngân hàng
                        <span class="badge rounded-pill bg-primary float-end">{{ (empty($user->getBank())) ? 'Chưa liên kết' : $user->getBank()->card_number }}</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-film"></i> Chủ tài khoản ngân hàng
                        <span class="badge rounded-pill bg-primary float-end">{{ (empty($user->getBank())) ? 'Chưa liên kết' : $user->getBank()->card_holder }}</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-film"></i> Ngân hàng
                        <span class="badge rounded-pill bg-primary float-end">{{ (empty($user->getBank())) ? 'Chưa liên kết' : \App\Models\Banks::where('id', $user->getBank()->bank_id)->first()->name }}</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">THÔNG TIN TÀI KHOẢN</h5>
                <div class="list-group w-100">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi-camera-fill"></i> Số dư
                        <span class="badge rounded-pill bg-primary float-end" id="userBalance">{{ $user->balanceFormated() }}</span>
                    </a>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-balance-type="+">+</button>
                        <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-balance-type="-">-</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bạn chắc chắn muốn thực hiện thao tác này ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="iam"></h5>
                <label for="inputPassword5" class="form-label">Số tiền</label>
                <input type="number" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Lời nhắn (nếu có)</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="balanceUpdate">Xác nhận</button>
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
        $('[data-balance-type]').click(function () {
            const editType = $(this).data('balance-type')
            if(editType == '+')
            {
                balActionType = 1
                $('#iam').html('Sau khi bấm xác nhận, hệ thống tự động cộng điểm trong tài khoản khách hàng.. ')
            }else{
                balActionType = 2
                $('#iam').html('Sau khi bấm xác nhận, hệ thống tự động trừ điểm trong tài khoản khách hàng..')
            }
        })

        $('#balanceUpdate').click(function () {
            var _this = $('.submit');
            setTimeout(function () {
                _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                _this.prop('disabled', false);
            }, 300);
            $.ajax({
                url: "{{route('admin.updateBalance')}}",
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    userid: "{{ $user->id }}",
                    balType: balActionType,
                    balAmount: $('#inputPassword5').val(),
                    balMsg: $('#exampleFormControlTextarea1').val(),
                }),
                processData: false,
                success: function (data) {
                    if (data.success) {
                        toast.success(data.message)
                        $('#userBalance').html(data.data.new_balance)
                    } else {
                        toast.error(data.message)
                    }
                },
                error: function (data) {
                    toast.error('Đã có lỗi xảy ra trong lúc xử lí.')
                }
            });
            $('#exampleModal').modal('hide');
        })
    })
</script>
@endsection
