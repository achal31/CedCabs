<?php include('headeruser.php');
session_start();
include_once('user.php');
if(isset($_POST['Save']))
{ 
    $current="";
    $new="";
    $confirm="";

    if($_POST['Save']=='change Password')
    {
      $current=$_POST['currentpass'];
      $new=$_POST['newpass'];
      $confirm=$_POST['confpass']; 

    }
    else if($_POST['Save']=='change Number')
    {
        $current=$_POST['currentnum']; 
        $new=$_POST['newnum'];
        $confirm=$_POST['confnum'];
       
    }
    else if($_POST['Save']=='change Username')
    {
        $current=$_POST['currentname'];
        $new=$_POST['newname'];
        $confirm=$_POST['confname'];   
    }
    $savedata=new user();
    $savedata->usersettings($_SESSION['username'],$_POST['Save'],$current,$new,$confirm);
}
?>
<div id="usersettings"> 
    <ul id="setting">
    <span>SELECT AN OPTION</span>
        <li class="changes"><button id="btnpass">Change Password</button></li>
        <li class="changes"><button id="btnnum">Mobile Number</button></li>
        <li class="changes"><button id="btnname">Name</button></li>
    </ul>

    <div id="changepassword">
        <form action="userSettings.php" method="POST"> 
        <input placeholder="Enter Current Passsword" name="currentpass" required>
        <p></p>
        <input placeholder="Enter New Passsword" name="newpass" required>
        <p></p>
        <input placeholder="Please Confirm Passsword" name="confpass" required>
        <p></p>
        <input type="submit" value="change Password" name="Save">
        </form>
    </div>

    <div id="changenumber">
        <form action="userSettings.php" method="POST">
        <input placeholder="Enter Current Number" name="currentnum" required>
        <p></p>
        <input placeholder="Enter New Number" name="newnum" required>
        <p></p>
        <input placeholder="Please Confirm Number" name="confnum" required>
        <p></p>
        <input type="submit" value="change Number" name="Save">
        </form>
    </div>

    <div id="changename">
    <form action="userSettings.php" method="POST">
        <input placeholder="Enter Current Full Name" name="currentname" required>
        <p></p>
        <input placeholder="Enter New Full Name" name="newname" required>
        <p></p>
        <input placeholder="Please Confirm Full Name" name="confname" required>
        <p></p>
        <input type="submit" value="change Username" name="Save">
        </form>
    </div>
</div>