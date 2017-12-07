
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

window.onload = function() {
    console.log("Window loaded...");
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("input-date")[0].setAttribute('min', today);
    var dateSelect = document.getElementById('input-date').value;

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
