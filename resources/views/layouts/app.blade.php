<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
         window.onload = function() {
                console.log("Window loaded...");
                // Users cannot choose a date in the past
                var today = new Date().toISOString().split('T')[0];
                document.getElementsByName("input-date")[0].setAttribute('min', today);
                var dateSelect = document.getElementById('input-date').value;

                // Display available time slots in drop down
                var listTimes = function (e) {
                    console.log(dateSelect);
                    dateSelect = document.getElementById('input-date').value;
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = JSON.parse(this.responseText);
                            document.getElementById('input-time').innerHTML = "<option selected value=''>Please pick a time...</option>"
                            if (data.length == 0) {
                                document.getElementById('input-time').innerHTML = "<option selected value=''>No slots available</option>"
                            } else {
                                for (i=0;i<data.length;i++){
                                console.log(data[i]);
                                if (data[i] < 10) {
                                    var prefix = 0;
                                } else {
                                    var prefix = "";
                                }
                                document.getElementById('input-time').innerHTML += "<option value='"+data[i]+"'>"+prefix+data[i]+":00</option>"
                            }
                            }
                        }
                    }; 
                    xhr.open("GET", "/bookings/check/"+dateSelect, true);
                    xhr.send(); 
                };
                
                listTimes();
                document.getElementById('input-date').addEventListener('click', listTimes);
    };
    </script>
</body>
</html>
