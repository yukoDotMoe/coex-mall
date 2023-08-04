<x-changer-layout>
    <x-slot name="header">
        Thông tin cá nhân
    </x-slot>
    <form id="updateForm"  class="mt-5 p-md-3 p-5">
{{--        <div class="MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Nickname</label>--}}
{{--            <div class="MuiFormControl-root MuiTextField-root css-6manqy">--}}
{{--                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">--}}
{{--                    <input aria-invalid="false" id=":r8:" name="nickname" type="text"--}}
{{--                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" value="">--}}
{{--                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">--}}
{{--                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Số điện thoại</label>--}}
{{--            <div class="MuiFormControl-root MuiTextField-root css-6manqy">--}}
{{--                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">--}}
{{--                    <input aria-invalid="false" id=":r9:" name="phoneNumber" type="text"--}}
{{--                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" value="">--}}
{{--                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">--}}
{{--                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="MuiFormControl-root MuiFormControl-fullWidth css-tzsjye mb-4"><label>Số điện thoại</label>
            <div class="MuiFormControl-root MuiTextField-root css-6manqy">
                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">
                    <input aria-invalid="false" id=":ra:" name="phone" type="number"
                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" value="{{ Auth::user()->phone ?? '' }}">
                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="MuiFormControl-root MuiFormControl-fullWidth css-tzsjye"><label>Địa chỉ</label>
            <div class="MuiFormControl-root MuiTextField-root css-6manqy">
                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorWarning MuiInputBase-formControl css-ntyc4g">
                    <input aria-invalid="false" id=":ra:" name="addr" type="text"
                           class="MuiInputBase-input MuiOutlinedInput-input css-1x5jdmq" value="{{ Auth::user()->address ?? '' }}">
                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span></legend>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="pt-4">
            <button class="MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeLarge MuiButton-containedSizeLarge MuiButton-disableElevation MuiButton-fullWidth css-1mvs4o1"
                    tabindex="0" type="submit" id=":rb:">Cập nhật thông tin<span
                        class="MuiTouchRipple-root css-w0pj6f"></span></button>
        </div>
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
                        url: "{{route('account.profile.post')}}",
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
