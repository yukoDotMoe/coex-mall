<x-app-layout>
    @section('header')
        <div class="-container sm:h-[180px] h-[140px] flex items-center justify-between pl-4 pr-6"
             style="background: url(&quot;{{asset('minigame/img/Cover.Account.bac6a38ebab2f92af570.png')}}&quot;) left top / cover no-repeat;">
            <div class="justify-content-center text-base2 w-[200px] text-center sm:text-2xl text-xl font-bold whitespace-pre-line z-10">
                <div style="text-shadow: rgb(255, 255, 136) 1px 0px 10px; color: rgba(255, 255, 255, 0.8);">
                    <div class=" font-medium">ID của bạn</div><div><strong>{{ Auth::user()->id }}</strong></div>
                </div>
            </div>
        </div>
        @include('layouts.movingAnn')

    @endsection
    <div class="py-4">
        <div class="text-navbar rounded-[12px] pl-10 pr-8 py-6"
             style="background: url('{{ asset('/minigame/img/Cover.Balance.c214a0c87a9c3b605282.png') }}') center center / cover no-repeat;">
            <div class="text-[#073152]">Số dư tài khoản</div>
            <div class="flex items-center relative gap-2 my-2 pr-8"><span
                    class="text-[42px] leading-[48px] font-bold max-line-1 text-[#073152]"><span>{{ Auth::user()->balanceFormated() }}</span></span>
                <button
                    class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium absolute right-[-12px] text-white css-1yxmbwk"
                    tabindex="0" type="button">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="VisibilityOffOutlinedIcon">
                        <path
                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5 2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4 1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            </div>
        </div>
        <div class="flex space-x-3 g-5 py-2">
            <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters w-full flex justify-center gap-2 css-17z60tr"
                tabindex="-1" role="menuitem" data-toggle="modal"
                data-target="#exampleModal">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false" aria-hidden="true"
                     viewBox="0 0 24 24" data-testid="AddIcon">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                </svg>
                <span>Nạp điểm</span><span class="MuiTouchRipple-root css-w0pj6f"></span></li>
            <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters w-full flex justify-center gap-2 css-17z60tr"
                tabindex="-1" role="menuitem">
                <a href="{{ route('account.withdraw') }}">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false" aria-hidden="true"
                         viewBox="0 0 24 24" data-testid="RemoveIcon">
                        <path d="M19 13H5v-2h14v2z"></path>
                    </svg>
                    <span>Quy đổi</span><span class="MuiTouchRipple-root css-w0pj6f"></span>
                </a> </li>
        </div>

        <ul class="MuiList-root MuiList-padding flex flex-col space-y-2 mb-3 css-1ontqvh" role="menu" tabindex="-1">
            <a
                tabindex="0" href="/profile">
                <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-17z60tr"
                    tabindex="-1" role="menuitem">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="AccountCircleOutlinedIcon">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.35 18.5C8.66 17.56 10.26 17 12 17s3.34.56 4.65 1.5c-1.31.94-2.91 1.5-4.65 1.5s-3.34-.56-4.65-1.5zm10.79-1.38C16.45 15.8 14.32 15 12 15s-4.45.8-6.14 2.12C4.7 15.73 4 13.95 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.95-.7 3.73-1.86 5.12z"></path>
                        <path
                            d="M12 6c-1.93 0-3.5 1.57-3.5 3.5S10.07 13 12 13s3.5-1.57 3.5-3.5S13.93 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"></path>
                    </svg>
                    <div class="MuiListItemText-root css-1tsvksn"><span
                            class="MuiTypography-root MuiTypography-body1 MuiListItemText-primary css-lz9xor">Thông tin cá nhân</span>
                    </div>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="NavigateNextIcon">
                        <path d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></li>
            </a>
            @if(!Auth::user()->is_verify())
                <a href="{{ route('account.verify') }}"> @endif
                    <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters relative css-17z60tr"
                        tabindex="-1" role="menuitem">
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                             aria-hidden="true"
                             viewBox="0 0 24 24" data-testid="VerifiedOutlinedIcon">
                            <path
                                d="M23 11.99 20.56 9.2l.34-3.69-3.61-.82L15.4 1.5 12 2.96 8.6 1.5 6.71 4.69 3.1 5.5l.34 3.7L1 11.99l2.44 2.79-.34 3.7 3.61.82 1.89 3.2 3.4-1.47 3.4 1.46 1.89-3.19 3.61-.82-.34-3.69 2.44-2.8zm-3.95 1.48-.56.65.08.85.18 1.95-1.9.43-.84.19-.44.74-.99 1.68-1.78-.77-.8-.34-.79.34-1.78.77-.99-1.67-.44-.74-.84-.19-1.9-.43.18-1.96.08-.85-.56-.65L3.67 12l1.29-1.48.56-.65-.09-.86-.18-1.94 1.9-.43.84-.19.44-.74.99-1.68 1.78.77.8.34.79-.34 1.78-.77.99 1.68.44.74.84.19 1.9.43-.18 1.95-.08.85.56.65 1.29 1.47-1.28 1.48z"></path>
                            <path d="m10.09 13.75-2.32-2.33-1.48 1.49 3.8 3.81 7.34-7.36-1.48-1.49z"></path>
                        </svg>
                        <div class="MuiListItemText-root css-1tsvksn"><span
                                class="MuiTypography-root MuiTypography-body1 MuiListItemText-primary css-lz9xor">Trạng thái</span>
                        </div>
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                             aria-hidden="true"
                             viewBox="0 0 24 24" data-testid="NavigateNextIcon">
                            <path d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                        </svg>
                        <div class="absolute right-[40px]" style="bottom: 50%; transform: translateY(50%);">
                            <div
                                class="MuiChip-root MuiChip-filled MuiChip-sizeMedium MuiChip-colorDefault MuiChip-filledDefault @if(Auth::user()->is_verify()) css-m6xmer @else css-1l3bzoq @endif">
                                <span class="MuiChip-label MuiChip-labelMedium css-9iedg7">@if(Auth::user()->is_verify())
                                        ĐÃ XÁC THỰC
                                    @else
                                        CHƯA XÁC THỰC
                                    @endif</span></div>
                        </div>
                        <span class="MuiTouchRipple-root css-w0pj6f"></span></li>
                    @if(!Auth::user()->is_verify()) </a>
            @endif
            <a href="/banking">
                <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-17z60tr"
                    tabindex="-1" role="menuitem">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="AccountBalanceOutlinedIcon">
                        <path
                            d="M6.5 10h-2v7h2v-7zm6 0h-2v7h2v-7zm8.5 9H2v2h19v-2zm-2.5-9h-2v7h2v-7zm-7-6.74L16.71 6H6.29l5.21-2.74m0-2.26L2 6v2h19V6l-9.5-5z"></path>
                    </svg>
                    <div class="MuiListItemText-root css-1tsvksn"><span
                            class="MuiTypography-root MuiTypography-body1 MuiListItemText-primary css-lz9xor">Quản lý thẻ ngân hàng</span>
                    </div>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="NavigateNextIcon">
                        <path d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></li>
            </a><a href="{{ route('account.history_play', ['tables' => 'withdraw']) }}">
                <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-17z60tr"
                    tabindex="-1" role="menuitem">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="GamesOutlinedIcon">
                        <path
                            d="M13 4v2.67l-1 1-1-1V4h2m7 7v2h-2.67l-1-1 1-1H20M6.67 11l1 1-1 1H4v-2h2.67M12 16.33l1 1V20h-2v-2.67l1-1M15 2H9v5.5l3 3 3-3V2zm7 7h-5.5l-3 3 3 3H22V9zM7.5 9H2v6h5.5l3-3-3-3zm4.5 4.5-3 3V22h6v-5.5l-3-3z"></path>
                    </svg>
                    <div class="MuiListItemText-root css-1tsvksn"><span
                            class="MuiTypography-root MuiTypography-body1 MuiListItemText-primary css-lz9xor">Lịch sử đánh giá</span>
                    </div>
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="NavigateNextIcon">
                        <path d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></li>
            </a>

        </ul>

        <div class="flex justify-center">


            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation px-10 mx-auto css-1n02ex7"
                    tabindex="0" type="button"
                    :href="route('logout')"
                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                <span class="MuiButton-startIcon MuiButton-iconSizeMedium css-1l6c7y9">
                    <svg style="    fill: var(--color-primary-dark) !important;"
                         class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="LogoutOutlinedIcon"><path
                            d="m17 8-1.41 1.41L17.17 11H9v2h8.17l-1.58 1.58L17 16l4-4-4-4zM5 5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h7v-2H5V5z"></path></svg></span>Đăng
                    xuất<span class="MuiTouchRipple-root css-w0pj6f"></span>
                </button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a" id=":rf:">Thông
                        báo</h2>
                    <div class="MuiDialogContent-root css-1ty026z mt-3">
                        Liên hệ Hotline CSKH để tiến hành
                        nạp/quy đổi điểm vào tài khoản.
                        <hr>
                        <div class="d-flex justify-content-center">
                            <span class="">Giờ làm việc: <strong>{{\App\Http\Controllers\ApiController::getSetting('work_time_start')}}</strong> - <strong>{{\App\Http\Controllers\ApiController::getSetting('work_time_end')}}</strong></span>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
