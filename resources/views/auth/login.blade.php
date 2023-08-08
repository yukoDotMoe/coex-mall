<x-guest-layout>
    <form id="login_form" accept-charset="utf8" class="p-3">
        @csrf
        <div class="flex flex-col items-center justify-center bg-white rounded-2xl py-10 px-8 gap-y-12">
            <h5 class="MuiTypography-root MuiTypography-h5 MuiTypography-alignCenter css-1n8l99l">ĐĂNG NHẬP TÀI
                KHOẢN</h5>
            <div class="flex flex-col items-stretch gap-8 relative w-full">
                <div
                    class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-fullWidth MuiInputBase-formControl MuiInputBase-adornedStart css-vjls2h">
                    <div
                        class="MuiInputAdornment-root MuiInputAdornment-positionStart MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1a6giau">
                        <span class="notranslate">&ZeroWidthSpace;</span>
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                             aria-hidden="true" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2C14.9391 2 17.294 4.35402 17.294 7.29105ZM12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22Z"
                                  fill="#9E9E9E"></path>
                        </svg>
                    </div>
                    <input aria-invalid="false" id=":r5:" name="input_type" placeholder="Tài khoản" type="text"
                           class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedStart css-1ixds2g">
                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                    </fieldset>
                </div>

                <div class="MuiFormControl-root MuiFormControl-fullWidth MuiTextField-root css-feqhe6">
                    <div
                        class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-fullWidth MuiInputBase-formControl MuiInputBase-adornedStart MuiInputBase-adornedEnd css-1x41kx5">
                        <div
                            class="MuiInputAdornment-root MuiInputAdornment-positionStart MuiInputAdornment-outlined MuiInputAdornment-sizeMedium css-1a6giau">
                            <span class="notranslate">&ZeroWidthSpace;</span>
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M17.5227 7.39601V8.92935C19.2451 9.46696 20.5 11.0261 20.5 12.8884V17.8253C20.5 20.1308 18.5886 22 16.2322 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8253V12.8884C3.5 11.0261 4.75595 9.46696 6.47729 8.92935V7.39601C6.48745 4.41479 8.95667 2 11.9848 2C15.0535 2 17.5227 4.41479 17.5227 7.39601ZM12.0051 3.73904C14.0678 3.73904 15.7445 5.37871 15.7445 7.39601V8.7137H8.25553V7.37613C8.26569 5.36878 9.94232 3.73904 12.0051 3.73904ZM12.8891 16.4549C12.8891 16.9419 12.4928 17.3294 11.9949 17.3294C11.5072 17.3294 11.1109 16.9419 11.1109 16.4549V14.2488C11.1109 13.7718 11.5072 13.3843 11.9949 13.3843C12.4928 13.3843 12.8891 13.7718 12.8891 14.2488V16.4549Z"
                                      fill="#9E9E9E"></path>
                            </svg>
                        </div>
                        <input aria-invalid="false" id=":r6:" name="password" placeholder="Mật khẩu" type="password"
                               class="MuiInputBase-input MuiOutlinedInput-input MuiInputBase-inputAdornedStart MuiInputBase-inputAdornedEnd css-1gnht4k">
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                            <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                        </fieldset>
                    </div>
                </div>


                <button type="submit" id="submitBtn"
                        class="submit MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge mx-auto shadow-none rounded-full bg-[#fa6253] css-avm12u"
                        tabindex="0" type="button" id=":r2:">Đăng Nhập<span
                        class="MuiTouchRipple-root css-w0pj6f"></span></button>
                <div id="recaptcha-container" class="mx-auto"></div>
                <div class="flex justify-center gap-2 text-sm z-20"><span>Bạn chưa có tài khoản?</span><a class="font-medium text-[#453D83] hover:text-primary-dark" href="{{ route('register') }}">Đăng ký</a></div>
            </div>
        </div>
        </div>
    </form>

    @section('jsl')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';

            $(document).ready(function () {
                $('#login_form').submit(function (data) {
                    data.preventDefault()
                    var _this = $('.submit');
                    setTimeout(function () {
                        _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                        _this.prop('disabled', true);
                    }, 300);

                    $.ajax({
                        url: "{{route('login')}}",
                        type: 'POST',
                        dataType: "json",
                        data: $('#login_form').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            toast.success("Đăng nhập tài khoản thành công.");
                            setTimeout(function () {
                                location.reload()
                            }, 1000)
                        },
                        error: function (data) {
                            if (data.responseJSON === undefined || data.responseJSON === null) {
                                toast.success("Đăng nhập tài khoản thành công.");
                                setTimeout(function () {
                                    location.reload()
                                }, 1000)
                            } else {
                                toast.error(data.responseJSON.message);
                                setTimeout(function () {
                                    _this.html('Đăng nhập');
                                    _this.prop('disabled', false);
                                }, 300);
                            }
                        }
                    });
                });
            })
        </script>
    @endsection
</x-guest-layout>
