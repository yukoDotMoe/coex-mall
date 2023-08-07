<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <x-auto-reload-checkbox />

    <table class="table table-striped display"  id="myTable">
        <thead>
        <tr>
            <th scope="col">Thời gian</th>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Đại lí</th>
            <th scope="col">Số điểm</th>
            <th scope="col">Đánh giá</th>
            <th scope="col">Phiên</th>
            <th scope="col">Trạng thái phiên</th>
            <th scope="col">Kết quả phiên</th>
            <th scope="col">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            @php($finish = false)
            <tr>
                <td>{{ $row->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $row->user_id }}</td>
                <td>{{ $row->username }}</td>
                <td>{{ $row->dai_li }}</td>
                <td>{{ $row->so_luong }}</td>
                <td>
                    @switch($row->thao_tac)
                        @case(1)
                            <span class="badge text-bg-primary" style="background-color: #f73007 !important;">Like</span>
                            @break
                        @case(2)
                            <span class="badge text-bg-primary" style="background-color: #00af52 !important;">Vote</span>
                            @break
                        @case(3)
                            <span class="badge text-bg-primary" style="background-color: #009cd9 !important;">5 Sao</span>
                            @break
                        @case(4)
                            <span class="badge text-bg-primary" style="background-color: #9534f0 !important;">3 sao</span>
                            @break
                    @endswitch
                </td>
                <td>{{ $row->phien }}</td>
                @php($currentTime = \Carbon\Carbon::now()->format('YmdHis'))
                <td>
                    @if($row->game_id > $currentTime)
                        Chưa sổ
                    @else
                        @php($finish = true)
                        @switch($row->trang_thai)
                            @case(0)
                                <span class="badge text-bg-secondary text-white">Chờ</span>
                                @break
                            @case(1)
                                <span class="badge text-bg-success text-white">Thắng</span>
                                @break
                            @case(2)
                                <span class="badge text-bg-danger text-white">Thua</span>
                                @break
                        @endswitch
                    @endif
                </td>
                <th class="numbers id-{{ $row->phien }}">{{ $row->ketqua_phien }}</th>
                @php($numbers = explode('-', $row->ketqua_phien))
                <td>
                    @if(!$finish)
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input firstRow id-{{ $row->phien }}" type="radio" data-id="{{ $row->phien }}" value="option1" data-type="vote"
                                       @if(in_array($numbers[0], [5,6,7,8,9])) checked @endif
                                >
                                <label class="form-check-label">
                                    Like
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input firstRow id-{{ $row->phien }}" type="radio" data-id="{{ $row->phien }}" value="option2" data-type="like"
                                       @if(in_array($numbers[0], [0,1,2,3,4])) checked @endif
                                >
                                <label class="form-check-label">
                                    Vote
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input secondRow id-{{ $row->phien }}" type="radio" data-id="{{ $row->phien }}" value="option1" data-type="5sao"
                                       @if(in_array($numbers[2], [0,2,4,6,8])) checked @endif
                                >
                                <label class="form-check-label">
                                    5 sao
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input secondRow id-{{ $row->phien }}" type="radio" data-id="{{ $row->phien }}" value="option2" data-type="3sao"
                                       @if(in_array($numbers[2], [1,3,5,7,9])) checked @endif
                                >
                                <label class="form-check-label">
                                    3 sao
                                </label>
                            </div>
                        </div>
                    </div>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast'

        Array.prototype.sample = function(){
            return this[Math.floor(Math.random()*this.length)];
        }

        window.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "order": [[ 0, 'desc' ]]
                });
            });
            $('.firstRow').change(function () {
                var newOne = $(`.firstRow.id-${$(this).attr('data-id')}`);
                change($(this).attr('data-id'),1, $(this).attr('data-type'), newOne.attr('data-type'))
                newOne.prop('checked', false);
                $(this).prop('checked', true);
            })

            $('.secondRow').change(function () {
                var newOne = $(`.secondRow.id-${$(this).attr('data-id')}`);
                change($(this).attr('data-id'),2, $(this).attr('data-type'), newOne.attr('data-type'))
                newOne.prop('checked', false);
                $(this).prop('checked', true);
            })

            function change(id, row, oldType, newType) {
                var numbers = $(`.numbers.id-${id}`).first().text().split('-')
                var newNumber;
                if (row === 1)
                {
                    if (oldType == 'vote')
                    {
                        numbers[0] = [5,6,7,8,9].sample()
                    }else{
                        numbers[0] = [0,1,2,3,4].sample()
                    }
                }else{
                    if (oldType == '5sao')
                    {
                        numbers[2] = [0,2,4,6,8].sample()
                    }else{
                        numbers[2] = [1,3,5,7,9].sample()
                    }
                }

                newNumber = numbers.join('-')
                postChange(id, newNumber)
                $(`.numbers.id-${id}`).html(newNumber)
            }

            function postChange(id, newNumber)
            {
                var formData = new FormData();
                formData.append('id', id);
                formData.append('gia_tri', newNumber);
                $.ajax({
                    url: "{{route('admin.lucky_game.post')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success)
                        {
                            toast.success('Cập nhật thành công')
                        }else{
                           toast.error('Không thành công')
                        }
                        location.reload()
                    },
                    error: function (data) {
                        toast.success('Thất bại')
                    }
                });
            }
        })
    </script>
@endsection
