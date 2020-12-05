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
include_once ('user.php');
if (isset($_POST['Save']))
{
if ($_POST['Save'] == 'UpdateNumber')
    {
        $value = 'mobile';

    }
    else if ($_POST['Save'] == 'Updatename')
    {
        $value = 'name';
    }
    $current = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['conf'];

    $savedata = new user();
    $savedata->usersettings($_SESSION['username'], $value, $current, $new, $confirm);
}
?>

<div id="usersettings"> 
    <ul id="setting">
    <span id="info">UPDATE INFORMATION</span>
        <li class="changes"><button id="btnnum" pattern="^[a-zA-Z ]*$"  class="option">Mobile Number</button></li>
        <li class="changes"><button id="btnname" pattern="^[a-zA-Z ]*$" class="option">Name</button></li>
    </ul>

    <div id="changenumber">
        <form action="userSettings.php" method="POST">
        <input placeholder="Enter Current Number" name="current" class="detail"  pattern="[1-9]{1}[0-9]{9}" required>
        <p></p>
        <input placeholder="Enter New Number" name="new" class="detail"  pattern="[1-9]{1}[0-9]{9}" required>
        <p></p>
        <input placeholder="Please Confirm Number" name="conf" class="detail"  pattern="[1-9]{1}[0-9]{9}" required>
        <p></p>
        <input type="submit" value="UpdateNumber" name="Save" class="detailbutton">
        </form>
    </div>

    <div id="changename">
    <form action="userSettings.php" method="POST">
        <input  placeholder="Enter Current Full Name" name="current"  class="detail" value="<?php if(isset($_SESSION['userid'])){ echo $_SESSION['userid'];} ?>"   required>
        <p></p>
        <input  placeholder="Enter New Full Name" name="new" class="detail" required>
        <p></p>
        <input  placeholder="Please Confirm Full Name" name="conf" class="detail" required>
        <p></p>
        <input type="submit" value="Updatename" name="Save" class="detailbutton">
        </form>
    </div>

<div id=pad></div>
</div>
<?php include ('footer.php'); ?>
