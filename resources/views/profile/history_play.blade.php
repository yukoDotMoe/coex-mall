<x-changer-layout>
    <x-slot name="header">
        Tổng hợp lịch sử
    </x-slot>
    <form id="updateForm" class="mt-5 p-md-3 p-5">
        <div class="MuiTabs-root css-orq8zk">
            <div class="MuiTabs-scroller MuiTabs-fixed css-1anid1y" style="overflow: hidden; margin-bottom: 0px;">
                <div class="MuiTabs-flexContainer justify-center css-k008qs" role="tablist">
                    <a href="{{ route('account.history_play', 'withdraw') }}"
                       class="MuiButtonBase-root MuiTab-root MuiTab-textColorInherit MuiTab-fullWidth p-0 @if($type == 'withdraw') Mui-selected @endif css-s5b7cy"
                       tabindex="0">LS Quy đổi<span class="MuiTouchRipple-root css-w0pj6f"></span></a>
                    <a href="{{ route('account.history_play', 'bet') }}"
                       class="MuiButtonBase-root MuiTab-root MuiTab-textColorInherit MuiTab-fullWidth p-0 @if($type == 'bet') Mui-selected @endif css-s5b7cy"
                       tabindex="-1">LS Tham gia<span class="MuiTouchRipple-root css-w0pj6f"></span></a>
                </div>
                <span class="MuiTabs-indicator css-w2qe5v" style="left: @if($type == 'withdraw') 19px @else 216px @endif; width: 170px;"></span>
            </div>
        </div>

        <div>
            <div class="MuiDialogContent-root px-0 py-2 -mx-2 relative css-1ty026z">
                <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 MuiTableContainer-root p-0 css-13xy2my">
                    <table class="MuiTable-root css-ud4dfi">
                        <thead class="MuiTableHead-root css-1wbz3t9">
                        <tr class="MuiTableRow-root MuiTableRow-head css-10wvkr9">
                            @switch($type)
                                @case('withdraw')
                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-1nnya3x"
                                    scope="col">
                                    Thời gian
                                </th>
                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                    scope="col">Số điểm
                                </th>
                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                    scope="col">Trạng thái
                                </th>
                                @break
                                @case('bet')
                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-1nnya3x"
                                    scope="col">
                                    Tổng điểm
                                </th>
                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1nnya3x"
                                    scope="col">Thưởng
                                </th>
                                <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                    scope="col">Số kỳ
                                </th>
                                @break
                            @endswitch
                        </tr>
                        </thead>
                        <tbody class="MuiTableBody-root css-1xnox0e">
                        @foreach($data as $raw)
                            @switch($type)
                                @case('withdraw')
                                <tr class="MuiTableRow-root css-10wvkr9">
                                    <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1afg4rq">
                                        {{ $raw->created_at }}
                                    </td>
                                    <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-alignRight MuiTableCell-sizeMedium css-dwdc7h">
                                        {{ $raw->amount }}
                                    </td>
                                    <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-alignRight MuiTableCell-sizeMedium css-dwdc7h">
                                        @switch($raw->status)
                                            @case(0)
                                            <div class="text-info">Chờ</div>
                                            @break
                                            @case(1)
                                            <div class="text-success">Đã quy đổi</div>
                                            @break
                                            @case(2)
                                            <div class="text-danger">Lỗi</div>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                @break
                                @case('bet')
                                <tr class="MuiTableRow-root css-10wvkr9">
                                    <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1afg4rq">
                                        {{ $raw->so_luong }}
                                    </td>
                                    <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-alignCenter MuiTableCell-sizeMedium css-r0fgiq">
                                        {{ $raw->finalAmount ?? 0 }}
                                    </td>
                                    <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-r0fgiq">
                                        <div class="MuiChip-root MuiChip-filled MuiChip-sizeSmall MuiChip-colorDefault MuiChip-filledDefault css-31ic4c">
                                            <span class="MuiChip-label MuiChip-labelSmall css-1pjtbja">{{ \App\Http\Controllers\ApiController::gameIdToId($raw->game_id) }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @break
                            @endswitch
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</x-changer-layout>