<x-news-layout>
    @if(count(\App\Models\DanhMuc::orderBy('order', 'asc')->get()) < 1)
        <p class="text-center p-3">Chưa có tin nào hết á 🤷‍♀️</p>
    @endif
    <div class="accordion" id="post_accor">
        @foreach(\App\Models\DanhMuc::orderBy('order', 'asc')->get() as $dm)
            <div class="accordion-item border-0">
                <button class="w-100" type="button" data-bs-toggle="collapse" data-bs-target="#post_accor_{{$dm->id}}">
                    <div class="mb-3">
                        <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[48px] rounded-none flex items-center px-3 border-l-4 border-primary-dark shadow-md sticky top-0 z-10 cursor-pointer hover:brightness-90 css-aoeo82">
                            <div class="text-lg font-bold">{{$dm->name}}</div>
                        </div>
                    </div>
                </button>
                @php
                    $paginatorName = 'post_accor_' . $dm->id;
                    $dmPosts = \App\Http\Controllers\NewsController::findPost($dm->id)->paginate(5, ['*'], $paginatorName);
                @endphp
                <div data-bs-parent="#post_accor" id="post_accor_{{ $dm->id }}"
                     class="accordion-collapse collapse @if($loop->iteration == 1) show @endif"
                     data-bs-parent="#post_accor">
                    @foreach($dmPosts as $post)
                        <div class="MuiCollapse-root MuiCollapse-vertical MuiCollapse-entered css-c4sutr" style="min-height: 0px;">
                            <div class="p-{{ $post->post_id }} MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 MuiCard-root rounded-none mb-3 relative css-s18byi">
                                <div class="slick-slider w-full flex justify-center h-[240px] slick-initialized">
                                    <div class="slick-list">
                                        <div class="slick-track"
                                             style="width: 444px; opacity: 1; transform: translate3d(0px, 0px, 0px);">
                                            <div data-index="0" class="slick-slide slick-active slick-current"
                                                 tabindex="-1"
                                                 aria-hidden="false" style="outline: none; width: 444px;">
                                                <div>
                                                    <div class="MuiCardMedia-root h-[240px] flex flex-col justify-end css-pqdqbj"
                                                         role="img"
                                                         tabindex="-1"
                                                         style="background-image: url(&quot;{{ asset($post->thumbnail) }}&quot;); width: 100%; display: inline-block;">
                                                        <div style="width: 90%!important" class="d-flex justify-content-center">
                                                            <div class="text-lg font-bold text-white"
                                                                 style="text-shadow: rgb(0, 0, 0) 0px 0px 4px;">{{ mb_strimwidth($post->title, 0, 20, '...') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiCardContent-root p-3 space-y-2 pb-0 css-1qw96cp">
                                    <a href="{{ route('news.view', $post->post_id ) }}"><span
                                                class="font-bold hover:text-navbar">{{ number_format($post->price , 0, '.', '.') }}</span></a>
                                    <div class="flex justify-between">
                                        <div class="flex items-center gap-1">
                                            <span class="MuiRating-root MuiRating-sizeMedium css-1ipqyij"
                                                  data-post="{{ $post->post_id }}">
                                                <x-newsRate rating="{{ $post->order ?? 0 }}"/>
                                            </span>
                                            <div><span class="rateCount">{{ $post->vote }}</span> Đánh giá</div>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium text-[orangered] cursor-pointer css-vubbuv likePost"
                                                 focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                                                 data-testid="FavoriteBorderIcon" data-post="{{ $post->post_id }}">
                                                <path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path>
                                            </svg>
                                            <div class="likeCount">{{ $post->like }}</div>
                                        </div>
                                    </div>
                                    <div class="text-sm">
                                        {{ mb_strimwidth($post->content, 0, 200, '...') }}
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="MuiChip-root MuiChip-filled MuiChip-sizeSmall MuiChip-colorDefault MuiChip-filledDefault bg-color-secondary text-white css-31ic4c">
                                            <span class="MuiChip-label MuiChip-labelSmall css-1pjtbja">Earn Like: 14</span>
                                        </div>
                                        <div class="MuiChip-root MuiChip-filled MuiChip-sizeSmall MuiChip-colorDefault MuiChip-filledDefault bg-color-secondary text-white css-31ic4c">
                                            <span class="MuiChip-label MuiChip-labelSmall css-1pjtbja">Earn Vote: 14</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="MuiCardActions-root MuiCardActions-spacing p-3 flex justify-between pt-2 css-3zukih">
                                    <a href="{{ route('news.view', $post->post_id ) }}">
                                        <div class="flex items-center gap-1 text-primary-light hover:text-primary-dark">
                                            <span class="text-sm">Xem thêm</span>
                                            <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium text-base css-vubbuv"
                                                 focusable="false"
                                                 aria-hidden="true" viewBox="0 0 24 24"
                                                 data-testid="KeyboardDoubleArrowRightIcon">
                                                <path d="M6.41 6 5 7.41 9.58 12 5 16.59 6.41 18l6-6z"></path>
                                                <path d="m13 6-1.41 1.41L16.17 12l-4.58 4.59L13 18l6-6z"></path>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $dmPosts->appends([$paginatorName => $dmPosts->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @section('js')
        <script type="module">
            import {toast} from 'https://cdn.skypack.dev/wc-toast';



            $(document).ready(function () {
                const basePath = window.location.search.replace('?', '').split('&');
                if (basePath !== undefined && basePath.length > 0 && basePath[0] !== '') {
                    $('.show').each(function () {
                        $(this).removeClass('show')
                    })
                    const smallerBase = basePath[0].split('=');
                    $(`#${smallerBase[0]}`).addClass('show')
                }
            })

            $('.MuiRating-icon').click(function () {
                const pid = $(this).parent().data('post')
                const rating = $(this).data('rating')
                editStar($(this), pid)
                $.ajax({
                    url: "/news/react/" + pid,
                    type: 'POST',
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        react: 1,
                        post_id: pid,
                        rating: rating
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            toast.success(`${data.message}`)
                            const rateDiv = $(`.p-${pid} .rateCount`)
                            rateDiv.html(parseInt(rateDiv.html()) + 1)
                            updateCurrent(2)
                        } else {
                            toast.error(`${data.message}`)
                        }
                        clearStars(pid)
                    },
                    error: function (data) {
                        toast.error(data.responseJSON.message ?? data.message);
                    }
                });
            });

            $('.likePost').click(function () {
                const pid = $(this).data('post');
                $.ajax({
                    url: "/news/react/" + pid,
                    type: 'POST',
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                        react: 2,
                        post_id: pid
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            toast.success(`${data.message}`)
                            const rateDiv = $(`.p-${pid} .likeCount`)
                            rateDiv.html(parseInt(rateDiv.html()) + 1)
                            updateCurrent(1)
                        } else {
                            toast.error(`${data.message}`)
                        }
                    },
                    error: function (data) {
                        toast.error(data.responseJSON.message ?? data.message);
                    }
                });
            })

            function editStar(_this, id) {
                $(`.p-${id} .MuiRating-icon`).removeClass('MuiRating-iconFilled css-13m1if9');
                $(`.p-${id} .MuiRating-icon`).addClass('MuiRating-iconEmpty css-1xh6k8t');
                $(`.p-${id} .MuiRating-icon`).html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarBorderIcon"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg>`);

                const selectedStar = $(_this);
                const previousStars = selectedStar.prevAll(`.p-${id} .MuiRating-icon`);
                selectedStar.removeClass('MuiRating-iconEmpty css-1xh6k8t');
                selectedStar.addClass('MuiRating-iconFilled css-13m1if9');
                selectedStar.html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarIcon"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>`)

                previousStars.removeClass('MuiRating-iconEmpty css-1xh6k8t');
                previousStars.addClass('MuiRating-iconFilled css-13m1if9');
                previousStars.html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarIcon"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>`)
            }

            function clearStars(id) {
                $(`.p-${id} .MuiRating-icon`).removeClass('MuiRating-iconFilled css-13m1if9');
                $(`.p-${id} .MuiRating-icon`).addClass('MuiRating-iconEmpty css-1xh6k8t');
                $(`.p-${id} .MuiRating-icon`).html(`<svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeInherit css-1cw4hi4" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="StarBorderIcon"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg>`);
            }
        </script>
    @endsection
</x-news-layout>
