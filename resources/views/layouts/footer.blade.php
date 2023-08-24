<div class="mt-3">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
        <div class="font-medium text-color-primary">Đối tác lớn
        </div>
    </div>
</div>

<div class="mt-3">
    @foreach(\App\Models\ImgRetail::orderBy('order', 'asc')->get() as $col)
        <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 css-aoeo82 @if($loop->index == 0) mt-2  @endif">
            <img src="{{ asset($col->path) }}">
        </div>
    @endforeach
</div>

<div>
    <div
            class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
        <div class="font-medium text-color-primary">Về chúng tôi</div>
    </div>
    @foreach(\App\Models\ImgAbout::orderBy('order', 'asc')->get() as $col)
        <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 css-aoeo82 @if($loop->index == 0) mt-2  @endif">
            <img src="{{ asset($col->path) }}">
        </div>
    @endforeach
</div>

<div class="mt-3">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 h-[40px] flex items-center justify-between px-3 border-l-2 border-primary-dark css-aoeo82">
        <div class="font-medium text-color-primary">Trụ sở chính
        </div>
    </div>
</div>

<div class="mt-3">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 my-2 p-3 css-aoeo82">

        @foreach(\App\Models\ImgLocation::orderBy('order', 'asc')->get() as $col)
            <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 css-aoeo82 @if($loop->index == 0) mt-2  @endif">
                <img src="{{ asset($col->path) }}">
            </div>
        @endforeach

        <div class="flex justify-center gap-1 mt-3 -mb-1 pt-1 border-t border-black/20">
            <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                    tabindex="0" type="button">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                     aria-hidden="true" viewBox="0 0 24 24" data-testid="FacebookIcon">
                    <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2m13 2h-2.5A3.5 3.5 0 0 0 12 8.5V11h-2v3h2v7h3v-7h3v-3h-3V9a1 1 0 0 1 1-1h2V5z"></path>
                </svg>
                <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                    tabindex="0" type="button">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                     aria-hidden="true" viewBox="0 0 24 24" data-testid="InstagramIcon">
                    <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3z"></path>
                </svg>
                <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                    tabindex="0" type="button">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                     aria-hidden="true" viewBox="0 0 24 24" data-testid="TelegramIcon">
                    <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"></path>
                </svg>
                <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
            <button class="MuiButtonBase-root MuiIconButton-root MuiIconButton-sizeMedium css-1yxmbwk"
                    tabindex="0" type="button">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                     aria-hidden="true" viewBox="0 0 24 24" data-testid="YouTubeIcon">
                    <path d="M10 15l5.19-3L10 9v6m11.56-7.83c.13.47.22 1.1.28 1.9.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83-.25.9-.83 1.48-1.73 1.73-.47.13-1.33.22-2.65.28-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44-.9-.25-1.48-.83-1.73-1.73-.13-.47-.22-1.1-.28-1.9-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83.25-.9.83-1.48 1.73-1.73.47-.13 1.33-.22 2.65-.28 1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44.9.25 1.48.83 1.73 1.73z"></path>
                </svg>
                <span class="MuiTouchRipple-root css-w0pj6f"></span></button>
        </div>
    </div>
</div>

<div class="mb-5 pb-5"><img src="{{ asset('minigame/img/Group.Partners.B2.7245cabf7a6d853d90cb.png') }}" class="h-[48px] mx-auto"></div>
