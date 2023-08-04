<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \App\Http\Controllers\ApiController::getSetting('page_title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/lexend-deca" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/minigame/style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="overflow: hidden">
<wc-toast position="top-center"> </wc-toast>
<div class="content-wrapper MuiContainer-root MuiContainer-maxWidthXs relative css-hltdia align-content-center" style="background: linear-gradient(to right, #17132c, #252144) center center / cover no-repeat; height: 108vh; display: flex; justify-content: center; align-items: center;">
    <div class="auth-screen md:pb-[24px] pb-[12px]">
        <div class="flex justify-center items-center pt-[24px] mb-4"><img src="{{ asset('logo.png') }}" style="    height: 4rem;"></div>

        {{ $slot }}
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "{{ env('FB_KEY') }}",
        authDomain: "{{ env('FB_AUTH') }}",
        databaseURL: "{{ env('FB_DB') }}",
        projectId: "{{ env('FB_PROJECT') }}",
        storageBucket: "{{ env('FB_STORAGE') }}",
        messagingSenderId: "{{ env('FB_MSG') }}",
        appId: "{{ env('FB_APP') }}",
        measurementId: "{{ env('FB_ANALYTICS') }}"
    };

    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>
@yield('jsl')
</body>
</html>
