<x-changer-layout>
    <x-slot name="header">
        Tổng hợp lịch sử
    </x-slot>
    <form id="updateForm" class="mt-5 p-md-3 p-2">
        <div class="MuiTabs-root css-orq8zk">
            <div class="MuiTabs-scroller MuiTabs-fixed css-1anid1y" style="overflow: hidden; margin-bottom: 0px;">
                <div class="MuiTabs-flexContainer justify-center css-k008qs" role="tablist">
                    <a href="{{ route('account.history_play', 'withdraw') }}"
                       class="MuiButtonBase-root MuiTab-root MuiTab-textColorInherit MuiTab-fullWidth p-0 @if($type == 'withdraw') Mui-selected @endif css-s5b7cy"
                       tabindex="0">LS Quy đổi<span class="MuiTouchRipple-root css-w0pj6f"></span></a>
                    <a href="{{ route('account.history_play', 'recharge') }}"
                       class="MuiButtonBase-root MuiTab-root MuiTab-textColorInherit MuiTab-fullWidth p-0 @if($type == 'recharge') Mui-selected @endif css-s5b7cy"
                       tabindex="0">LS Nạp điểm<span class="MuiTouchRipple-root css-w0pj6f"></span></a>
                    <a href="{{ route('account.history_play', 'bet') }}"
                       class="MuiButtonBase-root MuiTab-root MuiTab-textColorInherit MuiTab-fullWidth p-0 @if($type == 'bet') Mui-selected @endif css-s5b7cy"
                       tabindex="-1">LS Tham gia<span class="MuiTouchRipple-root css-w0pj6f"></span></a>
                </div>
            </div>
        </div>

        <div>
            <div class="MuiDialogContent-root px-0 py-2 -mx-2 relative css-1ty026z">
                <div
                    class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 MuiTableContainer-root p-0 css-13xy2my">
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
                                    <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                        scope="col">Thưởng
                                    </th>
                                    <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                        scope="col">Số kỳ
                                    </th>
                                    @break
                                @case('recharge')
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
                            @endswitch
                        </tr>
                        </thead>
                        <tbody class="MuiTableBody-root css-1xnox0e">
                        @foreach($data as $raw)
                            @switch($type)
                                @case('withdraw')
                                    <tr class="MuiTableRow-root css-10wvkr9">
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1afg4rq">
                                            {{ $raw->created_at->format('d/m/Y') }}
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
                                    <tr class="MuiTableRow-root css-10wvkr9 gamehistory" data-toggle="modal"
                                        data-target="#explain"
                                        data-id="{{ $raw->game_id }}" data-bet-id="{{ $raw->id }}">
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1afg4rq">
                                            {{ $raw->so_luong }}
                                        </td>
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-alignCenter MuiTableCell-sizeMedium css-dwdc7h">
                                            @if($raw->trang_thai == 1)
                                                {{ $raw->so_luong * \App\Http\Controllers\ApiController::getSetting(\App\Http\Controllers\ApiController::numToGameType($raw->thao_tac) . '_multiply') }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-dwdc7h">
                                            <div
                                                class="MuiChip-root MuiChip-filled MuiChip-sizeSmall MuiChip-colorDefault MuiChip-filledDefault css-31ic4c">
                                                <span
                                                    class="MuiChip-label MuiChip-labelSmall css-1pjtbja">{{ \App\Http\Controllers\ApiController::gameIdToId($raw->game_id) }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @break
                                @case('recharge')
                                    <tr class="MuiTableRow-root css-10wvkr9 gamehistory">
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1afg4rq">
                                            {{ $raw->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-dwdc7h">
                                            {{ $raw->amount }}
                                        </td>
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-dwdc7h">
                                            @switch($raw->status)
                                                @case(0)
                                                    <div class="text-info">Chờ</div>
                                                    @break
                                                @case(1)
                                                    <div class="text-success">Đã nạp</div>
                                                    @break
                                                @case(2)
                                                    <div class="text-danger">Lỗi</div>
                                                    @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @if($raw->bill == 0 && !empty($raw->note))
                                        <tr class="MuiTableRow-root mt-[-4px] css-10wvkr9">
                                            <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium pt-0 css-1afg4rq"
                                                colspan="3">Ghi chú: {{ $raw->note }}
                                            </td>
                                        </tr>
                                    @endif
                                    @break
                            @endswitch
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="explain" tabindex="1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content css-mbdu2s">
                <div class="modal-body ">
                    <button data-dismiss="modal"
                            class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeSmall css-o1bub9"
                            tabindex="0" type="button">
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                             style="fill: white !important;"
                             aria-hidden="true" viewBox="0 0 24 24" data-testid="CloseIcon">
                            <path
                                d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                        </svg>
                        <span class="MuiTouchRipple-root css-w0pj6f"></span>
                    </button>
                    <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a" id=":rf:">Chi tiết kỳ

                    </h2>
                    <div class="MuiDialogContent-root css-1ty026z" style="padding: 5px 1px !important;">
                        <div class="MuiDialogContent-root flex flex-col items-stretch space-y-4 css-1ty026z mt-2">
                            <div class="flex justify-center">
                                <div
                                    class="font-medium bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-primary-main css-1ruz4ejj font-bold">
                                    <span id="phienGame">-</span></div>
                            </div>
                            <div class="flex justify-between">
                                <div>Thời gian</div>
                                <div id="phienTime" class="text-sm">-</div>
                            </div>
                            <div class="flex justify-between">
                                <div>ID người chơi</div>
                                <div id="userid" class="text-sm">{{ Auth::user()->id }}</div>
                            </div>
                            <div class="flex justify-between">
                                <div>Kết quả</div>
                                <div class="inline-flex space-x-1">
                                    <div id="kq1"
                                         class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault w-[24px] h-[24px] text-sm font-medium bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-primary-main css-1ruz4ejz">
                                        -
                                    </div>
                                    <div id="kq2"
                                         class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault w-[24px] h-[24px] text-sm font-medium bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-primary-main css-1ruz4ejz">
                                        -
                                    </div>
                                    <div id="kq3"
                                         class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault w-[24px] h-[24px] text-sm font-medium bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-primary-main css-1ruz4ejz">
                                        -
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div
                                    class="bg-primary-main text-white rounded-[12px] flex items-center px-4 pt-2 pb-3 my-4">
                                    <div class="text-center px-4">
                                        <div class="text-[24px] font-bold totalBet">-</div>
                                        <div class="text-sm">Tổng điểm</div>
                                    </div>
                                    <hr class="MuiDivider-root MuiDivider-fullWidth MuiDivider-vertical border-white/40 border-r-2 h-[80%] css-w6wt69">
                                    <div class="text-center px-4">
                                        <div class="text-[24px] font-bold totalWin">-</div>
                                        <div class="text-sm">Phần thưởng</div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="MuiPaper-root MuiPaper-outlined MuiPaper-rounded MuiTableContainer-root p-0 css-x2rcou">
                                <table class="MuiTable-root css-ud4dfi">
                                    <thead class="MuiTableHead-root css-1wbz3t9">
                                    <tr class="MuiTableRow-root MuiTableRow-head css-10wvkr9">
                                        <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-sizeMedium css-1nnya3x"
                                            scope="col">Loại
                                        </th>
                                        <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                            scope="col">Cược
                                        </th>
                                        <th class="MuiTableCell-root MuiTableCell-head MuiTableCell-alignRight MuiTableCell-sizeMedium css-1hkbn6i"
                                            scope="col">Thưởng
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="MuiTableBody-root css-1xnox0e">
                                    <tr class="MuiTableRow-root css-10wvkr9">
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-sizeMedium css-1afg4rq text-primary" id="betType">-
                                        </td>
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-alignRight MuiTableCell-sizeMedium css-dwdc7h totalBet">
                                            -
                                        </td>
                                        <td class="MuiTableCell-root MuiTableCell-body MuiTableCell-alignRight MuiTableCell-sizeMedium css-dwdc7h totalWin">
                                            -
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';

            $('.gamehistory').click(function () {
                const roundId = $(this).data('id')
                const betId = $(this).data('bet-id')
                $.ajax({
                    url: "{{route('account.getGame')}}",
                    type: 'POST',
                    dataType: 'json', // Specify the expected response type
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({game_id: roundId, bet_id: betId}), // Use the FormData object with all the fields
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Set to false, since we are using FormData object
                    success: function (data) {
                        if(!data.success)
                        {
                            $('#explain').modal('toggle');
                            toast.error('Không tìm thấy')
                        }
                        const numbersArr = (data.data.result).split('-')
                        $('#kq1').html(numbersArr[0])
                        $('#kq2').html(numbersArr[1])
                        $('#kq3').html(numbersArr[2])
                        $('.totalBet').html(data.data.bet)
                        $('.totalWin').html(data.data.win)
                        $('#betType').html(data.data.type)
                        $('#phienGame').html(data.data.phien)
                        if (data.data.win == 0)
                        {
                            $('#betType').removeClass('text-primary')
                            $('#betType').addClass('text-danger')
                        }else{
                            $('#betType').removeClass('text-danger')
                            $('#betType').addClass('text-primary')
                        }
                        $('#phienTime').html(data.data.time)
                    },
                    error: function (data) {
                        toast.error('Không tìm thấy');
                    },
                });
            })
        </script>
    @endsection
</x-changer-layout>
