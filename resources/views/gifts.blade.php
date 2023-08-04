<x-app-layout>
    <div class="">
        <!-- START CONTENT -->
        <div class="mt-3">
            <div
                    class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
                <div class="font-medium text-color-primary">Giới thiệu</div>
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-1h2no49" focusable="false" aria-hidden="true"
                     viewBox="0 0 24 24">
                    <path
                            d="M20.6501 6.74998H17.3689C17.8413 6.15343 18.0693 5.39966 18.0069 4.64129C17.9444 3.88292 17.5961 3.17663 17.0324 2.66542C16.4688 2.15421 15.732 1.87629 14.9711 1.88792C14.2103 1.89956 13.4823 2.19989 12.9345 2.7281C12.7136 2.95177 12.5328 3.21182 12.4001 3.49685C12.2675 3.21182 12.0867 2.95177 11.8658 2.7281C11.318 2.19989 10.59 1.89956 9.82919 1.88792C9.06834 1.87629 8.3315 2.15421 7.76785 2.66542C7.20421 3.17663 6.85589 3.88292 6.79343 4.64129C6.73096 5.39966 6.95901 6.15343 7.4314 6.74998H4.15015C3.75232 6.74998 3.37079 6.90801 3.08949 7.18932C2.80818 7.47062 2.65015 7.85215 2.65015 8.24998V11.25C2.65015 11.6478 2.80818 12.0293 3.08949 12.3106C3.37079 12.5919 3.75232 12.75 4.15015 12.75V18.75C4.15015 19.1478 4.30818 19.5293 4.58949 19.8106C4.87079 20.0919 5.25232 20.25 5.65015 20.25H19.1501C19.548 20.25 19.9295 20.0919 20.2108 19.8106C20.4921 19.5293 20.6501 19.1478 20.6501 18.75V12.75C21.048 12.75 21.4295 12.5919 21.7108 12.3106C21.9921 12.0293 22.1501 11.6478 22.1501 11.25V8.24998C22.1501 7.85215 21.9921 7.47062 21.7108 7.18932C21.4295 6.90801 21.048 6.74998 20.6501 6.74998ZM13.9939 3.78748C14.1303 3.6369 14.2959 3.51561 14.4807 3.43097C14.6654 3.34633 14.8654 3.30011 15.0685 3.29511C15.2717 3.29011 15.4737 3.32643 15.6624 3.40188C15.8511 3.47732 16.0224 3.59031 16.1661 3.734C16.3098 3.87768 16.4228 4.04906 16.4982 4.23773C16.5737 4.4264 16.61 4.62844 16.605 4.83158C16.6 5.03471 16.5538 5.23472 16.4692 5.41945C16.3845 5.60418 16.2632 5.76979 16.1126 5.90623C15.6533 6.37498 14.3126 6.6281 13.1783 6.72185C13.272 5.58748 13.5251 4.24685 13.9939 3.78748ZM8.68765 3.78748C8.97004 3.50923 9.35057 3.35325 9.74702 3.35325C10.1435 3.35325 10.524 3.50923 10.8064 3.78748C11.2751 4.24685 11.5283 5.58748 11.622 6.72185C10.4876 6.6281 9.14702 6.37498 8.68765 5.90623C8.40939 5.62383 8.25342 5.2433 8.25342 4.84685C8.25342 4.45041 8.40939 4.06987 8.68765 3.78748ZM4.15015 8.24998H11.6501V11.25H4.15015V8.24998ZM5.65015 12.75H11.6501V18.75H5.65015V12.75ZM19.1501 18.75H13.1501V12.75H19.1501V18.75ZM20.6501 11.25H13.1501V8.24998H20.6501V11.25Z"
                            fill="#9E9E9E"></path>
                </svg>
            </div>
            <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 mt-2 px-3 py-2 css-aoeo82">
                {{ \App\Http\Controllers\ApiController::getSetting('gift_intro') }}
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('lucky') }}">
                <div
                        class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark cursor-pointer hover:bg-black/10 css-aoeo82">
                    <div class="font-medium text-color-primary">Hạng mục đánh giá</div>
                    <svg
                            class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-1h2no49" focusable="false"
                            aria-hidden="true"
                            viewBox="0 0 24 24" data-testid="LocalPlayOutlinedIcon">
                        <path
                                d="M22 10V6c0-1.1-.9-2-2-2H4c-1.1 0-1.99.9-1.99 2v4c1.1 0 1.99.9 1.99 2s-.89 2-2 2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-4c-1.1 0-2-.9-2-2s.9-2 2-2zm-2-1.46c-1.19.69-2 1.99-2 3.46s.81 2.77 2 3.46V18H4v-2.54c1.19-.69 2-1.99 2-3.46 0-1.48-.8-2.77-1.99-3.46L4 6h16v2.54zM9.07 16 12 14.12 14.93 16l-.89-3.36 2.69-2.2-3.47-.21L12 7l-1.27 3.22-3.47.21 2.69 2.2z">
                        </path>
                    </svg>
                </div>
            </a>
        </div>

        <div class="mt-3">
            <div
                    class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
                <div class="font-medium text-color-primary">Lucky Box</div>
                <button
                        class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeSmall mr-[-5px] css-1j7qk7u"
                        tabindex="0"
                        type="button" aria-label="Xem chi tiết" data-toggle="modal"
                        data-target="#explain">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-96rm37"
                         focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="InfoOutlinedIcon">
                        <path
                                d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z">
                        </path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span>
                </button>
            </div>
            <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 mt-2 px-3 py-3 css-aoeo82">
                <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-2 css-isbt42">
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                    <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513" data-toggle="modal"
                         data-target="#exampleModal"><img
                                src="{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}"
                                class="cursor-pointer hover:scale-105"></div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>

    <!-- Modal -->
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
                            <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                        </svg>
                        <span class="MuiTouchRipple-root css-w0pj6f"></span>
                    </button>
                    <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a" id=":rf:">Mở hộp quà
                    </h2>
                    <div class="MuiDialogContent-root css-1ty026z">
                    </div>
                </div>
            </div>
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
                            <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                        </svg>
                        <span class="MuiTouchRipple-root css-w0pj6f"></span>
                    </button>
                    <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a" id=":rf:">Mở hộp
                        quà</h2>

                    <div class="MuiDialogContent-root css-1ty026z">
                        <div class="MuiCardMedia-root h-[160px] bg-contain my-6 css-pqdqbj" role="img"
                             style="background-image: url('{{ asset('/minigame/img/Image.Gift.43c8ffee00f9394c61bf.png') }}');">
                            <div></div>
                        </div>
                        <div class="text-center"></div>
                    </div>

                    <div class="MuiDialogActions-root MuiDialogActions-spacing flex-col justify-center css-14b29qc">
                        <button id="open_gift"
                                class="MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation w-[80%] css-1n8uu98"
                                tabindex="0" type="button" id=":r4:">Mở quà<span
                                    class="MuiTouchRipple-root css-w0pj6f"></span></button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';

            window.addEventListener('DOMContentLoaded', function () {
                $("#open_gift").click(function (e) {
                    e.preventDefault()
                    var _this = $('.submit');
                    setTimeout(function () {
                        _this.html('<i class="fa-solid fa-circle-notch fa-spin"></i>');
                        _this.prop('disabled', false);
                    }, 300);
                    $.ajax({
                        url: "{{route('gift.open')}}",
                        type: 'POST',
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                toast.success(`Chúc mừng bạn đã nhận được ${data.data.ten}`)
                            } else {
                                toast.error(`Lỗi: ${data.message}`)
                            }
                        },
                        error: function (data) {
                            // console.log(data)
                        }
                    });
                    $('#exampleModal').modal('toggle');

                })
            });
        </script>
    @endsection
</x-app-layout>