<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
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

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Giá trị</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="amount" min="1" required>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ghi chú</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reason"></textarea>
        </div>

        <input name="type" value="ad" hidden>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Xác nhận</button>
        </div>
    </form>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast'
        window.addEventListener('DOMContentLoaded', function () {
            $('#checkId').click(function (e){
                e.preventDefault()
                if($('[name="user_id"]').val() == '') return false;
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
                        toast.success(`Username: ${data.username}`);
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
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
        })
    </script>
@endsection
