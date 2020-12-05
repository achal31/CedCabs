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
        <input type="password" placeholder="Enter New Passsword" name="new" class="detail" pattern=".{8,}" required>
        <p></p>
        <input type="password" placeholder="Please Confirm Passsword" name="conf" class="detail" pattern=".{8,}" required>
        <p></p>
        <input type="submit" value="UpdatePassword" name="Save" class="detailbutton">
        </form>
</div>
<div id=pad></div>
</div>
<?php include ('footer.php'); ?>
