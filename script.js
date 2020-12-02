$(document).ready(function() {


    /*----------Function To Disable The Similar Drop Location--------------*/
    $("#pickup").change(function() {
        if (this.val != "") {

            var drop = $(this).val();

            $("#drop option[value='" + drop + "']").attr("disabled", "disabled").siblings().removeAttr("disabled");
        }
    });

    /*----------Function To Disable The Similar Pickup Location--------------*/
    $("#drop").change(function() {
        if (this.val != "") {
            var pick = $(this).val();

            $("#pickup option[value='" + pick + "']").attr("disabled", "disabled").siblings().removeAttr("disabled");
        }
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

    $("#btnpass").click(function() {
        $("#changepassword").css({ "display": "block" });
        $("#changenumber").css({ "display": "none" });
        $("#changename").css({ "display": "none" });
    });

    $("#btnnum").click(function() {
        $("#changepassword").css({ "display": "none" });
        $("#changenumber").css({ "display": "block" });
        $("#changename").css({ "display": "none" });
    });
    $("#btnname").click(function() {
        $("#changepassword").css({ "display": "none" });
        $("#changenumber").css({ "display": "none" });
        $("#changename").css({ "display": "block" });
    });

    $("#distance1").click(function() {
        $("#distance").toggle();
        $("#fare").css({ "display": "none" });
        $("#weight").css({ "display": "none" });
        $("#week").css({ "display": "none" });
        $("#date").css({ "display": "none" });
        $("#cab").css({ "display": "none" });
        $("#status").css({ "display": "none" });
    })
    $("#fare1").click(function() {
        $("#fare").toggle();
        $("#distance").css({ "display": "none" });
        $("#weight").css({ "display": "none" });
        $("#week").css({ "display": "none" });
        $("#date").css({ "display": "none" });
        $("#cab").css({ "display": "none" });
        $("#status").css({ "display": "none" });
    })
    $("#weight1").click(function() {
        $("#weight").toggle();
        $("#distance").css({ "display": "none" });
        $("#fare").css({ "display": "none" });
        $("#week").css({ "display": "none" });
        $("#date").css({ "display": "none" });
        $("#cab").css({ "display": "none" });
        $("#status").css({ "display": "none" });
    })
    $("#week1").click(function() {
        $("#week").toggle();
        $("#distance").css({ "display": "none" });
        $("#fare").css({ "display": "none" });
        $("#weight").css({ "display": "none" });
        $("#date").css({ "display": "none" });
        $("#cab").css({ "display": "none" });
        $("#status").css({ "display": "none" });
    })
    $("#date1").click(function() {
        $("#date").toggle();
        $("#distance").css({ "display": "none" });
        $("#fare").css({ "display": "none" });
        $("#weight").css({ "display": "none" });
        $("#week").css({ "display": "none" });
        $("#cab").css({ "display": "none" });
        $("#status").css({ "display": "none" });
    })
    $("#cab1").click(function() {
        $("#cab").toggle();
        $("#distance").css({ "display": "none" });
        $("#fare").css({ "display": "none" });
        $("#weight").css({ "display": "none" });
        $("#week").css({ "display": "none" });
        $("#date").css({ "display": "none" });
        $("#status").css({ "display": "none" });
    })
    $("#status1").click(function() {
        $("#distance").css({ "display": "none" });
        $("#status").toggle();
        $("#fare").css({ "display": "none" });
        $("#weight").css({ "display": "none" });
        $("#week").css({ "display": "none" });
        $("#date").css({ "display": "none" });
        $("#cab").css({ "display": "none" });

    })
    $("#submit").click(function() {
        var pickup = $("#pickup").val();
        var drop = $("#drop").val();
        var cabtype = $("#cabtype").val();
        var weight = $("#weight").val();
        var dataString = 'pickup1=' + pickup + '&drop1=' + drop + '&cabtype1=' + cabtype + '&weight1=' + weight;
        if (pickup == '' || drop == '' || cabtype == '' || weight == '') {
            alert("Please fill all values")

        } else {
            $.ajax({
                type: "POST",
                url: "calculatefare.php",
                data: dataString,
                cache: false,
                success: function(result) {

                    $("#getfaredetail").css({ "display": "block" });
                    $("#getfare").css({ "display": "block" });
                    $("#getfare").val(result);
                    $("#getfar").val(result);
                    $('#book').css({ "display": "block" });

                }
            });
        }
        return false;
    });

});