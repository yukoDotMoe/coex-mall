<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <table class="table table-striped display"  id="myTable">
        <div class="form-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Tìm theo ID  ...">
        </div>
        <thead>
        <tr>
            <th scope="col">ID User</th>
            <th scope="col">Username</th>
            <th scope="col">Đại lí</th>
            <th scope="col">Giá trị</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngân hàng</th>
            <th scope="col">STK</th>
            <th scope="col">Chủ TK</th>
            <th scope="col">Thời gian</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($withdraws as $wd)
            <tr>
                <th>{{ $wd->user_id }}</th>
                <th>{{ $wd->username }}</th>
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
                <th>{{ $wd->created_at->format('Y-m-d H:i:s') }}</th>
                <th>{{ ($wd->note == '.') ? null : $wd->note }}</th>
                <th>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-success action" data-action="1" data-id="{{ $wd->id }}" @if($wd->status > 0) disabled @endif>Duyệt</button>
                        <button type="button" class="btn btn-danger action" data-action="2" data-id="{{ $wd->id }}" @if($wd->status > 0) disabled @endif>Từ chối</button>
                    </div>
                </th>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {
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
                        toast.success(`Thu hồi thành công`);
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
