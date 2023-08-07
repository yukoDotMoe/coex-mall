<x-app-layout>
    <div class="">
        <div class="-container flex flex-col items-center p-3">
            <div
                class="bg-color-primary text-white text-2xl font-bold px-6 py-2 rounded-[8px] tracking-widest z-10 mt-0">
                Đánh Giá Tổng
            </div>
            <div class="flex justify-center -m-3 mt-6">
                <div class="relative w-[100px] h-[100px] flex justify-center items-center">
                    <div
                        class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault w-[60px] h-[60px] text-[42px] font-bold bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-color-primary css-1ruz4ej"
                        aria-label="H" id="firstDigit"> -
                    </div>
                </div>
                <div class="relative w-[100px] h-[100px] flex justify-center items-center">
                    <div
                        class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault w-[60px] h-[60px] text-[42px] font-bold bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-color-primary css-1ruz4ej"
                        id="secondDigit">
                        -
                    </div>
                </div>
                <div class="relative w-[100px] h-[100px] flex justify-center items-center">
                    <div
                        class="MuiAvatar-root MuiAvatar-circular MuiAvatar-colorDefault w-[60px] h-[60px] text-[42px] font-bold bg-gradient-to-b from-[#FFF] to-[#D6D6D6] text-color-primary css-1ruz4ej"
                        aria-label="L" id="thirdDigit"> -
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center pb-3">
                <div class="text-lg">Trang tiếp - <span class="font-bold" id="nextId">0</span></div>
                <div class="flex items-center space-x-1">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true"
                         style="    fill: var(--color-primary-dark) !important;"
                         viewBox="0 0 24 24" data-testid="AccessTimeOutlinedIcon">
                        <path
                            d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                    </svg>
                    <span class="text-lg font-bold" id="timer">00:00</span></div>
            </div>
        </div>

        <div
            class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 py-10 rounded-none relative overflow-hidden css-aoeo82">
            <div class="absolute right-3 top-2">
                <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeSmall mr-[-5px] css-1j7qk7u"
                        tabindex="0" type="button" aria-label="Xem chi tiết" data-toggle="modal"
                        data-target="#explain">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium text-transparent css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M11.9899 15.7961V11.3771" stroke="#1E2843" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path d="M11.9899 8.20432H11.9999" stroke="#1E2843" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M16.3346 2.75021H7.66561C4.64461 2.75021 2.75061 4.88921 2.75061 7.91621V16.0842C2.75061 19.1112 4.63561 21.2502 7.66561 21.2502H16.3336C19.3646 21.2502 21.2506 19.1112 21.2506 16.0842V7.91621C21.2506 4.88921 19.3646 2.75021 16.3346 2.75021Z"
                              stroke="#1E2843" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            </div>
            <div class="MuiGrid-root MuiGrid-container mt-2 px-3 css-1d3bbye">
                <div
                    class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 relative flex justify-end px-0.5 py-[2px] css-1s50f5r">
                    <button
                        class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation right-[0px] bottom-[0px] p-0 z-10 cursor-pointer hover:brightness-110 bg-transparent css-1n02ex7"
                        tabindex="0" type="button" data-toggle="modal"
                        data-target="#exampleModal" data-type="like"><img
                            src="{{ asset('/minigame/img/Square.Red.db623f6ff5c842986208.png') }}"><span
                            class="MuiTouchRipple-root css-w0pj6f"></span></button>
                </div>
                <div
                    class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 relative flex justify-start px-0.5 py-[2px] css-1s50f5r">
                    <button
                        class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation left-[0px] bottom-[0px] p-0 z-10 cursor-pointer hover:brightness-110 bg-transparent css-1n02ex7"
                        tabindex="0" type="button" data-toggle="modal"
                        data-target="#exampleModal" data-type="vote"><img
                            src="{{ asset('/minigame/img/Square.Green.4fb895cd423137759a2d.png') }}"><span
                            class="MuiTouchRipple-root css-w0pj6f"></span></button>
                </div>
                <div
                    class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 relative flex justify-end px-0.5 py-[2px] css-1s50f5r">
                    <button
                        class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation right-[0px] top-[0px] p-0 z-10 cursor-pointer hover:brightness-110 bg-transparent css-1n02ex7"
                        tabindex="0" type="button" data-toggle="modal"
                        data-target="#exampleModal" data-type="5sao"><img
                            src="{{ asset('/minigame/img/Square.Blue.2a704b07d5d229ec430a.png') }}"><span
                            class="MuiTouchRipple-root css-w0pj6f"></span></button>
                </div>
                <div
                    class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-6 relative flex justify-start px-0.5 py-[2px] css-1s50f5r">
                    <button
                        class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textInherit MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-colorInherit MuiButton-disableElevation left-[0px] top-[0px] p-0 z-10 cursor-pointer hover:brightness-110 bg-transparent css-1n02ex7"
                        tabindex="0" type="button" data-toggle="modal"
                        data-target="#exampleModal" data-type="3sao"><img
                            src="{{ asset('/minigame/img/Square.Purple.873252a3cd71c85f6584.png') }}"><span
                            class="MuiTouchRipple-root css-w0pj6f"></span></button>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>

    <div
        class="MuiContainer-root MuiContainer-maxWidthXs fixed inset-0 top-[unset] bottom-[68px] px-3 z-20 rounded-lg css-hltdia">
        <div
            class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 flex items-center justify-between bg-secondary-main border text-white border-none p-2 css-aoeo82">
            <span>ID: <span class="text-lg">{{ Auth::user()->id }}</span></span>
            <div class="flex items-center"><span class="font-bold max-line-1"><span
                        id="balanceSpan">{{ Auth::user()->balanceFormated() }}</span></span>
                <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium text-white css-1yxmbwk"
                        tabindex="0" type="button">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" viewBox="0 0 24 24" data-testid="VisibilityOffOutlinedIcon">
                        <path
                            d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5 2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4 1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center">
            <div class="modal fade" id="explain" tabindex="1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content css-mbdu2s">
                        <div class="modal-body p-0">
                            <button data-dismiss="modal"
                                    class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeSmall css-o1bub9"
                                    tabindex="0" type="button" style="top: 10px;
    right: 13px;">
                                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                     style="fill: white !important;"
                                     aria-hidden="true" viewBox="0 0 24 24" data-testid="CloseIcon">
                                    <path
                                        d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                                </svg>
                                <span class="MuiTouchRipple-root css-w0pj6f"></span>
                            </button>
                            <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a" id=":rf:">
                                Điều khoản và quy định
                            </h2>
                            <div
                                class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation24 MuiDialog-paper MuiDialog-paperScrollPaper MuiDialog-paperWidthSm MuiDialog-paperFullScreen css-1hyl1h2">
                                <div class="absolute inset-0"><img
                                        src="{{ asset('minigame/img/Frame.Tax.5918f4394b94358de880.png') }}"
                                        class="h-full"></div>
                                <div class="fixed top-[30%] left-[50%] translate-x-[-50%] opacity-30"><img
                                        src="{{ asset('minigame/img/Frame.Star.51850350651321e35085.png') }}"
                                        class="rounded-full w-[180px]"></div>
                                <div class="MutiDialogContent-root px-12 mb-16 mt-20 z-10 css-1ty026z">
                                    @php($pageTitle = \App\Http\Controllers\ApiController::getSetting('page_title'))
                                    <p class="mb-3">
                                        <b>Điều khoản và Quy định:</b> Like hoặc Vote theo thứ tự từ trái qua phải bắt
                                        đầu từ:</p>
                                    <p class="text-justify mb-3"><b>Nhấp chọn LIKE - VOTE:</b> Căn cứ theo đơn đặt vào
                                        các vị trí, ví dụ: Ô số đầu tiên lớn hơn số 5 là LIKE, Ô số đầu tiên nhỏ hơn
                                        hoặc bằng 4 là VOTE.</p>
                                    <p class="text-justify mb-3"><b>Chọn hạng mục 5 Sao - 3 Sao:</b> Căn cứ theo đơn đặt
                                        vào các vị trí, ví dụ: Ô số cuối cùng hiển thị số 0-2-4-6-8 là 5 Sao, Ô số cuối
                                        cùng hiển thị số 1-3-5-7-9 là 3 Sao.</p>
                                    <p class="text-justify mb-3">{{ $pageTitle }} nghiêm cấm các hành vi gian lận có hành vi
                                        đặt số điểm cùng một lúc 2 ô sẽ được tính là vi phạm, và phải hoàn thành x5 tổng
                                        số điểm được tính trên mỗi lượt đặt điểm sẽ hoàn thành vòng cược. {{ $pageTitle }} có
                                        quyền thu hồi tất cả số điểm và tiền thưởng từ mã số ID của Quý khách khi có
                                        hành vi gian dối đặt điểm và sử dụng phần mềm hỗ trợ.</p>
                                    <p class="text-justify mb-3">Nếu Quý khách có bất kì kiến nghị nào vui lòng chọn mục
                                        CSKH để được nhân viên kịp thời hỗ trợ tư vấn.</p>
                                    <p class="font-bold mb-3">Thuế:</p>
                                    <p class="text-justify mb-3">Để đảm bảo được {{ $pageTitle }} hoạt động lâu dài, gắn bó
                                        cùng Quý khách hàng cũng như đóng thuế cho Bộ Công Thương, đồng hành cùng các
                                        đơn vị tài trợ, khi Quý khách được nhận hộp quà huyền bí từ hệ thống vui lòng
                                        thực hiện nghĩa vụ đóng thuế như sau:</p>
                                    <p class="text-justify mb-3">- Đối với Quý khách hàng rút hạn mức từ <span
                                            class="text-navbar">199.000 điểm tương ứng 199.000.000 VNĐ</span> vui lòng
                                        đóng mức thuế 15% / tổng số điểm Quý khách rút ra.</p>
                                    <p class="text-justify mb-3">- Đối với Quý khách hàng rút hạn mức từ <span
                                            class="text-navbar">200.000 điểm - 399.000 điểm</span> vui lòng đóng mức
                                        thuế 20% / tổng số điểm Quý khách rút ra.</p>
                                    <p class="text-justify mb-3">- Đối với Quý khách hàng rút hạn mức trên <span
                                            class="text-navbar">400.000 điểm tương ứng 400.000.000 VNĐ</span> vui lòng
                                        đóng mức thuế 30% / tổng số điểm Quý khách rút ra.</p>
                                    <p class="text-justify mb-3">- Đối với Quý khách hàng rút hạn mức trên <span
                                            class="text-navbar">1.199.000 điểm tương ứng 1.199.000.000 VNĐ</span> cần
                                        đóng thuế TNCN 7 - 10% / tổng số điểm Quý khách rút ra.</p>
                                    <p class="text-justify mb-3">Sau khi Quý khách hoàn thành nghĩa vụ đóng thuế cho
                                        Doanh nghiệp tài khoản của Quý khách sẽ đủ điều kiện xuất khoản.</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

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
                    <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a" id="modaltitle"></h2>

                    <div class="MuiDialogContent-root css-1ty026z">
                        <div class="flex justify-center items-center space-x-2">
                            <button
                                class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation hover:bg-black/5 css-4lk0i2"
                                tabindex="0" type="button" data-type="minus"><img
                                    src="{{ asset('/minigame/img/Icon.Minus.58bcf4aafc66e99fd86700eab74c4eb0.svg') }}"
                                    class="scale-125"><span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                            <div class="MuiFormControl-root MuiTextField-root css-16zb4wv">
                                <div
                                    class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorPrimary MuiInputBase-formControl css-vb3fd7">
                                    <input aria-invalid="false" name="amount"
                                           class="MuiInputBase-input MuiOutlinedInput-input text-base py-3 css-1x5jdmq"
                                           type="text" value="100" inputmode="numeric" id="amountRate">
                                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span>
                                        </legend>
                                    </fieldset>
                                </div>
                            </div>
                            <button
                                class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation hover:bg-black/5 css-4lk0i2"
                                tabindex="0" type="button" data-type="plus"><img
                                    src="{{ asset('/minigame/img/Icon.Add.9549a677521310efc807ccf43e191ac2.svg') }}"
                                    class="scale-125"><span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                        </div>
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1.2 mt-2 css-1ohpmkg">
                            @foreach(json_decode(\App\Http\Controllers\ApiController::getSetting('bet_limit'), true) as $step)
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513">
                                    <button
                                        class="MuiButtonBase-root MuiButton-root MuiButton-outlined MuiButton-outlinedInfo MuiButton-sizeMedium MuiButton-outlinedSizeMedium MuiButton-disableElevation MuiButton-fullWidth MuiButton-root MuiButton-outlined MuiButton-outlinedInfo MuiButton-sizeMedium MuiButton-outlinedSizeMedium MuiButton-disableElevation MuiButton-fullWidth h-[40px] rounded-[8px] text-[20px] css-bonpy3"
                                        tabindex="0" type="button" data-amount="{{ $step }}">{{ $step }}<span
                                            class="MuiTouchRipple-root css-w0pj6f"></span></button>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="MuiDialogActions-root MuiDialogActions-spacing justify-center css-14b29qc ">
                    <button
                        class="MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation w-[80%] css-1n8uu98"
                        tabindex="0" type="button" id=":rg:">Chốt<span
                            class="MuiTouchRipple-root css-w0pj6f"></span></button>
                </div>

            </div>
        </div>
    </div>
    </div>

    <input id="side" value="" hidden>
    <input id="amount" value="" hidden>
    <input type="hidden" id="auth_token" value="{{App\Services\Game::getTokenUserKey()}}">
    <style>
        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100vw;
            height: 100vh;
            background-image: url('{{ asset('minigame/img/chucmung.png') }}'); /* Replace 'path/to/your/image.jpg' with your image file path */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
    <div class="modal fade" id="thongbaokhuyenmai" tabindex="-1" aria-labelledby="thongbaokhuyenmai" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-background"></div>

            <div class="modal-content css-mbdu2s">
                <div class="modal-body">
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

                    <div class="MuiDialogContent-root css-1ty026z">
                        <div class="MuiCardMedia-root h-[160px] bg-contain my-6 css-pqdqbj" role="img"
                             style="background-image: url('{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}');">
                            <div></div>
                        </div>
                        <div class="text-center" id="thongbaokhuyenmai_content"></div>
                    </div>

                    <div class="MuiDialogActions-root MuiDialogActions-spacing flex-col justify-center css-14b29qc">
                        <button id="open_gift"
                                class="MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation w-[80%] css-1n8uu97"
                                data-dismiss="modal">Đồng ý<span
                                class="MuiTouchRipple-root css-w0pj6f"></span></button>
                    </div>


                </div>
            </div>
        </div>
    </div>

    {{--    <div role="tooltip" id=":r4:"--}}
    {{--         class="MuiTooltip-popper MuiTooltip-popperInteractive MuiTooltip-popperArrow css-1woa8fr MuiPopper-root"--}}
    {{--         style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(396px, -591px);"--}}
    {{--         data-popper-placement="top">--}}
    {{--        <div class="MuiTooltip-tooltip MuiTooltip-tooltipArrow MuiTooltip-tooltipPlacementTop css-x8cpb2"--}}
    {{--             style="opacity: 1; transform: none; transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, transform 133ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;">--}}
    {{--            H<span class="MuiTooltip-arrow css-1urvb1y"--}}
    {{--                   style="position: absolute; left: 0px; transform: translate(6px, 0px);"></span></div>--}}
    {{--    </div>--}}

    {{--    <div role="tooltip" id=":r5:"--}}
    {{--         class="MuiTooltip-popper MuiTooltip-popperInteractive MuiTooltip-popperArrow css-1woa8fr MuiPopper-root"--}}
    {{--         style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(598px, -591px);"--}}
    {{--         data-popper-placement="top">--}}
    {{--        <div class="MuiTooltip-tooltip MuiTooltip-tooltipArrow MuiTooltip-tooltipPlacementTop css-x8cpb2"--}}
    {{--             style="opacity: 1; transform: none; transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, transform 133ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;">--}}
    {{--            L<span class="MuiTooltip-arrow css-1urvb1y"--}}
    {{--                   style="position: absolute; left: 0px; transform: translate(5px, 0px);"></span></div>--}}
    {{--    </div>--}}
    <audio id="audioElement" src="{{ asset('minigame/img/chucmung.mp3') }}"></audio>
    @section('js')
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';

            let wsReady = false;
            let thongbao;
            let connectTion;
            window.addEventListener('DOMContentLoaded', function () {
                connectTion = new WebSocket('{{ env('APP_DEBUG') ? 'ws' : 'wss' }}://' + window.location.hostname + '{{ env('APP_DEBUG') ? ':' . env('GAME_PORT') : ''}}/wsstrade/?auth_token=' + $('#auth_token').val());
                connectTion.onopen = function (e) {
                    wsReady = true;
                    setInterval(function () {
                        connectTion.send(JSON.stringify({action: 'game_information', message: ''}));
                        connectTion.send(JSON.stringify({action: 'balance', message: ''}));
                        connectTion.send(JSON.stringify({action: 'promote', message: ''}));
                    }, 1000);
                };
                connectTion.onmessage = function (e) {
                    var info = JSON.parse(e.data);
                    switch (info.type) {
                        case 'game_information':
                            handleGame(info.data)
                            break;
                        case 'thong_bao':
                            handlethongbao(info.data)
                            break;
                        case 'user_info':
                            $('#balanceSpan').html(info.data)
                            break;
                    }
                };
                connectTion.onclose = function (e) {
                    wsReady = false;
                    toast.error('Kết nối đến server không thành công, bạn vui lòng thử lại sau..')
                };
                connectTion.onerror = function (e) {
                    wsReady = false;
                }
            });

            let _next_id = 0;
            let time_hold_s = 0;

            function canAutoplay(audioElement) {
                return new Promise((resolve, reject) => {
                    // Attempt to play the audio
                    const playPromise = audioElement.play();

                    if (playPromise !== undefined) {
                        playPromise
                            .then(() => {
                                // Audio can be autoplayed
                                resolve(true);
                            })
                            .catch((error) => {
                                // Autoplay is not allowed
                                reject(error);
                            });
                    } else {
                        // Autoplay is not allowed
                        reject(new Error('Autoplay not allowed.'));
                    }
                });
            }

            function handlethongbao(data) {
                if (thongbao == data.id) return false
                if (data.user_id != {{ Auth::user()->id }}) return false;
                thongbao = data.id
                $('#thongbaokhuyenmai_content').html(data.note)
                $('#open_gift').attr('data-id', data.id)
                $('#thongbaokhuyenmai').modal('show')
                const audioElement = document.getElementById('audioElement');

                canAutoplay(audioElement)
                    .then(() => {
                        console.log('Sound autoplayed successfully.');
                    })
                    .catch((error) => {
                        console.error('Autoplay not allowed:', error.message);
                    });
            }

            $('#open_gift').click(function (e) {
                e.preventDefault()
                const ann_id = $(this).data('id')
                connectTion.send(JSON.stringify({action: 'mark_seen', rid: ann_id}));
            })

            function handleGame(data) {

                time_hold_s = data.time_hold_s;


                if (_next_id != data.next_id) {

                    _next_id = data.next_id;
                    $('#nextId').html(data.next_id)
                    $('#game_id').val(data.next_game_id)
                    const numbersArr = (data.old_value).split('-')
                    $('#firstDigit').html(numbersArr[0])
                    $('#secondDigit').html(numbersArr[1])
                    $('#thirdDigit').html(numbersArr[2])
                }
            }


            let t = 0;
            // To call defined fuction every second
            setInterval(function () {

                if (t < 0) {
                    t = time_hold_s;
                }
                let minutes = (t - (t % 60)) / 60;
                let seconds = t % 60;
                const formattedDuration = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
                $('#timer').html(formattedDuration)
                t--;

            }, 1000);

            $('.css-1n02ex7').click(function () {
                const type = $(this).attr('data-type')
                var title = 'Nhập đánh giá ';
                $('#side').val(type)
                switch (type) {
                    case 'like':
                        title += 'Like'
                        break;
                    case 'vote':
                        title += 'Vote'
                        break;
                    case '5sao':
                        title += '5 sao'
                        break;
                    case '3sao':
                        title += '3 sao'
                        break;
                }
                $('#modaltitle').html(title)
            })

            $('.css-4lk0i2').click(function () {
                var amount;
                if ($(this).attr('data-type') == 'plus') {
                    amount = parseInt($('#amountRate').val()) + 100;
                } else {
                    amount = parseInt($('#amountRate').val()) - 100;
                }
                $('#amountRate').val((amount < 0) ? 0 : amount)
            })

            $(".css-bonpy3").on("click", function () {
                $(".css-bonpy3").removeClass("selected");
                $(this).addClass("selected");
                $("#amountRate").val($(this).attr("data-amount"));
            });

            $("#exampleModal").on("hidden.bs.modal", function () {
                $("#amountRate").val(100);
                $(".css-bonpy3").removeClass("selected");
            });

            $('.css-1n8uu98').click(function () {
                const sideChoosed = $('#side').val();
                const amount = $('#amountRate').val();
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', false);
                }, 300);
                $.ajax({
                    url: "{{route('lucky.bet')}}",
                    type: 'POST',
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        sideChoosed: sideChoosed,
                        amount: amount,
                    }),
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            toast.success(data.message)
                            connectTion.send('balance');
                        } else {
                            toast.error(data.message)
                        }
                    },
                    error: function (data) {
                        toast.error('Đã có lỗi xảy ra trong lúc xử lí.')
                    }
                });
                $('#exampleModal').modal('toggle');
            })
        </script>
    @endsection
</x-app-layout>
