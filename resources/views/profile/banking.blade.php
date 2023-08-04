    <x-changer-layout>
    <x-slot name="header">
        Liên kết ngân hàng
    </x-slot>
    @php($bankUser = \App\Models\UserBank::where('user_id', Auth::user()->id)->first())
    <form id="updateForm" class="mt-5 p-md-3 p-5">
        <div class="MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Ngân hàng</label>
            <div class="MuiFormControl-root MuiTextField-root css-ajinsy">
                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">
                    <select aria-invalid="false" id="bankList" name="bankId" type="text"
                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq">
                        @foreach(\App\Models\Banks::where('status', 1)->get() as $bank)
                            <option @if(isset($bankUser->bank_id) && $bankUser->bank_id == $bank->id) selected @endif value="{{ $bank->id }}">{{ $bank->name }} ({{ $bank->code }})</option>
                        @endforeach
                    </select>
                    <fieldset   aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="mt-4 MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Số tài khoản</label>
            <div class="MuiFormControl-root MuiTextField-root css-ajinsy">
                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">
                    <input aria-invalid="false" id=":r11:" name="bankAccountNumber" type="text"
                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" @if(isset($bankUser->card_number)) value="{{ $bankUser->card_number }}" @endif >
                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="mt-4 MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Chủ tài khoản</label>
            <div class="MuiFormControl-root MuiTextField-root css-ajinsy">
                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">
                    <input aria-invalid="false" id=":r12:" name="bankAccountHolder" type="text"
                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" @if(isset($bankUser->card_holder)) value="{{ strtoupper($bankUser->card_holder) }}" @endif >
                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                    </fieldset>
                </div>
            </div>
        </div>
        <div>
            <div class="text-sm my-4">* Quý khách vui lòng điền đúng thông tin</div>
        </div>
        <div>
            <button type="submit" class="mb-4 MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth css-1mvs4o1"
                    tabindex="0" type="button" id=":r13:">Liên kết ngân hàng<span
                        class="MuiTouchRipple-root css-w0pj6f"></span></button>
        </div>
        <div class="fixImg"><img src="{{ asset('/minigame/img/Group.Banks.B1.37625aaf57ca031228ed.png') }}"></div>
        <div class="fixImg"><img src="{{ asset('/minigame/img/Group.Banks.B2.a39269774753383a360c.png') }}" class="h-[48px] mx-auto"></div>
    </form>

    @section('js')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';

            document.addEventListener("DOMContentLoaded", () => {
                $('#bankList').select2();
                $('#updateForm').submit(function (data) {
                    data.preventDefault()
                    var _this = $('.submit');
                    setTimeout(function () {
                        _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                        _this.prop('disabled', false);
                    }, 300);
                    $.ajax({
                        url: "{{route('account.banking.post')}}",
                        type: 'POST',
                        dataType: "json",
                        data: $('#updateForm').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            if(data.success)
                            {
                                toast.success(`${data.message}`)
                                setTimeout(function(){
                                    window.location.href = data.data.redirect_url;
                                },1000);
                            }else{
                                toast.error(`Lỗi: ${data.message}`)
                                setTimeout(function () {
                                    _this.html('Liên kết ngân hàng');
                                    _this.prop('disabled', false);
                                }, 300);
                            }
                        },
                        error: function (data) {
                            toast.error(data.responseJSON.message ?? data.message);
                            setTimeout(function () {
                                _this.html('Liên kết ngân hàng');
                                _this.prop('disabled', false);
                            }, 300);
                        }
                    });
                });
            });
        </script>
    @endsection
</x-changer-layout>
