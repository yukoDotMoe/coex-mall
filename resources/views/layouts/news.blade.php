<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('header')

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/lexend-deca" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/minigame/style.css') }}">
</head>
<body>
<wc-toast position="top-center"></wc-toast>
<div class="content-wrapper css-hltdia px-0">
    @hasSection('header')
        <div style="z-index: 99;"
             class="MuiContainer-root MuiContainer-maxWidthXs MuiPaper-root MuiPaper-elevation MuiPaper-elevation1 MuiAppBar-root MuiAppBar-colorPrimary MuiAppBar-positionFixed shadow-md inset-0 bottom-[unset] h-[54px] flex flex-row items-center gap-1 px-2 mui-fixed css-m6yqs9">
            <a href="{{ route('news') }}">
                <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-colorInherit MuiIconButton-sizeMedium css-1deacqj"
                        tabindex="0" type="button">
                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                         aria-hidden="true" style="fill: var(--color-text-secondary) !important;"
                         viewBox="0 0 24 24" data-testid="ArrowBackIcon">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
                    </svg>
                    <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            </a><span class="text-lg font-medium">@yield('header')</span>
        </div>
    @endif
    {{ $slot }}
    <div class="MuiContainer-root MuiContainer-maxWidthXs flex justify-end fixed left-0 right-0 top-[unset] bottom-[68px] z-20 px-2 css-hltdia">
        <div class="w-max flex items-center gap-x-2 font-medium text-color-primary rounded-2xl">
            <div class="MuiChip-root MuiChip-filled MuiChip-sizeMedium MuiChip-colorDefault MuiChip-filledDefault bg-color-secondary text-white css-1l3bzoq">
                <span class="MuiChip-label MuiChip-labelMedium css-9iedg7">Số lượt like có: <span id="currentLike">{{ Auth::user()->getReact(2) }}</span></span></div>
            <div class="MuiChip-root MuiChip-filled MuiChip-sizeMedium MuiChip-colorDefault MuiChip-filledDefault bg-color-secondary text-white css-1l3bzoq">
                <span class="MuiChip-label MuiChip-labelMedium css-9iedg7">Số lượt vote có: <span id="currentVote">{{ Auth::user()->getReact(1) }}</span></span></div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@include('layouts.navigation')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateCurrent(type) {
        var rateDiv;
        if (type == 1) {
            rateDiv = $(`#currentLike`)
        } else {
            rateDiv = $(`#currentVote`)
        }
        rateDiv.html(parseInt(rateDiv.html()) - 1)
    }
</script>
@yield('js')
</body>
</html>
