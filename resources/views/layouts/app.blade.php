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
    <link href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<wc-toast position="top-center"></wc-toast>

<div class="content-wrapper css-hltdia">
    @hasSection('header')
        @yield('header')
    @else
        <div class="slick -container">
            <div class="sm:h-[180px] h-[140px]"
                 style="background: url('{{ asset('/headers/1.jpg') }}') center top / contain no-repeat;">
            </div>
            <div class="sm:h-[180px] h-[140px]"
                 style="background: url('{{ asset('/headers/2.jpeg') }}') center top / contain no-repeat;">
            </div>
            <div class=" sm:h-[180px] h-[140px]"
                 style="background: url('{{ asset('/headers/3.jpeg') }}') center top / contain no-repeat;">
            </div>
        </div>
        <div class="container-fluid moving-ann mt-3 p-0 justify-content-center  d-flex align-items-center">
            <div class="row d-flex" style="max-width: 444px;">
                <div class="col-1 pb-0">
                    <img src="{{ asset('/minigame/img/Icon.Loa.017de1e2c6936a742433301c2b3011bb.svg') }}">
                </div>
                <div class="col-8" style="padding-right:unset">
                    <p class="mb-0">
                        <marquee>{{ \App\Http\Controllers\ApiController::getSetting('moving_ann') }}</marquee>
                    </p>
                </div>
                <div class="col-1">
                  <span class="badge rounded-pill bg-navbar badgecounter">
                     <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuvw" focusable="false"
                          aria-hidden="true"
                          viewBox="0 0 24 24" data-testid="GroupsIcon">
                        <path
                            d="M12 12.75c1.63 0 3.07.39 4.24.9 1.08.48 1.76 1.56 1.76 2.73V18H6v-1.61c0-1.18.68-2.26 1.76-2.73 1.17-.52 2.61-.91 4.24-.91zM4 13c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm1.13 1.1c-.37-.06-.74-.1-1.13-.1-.99 0-1.93.21-2.78.58C.48 14.9 0 15.62 0 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29zM20 13c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm4 3.43c0-.81-.48-1.53-1.22-1.85-.85-.37-1.79-.58-2.78-.58-.39 0-.76.04-1.13.1.4.68.63 1.46.63 2.29V18H24v-1.57zM12 6c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3z">
                        </path>
                     </svg>
                     <span class="counter">{{ \App\Http\Controllers\ApiController::currentUsers() }}</span>
                  </span>
                </div>
            </div>
        </div>
    @endif

    {{ $slot }}
</div>
@include('layouts.navigation')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.slick').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            arrows: true,
            prevArrow: false,
            nextArrow: false
        });
    });

</script>
@yield('js')
</body>
</html>
