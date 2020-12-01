$(function () {
    
    $("#weight").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            $("#mss").html("Digits Only").show().fadeOut("slow");
            return false;
        }
    });
    $("#cartype").change(function () {
        if ($(this).val() == "Micro") {
            $("#bags").hide();
        } else {
            $("#bags").show();
        }
    });
    $("#drop").change(function () {
        var pickup = $("#pickup").val();
        if ($(this).val() != pickup) {
            $("#submit").html("Calculate Fare");
        }
    });
    $("#cartype").change(function () {
        if ($(this).val() != "Select car") {
            $("#submit").html("Calculate Fare");
        }
    });
    $("#submit").click(function (e) {
        $("#book").hide();
        e.preventDefault();
        var pickup = $("#pickup").val();
        var drop = $("#drop").val();
        var cartype = $("#cartype").val();
        var weight = $("#weight").val();
        if (pickup == drop) {
            alert("pickup and drop location is same");
            $("#submit").html("PLEASE CHOOSE DIFFERENT DROP LOCATION");
            return;
        }
        if (cartype == "Select car") {
            alert("choose car type");
            $("#submit").html("SELECT CAR");
            return;
        }
        $.ajax({
            url: "ola.php",
            type: "POST",
            data: { pickup: pickup, drop: drop, cartype: cartype, weight: weight },
            success: function (result) {
                $("#submit").html(result);
                $("#book").show();
            },
            error: function () {
                alert("error");
            }
        });
    });
    $("#book").click(function (e) {
        e.preventDefault();
        var pickup = $("#pickup").val();
        var drop = $("#drop").val();
        var cartype = $("#cartype").val();
        var weight = $("#weight").val();
        var action=1;
        $.ajax({
            url: "ola.php",
            type: "POST",
            data: { pickup: pickup, drop: drop, cartype: cartype, weight: weight,action:action },
            success: function (result) {
                $text=$("#submit").html();
                if(result==$text){
                    window.location.href = "login.php";
                }
               else{
                   window.location.href = "invoice.php";
               }
                
            },
            error: function () {
                alert("error");
            }
        });
    })
});