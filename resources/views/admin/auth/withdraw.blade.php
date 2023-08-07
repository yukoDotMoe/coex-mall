<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <x-auto-reload-checkbox />
    <small class="text-danger fw-bold d-flex justify-content-center text-center">TRẠNG THÁI ĐÃ THAY ĐỔI KHÔNG HOÀN TÁC ĐƯỢC. VUI LÒNG KIỂM TRA KĨ THÔNG TIN</small>

    <table class="table table-striped display"  id="myTable">
        <thead>
        <tr>
            <th scope="col">Thời gian</th>
            <th scope="col">ID User</th>
            <th scope="col">Username</th>
            <th scope="col">Đại lí</th>
            <th scope="col">Giá trị</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngân hàng</th>
            <th scope="col">STK</th>
            <th scope="col">Chủ TK</th>
            <th scope="col">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($withdraws as $wd)
            <tr>
                <th>{{ $wd->created_at->format('Y-m-d H:i:s') }}</th>
                <th>{{ $wd->user_id }}</th>
                <th><a class="link-underline link-underline-opacity-0" href="{{ route('admin.users.find', $wd->user_id) }}">{{ $wd->username }}</a></th>
                <th>{{ $wd->promo_code }}</th>
                <th>{{ $wd->amount }}</th>
                <th>
                    @switch($wd->status)
                        @case(0)
                            <span class="badge rounded-pill text-bg-secondary">Đang chờ</span>
                            @break

                        @case(1)
                            <span class="badge rounded-pill text-bg-success text-white">Thành công</span>
                            @break

                        @case(2)
                            <span class="badge rounded-pill text-bg-danger text-white">Từ chối</span>
                            @break
                    @endswitch
                </th>
                @php($bankinfo = \App\Http\Controllers\ApiController::getFromBankId($wd->bank_id ?? 1))
                <th>{{ $bankinfo->code }}</th>
                <th>{{ $wd->card_number }}</th>
                <th>{{ $wd->card_holder }}</th>
                <th>
                    @if($wd->status == 0)
                        <div class="btn-group" role="group">
                            <button data-bs-toggle="modal" data-bs-target="#withdrawDetail" type="button" class="btn btn-outline-danger withdrawDetail" data-id="{{ $wd->id }}">Chi tiết</button>
                        </div>
                    @else
                        -
                    @endif
                </th>
            </tr>
        @endforeach

        </tbody>
    </table>

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
                                <i class="bi-music-note-beamed"></i> Thành tiền
                                <span class="float-end" id="withdrawFinalAmount"></span>
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
                            <div class="list-group-item list-group-item-action">
                                <i class="bi-music-note-beamed"></i> Nội dung
                                <span
                                    class="float-end" id="withdrawNote"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="" id="withdrawQr" style="width: 50%">
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
        import {toast} from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "order": [[ 0, 'desc' ]]
                });
            });
            $('#searchInput').on('keyup', function() {
                let searchTerm = $(this).val().toLowerCase();
                if (searchTerm.length >= 2) {
                    $.ajax({
                        url: "{{ route('admin.withdraw.ajax') }}",
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
            $('.withdrawDetail').click(function (e) {
                e.preventDefault()

                $('#withdrawId').html('')
                $('#withdrawAmount').html('')
                $('#withdrawFinalAmount').html('')
                $('#withdrawNumber').html('')
                $('#withdrawBank').html('')
                $('#withdrawName').html('')
                $('#withdrawNote').html('')
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
                        $('#withdrawId').html(`${data.data.data.id} | Username: ${data.data.user.username} ID: ${data.data.user.id}`)
                        $('#withdrawAmount').html(data.data.data.amount)
                        $('#withdrawFinalAmount').html(`${data.data.final} VND`)
                        $('#withdrawNumber').html(data.data.data.card_number)
                        $('#withdrawBank').html(data.data.data.bank)
                        $('#withdrawName').html(data.data.data.card_holder)
                        $('#withdrawNote').html(data.data.data.bankNote)
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
            $('.action').click(function (e) {
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
        })
    </script>
@endsection
