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
    @php($bankinfo = \App\Http\Controllers\ApiController::getFromBankId($wd->bank_id))
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
