$(window).on('load', function () {
    "use strict";

    setInterval(function () {
            let Data = new Date();
            let Hour = (Data.getHours() < 10 ? '0' : '') + Data.getHours();
            let Minutes = (Data.getMinutes() < 10 ? '0' : '') + Data.getMinutes();
            let Seconds = (Data.getSeconds() < 10 ? '0' : '') + Data.getSeconds();
            $('#time').html(Hour + ':' + Minutes + ':' + Seconds);
        }, 1000);

});