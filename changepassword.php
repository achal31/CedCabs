<?php
include ('header.php');
if (!isset($_SESSION))
{
    session_start();

}

if (!isset($_SESSION['username']))
{
    header('location:index.php');
}
else if ($_SESSION['usertype'] == '0')
{
    header("adminfiles/adminpanel.php");
}

if (isset($_POST['Save']))
 {include_once ('user.php');
      $value = 'password';
    $current = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['conf'];

    $savedata = new user();
    $savedata->usersettings($_SESSION['username'], $value, $current, $new, $confirm);
}
?>

<div id="userpanelsetting">
    
        <form action="changepassword.php" method="POST"> 
        <input type="password" placeholder="Enter Current Passsword" name="current" class="detail" required>
        <p></p>
        <input type="password" placeholder="Enter New Passsword" name="new" id="password" class="detail" pattern=".{8,}" oninvalid="InvalidMsg(this);" 
            oninput="InvalidMsg(this);" required>
        <p></p>
        <input type="password" placeholder="Please Confirm Passsword" name="conf" id="repassword" class="detail" pattern=".{8,}" oninvalid="InvalidMsg(this);" 
            oninput="InvalidMsg(this);" required>
        <p></p>
        <input type="submit" value="UpdatePassword" name="Save" class="detailbutton">
        </form>
</div>
<div id=pad></div>
</div>
<?php include ('footer.php'); ?>
<script>
  function InvalidMsg(textbox) { 
   if(textbox.id=='password'||textbox.id=='repassword')
{
  if (textbox.value === '') { 
      textbox.setCustomValidity 
            ('Entering a Password is necessary!'); 
  } else if (textbox.validity.patternMismatch) { 
      textbox.setCustomValidity 
            ('Please Enter 8 digit Password which is valid!'); 
  } else { 
      textbox.setCustomValidity(''); 
  } 
}else if(textbox.id=='fullname')
{
  if (textbox.value === '') { 
      textbox.setCustomValidity 
            ('Entering a Full Name is necessary!'); 
  } else if (textbox.validity.patternMismatch) { 
      textbox.setCustomValidity 
            ('Full Name Should Start from Alphabet and Shouldnt contain any numbers!'); 
  } else { 
      textbox.setCustomValidity(''); 
  } 
}

} 
  
</script>




