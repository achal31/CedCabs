$(document).ready(function(){

    $('#pickup').change(function(){
          var drop= $(this).val();
          $("#drop option").removeAttr("disabled");
          $("#drop option[value="+drop+"]").attr('disabled', 'disabled');
        });

        $('#drop').change(function(){
            var pick= $(this).val();
            $("#pickup option").removeAttr("disabled");
            $("#pickup option[value="+pick+"]").attr('disabled', 'disabled');
          });

          $("#weight").keyup(function(){
           var w =$("#weight").val();
            if(isNaN(w) == true) {
                alert("Interger Value Needed")
                $("#submit").attr('disabled', 'disabled');
            } else {
                $("#submit").removeAttr("disabled");
            }
          });
          
    $('#cabtype').change(function() {
        if( $(this).val() == 'CedMicro') {
        $('#weight').prop( "disabled", true );
        $('#weight').val("0");
    } else {       
        $('#weight').prop( "disabled", false );
        $('#weight').val("");
        $('#weight').attr("placeholder", "Enter the weight in kg");
    }
});

$("#submit").click(function(){
var pickup = $("#pickup").val();
var drop = $("#drop").val();
var cabtype = $("#cabtype").val(); 
var weight = $("#weight").val();
var dataString = 'pickup1='+ pickup + '&drop1='+ drop + '&cabtype1='+ cabtype + '&weight1='+ weight;
if(pickup==''||drop==''||cabtype==''||weight=='')
{
alert("Please Fill All Fields");
}
else
{
$.ajax({
type: "POST",
url: "index.php",
data: dataString,
cache: false,
success: function(result){
var a = pickup+" To "+drop+" By "+cabtype;
$("#way").html(a);
$("#demo").html(result);
 $('#myModal').modal('show');
            
}
});
}
return false;
});
});