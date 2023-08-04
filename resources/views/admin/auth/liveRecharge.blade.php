@foreach($recharges as $rc)
    <tr>
        <th>{{ $rc->user_id }}</th>
        <th>{{ $rc->username }}</th>
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
        <th>{{ $rc->created_at->format('Y-m-d H:i:s') }}</th>
        <th>{{ ($rc->note == '.') ? null : $rc->note }}</th>
        <th>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-danger revoke" data-id="{{ $rc->id }}" @if($rc->status == 2) disabled @endif>Thu hồi</button>
            </div>
        </th>
    </tr>
@endforeach
