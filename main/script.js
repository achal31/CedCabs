$(document).ready(function() {

    /*----------Function To Disable The Similar Drop Location--------------*/
    $('#pickup').change(function() {
        var drop = $(this).val();
        $("#drop option").removeAttr("disabled");
        $("#drop option[value=" + drop + "]").attr('disabled', 'disabled');
    });

    /*----------Function To Disable The Similar Pickup Location--------------*/
    $('#drop').change(function() {
        var pick = $(this).val();
        $("#pickup option").removeAttr("disabled");
        $("#pickup option[value=" + pick + "]").attr('disabled', 'disabled');
    });

    /*-----------Function To Validate The Input In The Weigth Field------------*/
    $("#weight").keyup(function() {
        var w = $("#weight").val();
        if (isNaN(w) == true) {
            $("#demo").html("Please Make Sure To Enter An Integer Value");
            $('#myModal').modal('show');
            $("#submit").attr('disabled', 'disabled');
        } else {
            $("#submit").removeAttr("disabled");
        }
    });

    /*----------Function To Set Lugage To Zero When CedMicro Is Selected---------*/
    $('#cabtype').change(function() {
        if ($(this).val() == 'CedMicro') {
            $('#weight').prop("disabled", true);
            $('#weight').val("0");
        } else {
            $('#weight').prop("disabled", false);
            $('#weight').val("");
            $('#weight').attr("placeholder", "Enter the weight in kg");
        }
    });

    /*----------Function To Send Form Data To The Php File----------------------*/
    $("#submit").click(function() {
        var pickup = $("#pickup").val();
        var drop = $("#drop").val();
        var cabtype = $("#cabtype").val();
        var weight = $("#weight").val();
        var dataString = 'pickup1=' + pickup + '&drop1=' + drop + '&cabtype1=' + cabtype + '&weight1=' + weight;
        if (pickup == '' || drop == '' || cabtype == '' || weight == '') {
            $("#statement").html("");
            $("#way").html("");
            $("#demo").html("Please Make Sure To Fill All The Fields");
            $('#myModal').modal('show');

        } else {
            $.ajax({
                type: "POST",
                url: "file.php",
                data: dataString,
                cache: false,
                success: function(result) {
                    var a = pickup + " To " + drop + " By " + cabtype;
                    $("#statement").html("Your Total Calculated Fare is :")
                    $("#way").html(a);
                    $("#demo").html(result);
                    $('#myModal').modal('show');

                }
            });
        }
        return false;
    });
});