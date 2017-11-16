<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'LGSAPP')}}</title>
        <style>
        </style>
    </head>
    <body>
    @include("inc.navbar")
    <div class="container">
        @include('inc/messages')
        @yield('content')
    </div>
    <script> 
    window.onload = function() {
                console.log("Window loaded...");

                document.getElementById('input-date').addEventListener('change', function(e){
                    var dateSelect = this.value;
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = JSON.parse(this.responseText);
                            document.getElementById('input-time').innerHTML = "<option selected value=''>Please pick a time...</option>"
                            if (data.length == 0) {
                                document.getElementById('input-time').innerHTML = "<option selected value=''>No slots available</option>"
                            } else {
                                for (i=0;i<data.length;i++){
                                console.log(data[i].time);
                                document.getElementById('input-time').innerHTML += "<option value='"+data[i]+"'>"+data[i]+":00</option>"
                            }
                            }
                        }
                    };
                    xhr.open("GET", "/bookings/check/"+dateSelect, true);
                    xhr.send(); 
                    });
    };
    </script>
    </body>
</html>
