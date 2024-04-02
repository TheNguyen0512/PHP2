<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('title') }}</title>
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
</head>
<body>
    <div class="container">
        <div class="success-message">
            <h2>{{ session('title') }}</h2>
            <p>You will return to the home page after 10 seconds</p>
            <div id="countdown"></div>
            <button id="homeButton">Home</button>
        </div>
    </div>
    <script>
        function redirectToHome() {
            window.location.href = "{{ route('home') }}";
        }

        function startCountdown(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                    redirectToHome();
                }
            }, 1000);
        }

        window.onload = function () {
            var tenSeconds = 10,
                display = document.querySelector('#countdown');
            startCountdown(tenSeconds, display);
        };
        document.getElementById('homeButton').addEventListener('click', redirectToHome);
    </script>
</body>
</html>
