<x-guest-layout>
    <form id="login_form" accept-charset="utf8">
        @csrf
        <div class="flex flex-col items-center justify-center bg-white rounded-2xl py-10 px-8 gap-y-12">
            <h5 class="MuiTypography-root MuiTypography-h5 MuiTypography-alignCenter css-1n8l99l">TẠO TÀI KHOẢN MỚI
            </h5>
            <div class="flex flex-col items-stretch gap-8 relative w-full">
                <div class="MuiFormControl-root MuiFormControl-fullWidth MuiTextField-root css-feqhe6">
                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-fullWidth MuiInputBase-formControl MuiInputBase-adornedStart css-vjls2h">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionStart MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1a6giau">
                            <span class="notranslate">&ZeroWidthSpace;</span>
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2C14.9391 2 17.294 4.35402 17.294 7.29105ZM12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22Z"
                                      fill="#9E9E9E"></path>
                            </svg>
                        </div>
                        <input aria-invalid="false" id=":r0:" name="username" placeholder="Tài khoản" type="text"
                               class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedStart css-1ixds2g"
                               value="">
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                            <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                        </fieldset>
                    </div>
                </div>
                <div class="MuiFormControl-root MuiFormControl-fullWidth MuiTextField-root css-feqhe6">
                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-fullWidth MuiInputBase-formControl MuiInputBase-adornedStart MuiInputBase-adornedEnd css-1x41kx5">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionStart MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1a6giau">
                            <span class="notranslate">&ZeroWidthSpace;</span>
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17.5227 7.39601V8.92935C19.2451 9.46696 20.5 11.0261 20.5 12.8884V17.8253C20.5 20.1308 18.5886 22 16.2322 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8253V12.8884C3.5 11.0261 4.75595 9.46696 6.47729 8.92935V7.39601C6.48745 4.41479 8.95667 2 11.9848 2C15.0535 2 17.5227 4.41479 17.5227 7.39601ZM12.0051 3.73904C14.0678 3.73904 15.7445 5.37871 15.7445 7.39601V8.7137H8.25553V7.37613C8.26569 5.36878 9.94232 3.73904 12.0051 3.73904ZM12.8891 16.4549C12.8891 16.9419 12.4928 17.3294 11.9949 17.3294C11.5072 17.3294 11.1109 16.9419 11.1109 16.4549V14.2488C11.1109 13.7718 11.5072 13.3843 11.9949 13.3843C12.4928 13.3843 12.8891 13.7718 12.8891 14.2488V16.4549Z"
                                      fill="#9E9E9E"></path>
                            </svg>
                        </div>
                        <input aria-invalid="false" id=":r1:" name="password" placeholder="Mật khẩu" type="password"
                               class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedStart MuiInputBase-inputAdornedEnd css-1gnht4k"
                               value="">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1nvf7g0">
                            <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                                    tabindex="0" type="button">
                                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                     aria-hidden="true" viewBox="0 0 24 24" data-testid="VisibilityOutlinedIcon">
                                    <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"></path>
                                </svg>
                                <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                        </div>
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                            <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                        </fieldset>
                    </div>
                </div>
                <div class="MuiFormControl-root MuiFormControl-fullWidth MuiTextField-root css-feqhe6">
                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-fullWidth MuiInputBase-formControl MuiInputBase-adornedStart MuiInputBase-adornedEnd css-1x41kx5">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionStart MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1a6giau">
                            <span class="notranslate">&ZeroWidthSpace;</span>
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17.5227 7.39601V8.92935C19.2451 9.46696 20.5 11.0261 20.5 12.8884V17.8253C20.5 20.1308 18.5886 22 16.2322 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8253V12.8884C3.5 11.0261 4.75595 9.46696 6.47729 8.92935V7.39601C6.48745 4.41479 8.95667 2 11.9848 2C15.0535 2 17.5227 4.41479 17.5227 7.39601ZM12.0051 3.73904C14.0678 3.73904 15.7445 5.37871 15.7445 7.39601V8.7137H8.25553V7.37613C8.26569 5.36878 9.94232 3.73904 12.0051 3.73904ZM12.8891 16.4549C12.8891 16.9419 12.4928 17.3294 11.9949 17.3294C11.5072 17.3294 11.1109 16.9419 11.1109 16.4549V14.2488C11.1109 13.7718 11.5072 13.3843 11.9949 13.3843C12.4928 13.3843 12.8891 13.7718 12.8891 14.2488V16.4549Z"
                                      fill="#9E9E9E"></path>
                            </svg>
                        </div>
                        <input aria-invalid="false" id=":r5:" name="password_confirmation"
                               placeholder="Xác nhận mật khẩu"
                               type="password"
                               class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedStart MuiInputBase-inputAdornedEnd css-1gnht4k"
                               value="">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1nvf7g0">
                            <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                                    tabindex="0" type="button">
                                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                     aria-hidden="true" viewBox="0 0 24 24" data-testid="VisibilityOutlinedIcon">
                                    <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"></path>
                                </svg>
                                <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                        </div>
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                            <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                        </fieldset>
                    </div>
                </div>
                <div class="MuiFormControl-root MuiFormControl-fullWidth MuiTextField-root css-feqhe6">
                    <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-fullWidth MuiInputBase-formControl MuiInputBase-adornedStart css-vjls2h">
                        <div class="MuiInputAdornment-root MuiInputAdornment-positionStart MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1a6giau">
                            <span class="notranslate">&ZeroWidthSpace;</span>
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24">
                                <path d="M17.9185 14.3201C17.6595 14.5711 17.5405 14.9341 17.5995 15.2901L18.4885 20.2101C18.5635 20.6271 18.3875 21.0491 18.0385 21.2901C17.6965 21.5401 17.2415 21.5701 16.8685 21.3701L12.4395 19.0601C12.2855 18.9781 12.1145 18.9341 11.9395 18.9291H11.6685C11.5745 18.9431 11.4825 18.9731 11.3985 19.0191L6.96851 21.3401C6.74951 21.4501 6.50151 21.4891 6.25851 21.4501C5.66651 21.3381 5.27151 20.7741 5.36851 20.1791L6.25851 15.2591C6.31751 14.9001 6.19851 14.5351 5.93951 14.2801L2.32851 10.7801C2.02651 10.4871 1.92151 10.0471 2.05951 9.65011C2.19351 9.25411 2.53551 8.96511 2.94851 8.90011L7.91851 8.17911C8.29651 8.14011 8.62851 7.91011 8.79851 7.57011L10.9885 3.08011C11.0405 2.98011 11.1075 2.88811 11.1885 2.81011L11.2785 2.74011C11.3255 2.68811 11.3795 2.64511 11.4395 2.61011L11.5485 2.57011L11.7185 2.50011H12.1395C12.5155 2.53911 12.8465 2.76411 13.0195 3.10011L15.2385 7.57011C15.3985 7.89711 15.7095 8.12411 16.0685 8.17911L21.0385 8.90011C21.4585 8.96011 21.8095 9.25011 21.9485 9.65011C22.0795 10.0511 21.9665 10.4911 21.6585 10.7801L17.9185 14.3201Z"
                                      fill="#200E32"></path>
                            </svg>
                        </div>
                        <?php $ref = request()->input('ref', ''); ?>
                        <input aria-invalid="false" id=":r6:" name="promo_code" placeholder="Mã giới thiệu"
                               type="text"
                               class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedStart css-1ixds2g"
                               value="{{$ref}}">
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                            <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                        </fieldset>
                    </div>
                </div>
                <button type="submit"
                        class="submit MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge mx-auto shadow-none rounded-full bg-[#fa6253] css-avm12u"
                        tabindex="0" type="button" id=":r2:">Đăng Ký<span
                        class="MuiTouchRipple-root css-w0pj6f"></span></button>
                <div class="flex justify-center gap-2 text-sm z-20"><span>Bạn đã có tài khoản?</span><a
                        class="font-medium text-[#453D83] hover:text-primary-dark" href="{{route('login')}}">Đăng
                        nhập</a>
                </div>
            </div>
        </div>
    </form>

    <script type="module">
        import {toast} from 'https://cdn.skypack.dev/wc-toast';

        $(document).ready(function () {
            $('#login_form').submit(function (data) {
                data.preventDefault()
                var _this = $('.submit');
                setTimeout(function () {
                    _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                    _this.prop('disabled', false);
                }, 300);
                $.ajax({
                    url: "{{route('register')}}",
                    type: 'POST',
                    dataType: "json",
                    data: $('#login_form').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function (data) {
                        toast.success("Đăng kí tài khoản thành công.");
                        setTimeout(function () {
                            location.reload()
                        }, 1000)
                    },
                    error: function (data) {
                        if (data.responseJSON === undefined || data.responseJSON === null) {
                            toast.success("Đăng kí tài khoản thành công.");
                            setTimeout(function () {
                                location.reload()
                            }, 1000)
                        }else{
                            toast.error(data.responseJSON.message);
                            setTimeout(function () {
                                _this.html('Đăng kí');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    }
                });
            });
        })
    </script>
</x-guest-layout>
