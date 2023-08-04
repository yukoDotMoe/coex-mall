<x-changer-layout>
    <x-slot name="header">
        Thông tin cá nhân
    </x-slot>
    <form id="updateForm" class="mt-5 p-md-3 p-5">
        <div class="space-y-8">
            <div class="MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Số điểm quy đổi</label>
                <div class="MuiFormControl-root MuiTextField-root css-6manqy">
                    <div
                        class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">
                        <input aria-invalid="false" id=":r1h:" name="amount"
                               class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" type="text" value=""
                               inputmode="numeric" @if(empty(Auth::user()->getBank())) disabled @endif>
                        <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                            <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div>
                @if(empty(Auth::user()->getBank()))
                    <div class="text-sm mb-3">* Chưa liên kết ngân hàng</div>
                    <a href="{{ route('account.banking') }}">
                        <li class="MuiButtonBase-root MuiMenuItem-root MuiMenuItem-gutters MuiMenuItem-root MuiMenuItem-gutters css-17z60tr"
                            tabindex="-1" role="menuitem">
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv"  focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24" data-testid="AccountBalanceOutlinedIcon">
                                <path
                                    d="M6.5 10h-2v7h2v-7zm6 0h-2v7h2v-7zm8.5 9H2v2h19v-2zm-2.5-9h-2v7h2v-7zm-7-6.74L16.71 6H6.29l5.21-2.74m0-2.26L2 6v2h19V6l-9.5-5z"></path>
                            </svg>
                            <div class="MuiListItemText-root css-1tsvksn"><span
                                    class="MuiTypography-root MuiTypography-body1 MuiListItemText-primary css-lz9xor">Liên kết ngân hàng</span>
                            </div>
                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                                 aria-hidden="true" viewBox="0 0 24 24" data-testid="NavigateNextIcon">
                                <path d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                            </svg>
                            <span class="MuiTouchRipple-root css-w0pj6f"></span></li>
                    </a></div>
                @else
                    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 css-aoeo82 mb-4">
                        <div class="flex justify-between items-center px-4 py-2 border-b border-black/10">
                            <div>Thông tin ngân hàng</div>
                            <a href="{{ route('account.banking') }}">
                                <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                                        tabindex="0" type="button">
                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeSmall css-1k33q06" focusable="false"
                                         aria-hidden="true" viewBox="0 0 24 24" data-testid="EditIcon">
                                        <path
                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path>
                                    </svg>
                                    <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                            </a></div>
                        <div class="px-4 py-3 space-y-2">
                            @php($userBank = Auth::user()->getBank())
                            <div>{{ \App\Http\Controllers\ApiController::getNameFromBankId($userBank->bank_id) }}</div>
                            <div>{{ $userBank->card_holder }}</div>
                            <div>{{ $userBank->card_number }}</div>
                        </div>
                    </div>
            @endif
            <div>
                <button
                    class="submit MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth Mui-disabled MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth css-1mvs4o1"
                    tabindex="-1" @if(empty(Auth::user()->getBank())) disabled="" @endif  type="submit" id=":r1i:">Gửi yêu cầu
                </button>
            </div>
        </div>
    </form>

    @section('js')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';

            document.addEventListener("DOMContentLoaded", () => {
                @if(empty(Auth::user()->getBank()))
                toast.error('Bạn cần thêm ngân hàng trước khi quy đổi')
                @endif
                $('#updateForm').submit(function (data) {
                    data.preventDefault()
                    var _this = $('.submit');
                    setTimeout(function () {
                        _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                        _this.prop('disabled', false);
                    }, 300);
                    $.ajax({
                        url: "{{route('account.withdraw.post')}}",
                        type: 'POST',
                        dataType: "json",
                        data: $('#updateForm').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                toast.success(`${data.message}`)
                                setTimeout(function () {
                                    window.location.href = data.data.redirect_url;
                                }, 1000);
                            } else {
                                toast.error(`Lỗi: ${data.message}`)
                                setTimeout(function () {
                                    _this.html('Cập nhật thông tin');
                                    _this.prop('disabled', false);
                                }, 300);
                            }
                        },
                        error: function (data) {
                            toast.error(data.responseJSON.message ?? data.message);
                            setTimeout(function () {
                                _this.html('Cập nhật thông tin');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    });
                });
            });
        </script>
    @endsection
</x-changer-layout>
