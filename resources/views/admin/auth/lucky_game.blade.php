<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <div class="card text-center mb-3">
        <div class="card-header" id="gameId">ID tiếp theo: {{ $next->id     }}</div>
        <div class="card-body">
            <h5 class="card-title" id="gameResult" data-id="{{ $next->id }}">{{ $next->gia_tri }}</h5>
        </div>
        <div class="card-footer text-muted" id="timer">
            00:00
        </div>
    </div>

    <div class="container d-flex ">
        <table class="table ">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Kết quả</th>
                <th scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $round)
                <tr>
                    <th scope="row">{{ $round->id }}</th>
                    <th scope="row">{{ \App\Http\Controllers\ApiController::textToTime($round->game_id) }}</th>
                    <td class="numbers id-{{ $round->id }}">{{ $round->gia_tri }}</td>
                    @php($numbers = explode('-', $round->gia_tri))
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input firstRow id-{{ $round->id }}" type="radio" data-id="{{ $round->id }}" value="option1" data-type="vote"
                                    @if(in_array($numbers[0], [5,6,7,8,9])) checked @endif
                                    >
                                    <label class="form-check-label">
                                        Like
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input firstRow id-{{ $round->id }}" type="radio" data-id="{{ $round->id }}" value="option2" data-type="like"
                                   @if(in_array($numbers[0], [0,1,2,3,4])) checked @endif
                                    >
                                    <label class="form-check-label">
                                        Vote
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input secondRow id-{{ $round->id }}" type="radio" data-id="{{ $round->id }}" value="option1" data-type="5sao"
                                           @if(in_array($numbers[2], [0,2,4,6,8])) checked @endif
                                    >
                                    <label class="form-check-label">
                                        5 sao
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input secondRow id-{{ $round->id }}" type="radio" data-id="{{ $round->id }}" value="option2" data-type="3sao"
                                           @if(in_array($numbers[2], [1,3,5,7,9])) checked @endif
                                    >
                                    <label class="form-check-label">
                                        3 sao
                                    </label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection

@section('js')
<script type="module">
    import {toast} from 'https://cdn.skypack.dev/wc-toast'

    let oldid;
    let firstTime = true;
    Array.prototype.sample = function(){
        return this[Math.floor(Math.random()*this.length)];
    }
    window.addEventListener('DOMContentLoaded', function () {
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

        setInterval(function () {
            const format = 'YYYYMMDDHHmmss';
            const next = moment({{ $next->game_id }}, format);
            const currentTime = moment();
            const duration = moment.duration(next.diff(currentTime));
            const minutes = duration.minutes();
            const seconds = (duration.seconds() < 0) ? 0 : duration.seconds();
            if (minutes == 0 && seconds == 0) location.reload()
            const formattedDuration = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
            $('#timer').html(formattedDuration)
        }, 1000);

        function change(id, row, oldType, newType) {
            var numbers = $(`.numbers.id-${id}`).text().split('-')
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
            if (id === $('#gameResult').attr('data-id')) $('#gameResult').html(newNumber)
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
                    toast.success('Cập nhật thành công')
                },
                error: function (data) {
                    toast.success('Thất bại')
                }
            });
        }
    });
</script>
@endsection
