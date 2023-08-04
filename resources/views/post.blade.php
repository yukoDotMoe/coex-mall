<x-news-layout>
    @section('header') {{ mb_strimwidth($post->title, 0, 20, '...') }} @endsection
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 MuiCard-root rounded-none mb-3 bg-transparent css-s18byi mt-5">
        <div class="slick-slider w-full flex justify-center h-[240px] slick-initialized">
            <div class="slick-list">
                <div class="slick-track" style="width: 444px; opacity: 1; transform: translate3d(0px, 0px, 0px);">
                    <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false"
                         style="outline: none; width: 444px;">
                        <div>
                            <div class="MuiCardMedia-root h-[240px] css-pqdqbj" role="img" tabindex="-1"
                                 style="background-image: url(&quot;{{ asset($post->thumbnail) }}&quot;); width: 100%; display: inline-block;">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="MuiCardContent-root p-3 space-y-2 pb-0 css-1qw96cp">
            <div class="flex justify-between">
                <div class="flex items-center gap-1">
                    <span class="MuiRating-root MuiRating-sizeMedium css-1ipqyij">
                        <x-newsRate rating="{{ $post->order ?? 0 }}"/>
                    </span>
                    <strong id="rateCount">{{ $post->vote }}</strong> Đánh giá
                </div>
                <div class="flex items-center gap-1">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium text-[orangered] cursor-pointer css-vubbuv" id="likePost"
                         focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="FavoriteBorderIcon">
                        <path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path>
                    </svg>
                    <div id="likeCoun">{{ $post->like }}</div>
                </div>
            </div>
            <div class="flex items-center gap-1 text-primary-light">
                <span class="h5">{{ number_format($post->price , 0, '.', '.') }} đ</span></div>
            <div>{{ mb_strimwidth($post->content, 0, 200, '...') }}
            </div>
        </div>
    </div>

    <div class="px-3 flex justify-between mb-3">
        <div class="MuiChip-root MuiChip-filled MuiChip-sizeMedium MuiChip-colorDefault MuiChip-filledDefault bg-color-secondary text-white css-1l3bzoq">
            <span class="MuiChip-label MuiChip-labelMedium css-9iedg7">Earn Like: 14</span></div>
        <div class="MuiChip-root MuiChip-filled MuiChip-sizeMedium MuiChip-colorDefault MuiChip-filledDefault bg-color-secondary text-white css-1l3bzoq">
            <span class="MuiChip-label MuiChip-labelMedium css-9iedg7">Earn Vote: 14</span></div>
    </div>

    <div class="px-3 flex justify-between">
        <div>
            <button class="MuiButtonBase-root MuiButton-root MuiButton-outlined MuiButton-outlinedPrimary MuiButton-sizeLarge MuiButton-outlinedSizeLarge MuiButton-disableElevation MuiButton-root MuiButton-outlined MuiButton-outlinedPrimary MuiButton-sizeLarge MuiButton-outlinedSizeLarge MuiButton-disableElevation px-6 css-yfb7ui"
                    tabindex="0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-type="like">Mua Like<span class="MuiTouchRipple-root css-w0pj6f"></span></button>
        </div>
        <div>
            <button class="MuiButtonBase-root MuiButton-root MuiButton-outlined MuiButton-outlinedPrimary MuiButton-sizeLarge MuiButton-outlinedSizeLarge MuiButton-disableElevation MuiButton-root MuiButton-outlined MuiButton-outlinedPrimary MuiButton-sizeLarge MuiButton-outlinedSizeLarge MuiButton-disableElevation px-6 css-yfb7ui"
                    tabindex="0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-type="vote">Mua Vote<span class="MuiTouchRipple-root css-w0pj6f"></span></button>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content css-mbdu2s">
                <div class="modal-body ">
                    <button data-bs-dismiss="modal"
                            class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeSmall css-o1bub9"
                            tabindex="0" type="button">
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                             style="fill: white !important;"
                             aria-hidden="true" viewBox="0 0 24 24" data-testid="CloseIcon">
                            <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                        </svg>
                        <span class="MuiTouchRipple-root css-w0pj6f"></span>
                    </button>
                    <h2 class="MuiTypography-root MuiTypography-h6 MuiDialogTitle-root css-3cs75a mb-4" id="modaltitle">Mua lượt <span id="interactTitle"></span>
                    </h2>

                    <div class="MuiDialogContent-root css-1ty026z">
                        <div class="flex justify-center items-center space-x-2">
                            <button class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation hover:bg-black/5 css-4lk0i2"
                                    tabindex="0" type="button" data-type="minus"><img
                                        src="{{ asset('/minigame/img/Icon.Minus.58bcf4aafc66e99fd86700eab74c4eb0.svg') }}"
                                        class="scale-125"><span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                            <div class="MuiFormControl-root MuiTextField-root css-16zb4wv">
                                <div class="MuiInputBase-root MuiOutlinedInput-root MuiInputBase-colorPrimary MuiInputBase-formControl css-vb3fd7">
                                    <input aria-invalid="false" name="amount"
                                           class="MuiInputBase-input MuiOutlinedInput-input text-base py-3 css-1x5jdmq"
                                           type="text" value="5" inputmode="numeric" id="amountRate">
                                    <fieldset aria-hidden="true" class="MuiOutlinedInput-notchedOutline css-igs3ac">
                                        <legend class="css-ihdtdm"><span class="notranslate">&ZeroWidthSpace;</span>
                                        </legend>
                                    </fieldset>
                                </div>
                            </div>
                            <button class="MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium MuiButton-disableElevation hover:bg-black/5 css-4lk0i2"
                                    tabindex="0" type="button" data-type="plus"><img
                                        src="{{ asset('/minigame/img/Icon.Add.9549a677521310efc807ccf43e191ac2.svg') }}"
                                        class="scale-125"><span class="MuiTouchRipple-root css-w0pj6f"></span></button>
                        </div>
                        <div class="MuiGrid-root MuiGrid-container MuiGrid-spacing-xs-1.2 mt-2 css-1ohpmkg">
                            @foreach(json_decode(\App\Http\Controllers\ApiController::getSetting('interact_buy'), true) as $step)
                                <div class="MuiGrid-root MuiGrid-item MuiGrid-grid-xs-4 css-1udb513">
                                    <button class="MuiButtonBase-root MuiButton-root MuiButton-outlined MuiButton-outlinedInfo MuiButton-sizeMedium MuiButton-outlinedSizeMedium MuiButton-disableElevation MuiButton-fullWidth MuiButton-root MuiButton-outlined MuiButton-outlinedInfo MuiButton-sizeMedium MuiButton-outlinedSizeMedium MuiButton-disableElevation MuiButton-fullWidth h-[40px] rounded-[8px] text-[20px] css-bonpy3"
                                            tabindex="0" type="button" data-amount="{{ $step }}">{{ $step }}<span
                                                class="MuiTouchRipple-root css-w0pj6f"></span></button>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="text-center">Giá: <span id="finalPrice">50</span></div>

                <div class="MuiDialogActions-root MuiDialogActions-spacing justify-center css-14b29qc ">
                    <button class="MuiButtonBase-root MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation MuiButton-root MuiLoadingButton-root MuiButton-contained MuiButton-containedPrimary MuiButton-sizeMedium MuiButton-containedSizeMedium MuiButton-disableElevation w-[80%] css-1n8uu98"
                            tabindex="0" type="button" id="buyInteract">Xác nhận<span
                                class="MuiTouchRipple-root css-w0pj6f"></span></button>
                </div>

            </div>
        </div>
    </div>

    @section('js')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';
            Object.defineProperty(String.prototype, 'capitalize', {
                value: function() {
                    return this.charAt(0).toUpperCase() + this.slice(1);
                },
                enumerable: false
            });
            let interactType = 0;
            $(document).ready(function () {
                function updateCurrentPlus(type, amount) {
                    var rateDiv;
                    if (type == 1) {
                        rateDiv = $(`#currentVote`)
                    } else {
                        rateDiv = $(`#currentLike`)
                    }
                    rateDiv.html(parseInt(rateDiv.html()) + amount)
                }
                $('.css-yfb7ui').click(function () {
                    $('#interactTitle').html(($(this).data('type')).capitalize())
                    if ($(this).data('type') == 'vote')
                    {
                        interactType = 1;
                    }else{
                        interactType = 2;
                    }
                })
                $('#buyInteract').click(function () {
                    $.ajax({
                        url: "{{route('news.buyReact')}}",
                        type: 'POST',
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify({
                            amount: parseInt($('#amountRate').val()),
                            type: interactType
                        }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                toast.success(`${data.message}`)
                                updateCurrentPlus(interactType, parseInt($('#amountRate').val()))
                            } else {
                                clearStars()
                                toast.error(`${data.message}`)
                            }
                            $("#exampleModal").modal('hide');
                        },
                        error: function (data) {
                            toast.error(data.responseJSON.message ?? data.message);
                        }
                    });
                })
                $('.css-4lk0i2').click(function () {
                    var amount;
                    if ($(this).attr('data-type') == 'plus') {
                        amount = parseInt($('#amountRate').val()) + 1;
                    } else {
                        amount = parseInt($('#amountRate').val()) - 1;
                    }
                    $('#amountRate').val((amount < 0) ? 0 : amount)
                    $('#finalPrice').html(parseInt($('#amountRate').val()) * {{ \App\Http\Controllers\ApiController::getSetting('interact_rate') }})
                })

                $(".css-bonpy3").on("click", function () {
                    $(".css-bonpy3").removeClass("selected");
                    $(this).addClass("selected");
                    $("#amountRate").val($(this).attr("data-amount"));
                    $('#finalPrice').html(parseInt($('#amountRate').val()) * {{ \App\Http\Controllers\ApiController::getSetting('interact_rate') }})
                });

                $('.MuiRating-icon').click(function () {
                    const rating = $(this).data('rating');
                    editStar($(this))
                    $.ajax({
                        url: "{{route('news.react', $post->post_id)}}",
                        type: 'POST',
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify({
                            react: 1,
                            rating: rating,
                            post_id: '{{ $post->post_id }}'
                        }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                toast.success(`${data.message}`)
                                const rateDiv = $('#rateCount')
                                rateDiv.html(parseInt(rateDiv.html()) + 1)
                                updateCurrent(2)
                            } else {
                                clearStars()
                                toast.error(`${data.message}`)
                            }
                        },
                        error: function (data) {
                            toast.error(data.responseJSON.message ?? data.message);
                        }
                    });
                });

                $('#likePost').click(function () {
                    $.ajax({
                        url: "{{route('news.react', $post->post_id)}}",
                        type: 'POST',
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify({
                            react: 2,
                            post_id: '{{ $post->post_id }}'
                        }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                toast.success(`${data.message}`)
                                const rateDiv = $('#likeCoun')
                                rateDiv.html(parseInt(rateDiv.html()) + 1)
                                updateCurrent(1)
                            } else {
                                clearStars()
                                toast.error(`${data.message}`)
                            }
                        },
                        error: function (data) {
                            toast.error(data.responseJSON.message ?? data.message);
                        }
                    });
                })
                function editStar(_this) {
                    $('.MuiRating-icon').removeClass('MuiRating-iconFilled css-13m1if9');
                    $('.MuiRating-icon').addClass('MuiRating-iconEmpty css-1xh6k8t');
                    $('.MuiRating-icon').html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarBorderIcon"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg>`);

                    const selectedStar = $(_this);
                    const previousStars = selectedStar.prevAll('.MuiRating-icon');
                    selectedStar.removeClass('MuiRating-iconEmpty css-1xh6k8t');
                    selectedStar.addClass('MuiRating-iconFilled css-13m1if9');
                    selectedStar.html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarIcon"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>`)

                    previousStars.removeClass('MuiRating-iconEmpty css-1xh6k8t');
                    previousStars.addClass('MuiRating-iconFilled css-13m1if9');
                    previousStars.html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarIcon"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>`)
                }

                function clearStars() {
                    $('.MuiRating-icon').removeClass('MuiRating-iconFilled css-13m1if9');
                    $('.MuiRating-icon').addClass('MuiRating-iconEmpty css-1xh6k8t');
                    $('.MuiRating-icon').html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarBorderIcon"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg>`);
                }
            });
        </script>
    @endsection
</x-news-layout>
