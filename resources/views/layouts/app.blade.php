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
    <link rel="stylesheet" href="{{ asset('/minigame/style.css') }}?ver={{ \App\Http\Controllers\ApiController::cacheVersion('/minigame/style.css') }}">
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
                 style="background: url('{{ asset('/headers/1.jpeg') }}') center top / contain no-repeat;">
            </div>
            <div class="sm:h-[180px] h-[140px]"
                 style="background: url('{{ asset('/headers/2.jpeg') }}') center top / contain no-repeat;">
            </div>
            <div class=" sm:h-[180px] h-[140px]"
                 style="background: url('{{ asset('/headers/3.jpeg') }}') center top / contain no-repeat;">
            </div>
        </div>
        @include('layouts.movingAnn')
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
