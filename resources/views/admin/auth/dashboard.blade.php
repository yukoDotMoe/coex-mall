<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
    <h1>Chào mừng, bây giờ là <span id="txt"></span></h1>

    <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        startTime()
    </script>
@endsection
