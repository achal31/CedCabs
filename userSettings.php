<?php
include('header.php');
if (!isset($_SESSION)) {
    session_start();
    
}


if (!isset($_SESSION['username'])) {
    header('location:unauthorisedUser.php');
} else if ($_SESSION['usertype'] == '0') {
    header("adminfiles/adminpanel.php");
}
include_once('user.php');
if (isset($_POST['Save'])) {
    $value = "";
    if ($_POST['Save'] == 'UpdatePassword') {
        $value = 'password';
    } else if ($_POST['Save'] == 'UpdateNumber') {
        $value = 'mobile';
        
    } else if ($_POST['Save'] == 'UpdateUsername') {
        $value = 'name';
    }
    $current = $_POST['current'];
    $new     = $_POST['new'];
    $confirm = $_POST['conf'];
    
    $savedata = new user();
    $savedata->usersettings($_SESSION['username'], $value, $current, $new, $confirm);
}
?>
<div id="usersettings"> 
    <ul id="setting">
    <span>SELECT AN OPTION</span>
        <li class="changes"><button id="btnpass" class="option">Change Password</button></li>
        <li class="changes"><button id="btnnum" class="option">Mobile Number</button></li>
        <li class="changes"><button id="btnname" class="option">Name</button></li>
    </ul>

    <div id="changepassword">
        <form action="userSettings.php" method="POST"> 
        <input placeholder="Enter Current Passsword" name="current" class="detail" required>
        <p></p>
        <input placeholder="Enter New Passsword" name="new" class="detail" required>
        <p></p>
        <input placeholder="Please Confirm Passsword" name="conf" class="detail" required>
        <p></p>
        <input type="submit" value="UpdatePassword" name="Save" class="detailbutton">
        </form>
    </div>

    <div id="changenumber">
        <form action="userSettings.php" method="POST">
        <input placeholder="Enter Current Number" name="current" class="detail"  required>
        <p></p>
        <input placeholder="Enter New Number" name="new" class="detail" required>
        <p></p>
        <input placeholder="Please Confirm Number" name="conf" class="detail" required>
        <p></p>
        <input type="submit" value="UpdateNumber" name="Save" class="detailbutton">
        </form>
    </div>

    <div id="changename">
    <form action="userSettings.php" method="POST">
        <input placeholder="Enter Current Full Name" name="current"  class="detail" required>
        <p></p>
        <input placeholder="Enter New Full Name" name="new" class="detail" required>
        <p></p>
        <input placeholder="Please Confirm Full Name" name="conf" class="detail" required>
        <p></p>
        <input type="submit" value="UpdateUsername" name="Save" class="detailbutton">
        </form>
    </div>
</div>