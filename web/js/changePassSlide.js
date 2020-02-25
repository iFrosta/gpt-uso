window.onload = function () {
    "use strict";
    $("#changePass").click(function () {
        $("#changePassSlider").show("slow", function () {
            $("#changedPass").click(function () {
                $("#changePassSlider").hide("slow");
            });
        });
    });
};
